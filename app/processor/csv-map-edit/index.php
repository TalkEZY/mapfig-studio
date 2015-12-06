<?PHP
	require_once(dirname(__FILE__)."/../../../include/master.inc.php");
	
	$error   = "";
	
	if(!isLogin()){
		$error = "Session Expires";
	}
	
	$user = getUserInfo();
	if(isset($_POST['name']) && isset($_POST['pk']) && isset($_POST['value'])){
		$name  = $_POST['name'];
		$value = $_POST['value'];
		$pk    = $_POST['pk'];
		$pk = explode(',', $pk);
		
		$dontSave   = false;
		
		$nameArray = array("name", "height", "width", "zoom", "password");
		if(in_array($name, $nameArray)){
			if($name == "width"){
				$value = (int)$value;
				if((int)$value < 0 || (int)$value > 1500){
					$error = "Invalid width!";
				}
			}
			else if($name == "height"){
				$value = (int)$value;
				if((int)$value < 0 || (int)$value > 1500){
					$error = "Invalid height!";
				}
			}
			else if($name == "zoom"){
				$value = (int)$value;
				if((int)$value < 0 || (int)$value > 18){
					$error = "Invalid Zoom level!";
				}
			}
		}
		else {
			$error = "Invalid Data Sent";
		}
	}
	
	echo $error;
?>