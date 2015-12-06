<?PHP
	if(file_get_contents(dirname(__FILE__)."/db.config.php") == "") {
		header("Location: ../install");
	}
	
	$db = pg_connect("host=".DB_HOST." port=".DB_PORT." dbname=".DB_NAME." user=".DB_USER." password=".DB_PASS) or die('<h2>Error While Establishing the Connection</h2>');
	$stats_db = pg_connect("host=".DB_HOST." port=".DB_PORT." dbname=".DB_NAME_STATS." user=".DB_USER." password=".DB_PASS) or die('<h2>Error While Establishing the Connection to Stats DB</h2>');
?>