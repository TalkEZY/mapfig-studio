<?PHP
	require_once(dirname(__FILE__)."/../include/master.inc.php");
	
	$mapId = (int)$_GET['mapid'];
	$map = getMapById($mapId);
	
	$jsonString = getPureJSON($mapId);
	
	echo $jsonString;
	exit;
?>