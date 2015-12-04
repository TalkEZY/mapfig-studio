<?PHP
	$get = $_POST;
	require_once(dirname(__FILE__)."/../../../include/master.inc.php");
	require_once(dirname(__FILE__)."/../common.php");
	$map = (array)json_decode($get['map']);
	$user = getUserByApiKey($get['apikey']);
	
	$error = false;
	$_RESPONSE = array();
	$mapId = 0;
	
	
	if(!$map) {
		$error = true;
		$_RESPONSE['success'] = false;
		$_RESPONSE['message'] = "Invalid Data Format!";
	}
	
	if(!$user) {
		$error = true;
		$_RESPONSE['success'] = false;
		$_RESPONSE['message'] = "Invalid API Key!";
	}
	
	/* API CALLS MONITOR */
	global $db;
	pg_query($db, "UPDATE users set apicalls = apicalls+1 WHERE id = ".$user['id']);
	
	if(!$error) {
		$map['layerId'] = (int)$map['layerId'];
		
		if($map['layerId'] != 1 && !getLayerByIdAndUserId($user['id'], $map['layerId'])) {
			$error = true;
			$_RESPONSE['success'] = false;
			$_RESPONSE['message'] = "Base Layer with given Id not found!";
		}
	}
	
	if(!$error) {
		$map['groupId'] = (int)$map['groupId'];
		
		if($map['groupId'] != 0 && !getGroupById($user['id'], $map['groupId'])) {
			$error = true;
			$_RESPONSE['success'] = false;
			$_RESPONSE['message'] = "Base Layer Group with given Id not found!";
		}
	}
	
	if(!$error) {
		$map['projectId'] = (int)$map['projectId'];
		
		if($map['projectId'] != 0) {
			
			if(isAdmin($user)) {
				$projects = getProjectsByUserId($user['id']);
			}
			else {
				$projects = getMyProjects($user['id']);
			}
			
			$found = false;
			foreach($projects as $p) {
				if($p['id'] == $map['projectId']) {
					$found = true;
				}
			}
			
			if(!$found) {
				$error = true;
				$_RESPONSE['success'] = false;
				$_RESPONSE['message'] = "Project with given Id not found!";
			}
		}
	}
	
	if(!$error) {
		$name     = $map['name'];
		$height   = ((int)$map['height'] == 0) ? 500 : (int)$map['height'];
		$width    = ((int)$map['width'] == 0) ? 500 : (int)$map['width'];
		$zoom     = ((int)$map['zoom'] == 0) ? 8 : (int)$map['zoom'];
		
		$center      = "[".$map['centerLatitude'].",".$map['centerLongitude']."]";
		$showsidebar = $map['showSidebar'] ? 'true' : 'false';
		$defaultopen = $map['defaultOpen'] ? 'true' : 'false';
		$password    = $map['password'];
		
		$mapId = createMap($user['id'], $height, $width, $zoom, $defaultopen, $showsidebar, 'true', $name, $center, $password, '[]');
		if(!$mapId) {
			$error = true;
		}
	}
	
	if(!$error) {
		$useCluster      = $map['useCluster'] ? 'true' : 'false';
		$overlayEnable   = $map['overlayEnable'] ? 'true' : 'false';
		$overlayTitle    = $map['overlayTitle'];
		$overlayBlurb    = $map['overlayBlurb'];
		$overlayContent  = $map['overlayContent'];
		$legendEnable    = $map['legendEnable'] ? 'true' : 'false';
		$legendContent   = $map['legendContent'];
		
		updateMap($mapId, $user['id'], 'cluster', $useCluster);
		updateMap($mapId, $user['id'], 'overlay_enable', $overlayEnable);
		updateMap($mapId, $user['id'], 'overlay_title', $overlayTitle);
		updateMap($mapId, $user['id'], 'overlay_blurb', $overlayBlurb);
		updateMap($mapId, $user['id'], 'overlay_content', $overlayContent);
		updateMap($mapId, $user['id'], 'legend_enable', $legendEnable);
		updateMap($mapId, $user['id'], 'legend_content', $legendContent);
		
		$showExport             = $map['showExport'] ? 'true' : 'false';
		$showMeasure            = $map['showMeasure'] ? 'true' : 'false';
		$showMinimap            = $map['showMinimap'] ? 'true' : 'false';
		$showFilelayer          = $map['showFilelayer'] ? 'true' : 'false';
		$showSvg                = $map['showSvg'] ? 'true' : 'false';
		$showSearch             = $map['showSearch'] ? 'true' : 'false';
		$showPlayback           = $map['showPlayback'] ? 'true' : 'false';
		$showStaticSidebar      = $map['showStaticSidebar'] ? 'true' : 'false';
		$staticSidebarContent   = $map['staticSidebarContent'];
		
		updateMap($mapId, $user['id'], 'show_export', $showExport);
		updateMap($mapId, $user['id'], 'show_measure', $showMeasure);
		updateMap($mapId, $user['id'], 'show_minimap', $showMinimap);
		updateMap($mapId, $user['id'], 'show_filelayer', $showFilelayer);
		updateMap($mapId, $user['id'], 'show_svg', $showSvg);
		updateMap($mapId, $user['id'], 'show_search', $showSearch);
		updateMap($mapId, $user['id'], 'show_playback', $showPlayback);
		updateMap($mapId, $user['id'], 'show_static_sidebar', $showStaticSidebar);
		updateMap($mapId, $user['id'], 'static_sidebar_content', $staticSidebarContent);
		
		updateMap($mapId, $user['id'], 'layers_id', $map['layerId']);
		updateMap($mapId, $user['id'], 'groups_id', $map['groupId']);
		updateMap($mapId, $user['id'], 'projects_id', $map['projectId']);
		
		updateMap($mapId, $user['id'], 'image_overlays', json_encode($map['imageOverlays']));
		
		$properties = array();
		$type = array();
		$coordinates = array();
		$styles = array();
		$shapeCustomProperties = array();
		
		foreach($map['markers'] as $marker) {
			$marker = (array)$marker;
			
			$marker['showGetDirection'] = $marker['showGetDirection'] ? 'true' : 'false';
			$marker['showInfoBox'] = $marker['showInfoBox'] ? 'true' : 'false';
			$marker['showLocationOnPopup'] = $marker['showLocationOnPopup'] ? 'true' : 'false';
			$marker['hideLabel'] = $marker['hideLabel'] ? 'true' : 'false';
			
			$properties[] = '[{"name":"Location","value":"'.$marker['location'].'","defaultProperty":true},{"name":"Popu-Up Content","value":"'.$marker['description'].'","defaultProperty":false}]';
			$type[] = 'Point';
			$coordinates[] = '['.$marker['longitude'].','.$marker['latitude'].']';
			
			$styles[] = '{"icon":"'.$marker['markerStyle'].'","prefix":"fa","markerColor":"'.$marker['markerColor'].'"}';
			$shapeCustomProperties[] = '{"get_direction":'.$marker['showGetDirection'].',"bootstrap_popup":'.$marker['showInfoBox'].',"show_address_on_popup":'.$marker['showLocationOnPopup'].',"hide_label":'.$marker['hideLabel'].'}';
		}
		
		updateShapes($mapId, $properties, $type, $coordinates, $styles, $shapeCustomProperties, $user['id']);
		
		$_RESPONSE['success'] = true;
		$_RESPONSE['message'] = array(	'id'       => $mapId, 
										'view'     => BASEURL."app/map-view.php?mapid=".$mapId, 
										'download' => BASEURL."app/map-download-html.php?mapid=".$mapId, 
										'iframe'   => "<iframe src='".BASEURL."app/map-view.php?mapid=".$mapId."' allowfullscreen='yes' height='".$height."' width='".$width."' scrolling='no' style='border:none'></iframe>");;
	}
	
	echo json_encode($_RESPONSE);
?>