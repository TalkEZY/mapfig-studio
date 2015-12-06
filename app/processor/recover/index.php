<?PHP
	require_once(dirname(__FILE__)."/../../../include/master.inc.php");
	$error   = "";
	$success = "";
	if(isset($_POST['recover'])){
		if(!recover($_POST['email'])) {
			$error = "Invalid Email.";
		}
		else {
			$success = "Password successfully sent to the respective Email Address.";
		}
	}
	else {
		$error = "Invalid Request";
	}
	
	if($error != "") {
		$_SESSION['response']['recover']['error'] = $error;
		redirect(BASEURL."app/recover.php");
	}
	else if($success != "") {
		$_SESSION['response']['login']['success'] = $success;
		redirect(BASEURL."app/index.php");
	}
?>