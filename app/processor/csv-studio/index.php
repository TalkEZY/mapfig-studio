<?PHP
	require_once(dirname(__FILE__)."/../../../include/master.inc.php");
	
	$error   = "";
	$success = "";
	if(!isLogin()){
		redirect(BASEURL."app/login.php");
	}
	
	global $_SOURCE_FILE_FORMATS_UNZIP;
	global $_SOURCE_FILE_FORMATS_ZIP;
	global $_TARGET_FILE_FORMATS;
	
	if(isset($_POST['convert']) && 
		array_key_exists($_POST['sourceFormat'], $_SOURCE_FILE_FORMATS_UNZIP) && 
		array_key_exists($_POST['targetFormat'], $_TARGET_FILE_FORMATS)) {
		
		$string = "ogr2ogr -f ";
		$folderId = "";
		
		$outputFile = "";
		$inputFile  = "";
		
		$downloadFilePath = "";
		
		$target_dir = dirname(__FILE__)."/../../../downloads/2csv/";
		$target_file = basename($_FILES["sourceUpload"]["name"]);
		
		if($_FILES["sourceUpload"]["error"] == 0 && 
		   $_FILES["sourceUpload"]["size"] > 0 &&
		   in_array(".".strtolower(pathinfo($target_file,PATHINFO_EXTENSION)), $_SOURCE_FILE_FORMATS_UNZIP[$_POST['sourceFormat']])) {
			
			$temp = $_FILES["sourceUpload"]["tmp_name"];
			$temp = explode("/", $temp);
			$folderId = $temp = end($temp).generateRandomString(20);
			
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
							
							$error = 'Sorry, invalid zip file.';
							
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
						$error = 'Sorry, there was an error while extracting the file.';
					}
				}
				
				if($isGood) {
					
					$string .= '"'.$_POST['targetFormat'].'" "'.$target_dir.$fileName.$_TARGET_FILE_FORMATS[$_POST['targetFormat']].'" ';
					$string .= '"'.$target_dir.$fileName.$EXTENSION.'"';
					
					// Additional Options
					if($_POST['argument1'] != "") {
						$string .= " -s_srs ".$_POST['argument1']." ";
					}
					
					if($_POST['argument2'] != "") {
						$string .= " -t_srs ".$_POST['argument2']." ";
					}
					
					if($_POST['LINEFORMAT'] != "") {
					 
						$string .= " -lco LINEFORMAT=".$_POST['LINEFORMAT']." ";
						
					}
					if($_POST['GEOMETRY'] != "") {
					
						$string .= " -lco GEOMETRY=".$_POST['GEOMETRY']." ";
					
					}
					if($_POST['CREATE_CSVT'] != "") {
					 
						$string .= " -lco  CREATE_CSVT=".$_POST['CREATE_CSVT']." ";
						
						
					}
					if($_POST['SEPARATOR'] != "") {
					   
						$string .= " -lco SEPARATOR=".$_POST['SEPARATOR']." ";
						
					}
					if($_POST['WRITE_BOM'] != "") {
					
						$string .= " -lco WRITE_BOM=".$_POST['WRITE_BOM']." ";
					
					}
				
					if($_POST['argument6'] != "") {
						$string .= " -where ".'"'.$_POST['argument6']."=";
					}
					if($_POST['argument7'] != "") {
						$string .= "'".$_POST['argument7']."'".'"'." ";
					}				
					
					$shell = shell_exec($string." 2>&1");
					if(strlen($shell) > 5 && (!(strpos(strtolower($shell), 'failure') === FALSE))) {
						$error = 'Error while execution query. Please check your optional fields and File Format';
					}
					else {
						$downloadFilePath = $folderId.'/'.$fileName.$_TARGET_FILE_FORMATS[$_POST['targetFormat']];
						
						if(is_dir($target_dir.$fileName.$_TARGET_FILE_FORMATS[$_POST['targetFormat']])) {
							
							$za = new FlxZipArchive;
							$res = $za->open($target_dir.$fileName.$_TARGET_FILE_FORMATS[$_POST['targetFormat']].'.zip', ZipArchive::CREATE);
							
							if($res === TRUE) {
								$za->addDir($target_dir.$fileName.$_TARGET_FILE_FORMATS[$_POST['targetFormat']],
									    basename($target_dir.$fileName.$_TARGET_FILE_FORMATS[$_POST['targetFormat']]));
								$za->close();
								$downloadFilePath .= '.zip';
							}
						}
						
						$success = $target_dir.'../'.$downloadFilePath;
						//echo $string;
					}
				}
				else {
					$error = 'Sorry, invalid zip file.';
				}
				
			}
			else {
				$error = 'Sorry, there was an error uploading your file.';
			}
		}
		else {
			$error = 'there was an error uploading your file. Probably incorrect file extension.';
		}
	}
	else {
		$error = "Invalid Request";
	}
	
	if($success != "") {
		$filename = explode("/",$success);
		$filename = end($filename);
		header("Content-Disposition: attachment; filename=".$filename);
		header("Content-Length: ".filesize($success));
		readfile($success);
		die();
	}
	else {
		$_SESSION['response']['csv-studio']['error']   = $error;
		redirect(BASEURL."app/csv-studio.php");
	}
?>