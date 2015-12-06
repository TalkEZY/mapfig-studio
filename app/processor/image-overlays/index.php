<?PHP
	require_once(dirname(__FILE__)."/../../../include/master.inc.php");
	$response = array();
	
	if(!isLogin()){
		$response = array('success' => false, 'message' => 'Session expired');
	}
	
	$rand = generateRandomString(10);
	$image_url = "app/mapplates/images/image_overlays_".$rand.'/';
	$target_dir = "../../mapplates/images/image_overlays_".$rand;
	shell_exec("mkdir ".$target_dir);
	$target_file = $target_dir .'/'. basename($_FILES["image_overlays_file"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["image_overlays_file"]["tmp_name"]);
		if($check !== false) {
			$uploadOk = 1;
		} else {
			$response = array('success' => false, 'message' => 'File is not an image');
			$uploadOk = 0;
		}
	}
	// Check if file already exists
	if (file_exists($target_file)) {
		$response = array('success' => false, 'message' => 'Sorry, file already exists');
		$uploadOk = 0;
	}
	// Check file size
	if ($_FILES["image_overlays_file"]["size"] > 500000) {
		$response = array('success' => false, 'message' => 'Sorry, your file is too large');
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		$response = array('success' => false, 'message' => 'Sorry, only JPG, JPEG, PNG & GIF files are allowed');
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		$response = array('success' => false, 'message' => 'Sorry, your file was not uploaded');
	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["image_overlays_file"]["tmp_name"], $target_file)) {
			$response = array('success' => true, 'src' => $image_url.$_FILES["image_overlays_file"]["name"], 'name' => $_FILES["image_overlays_file"]["name"]);
		} else {
			$response = array('success' => false, 'message' => 'Sorry, there was an error uploading your file');
		}
	}
	
	echo json_encode($response);
?>