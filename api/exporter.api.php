<?PHP
	require_once(dirname(__FILE__)."/../include/master.inc.php");
	require_once(dirname(__FILE__)."/sdk/common.php");
	$apikey = $_GET['apikey'];
	$action = $_GET['action'];
	
	$output = array();
	
	$user = getUserByApiKey($get['apikey']);
	
	if($user) {
		
		/* API CALLS MONITOR */
		global $db;
		pg_query($db, "UPDATE users set apicalls = apicalls+1 WHERE id = ".$user['id']);
		
		switch($action) {
			case "import":
				$maps = getMapsByApiKey($apikey);
				
				if($maps && count($maps)>0) {
					foreach($maps as $map) {
						$shapes = getShapesByMapId($map['id']);
						
						$output['message'][] = array(
							'id'     => $map['id'],
							'title'  => $map['name'],
							'height' => $map['height'],
							'width'  => $map['width'],
							'html'   => processMapFile($map, $shapes, dirname(__FILE__)."/../app/map/view.tpl", true)
						);
					}
					$output['success'] = true;
				}
				else {
					$output['success'] = false;
					$output['message'] = 'No Map Found. Please check and update your API Key under Studio Settings';
				}
			break;
			
			
			case "refresh":
				$id = (int)$_GET['id'];
				$maps = getMapsByIdAndApiKey($id, $apikey);
				
				if($maps && count($maps)>0) {
					foreach($maps as $map) {
						$shapes = getShapesByMapId($map['id']);
						
						$output['message'][] = array(
							'id'     => $map['id'],
							'title'  => $map['name'],
							'height' => $map['height'],
							'width'  => $map['width'],
							'html'   => processMapFile($map, $shapes, dirname(__FILE__)."/../app/map/view.tpl", true)
						);
					}
					$output['success'] = true;
				}
				else {
					$output['success'] = false;
					$output['message'] = 'No Map Found. Please check and update your API Key under Studio Settings';
				}
			break;
			
			case "allmaps" : 
				$output = getMapsByApiKey($apikey);
			break;
			
			default:
				$output['success'] = false;
				$output['message'] = 'Invalid Request';
			break;
			
			
		}
	}
	else {
		$output['success'] = false;
		$output['message'] = 'Invalid API';
	}
	
	header('Content-Type:text/plain');
	echo json_encode($output);
?>