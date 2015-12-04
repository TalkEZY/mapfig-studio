<?PHP
	if (!defined('API')) {
		die('Hacking Attempt!');
	}
	
	$get = $_GET;
	$get['request'] = strtolower($get['request']);
	
	$RESPONSE = array();
	
	$user = getUserByApiKey($get['apikey']);
	if($user) {
		
		/* API CALLS MONITOR */
		global $db;
		pg_query($db, "UPDATE users set apicalls = apicalls+1 WHERE id = ".$user['id']);
		
		switch($get['request']) {
			case "get" : 
				$map = getMapByIdAndApiKey($get['mapid'], $get['apikey']);
				
				if($map) {
					$result = array('view'     => BASEURL."app/map-view.php?mapid=".$map['id'],
									'download' => BASEURL."app/map-download-html.php?mapid=".$map['id'],
									'iframe'   => "<iframe src='".BASEURL."app/map-view.php?mapid=".$map['id']."' height='".$map['height']."' width='".$map['width']."' scrolling='no' style='border:none'></iframe>");
					
					$RESPONSE['response']['success'] = true;
					$RESPONSE['response']['message'] = $result;
				}
				else {
					$RESPONSE['response']['success'] = false;
					$RESPONSE['response']['message'] = "invalid Map Id or API Key!";
				}
			break;
			
			case "create" :
				/* Map Properties */
				$name     = $get['address'].' Map';
				$password = $get['password'];
				$height   = ((int)$get['height'] == 0) ? 500 : (int)$get['height'];
				$width    = ((int)$get['width'] == 0) ? 500 : (int)$get['width'];
				$zoom     = ((int)$get['zoom'] == 0) ? 8 : (int)$get['zoom'];
				$showsidebar  = (strtolower($get['showsidebar']) == 'no') ? 'false' : 'true'; // default YES
				$defaultopen  = (strtolower($get['defaultopen']) == 'yes') ? 'true' : 'false'; // default NO
				
				$show_export            = (strtolower($get['show_export']) == 'yes') ? 'true' : 'false'; // default NO
				$show_measure           = (strtolower($get['show_measure']) == 'no') ? 'false' : 'true'; // default YES
				$show_minimap           = (strtolower($get['show_minimap']) == 'no') ? 'false' : 'true'; // default YES
				$show_filelayer         = (strtolower($get['show_local_file_upload']) == 'no') ? 'false' : 'true'; // default YES
				$show_static_sidebar    = (strtolower($get['show_introbox']) == 'yes') ? 'true' : 'false'; // default NO
				$static_sidebar_content = $get['introbox_content'];
				
				$cluster  = (strtolower($get['cluster']) == 'no') ? 'false' : 'true'; // default YES
				$show_overlay    = (strtolower($get['show_overlay']) == 'yes') ? 'true' : 'false'; // default NO
				$overlay_title   = $get['overlay_title']; // default Empty String ''
				$overlay_blurb   = $get['overlay_blurb']; // default Empty String ''
				$overlay_content = $get['overlay_content']; // default Empty String ''
				$show_legend     = (strtolower($get['show_legend']) == 'yes') ? 'true' : 'false'; // default NO
				$legend_content  = $get['legend_content']; // default Empty String ''
				
				/* Marker Properties */
				$latlng = getLatLng($get['address']);
				if($latlng) {
					$address = $get['address'];
					$latitude  = $latlng['lat'];
					$longitude = $latlng['lng'];
					
					$description = isset($get['description']) ? $get['description'] : '';
					$marker_color = strtolower($get['marker_color']);
					$marker_style = strtolower($get['marker_style']);
					
					$get_direction   = (strtolower($get['get_direction']) == 'yes') ? 'true' : 'false';
					$bootstrap_popup = (strtolower($get['use_infobox']) == 'yes') ? 'true' : 'false';
					$showlocation    = (strtolower($get['showlocation']) == 'yes') ? 'true' : 'false';
					$hide_label      = (strtolower($get['hide_label']) == 'no') ? 'false' : 'true';
					
					$mapId = createMap($user['id'], $height, $width, $zoom, $defaultopen, $showsidebar, 'true', $name, '['.$latlng['lat'].','.$latlng['lng'].']', $password, '[]');
					if($mapId){
						
						updateMap($mapId, $user['id'], 'cluster', $cluster);
						updateMap($mapId, $user['id'], 'show_overlay', $show_overlay);
						updateMap($mapId, $user['id'], 'overlay_title', $overlay_title);
						updateMap($mapId, $user['id'], 'overlay_blurb', $overlay_blurb);
						updateMap($mapId, $user['id'], 'overlay_content', $overlay_content);
						updateMap($mapId, $user['id'], 'show_legend', $show_legend);
						updateMap($mapId, $user['id'], 'legend_content', $legend_content);
						
						updateMap($mapId, $user['id'], 'show_export', $show_export);
						updateMap($mapId, $user['id'], 'show_measure', $show_measure);
						updateMap($mapId, $user['id'], 'show_minimap', $show_minimap);
						updateMap($mapId, $user['id'], 'show_filelayer', $show_filelayer);
						updateMap($mapId, $user['id'], 'show_static_sidebar', $show_static_sidebar);
						updateMap($mapId, $user['id'], 'static_sidebar_content', $static_sidebar_content);
						
						$properties = array();
						$properties[] = '[{"name":"Location","value":"'.$address.'","defaultProperty":true},{"name":"Popu-Up Content","value":"'.$description.'","defaultProperty":false}]';
						
						$type = array();
						$type[] = 'Point';
						
						$coordinates = array();
						$coordinates[] = '['.$longitude.','.$latitude.']';
						
						$styles = array();
						$styles[] = '{"icon":"'.$marker_style.'","prefix":"fa","markerColor":"'.$marker_color.'"}';
						
						$shapeCustomProperties = array();
						$shapeCustomProperties[] = '{"get_direction":'.$get_direction.',"bootstrap_popup":'.$bootstrap_popup.',"show_address_on_popup":'.$showlocation.',"hide_label":'.$hide_label.'}';
						
						updateShapes($mapId, $properties, $type, $coordinates, $styles, $shapeCustomProperties);
						
						$result = array('view'     => BASEURL."app/map-view.php?mapid=".$mapId, 
										'download' => BASEURL."app/map-download-html.php?mapid=".$mapId, 
										'iframe'   => "<iframe src='".BASEURL."app/map-view.php?mapid=".$mapId."' height='".$height."' width='".$width."' scrolling='no' style='border:none'></iframe>");
						
						$RESPONSE['response']['success'] = true;
						$RESPONSE['response']['message'] = $result;
					}
					else {
						$RESPONSE['response']['success'] = false;
						$RESPONSE['response']['error']   = "Unknown Error Occur!";
					}
				}
			break;
			
			default:
				$RESPONSE['response']['success'] = false;
				$RESPONSE['response']['error']   = "Request is not specified";
		}
	}
	else {
		$RESPONSE['response']['success'] = false;
		$RESPONSE['response']['error']   = "Invalid API_KEY given!";
	}
	
	echo json_encode($RESPONSE);
	die();
?>