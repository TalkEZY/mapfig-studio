<?PHP
	$get = $_REQUEST;
	require_once(dirname(__FILE__)."/../../../include/master.inc.php");
	require_once(dirname(__FILE__)."/../common.php");
	$user = getUserByApiKey($get['apikey']);
	
	$error = false;
	$_RESPONSE = array();
	$mapId = (int)$get['id'];
	
	if(!$user) {
		$error = true;
		$_RESPONSE['success'] = false;
		$_RESPONSE['message'] = "Invalid API Key!";
	}
	
	/* API CALLS MONITOR */
	global $db;
	pg_query($db, "UPDATE users set apicalls = apicalls+1 WHERE id = ".$user['id']);
	
	if($mapId == 0) {
		$error = true;
		$_RESPONSE['success'] = false;
		$_RESPONSE['message'] = "Invalid Map Id!";
	}
	
	if(!$error) {
		if(!userHasMapAccess($user['id'], $mapId)) {
			$error = true;
			$_RESPONSE['success'] = false;
			$_RESPONSE['message'] = "You dont have access to the Map.";
		}
	}
	
	if(!$error) {
		$map = getMapById($mapId);
		
		if(!$map) {
			$error = true;
			$_RESPONSE['success'] = false;
			$_RESPONSE['message'] = "Map not found!";
		}
		else {
			$temp = str_replace(array("[","]"), array("",""), $map['mapcenter']);
			$temp = explode(",", $temp);
			$centerLat = (float)$temp[0];
			$centerLng = (float)$temp[1];
			
			$MAP = array(
						"id" => $mapId,
						"name" => $map['name'],
						"height" => $map['height'],
						"width" => $map['width'],
						"zoom" => $map['zoom'],
						"centerLatitude" => $centerLat,
						"centerLongitude" => $centerLng,
						"layerId" => $map['layers_id'],
						"groupId" => $map['groups_id'],
						"buttonStyle" => $map['button_style'],
						"password" => $map['password'],
						"useCluster" => ($map['cluster'] == "t"),
						"overlayEnable" => ($map['overlay_enable'] == "t"),
						"overlayTitle" => $map['overlay_title'],
						"overlayContent" => $map['overlay_content'],
						"overlayBlurb" => $map['overlay_blurb'],
						"legendEnable" => ($map['legend_enable'] == "t"),
						"legendContent" => $map['legend_content'],
						"projectId" => $map['projects_id'],
						"showSidebar" => ($map['showsidebar'] == "t"),
						"showExport" => ($map['show_export'] == "t"),
						"showMeasure" => ($map['show_measure'] == "t"),
						"showMinimap" => ($map['show_minimap'] == "t"),
						"showSearch" => ($map['show_search'] == "t"),
						"showFilelayer" => ($map['show_filelayer'] == "t"),
						"showSvg" => ($map['show_svg'] == "t"),
						"showStaticSidebar" => ($map['show_static_sidebar'] == "t"),
						"staticSidebarContent" => $map['static_sidebar_content'],
						"imageOverlays" => $map['image_overlays']
					);
			
			$shapes = getShapesByMapId($mapId);
			
			$Markers = array();
			foreach($shapes as $shape) {
				if(substr_count($shape['coordinates'], "[") == 1) {
					$temp = str_replace(array("[","]"), array("",""), $shape['coordinates']);
					$temp = explode(",", $temp);
					$lat = (float)$temp[0];
					$lng = (float)$temp[1];
					
					$properties       = (array)json_decode($shape['properties']);
					$style            = (array)json_decode($shape['style']);
					$customproperties = (array)json_decode($shape['customproperties']);
					
					$Markers[] = array(
						"latitude"  => $lng,
						"longitude" => $lat,
						"location" => $properties[0]->value,
						"description" => $properties[1]->value,
						"showGetDirection" => ($customproperties['get_direction'] == "t"),
						"showInfoBox" => ($customproperties['bootstrap_popup'] == "t"),
						"showLocationOnPopup" => ($customproperties['show_address_on_popup'] == "t"),
						"hideLabel" => ($customproperties['hide_label'] == "t"),
						"markerStyle" => $style['icon'],
						"markerColor" => $style['markerColor']
					);
				}
			}
			
			$MAP["markers"] = $Markers;
			
			$_RESPONSE['success'] = true;
			$_RESPONSE['message'] = json_encode($MAP);
		}
	}
	
	echo json_encode($_RESPONSE);
?>