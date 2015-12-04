<?PHP
	$get = $_REQUEST;
	require_once(dirname(__FILE__)."/../../../include/master.inc.php");
	require_once(dirname(__FILE__)."/../common.php");
	$user = getUserByApiKey($get['apikey']);
	
	$error = false;
	$_RESPONSE = array();
	
	$request = strtolower($get['request']);
	$options = $get['options'];
	$sourceFileURL = $get['sourceFileURL'];
	$targetFileExtension = $get['targetFileExtension'];
	
	$fileContent = "";
	$fileExt = "";
	
	if(!$user) {
		$error = true;
		$_RESPONSE['success'] = false;
		$_RESPONSE['message'] = "Invalid API Key!";
	}
	
	/* API CALLS MONITOR */
	global $db;
	pg_query($db, "UPDATE users set apicalls = apicalls+1 WHERE id = ".$user['id']);
	
	if(!$error) {
		if(!in_array($request, array("ogr2ogr", "ogrinfo", "gdal_translate"))) {
			$error = true;
			$_RESPONSE['success'] = false;
			$_RESPONSE['message'] = "Please enter request = ogr2ogr, ogrinfo or, gdal_translate";
		}
	}
	
	if(!$error) {
		$fileExt = explode(".", $sourceFileURL);
		$fileExt = end($fileExt);
		
		if(!($fileContent = file_get_contents($sourceFileURL))) {
			$error = true;
			$_RESPONSE['success'] = false;
			$_RESPONSE['message'] = "Invalid URL provided. Valid format is: http(s)://(www.)website.com/path/to/file.ext";
		}
	}
	
	if($request != "ogrinfo") {
		if(!$error) {
			if(strlen($targetFileExtension) > 10) {
				$error = true;
				$_RESPONSE['success'] = false;
				$_RESPONSE['message'] = "Invalid file extension";
			}
		}
		
		if(!$error) {
			if($targetFileExtension[0] != ".") {
				$targetFileExtension = ".".$targetFileExtension;
			}
		}
	}
	else {
		$targetFileExtension = "";
	}
	
	if(!$error) {
		$rand = md5(time().generateRandomString(32));
		$source = "../../../downloads/gdal/".$rand.".".$fileExt;
		
		$target = "";
		if($targetFileExtension != "") {
			$target = "../../../downloads/gdal/".$rand."_target".$targetFileExtension;
		}
		
		file_put_contents($source, $fileContent);
		
		if($request == "gdal_translate") {
			$output = shell_exec($request." ".$options." ".$source." ".$target." 2>&1");
		}
		else {
			$output = shell_exec($request." ".$options." ".$target." ".$source." 2>&1");
		}
		
		shell_exec("rm ".$source);
		
		if($request == "ogrinfo") {
			$_RESPONSE['success'] = true;
			$_RESPONSE['message'] = str_replace("../../../downloads/gdal/","",$output);
		}
		else if(file_exists($target)) {
			$_RESPONSE['success'] = true;
			$_RESPONSE['message'] = BASEURL."downloads/gdal/".$rand."_target".$targetFileExtension;
		}
		else {
			$_RESPONSE['success'] = false;
			$_RESPONSE['message'] = str_replace("../../../downloads/gdal/","",$output);
		}
	}
	
	echo json_encode($_RESPONSE);
?>