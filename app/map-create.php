<?PHP
	require_once(dirname(__FILE__)."/../include/master.inc.php");
	if(!isLogin()){
		redirect("login.php");
	}
	$user = getUserInfo();
	
	$map_id = createMap($user['id'], 550, 1000, 6, 'false', 'true', 'false', '', '[0,0]', '', '{}');
	if($map_id) {
		updateMap($map_id, $user['id'], 'source', 'website');
		redirect("map-edit.php?action=create&id=".$map_id);
	}
	else {
		redirect("map.php");
	}
?>