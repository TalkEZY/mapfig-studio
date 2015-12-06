<?PHP
	require_once(dirname(__FILE__)."/../../../include/master.inc.php");
	require_once(dirname(__FILE__)."/../../../include/classes/statistics.class.php");
	
	if(!isLogin()){
		redirect(BASEURL); // Session Expired
	}
	
	$timeframe = $_GET['timeframe'];
	$country   = $_GET['country'];
	$apikey    = $_GET['apikey'];
	$browser   = $_GET['browser'];
	
	$stats = new Statistics($_SESSION['user']['id']);
	$data = time();
	
	switch($timeframe) {
		case "1 Hour":
			$date = strtotime("-59 minutes");
		break;
		
		case "12 Hours":
			$date = strtotime("-11 hours");
		break;
		
		case "1 Day":
			$date = strtotime("-23 hours");
		break;
		
		case "1 Week":
			$date = strtotime("-6 days");
		break;
		
		case "1 Month":
			$date = strtotime("-29 days");
		break;
		
		case "3 Months":
			$date = strtotime("-89 days");
		break;
		
		case "1 Year":
			$date = strtotime("-365 days");
		break;
		
		case "3 Years":
			$date = strtotime("-795 days");
		break;
		
		default:
			die("Invalid Timeframe");
	}
	$rows = $stats->getStatistics($date, $country, $apikey, $browser);
	
	
	$data = "ID,Map Id,Map Name, API Key,View Time,Viewer IP,Host Name,City,Region,Country,Organization,Postal Code,Phone #,Referer URL,Browser Name, Browser Version, Operating System\n";
	$i = 1;
	foreach($rows as $row) {
		$data .= ($i++).",".$row['maps_id'].",".$row['maps_name'].",".$row['apikey'].",".$row['viewed_at'].",".$row['ip'].",".$row['hostname'].",".$row['city'].",".$row['region'].",".$row['country'].",".$row['org'].",".$row['postal'].",".$row['phone'].",".$row['referer_url'].",".$row['browser_name'].",".$row['browser_version'].",".$row['os']."\n";
	}
	
	
	header("Content-type: text/csv");
	header("Content-Disposition: attachment; filename=".$timeframe.".csv");
	header("Expires: 0");
	echo $data;
?>