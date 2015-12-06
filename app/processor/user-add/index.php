<?PHP
	require_once(dirname(__FILE__)."/../../../include/master.inc.php");
	
	$error   = "";
	$success = "";
	if(!isLogin()){
		redirect(BASEURL."app/login.php");
	}
	$user  = getUserInfo();
	
	if(!$user || !isAdmin($user)) {
		redirect(BASEURL."app/index.php");
	}
	
	if(isset($_POST['save'])){
		if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$error = "Invalid Email!";
		}
		else if(strlen($_POST['firstname']) < 2 || strlen($_POST['firstname']) > 255){
			$error = "First Name too short/long";
		}
		else if(strlen($_POST['lastname']) < 2 || strlen($_POST['lastname']) > 255){
			$error = "Last Name too short/long";
		}
		else if(strlen($_POST['password'])<8) {
			$error = "Password should be min of 8 characters long!";
		}
		else if(!register($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password'], (int)$user['id'], isset($_POST['send_welcome']))) { // default dont send welcome email
			$error = "Email already Exists";
		}
		else {
			$success = "User Successfully Created.";
		}
	}
	else {
		$error = "Invalid Request";
	}
	
	$_SESSION['response']['user-add']['error']   = $error;
	$_SESSION['response']['user-add']['success'] = $success;
	redirect(BASEURL."app/user-add.php");
?>