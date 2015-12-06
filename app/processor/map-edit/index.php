<?PHP
	require_once(dirname(__FILE__)."/../../../include/master.inc.php");
	
	$error   = "";
	
	if(!isLogin()){
		$error = "Session Expires";
	}
	else if(isset($_POST['addmarker']) && (int)$_GET['id'] > 0){
		$user = getUserInfo();
		$mapId  = (int)$_GET['id'];
		$userId = $user['id'];
		
		$markerId = createMarker($mapId, array(0), array(0), array(' '), array(' '), array(' '), array(' '), array('false'), array('false'), array('false'));
		redirect(BASEURL."app/map-edit.php?id=".$mapId);
	}
	else {
		$user = getUserInfo();
		if(isset($_POST['name']) && isset($_POST['pk']) && isset($_POST['value'])){
			$name  = $_POST['name'];
			$value = $_POST['value'];
			$pk    = $_POST['pk'];
			$pk = explode(',', $pk);
			
			if(count($pk) == 1) { // save request for Map
				$maps_id    = $pk[0];
				
				$dontSave   = false;
				
				$nameArray = array("name", "height", "width", "zoom", "defaultopen", "showsidebar", "layers_id", "groups_id", "button_style", "password", "cluster", "overlay_enable", "legend_enable", "show_export", "projects_id", "show_measure", "show_minimap", "show_search", "show_filelayer", "show_playback", "show_static_sidebar", "show_svg");
				if(in_array($name, $nameArray)){
					if(in_array($name, array("defaultopen", "showsidebar", "cluster", "overlay_enable", "legend_enable", "show_export", "show_measure", "show_minimap", "show_search", "show_filelayer", "show_playback", "show_static_sidebar", "show_svg"))){
						if($value == 'f'){
							$value= 'false';
						} else {
							$value= 'true';
						}
					}
					
					if($name == "width"){
						$value = (int)$value;
						if((int)$value < 0 || (int)$value > 1500){
							$error = "Invalid width!";
						}
					}
					else if($name == "height"){
						$value = (int)$value;
						if((int)$value < 0 || (int)$value > 1500){
							$error = "Invalid height!";
						}
					}
					else if($name == "zoom"){
						$value = (int)$value;
						if((int)$value < 0 || (int)$value > 18){
							$error = "Invalid Zoom level!";
						}
					}
					else if($name == "layers_id"){
						$value = (int)$value;
						if((int)$value < 0){
							$dontSave = true;
						}
					}
					else if($name == "groups_id"){
						$value = (int)$value;
						if((int)$value < 0){
							$dontSave = true;
						}
					}
					else if($name == "projects_id"){
						$value = (int)$value;
						if((int)$value < 0){
							$dontSave = true;
						}
					}
					
					if($error == "" || $dontSave){
						updateMap($maps_id, $user['id'], $name, $value);
						if($name == "layers_id") {
							$defaulLayer = getLayerById((int)$value);
							$defaulLayer = array('url' => $defaulLayer['url'], 'key' => $defaulLayer['lkey'], 'attribution' => $defaulLayer['attribution']);
							
							echo json_encode($defaulLayer);
						}
						else if($name == "groups_id") {
							global $db;
							
							$baseLayers = array();
							$res = pg_query($db, "SELECT * FROM layers WHERE id IN (SELECT layers_id FROM groups_has_layers WHERE groups_id = ".(int)$value.")") or die("Database Error");
							if(pg_num_rows($res) > 0){
								while($data = pg_fetch_assoc($res)) {
									$baseLayers[] = array('name' => $data['name'], 'url' => $data['url'], 'key' => $data['lkey'], 'attribution' => $data['attribution']);
								}
							}
							
							echo json_encode($baseLayers);
						}
					}
				}
				else {
					$error = "Invalid Data Sent";
				}
			}
			else {
				$error = "Invalid Request";
			}
		}
		else {
			$error = "Invalid Request";
		}
	}
	
	echo $error;
?>