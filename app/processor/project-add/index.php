<?PHP
	require_once(dirname(__FILE__)."/../../../include/master.inc.php");
	
	$error   = "";
	$success = "";
	if(!isLogin()){
		redirect(BASEURL."app/login.php");
	}
	
	if(isset($_POST['save'])){
		if(strlen($_POST['name'])<2) {
			$error = "Project Name Too Short.";
		}
		else if(!addProject($_SESSION['user']['id'], $_POST['name'])){
			$error = "Something went wrong. Please refresh and try again!";
		}
		else {
			$success = "Successfully Added!";
		}
	}
	else {
		$error = "Invalid Request";
	}
	
	$_SESSION['response']['project-add']['error']   = $error;
	$_SESSION['response']['project-add']['success'] = $success;
	redirect(BASEURL."app/project-add.php");
?>