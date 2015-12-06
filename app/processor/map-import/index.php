<?PHP
	require_once(dirname(__FILE__)."/../../../include/master.inc.php");
	
	require_once(dirname(__FILE__)."/include/config.php");
	require_once(dirname(__FILE__)."/include/FlxZipArchive.php");
	
	$error   = "";
	$success = "";
	
	if(!isLogin()){
		redirect(BASEURL."app/login.php");
	}
	
	if(isset($_POST['upload'])){
		$string = "ogr2ogr -f ";
		$folderId = "";
		
		$outputFile = "";
		$inputFile  = "";
		
		$RESULT = array();
		$downloadFilePath = "";
		
		$target_dir = "../../../uploads/geojson/";
		$target_file = basename($_FILES["sourceUpload"]["name"]);
		
		$_POST['targetFormat'] = 'GeoJSON';
		foreach($_SOURCE_FILE_FORMATS_UNZIP as $key => $value){
			if(in_array(".".strtolower(pathinfo($target_file,PATHINFO_EXTENSION)), $value)){
				$_POST['sourceFormat'] = $key;
				break;
			}
		}
		
		if(//isset($_POST['submit']) && 
		   array_key_exists($_POST['sourceFormat'], $_SOURCE_FILE_FORMATS_UNZIP) && 
		   array_key_exists($_POST['targetFormat'], $_TARGET_FILE_FORMATS)){
			
			global $_SOURCE_FILE_FORMATS_UNZIP;
			global $_SOURCE_FILE_FORMATS_ZIP;
			global $_TARGET_FILE_FORMATS;
			
			$RESULT = array();
			
			if($_FILES["sourceUpload"]["error"] == 0 && 
			   $_FILES["sourceUpload"]["size"] > 0 &&
			   in_array(".".strtolower(pathinfo($target_file,PATHINFO_EXTENSION)), $_SOURCE_FILE_FORMATS_UNZIP[$_POST['sourceFormat']])) {
				
				$temp = $_FILES["sourceUpload"]["tmp_name"];
				$temp = explode("/", $temp);
				$folderId = $temp = end($temp);
				
				if (!file_exists($target_dir) && !is_dir($target_dir)) {
					mkdir($target_dir);         
				}
				$target_dir .= $temp;
				
				if (!file_exists($target_dir) && !is_dir($target_dir)) {
					mkdir($target_dir);         
				}
				$target_dir .= '/';
				
				if (move_uploaded_file($_FILES["sourceUpload"]["tmp_name"], $target_dir.$target_file)) {
					
					$ext      = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
					$fileName = pathinfo($target_file,PATHINFO_FILENAME);
					
					$isGood   = true;
					$EXTENSION = '.'.$ext;
					
					
					if($ext == 'zip'){
						$zip = new ZipArchive;
						$res = $zip->open($target_dir.$target_file);
						
						if ($res === TRUE) {
							
							$zip->extractTo($target_dir);
							$zip->close();
							
							shell_exec("rm ".$target_dir.$target_file);
							$allFiles = scandir($target_dir);
							$count = 0;
							
							foreach($allFiles as $typ) {
								if($typ != '.' && 
								   $typ != '..' && 
								   in_array('.'.strtolower(pathinfo($typ,PATHINFO_EXTENSION)),
										$_SOURCE_FILE_FORMATS_ZIP[$_POST['sourceFormat']]['required'])) {
										$count++;
								}
							}
							
							if($count != count($_SOURCE_FILE_FORMATS_ZIP[$_POST['sourceFormat']]['required'])) {
								
								$RESULT['success'] = false;
								$RESULT['message'] = 'Sorry, invalid zip file.';
								
								foreach($allFiles as $t) {
									shell_exec("rm ".$t);
									shell_exec("rmdir ".$target_dir);
								}
								
								$isGood = false;
							}
							
							if($isGood) {
								$EXTENSION = $_SOURCE_FILE_FORMATS_ZIP[$_POST['sourceFormat']]['inputFormat'];
							}
						} else {
							$RESULT['success'] = false;
							$RESULT['message'] = 'Sorry, there was an error while extracting the file.';
						}
					}
					
					if($isGood) {
						
						$string .= '"'.$_POST['targetFormat'].'" "'.$target_dir.$fileName.$_TARGET_FILE_FORMATS[$_POST['targetFormat']].'" ';
						$string .= '"'.$target_dir.$fileName.$EXTENSION.'"';
						
						/*/ Additional Options
						if($_POST['argument1'] != "") {
							$string .= " -s_srs ".$_POST['argument1']." ";
						}
						
						if($_POST['argument2'] != "") {
							$string .= " -t_srs ".$_POST['argument2']." ";
						}
						if($_POST['argument3'] != "") {
							$string .= " -dsco NameField=".$_POST['argument3']." ";
						}
						if($_POST['argument4'] != "") {
							$string .= " -dsco DescriptionField=".$_POST['argument4']." ";
						}
						if($_POST['argument5'] != "") {
							$string .= " -dsco AltitudeMode=".$_POST['argument5']." ";
						}
						if($_POST['argument6'] != "") {
							$string .= " -where ".'"'.$_POST['argument6']."=";
						}
						if($_POST['argument7'] != "") {
							$string .= "'".$_POST['argument7']."'".'"'." ";
						}
						*/
						
						$shell = shell_exec($string." 2>&1");
						if(strlen($shell) > 5 && (!(strpos(strtolower($shell), 'failure') === FALSE))) {
							$RESULT['success'] = false;
							$RESULT['message'] = 'Error while execution query. Please check your optional fields and File Format';
							
							
							
						}
						else {
							//$downloadFilePath = $folderId.'/'.$fileName.$_TARGET_FILE_FORMATS[$_POST['targetFormat']];
							$FilePath = $target_dir.$fileName.$_TARGET_FILE_FORMATS[$_POST['targetFormat']];
							
							if(is_dir($target_dir.$fileName.$_TARGET_FILE_FORMATS[$_POST['targetFormat']])) {
								
								$za = new FlxZipArchive;
								$res = $za->open($target_dir.$fileName.$_TARGET_FILE_FORMATS[$_POST['targetFormat']].'.zip', ZipArchive::CREATE);
								
								if($res === TRUE) {
									$za->addDir($target_dir.$fileName.$_TARGET_FILE_FORMATS[$_POST['targetFormat']],
											basename($target_dir.$fileName.$_TARGET_FILE_FORMATS[$_POST['targetFormat']]));
									$za->close();
									//$downloadFilePath .= '.zip';
									$FilePath .= '.zip';
								}
							}
							
							$RESULT['success'] = true;
							$RESULT['message'] = file_get_contents($FilePath);
							//shell_exec("rm -r $FilePath");
							//$RESULT['message'] = array($_BASE_URL."download.php?file=".$downloadFilePath, $_BASE_URL."map.php?file=".$downloadFilePath);
							//echo $string;
						}
					}
					else {
						$RESULT['success'] = false;
						$RESULT['message'] = 'Sorry, invalid zip file.';
					}
					
				}
				else {
					$RESULT['success'] = false;
					$RESULT['message'] = 'Sorry, there was an error uploading your file.';
				}
			}
			else {
				$RESULT['success'] = false;
				$RESULT['message'] = 'there was an error uploading your file. Probably incorrect file extension.';
			}
		}
		else {
			$RESULT['success'] = false;
			$RESULT['message'] = 'Invalid Request.';
		}
		
		
		if($RESULT['success']) {
			//$RESULT['message'] Here is your geoJson file Content Please proceed with map creation
			$success = "Successfully Map Created!";
		}
		else {
			$error = $RESULT['message'];
		}
	}
	else {
		$error = "Invalid Request";
	}
	
	$_SESSION['response']['map-import']['error']   = $error;
	$_SESSION['response']['map-import']['success'] = $success;
	redirect(BASEURL."app/map-import.php");
?>