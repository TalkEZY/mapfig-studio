<?PHP
	require_once(dirname(__FILE__)."/../include/master.inc.php");
	
	if(activateUser($_GET['key'])) {
		$_SESSION['response']['login']['success'] = "Your account is activated!";
		redirect("login.php");
	}
	else {
		redirect("404.php");
	}
?>