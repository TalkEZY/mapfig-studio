<?PHP
	require_once(dirname(__FILE__)."/../../../include/master.inc.php");
	require_once(dirname(__FILE__)."/../../../include/classes/statistics.class.php");
	
	$error   = "";
	$success = "";
	if(!isLogin()){
		redirect(BASEURL."app/login.php");
	}
	
	if(isset($_POST['submit'])){
		
		$days = (int)$_POST['days'];
		if($days <= 0) {
			$error = "Days are invalid or not specified";
		}
		else {
			if(isset($_POST['cache'])) {
				$maps = getMapsOlderThan($days);
				foreach($maps as $map) {
					@unlink("../../../cache/".md5($map['id']).'.cache');
				}
				
				$success .= count($maps)." Maps cleared from Cache - Older than $days Days<br>";
			}
			if(isset($_POST['maps_database'])) {
				$t = (int)purgMaps($days);
				$success .= $t." Maps deleted from Database - Older than $days Days<br>";
			}
			if(isset($_POST['maps_history'])) {
				$stats = new Statistics();
				$t = (int)$stats->purgStatistics($days);
				$success .= $t." (Map View) Records removed from Database - Older than $days Days<br>";
			}
		}
	}
	else {
		$error = "Invalid Request";
	}
	
	$_SESSION['response']['cache-manager']['error']   = $error;
	$_SESSION['response']['cache-manager']['success'] = $success;
	redirect(BASEURL."app/cache-manager.php");
?>