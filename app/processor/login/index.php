<?PHP
	require_once(dirname(__FILE__)."/../../../include/master.inc.php");
	$error = "";
	if(isset($_POST['login'])){
		if(!login($_POST['email'],$_POST['password'])) {
			$error = "Invalid Email/Password or Email is not Verified";
		}
		else {
			redirect(BASEURL."app/dashboard.php");
		}
	}
	else {
		$error = "Invalid Request";
	}
	
	$_SESSION['response']['login']['error'] = $error;
	redirect(BASEURL."app/login.php");
?>