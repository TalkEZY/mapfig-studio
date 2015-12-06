<?PHP
	global $db;
	
	if(isLogin()) {
		if(isAdmin(getUserInfo())) {
			define("CSV_ROWS_LIMIT",10000000);
		}
		else {
			define("CSV_ROWS_LIMIT",100);
		}
	}
?>