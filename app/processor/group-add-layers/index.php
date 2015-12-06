<?PHP
	require_once(dirname(__FILE__)."/../../../include/master.inc.php");
	
	$error   = "";
	$success = "";
	if(!isLogin()){
		redirect(BASEURL."app/login.php");
	}
	
	if(isset($_POST['save'])){
		if(!addGroupHasLayers($_SESSION['user']['id'], (int)$_POST['id'], $_POST['assigned'])){
			$error = "Something went wrong. Please refresh and try again!";
		}
		else {
			$success = "Successfully Saved!";
		}
	}
	else {
		$error = "Invalid Request";
	}
	
	$_SESSION['response']['group-add-layers']['error']   = $error;
	$_SESSION['response']['group-add-layers']['success'] = $success;
	redirect(BASEURL."app/group-add-layers.php?id=". (int)$_POST['id']);
?>