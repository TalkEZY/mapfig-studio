<?PHP
	require_once(dirname(__FILE__)."/../include/master.inc.php");
	global $db;
	global $stats_db;
	
	if(isAdmin($_SESSION['user'])) {
		pg_query($db, "VACUUM ANALYZE maps");
		pg_query($db, "VACUUM ANALYZE users");
		pg_query($db, "VACUUM ANALYZE shapes");
		pg_query($db, "VACUUM ANALYZE projects");
		pg_query($db, "VACUUM ANALYZE layers");
		pg_query($db, "VACUUM ANALYZE groups");
		pg_query($db, "VACUUM ANALYZE groups_has_layers");
		pg_query($db, "VACUUM ANALYZE project_has_users");
		pg_query($stats_db, "VACUUM ANALYZE statistics_maps_view");
		
		redirect("cache-manager.php?msg=VACUUM/ANALYZE Successfully performed");
	}
	else {
		redirect("cache-manager.php");
	}
?>