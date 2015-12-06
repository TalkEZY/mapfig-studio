<?PHP
	require_once(dirname(__FILE__)."/../../../include/master.inc.php");
	
	$error   = "";
	$success = "";
	
	if(!isLogin()){
		$error = "Session Expires";
	}
	else if(isset($_POST['id'])){
		$user   = getUserInfo();
		$shapes           = json_decode($_POST['shapes']);
		$customProperties = json_decode($_POST['shapeCustomProperties']);
		$shapeStyles      = json_decode($_POST['shapeStyles']);
		
		if($customProperties == "") {
			$customProperties = "[]";
		}
		if($shapeStyles == "") {
			$shapeStyles = "[]";
		}
		
		if(!is_array($shapes)) {
			$error = "Invalid Request";
		}
		else {
			$properties            = array();
			$type                  = array();
			$coordinates           = array();
			$styles                = array();
			
			//$get_direction         = array();
			//$bootstrap_popup       = array(); //Popup From Top
			//$show_address_on_popup = array();
			//$hide_label            = array();
			$shapeCustomProperties = array();
			
			
			foreach($shapes as $key => $shape) {
				$tempProp = json_decode($shape->properties);
				for($i=0; $i<count($tempProp); $i++) {
					$val = (substr($tempProp[$i]->value,0,3) == "<p>" && substr($tempProp[$i]->value,-4,4) == "</p>") ? substr($tempProp[$i]->value,3,strlen($tempProp[$i]->value)-7) : $tempProp[$i]->value ;
					$tempProp[$i]->value = $val;
				}
				$shape->properties = json_encode($tempProp);
				$shapes[$key]  = $shape;
				
				$properties[]            = $shape->properties;
				$type[]                  = $shape->geometry->type;
				$coordinates[]           = (json_encode($shape->geometry->coordinates) == "") ? "[]" : json_encode($shape->geometry->coordinates);
				$shapeCustomProperties[] = (json_encode($customProperties[$key]) == "") ? "{}" : json_encode($customProperties[$key]);
				$styles[]                = (json_encode($shapeStyles[$key]) == "") ? "{}" : json_encode($shapeStyles[$key]);
			}
			
			updateMap((int)$_POST['id'], $user['id'], 'mapcenter', $_POST['mapcenter']);
			updateMap((int)$_POST['id'], $user['id'], 'zoom', (int)$_POST['zoom']);
			
			updateMap((int)$_POST['id'], $user['id'], 'overlay_title', $_POST['overlay_title']);
			updateMap((int)$_POST['id'], $user['id'], 'overlay_blurb', $_POST['overlay_blurb']);
			updateMap((int)$_POST['id'], $user['id'], 'overlay_content', $_POST['overlay_content']);
			updateMap((int)$_POST['id'], $user['id'], 'legend_content', $_POST['legend_content']);
			
			updateMap((int)$_POST['id'], $user['id'], 'image_overlays', $_POST['image_overlays']);
			
			updateMap((int)$_POST['id'], $user['id'], 'gpx_tracks', $_POST['gpx_tracks']);
			
			updateMap((int)$_POST['id'], $user['id'], 'map_bounds', $_POST['map_bounds']);
			
			updateMap((int)$_POST['id'], $user['id'], 'static_sidebar_content', $_POST['static_sidebar_content']);
			
			if(updateShapes((int)$_POST['id'], $properties, $type, $coordinates, $styles, $shapeCustomProperties)) {
				$success = "Map Successfully Saved!";
			}
			else {
				$error = "Invalid Map Data";
			}
		}
	}
	else {
		$error = "Invalid Request";
	}
	
	$_SESSION['response']['map-edit']['error']   = $error;
	$_SESSION['response']['map-edit']['success'] = $success;
	redirect(BASEURL."app/map-edit.php?id=".$_POST['id']);
?>