<?PHP
	$_SOURCE_FILE_FORMATS_UNZIP = array(
		"ESRI Shapefile" => array(".shp", ".zip"),
		"CSV"		 => array(".csv"),
		"KML"		 => array(".kml"),
		"GeoJSON" 	 => array(".json"),
		"GPX" 		 => array(".gpx"),
		"DGN" 		 => array(".dgn"),
		"DXF" 		 => array(".dxf"),
		"GeoConcept" => array(".gxt", ".txt"),
		"BNA" 		 => array(".bna"),
		"GeoRSS" 	 => array(".rss", ".georss", ".xml"),
		"GMT" 		 => array(".gmt"),
		"MapInfo File" 	 => array(".zip",
					 "zip" => array(
							"required" => array(".tab", ".map", ".id", ".dat"),
							"optional" => array()
						)
				 )
	);
	
	$_SOURCE_FILE_FORMATS_ZIP = array(
		"ESRI Shapefile" => array(
					"required" => array(".shp", ".dbf", ".shx"),
					"optional" => array(".prj"),
					"inputFormat" => '.shp'
				 ),
		"MapInfo File"	 => array(
					"required" => array(".tab", ".map", ".id", ".dat"),
					"optional" => array(),
					"inputFormat" => '.tab'
				 )
	);
	
	$_TARGET_FILE_FORMATS = array(
		"CSV" => ".csv"
		//"GeoJSON" => ".json",
        	//"PGDump" => ".dump"
	);
?>