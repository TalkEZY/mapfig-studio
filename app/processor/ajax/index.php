<?PHP
	require_once(dirname(__FILE__)."/../../../include/master.inc.php");
	
	$error   = "";
	
	if(!isLogin()){
		$error = "Session Expires";
	}
	else if(isset($_POST['getdescription']) && (int)$_GET['id'] > 0){
		$user = getUserInfo();
		$mapId  = (int)$_GET['id'];
		$userId = $user['id'];
		
		$markerId = createMarker($mapId, array(0), array(0), array(' '), array(' '), array(' '), array(' '));
		redirect(BASEURL."app/map-edit.php?id=".$mapId);
	}
	else {
		$user = getUserInfo();
		if(isset($_POST['name']) && isset($_POST['pk']) && isset($_POST['value'])){
			$name  = $_POST['name'];
			$value = $_POST['value'];
			$pk    = $_POST['pk'];
			$pk = explode(',', $pk);
			
			if(count($pk) == 2){ // save request for Marker
				$maps_id    = $pk[0];
				$markers_id = $pk[1];
				
				$nameArray = array("address", "description", "mcolor", "mstyle");
				if(in_array($name, $nameArray)){
					
					if($name == "address"){
						$latlng = getLatLng($value);
						if(!$latlng){
							$error = "Invalid Address!";
						}
						else {
							updateMarker($maps_id, $markers_id, $user['id'], 'lat', $latlng['lat']);
							updateMarker($maps_id, $markers_id, $user['id'], 'lng', $latlng['lng']);
						}
					}
					
					updateMarker($maps_id, $markers_id, $user['id'], $name, $value);
				}
				else {
					$error = "Invalid Data Sent";
				}
			}
			else if(count($pk) == 1){ // save request for Map
				$maps_id    = $pk[0];
				echo $name;
				$nameArray = array("name", "height", "width", "zoom", "direction", "defaultopen", "popupfromtop", "showsidebar", "hidelocation");
				if(in_array($name, $nameArray)){
					if(in_array($name, array("direction", "defaultopen", "popupfromtop", "showsidebar", "hidelocation"))){
						if($value == 'f'){
							$value= 'false';
						} else {
							$value= 'true';
						}
					}
					if($name == "width"){
						if((int)$value < 0 || (int)$value > 1500){
							$error = "Invalid width!";
						}
					}
					else if($name == "height"){
						if((int)$value < 0 || (int)$value > 1500){
							$error = "Invalid height!";
						}
					}
					else if($name == "zoom"){
						if((int)$value < 0 || (int)$value > 18){
							$error = "Invalid Zoom level!";
						}
					}
					if($error == "")
						updateMap($maps_id, $user['id'], $name, $value);
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