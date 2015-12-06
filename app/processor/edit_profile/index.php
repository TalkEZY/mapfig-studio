<?PHP
	require_once(dirname(__FILE__)."/../../../include/master.inc.php");
	
	$error   = "";
	$success = "";
	if(!isLogin()){
		redirect(BASEURL."app/login.php");
	}
	
	if(isset($_POST['edit_profile'])){
		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$error = "Invalid Email!";
		}
		else if(strlen($_POST['firstname']) < 2 || strlen($_POST['firstname']) > 255){
			$error = "First Name too short/long";
		}
		else if(strlen($_POST['lastname']) < 2 || strlen($_POST['lastname']) > 255){
			$error = "Last Name too short/long";
		}
		else if(!updateProfile($_SESSION['user']['id'], $_POST['firstname'], $_POST['lastname'], $_POST['email'])) {
			$error = "Email Already in used!";
		}
		else {
			$success = "Profile Successfully Updated!";
		}
	}
	else {
		$error = "Invalid Request";
	}
	
	$_SESSION['response']['edit_profile']['error']   = $error;
	$_SESSION['response']['edit_profile']['success'] = $success;
	redirect(BASEURL."app/edit_profile.php");
?>