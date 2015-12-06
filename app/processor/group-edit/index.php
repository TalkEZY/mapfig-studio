<?PHP
	require_once(dirname(__FILE__)."/../../../include/master.inc.php");
	
	$error   = "";
	$success = "";
	if(!isLogin()){
		redirect(BASEURL."app/login.php");
	}
	
	if(isset($_POST['save'])){
		if(strlen($_POST['name'])<2) {
			$error = "Layer Name Too Short.";
		}
		else if(!updateGroup($_SESSION['user']['id'], $_POST['id'], $_POST['name'])){
			$error = "Something went wrong. Please refresh and try again!";
		}
		else {
			$success = "Successfully Updated!";
		}
	}
	else {
		$error = "Invalid Request";
	}
	
	$_SESSION['response']['group-edit']['error']   = $error;
	$_SESSION['response']['group-edit']['success'] = $success;
	redirect(BASEURL."app/group-edit.php?id=".$_POST['id']);
?>