<?PHP
	require_once(dirname(__FILE__)."/../../../include/master.inc.php");
	
	/* Config Start */
	$requiredColumns = array("latitude", "longitude");
	$requiredFound   = 0;
	
	$columnIndexes   = array();
	$rowIndexes      = array();
	
	$validRows       = array();
	$validHead       = array();
	
	$stylingColumn = $_POST['stylingColumn'];
	$shapeStyling  = json_decode($_POST['shapeStyling']);
	
	$shapeIds = explode(',', $_POST['shape-ids']);
	/* Config End */
	
	if(strlen($stylingColumn) != 0) {
		for($i=0; $i<count($shapeStyling); $i++) {
			$shapeStyling[$i][1] = (array)json_decode($shapeStyling[$i][1]);
		}
	}
	
	function getStylingByColumnName($column) {
		global $shapeStyling;
		
		$ret = '';
		foreach($shapeStyling as $s) {
			if($s[0] == $column) {
				$ret = $s[1];
			}
		}
		
		return $ret;
	}
	
	function prepareShapeData($row, $index) {
		global $stylingColumn;
		global $requiredColumns;
		global $shapeIds;
		
		$prepare = array();
		$prepare['type']             = "Point";
		$prepare['coordinates']      = json_encode(array((float)$row['longitude'], (float)$row['latitude']));
		
		$properties = array();
		$hasContentColumn = false;
		foreach($row as $key => $value) {
			if(!in_array($key, $requiredColumns)) {
				$isDefault = false;
				if($key == $_POST['defaultProperty']) {
					$isDefault = true;
				}
				$properties[] = array("name" => $key, "value" => $value, "defaultProperty" => $isDefault);
				
				if($key == "Pop-Up Content") {
					$hasContentColumn = true;
				}
			}
		}
		if(!$hasContentColumn) {
			$properties[] = array("name" => 'Pop-Up Content', "value" => '', "defaultProperty" => false);
		}
		
		$prepare['properties']       = json_encode($properties);
		
		if(strlen($stylingColumn) != 0 && $stylingColumn != "[]") {
			$stlngs = getStylingByColumnName($row[$stylingColumn]);
			
			if(is_array($stlngs) && count($stlngs) > 0) {
				$prepare['styles']           = '{"icon":"'.$stlngs['icon'].'","prefix":"'.$stlngs['prefix'].'","markerColor":"'.$stlngs['markerColor'].'"}';
			}
			else {
				$prepare['styles']           = '{"icon":"","prefix":"fa","markerColor":""}';
			}
		} else {
			if(isset($shapeIds[$index])) {
				$sstl = getShapeStyleById($shapeIds[$index]);
				if($sstl) {
					$prepare['styles']           = $sstl;
				}
				else {
					$prepare['styles']           = '{"icon":"","prefix":"fa","markerColor":""}';
				}
			}
			else {
				$prepare['styles']           = '{"icon":"","prefix":"fa","markerColor":""}';
			}
		}
		
		$prepare['customproperties'] = '{"get_direction":false,"bootstrap_popup":false,"show_address_on_popup":true,"hide_label":false}';
		return $prepare;
	}
	
	
	
	
	
	
	$error   = "";
	$success = "";
	if(!isLogin()) {
		redirect(BASEURL."app/login.php");
	}
	
	$userId = $_SESSION['user']['id'];
	
	$csv_data = json_decode($_POST['csv_data']);
		
	$head = $csv_data[0];
	$body = $csv_data;
	array_shift($body);
	
	foreach($head as $key => $val) {
		if($val) { // if not a null record its key
			$columnIndexes[] = $key;
			
			if(in_array(strtolower($val), $requiredColumns)) {
				$validHead[] = strtolower($val);
				$requiredFound++;
			}
			else {
				$validHead[] = $val;
			}
		}
	}
	
	if($requiredFound < count($requiredColumns)) {
		$error = "Required Columns not found";
	}
	
	if(!$error) {
		foreach($body as $key => $value) {
			$requiredFound = 0;
			$row           = array();
			$check         = true;
			
			foreach($columnIndexes as $i => $index) {
				if(in_array(strtolower($validHead[$i]), $requiredColumns) && $body[$key][$index]) {
					$requiredFound++;
				}
				if($body[$key][$index]) {
					$row[$validHead[$i]] = $body[$key][$index];
				}
			}
			
			if($requiredFound >= count($requiredColumns)) {
				$validRows[] = $row;
			}
		}
		
		if(json_decode($_POST['filteredColumns']) == "") {
			$_POST['filteredColumns'] = "[]";
		}
		
		/* All iz Well, Now create map and shapes/markers */
		$mapId = (int)$_POST['csv_id'];
		if(!$mapId) {
			$error = "Map is not Updated!";
		}
		else {
			$properties       = array();
			$type             = array();
			$coordinates      = array();
			$styles           = array();
			$customproperties = array();
			
			$i=0;
			foreach($validRows as $row) {
				$shape = prepareShapeData($row, $i++);
				
				$type[]             = $shape['type'];
				$coordinates[]      = $shape['coordinates'];
				$properties[]       = $shape['properties'];
				$styles[]           = $shape['styles'];
				$customproperties[] = $shape['customproperties'];
			}
			
			updateMap($mapId, $userId, 'stylingcolumn', $_POST['stylingColumn']);
			updateMap($mapId, $userId, 'shapestyling', $_POST['shapeStyling']);
			updateMap($mapId, $userId, 'filteredcolumns', $_POST['filteredColumns']);
			
			updateMap($mapId, $userId, 'name', $_POST['map-name']);
			updateMap($mapId, $userId, 'height', (int)$_POST['map-height']);
			updateMap($mapId, $userId, 'width', (int)$_POST['map-width']);
			updateMap($mapId, $userId, 'zoom', (int)$_POST['map-zoom']);
			updateMap($mapId, $userId, 'password', $_POST['map-password']);
			
			updateShapesPoints($mapId, $properties, $type, $coordinates, $styles, $customproperties);
			
			$_SESSION['csv']['data'] = null;
		}
	}
	
	$_SESSION['response']['csv-edit']['error']   = $error;
	redirect(BASEURL."app/csv-edit.php?id=".$mapId);
?>