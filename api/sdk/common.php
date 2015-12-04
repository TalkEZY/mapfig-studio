<?PHP
	require_once(dirname(__FILE__)."/../../include/master.inc.php");
	$cronTimeFile = dirname(__FILE__)."/api.cron";
	
	if (file_exists($cronTimeFile)) {
		if(date ("F d Y", filemtime($cronTimeFile)) != date ("F d Y", time())) {
			global $db;
			pg_query($db, "UPDATE users set apicalls = 0");
			file_put_contents($cronTimeFile, "");
		}
	}
	else {
		file_put_contents($cronTimeFile, "");
	}
?>