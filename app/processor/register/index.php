<?PHP
	require_once(dirname(__FILE__)."/../../../include/master.inc.php");
	$error = "";
	if(isset($_POST['register'])){
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
		else if(!register($_POST['firstname'], $_POST['lastname'], $_POST['email'],$_POST['password'])) {
			$error = "Email is already Registered!";
		}
		else {
			$_SESSION['response']['login']['success'] = "An Activation email is sent to your account. Please check and verify.";
			redirect(BASEURL."app/login.php");
		}
	}
	else {
		$error = "Invalid Request";
	}
	$_SESSION['response']['register']['error'] = $error;
	redirect(BASEURL."app/register.php");
?>