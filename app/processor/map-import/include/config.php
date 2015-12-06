<?PHP
	session_start();
	$_BASE_URL = "http://2geojson.com/";
	
	$_SOURCE_FILE_FORMATS_UNZIP = array(
		"CSV"		 => array(".csv"),
		"GeoJSON" 	 => array(".json"),
		"KML"		 => array(".kml"),
		"GPX" 		 => array(".gpx"),
        //"KMZ"		 => array(".kmz"),
	);
	
	$_SOURCE_FILE_FORMATS_ZIP = array(
		
	);
	
	$_TARGET_FILE_FORMATS = array(
		"GeoJSON" => ".json"
	);
?>