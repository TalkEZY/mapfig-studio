<?PHP
	require_once(dirname(__FILE__)."/../../../include/master.inc.php");
	
	$error   = "";
	$success = "";
	if(!isLogin()){
		redirect(BASEURL."app/login.php");
	}
	
	if(isset($_POST['change_password'])){
		if(strlen($_POST['cpassword'])<8) {
			$error = "Password should be min of 8 characters long!";
		}
		else if(strlen($_POST['password'])<8) {
			$error = "Password should be min of 8 characters long!";
		}
		else if($_POST['password'] != $_POST['password2']) {
			$error = "Password mismatched!";
		}
		else if(!changePassword($_SESSION['user']['id'], $_POST['cpassword'], $_POST['password'])){
			$error = "Password Not Matched!";
		}
		else {
			$success = "Password Successfully Changed!";
		}
	}
	else {
		$error = "Invalid Request";
	}
	
	$_SESSION['response']['change_password']['error']   = $error;
	$_SESSION['response']['change_password']['success'] = $success;
	redirect(BASEURL."app/change_password.php");
?>