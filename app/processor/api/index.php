<?PHP
	require_once(dirname(__FILE__)."/../../../include/master.inc.php");
	$error = "";
	if(!isLogin()){
		redirect(BASEURL."app/login.php");
	}
	else if(isset($_POST['api'])){
		$apikey = refreshAPIKEY($_SESSION['user']['id']);
		if($apikey){
			$_SESSION['user']['apikey'] = $apikey;
		}
	}
	
	redirect(BASEURL."app/api.php");
?>