<?PHP
	require_once(dirname(__FILE__)."/../../../include/master.inc.php");
	require_once(dirname(__FILE__)."/../../../include/classes/statistics.class.php");
	
	if(!isLogin()){
		die(); // Session Expired
	}
	
	$timeframe = $_POST['timeframe'];
	$country   = $_POST['country'];
	$apikey    = $_POST['apikey'];
	$browser   = $_POST['browser'];
	if(!in_array($timeframe, array("1 Hour", "12 Hours", "1 Day", "1 Week", "1 Month", "3 Months", "1 Year", "3 Years"))) {
		die(); // invalid timeframe
	}
	
	$stats = new Statistics($_SESSION['user']['id']);
	
	$recurrent = $stats->getRecentMapViews($timeframe, $country, $apikey, $browser);
	$unique    = $stats->getUniqueMapViews($timeframe, $country, $apikey, $browser);
	
	
	$data1 = array();
	foreach($recurrent as $r) {
		$data1[] = array($r['date'], (int)$r['count']);
	}
	
	$data2 = array();
	foreach($unique as $r) {
		$data2[] = array($r['date'], (int)$r['count']);
	}
	
	
	$data = array (
				array (
					"label" => "Recurrent",
					"color" => "#768294",
					"data" => $data1
				),
				array (
					"label" => "Uniques",
					"color" => "#1f92fe",
					"data" => $data2
				),
			);
	
	echo json_encode($data);
?>