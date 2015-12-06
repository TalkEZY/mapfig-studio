<?PHP
	require_once(dirname(__FILE__)."/master.inc.php");

	function login($email, $password){
		global $db;
		$res = pg_query($db, "SELECT * FROM users WHERE email = '".pg_escape_string($email)."' AND password = '".md5($password)."' AND activationkey = ''") or die("Database Error");
		if(pg_num_rows($res) == 1){
			if($data = pg_fetch_assoc($res)) {
				$_SESSION['user']['id']            = $data['id'];
				$_SESSION['user']['firstname']     = $data['firstname'];
				$_SESSION['user']['lastname']      = $data['lastname'];
				$_SESSION['user']['email']         = $data['email'];
				$_SESSION['user']['apikey']        = $data['apikey'];
				$_SESSION['user']['cdn_url']       = $data['cdn_url'];

				if($data['users_id'] == 0) { // if user is Parent/Super user
					$_SESSION['user']['switcher_id']  = $data['id'];
				}
			}
			return true;
		}
		return false;
	}

	function register($firstname, $lastname, $email, $password, $userId = 0, $send_welcome = true) {
		global $db;
		
		$userId = (int)$userId;
		$email  = strtolower($email);

		$res = pg_query($db, "SELECT * FROM users WHERE email = '".pg_escape_string($email)."'") or die("Database Error");
		if(pg_num_rows($res) > 0){
			return false;
		}

		$apikey         = generateRandomString(32);
		$activationKey  = $send_welcome ? generateRandomString(40) : "";

		$res = pg_query($db, "INSERT INTO users(firstname, lastname, email, password, apikey, users_id, activationkey) VALUES('".pg_escape_string($firstname)."', '".pg_escape_string($lastname)."', '".pg_escape_string($email)."', '".md5($password)."', '".$apikey."', ".$userId.", '".pg_escape_string($activationKey)."'); SELECT currval(pg_get_serial_sequence('users','id')) as last_insert_id;") or die("Database Error");
		if($d = pg_fetch_assoc($res)) {
			$userId = $d['last_insert_id'];

			
			$layers_my_group = array();
			$layers_ssl_maps = array();
			$layers_style_maps = array();
			$layers_outdoor_maps = array();
			$layers_satellite_maps = array();
			
			$layers_style_maps[] = $layers_my_group[] = addLayers($userId, 'CartoDB Light', 'https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}.png', '', '', 'Map tiles by <a href="http://cartodb.com/attributions#basemaps" target="_blank">CartoDB</a>, under <a href="https://creativecommons.org/licenses/by/3.0/" target="_blank">CC BY 3.0</a>. Data by <a href="http://www.openstreetmap.org/" target="_blank">OpenStreetMap</a>, under ODbL.');
			$layers_outdoor_maps[] = $layers_my_group[] = addLayers($userId, 'Loniva Hiking', 'http://tile.waymarkedtrails.org/hiking/{z}/{x}/{y}.png', '', '', '<a href="https://openpistemap.org" target="_blank">OpenStreetMap</a>');
			$layers_style_maps[] = $layers_my_group[] = addLayers($userId, 'MapQuest Sat', 'https://otile1.mqcdn.com/tiles/1.0.0/sat/{z}/{x}/{y}.png', '', '', '<a href="https://openstreetmap.org" target="_blank">OpenStreetMap</a>');
			$layers_style_maps[] = $layers_my_group[] = addLayers($userId, 'Stamen.Watercolor', 'http://{s}.tile.stamen.com/watercolor/{z}/{x}/{y}.jpg', '', '', 'Map tiles by <a href="http://stamen.com" target="_blank">Stamen Design</a>, under <a href="http://creativecommons.org/licenses/by/3.0" target="_blank">CC BY 3.0</a>. Data by <a href="http://openstreetmap.org" target="_blank">OpenStreetMap</a>, under <a href="http://creativecommons.org/licenses/by-sa/3.0" target="_blank">CC BY SA</a>.');
			$layers_outdoor_maps[] = $layers_my_group[] = addLayers($userId, 'OpenCycleMap', 'http://{s}.tile.thunderforest.com/cycle/{z}/{x}/{y}.png', '', '', '<a href="http://thunderforest.com/" target="_blank">Thunderforest</a>');
			$layers_ssl_maps[] = $layers_my_group[] = addLayers($userId, 'OpenStreetMap', 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', '', '', '<a href="https://openstreetmap.org" target="_blank">OpenStreetMap</a>');
			$layers_satellite_maps[] = $layers_my_group[] = addLayers($userId, 'Esri World Imagery', 'http://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', '', '', 'Attribution: <a href="http://www.esri.com/" target="_blank">ESRI</a>');
			$layers_satellite_maps[] = $layers_my_group[] = addLayers($userId, 'Google Maps', 'http://mt1.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', '', '', '<a href="http://www.google.com/intl/en-GB_US/help/terms_maps.html" target="_blank">Google - Terms of Use</a>');
			$layers_my_group[] = addLayers($userId, 'MapBox', 'https://{s}.tiles.mapbox.com/v3/{id}/{z}/{x}/{y}.png', 'examples.map-i875mjb7', '', '<a href="https://mapbox.com" target="_blank">MapBox</a>');
			$layers_outdoor_maps[] = $layers_my_group[] = addLayers($userId, 'Loniva Biking', 'http://tile.waymarkedtrails.org/cycling/{z}/{x}/{y}.png', '', '', '<a href="http://cycling.waymarkedtrails.org/" target="_blank">OpenStreetMap</a>');
			$layers_style_maps[] = $layers_my_group[] = addLayers($userId, 'Stamen.Toner', 'http://a.tile.stamen.com/toner/{z}/{x}/{y}.png', '', '', 'Map tiles by <a href="http://stamen.com" target="_blank">Stamen Design</a>, under <a href="http://creativecommons.org/licenses/by/3.0" target="_blank">CC BY 3.0</a>. Data by <a href="http://openstreetmap.org" target="_blank">OpenStreetMap</a>, under <a href="http://www.openstreetmap.org/copyright" target="_blank">ODbL</a>.');
			$layers_style_maps[] = $layers_my_group[] = addLayers($userId, 'CartoDB Dark', 'https://cartodb-basemaps-{s}.global.ssl.fastly.net/dark_all/{z}/{x}/{y}.png', '', '', 'Map tiles by <a href="http://cartodb.com/attributions#basemaps" target="_blank">CartoDB</a>, under <a href="https://creativecommons.org/licenses/by/3.0/" target="_blank">CC BY 3.0</a>. Data by <a href="http://www.openstreetmap.org/" target="_blank">OpenStreetMap</a>, under ODbL.');
			$layers_ssl_maps[] = $layers_my_group[] = addLayers($userId, 'MapQuest', 'https://otile3-s.mqcdn.com/tiles/1.0.0/map/{z}/{x}/{y}.png', '', '', '<a href="https://openstreetmap.org" target="_blank">OpenStreetMap. </a> Tiles Courtesy of <a href="http://www.mapquest.com/" target="_blank">MapQuest</a>');
			$layers_my_group[] = addLayers($userId, 'MapFig Greenwaters', 'https://{s}.tile.thunderforest.com/mapfig-2a6/{z}/{x}/{y}.png', '', '', '&copy; <a href="http://mapfig.org" target="_blank">MapFig </a> Greenwaters by <a href="http://thunderforest.com" target="_blank">Thunderforest,</a> Data by <a href="http://www.openstreetmap.org/copyright" target="_blank">OpenStreetMap</a>.');
			$layers_ssl_maps[] = $layers_my_group[] = addLayers($userId, 'MapFig Darkwaters', 'https://{s}.tile.thunderforest.com/mapfig-darkwaters/{z}/{x}/{y}.png', '', '', '&copy; <a href="http://mapfig.org" target="_blank">MapFig </a> Darkwaters by <a href="http://thunderforest.com" target="_blank">Thunderforest,</a> Data by <a href="http://www.openstreetmap.org/copyright" target="_blank">OpenStreetMap</a>.');
			$layers_ssl_maps[] = $layers_my_group[] = addLayers($userId, 'MapFig Bluewaters', 'https://{s}.tile.thunderforest.com/mapfig-bluewaters/{z}/{x}/{y}.png', '', '', '&copy; <a href="http://mapfig.org" target="_blank">MapFig </a> Bluewaters by <a href="http://thunderforest.com" target="_blank">Thunderforest,</a> Data by <a href="http://www.openstreetmap.org/copyright" target="_blank">OpenStreetMap</a>.');
			
			$g1 = addGroup($userId, 'My Group');
			addGroupHasLayers($userId, $g1, $layers_my_group);
			
			$g1 = addGroup($userId, 'SSL Maps');
			addGroupHasLayers($userId, $g1, $layers_ssl_maps);
			
			$g1 = addGroup($userId, 'Style Maps');
			addGroupHasLayers($userId, $g1, $layers_style_maps);
			
			$g1 = addGroup($userId, 'Outdoor Maps');
			addGroupHasLayers($userId, $g1, $layers_outdoor_maps);
			
			$g1 = addGroup($userId, 'Satellite Maps');
			addGroupHasLayers($userId, $g1, $layers_satellite_maps);
			
			
			if($send_welcome) {
				sendWelcomeEmail($userId, $password);
			}

			return $userId;
		}
		else {
			return false;
		}
	}

	function activateUser($activationKey){
		global $db;

		$res = pg_query($db, "UPDATE users SET activationkey = '' WHERE activationkey = '".pg_escape_string($activationKey)."'") or die("Database Error");
		if(pg_affected_rows($res) == 1) {
			return true;
		}

		return false;
	}

	function updateCDNUrl($url, $userId = 0){
		global $db;
		$userId = (int)$userId;
		
		if($userId == 0) {
			$userId = (int)$_SESSION['user']['id'];
		}
		
		$res = pg_query($db, "UPDATE users SET cdn_url = '".pg_escape_string($url)."' WHERE id = ".$userId) or die("Database Error");
		if(pg_affected_rows($res) == 1) {
			$_SESSION['user']['cdn_url'] = $url;
			return true;
		}

		return false;
	}
	
	function generateRandomString($length = 8) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-_';
		$charactersLength = strlen($characters);
		$randomString = '';

		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}

		return $randomString;
	}

	function isLogin() {
		if(isset($_SESSION['user']) && $_SESSION['user'] != null){
			return true;
		}
		return false;
	}

	function logout(){
		$_SESSION['user'] = null;
		unset($_SESSION['user']);
	}

	function redirect($loc){
		header("Location: ".$loc);
		die();
	}

	function getAllSuperUsers() {
		global $db;
		$users = array();

		$res = pg_query($db, "SELECT * FROM users WHERE users_id = 0") or die("Database Error");
		while($data = pg_fetch_assoc($res)) {
			unset($data['password']);
			$users[] =  $data;
		}

		return $users;
	}

	function getUserInfo($id = null){
		global $db;
		//if(isLogin()){
			if(!$id){
				$id = (int)$_SESSION['user']['id'];
			}

			$res = pg_query($db, "SELECT * FROM users WHERE id = $id") or die("Database Error");
			if($data = pg_fetch_assoc($res)) {
				unset($data['password']);
				return $data;
			}

			return null;
		//}
		//return null;
	}

	function isAdmin($user){
		return ($user && (int)$user['users_id'] == 0);
	}

	function userHasMapAccess($userId, $mapId) {
		global $db;

		$res = pg_query($db, "SELECT * FROM maps WHERE id = $mapId AND ((users_id = $userId) OR (projects_id IN (SELECT projects_id FROM project_has_users WHERE users_id = $userId)) OR (projects_id IN (SELECT id FROM projects WHERE users_id = $userId)))") or die("Database Error");
		if(pg_fetch_assoc($res)) {
			return true;
		}
		return false;
	}

	function getUserByEmail($email){
		global $db;
		$res = pg_query($db, "SELECT * FROM users WHERE email = '".pg_escape_string($email)."' LIMIT 1") or die("Database Error");
		if($data = pg_fetch_assoc($res)) {
			unset($data['password']);
			return $data;
		}
		return null;
	}

	function getUserByApiKey($apikey){
		global $db;
		$res = pg_query($db, "SELECT * FROM users WHERE apikey = '".pg_escape_string($apikey)."' LIMIT 1") or die("Database Error");
		if($data = pg_fetch_assoc($res)) {
			unset($data['password']);
			return $data;
		}
		return null;
	}

	function getUsers($userId) {
		global $db;
		$users = array();
		if((int)$userId == 0){
			return $users;
		}
		$res = pg_query($db, "SELECT * FROM users WHERE users_id = $userId AND users_id <> 0 ORDER BY id DESC") or die("Database Error");
		if(pg_num_rows($res) > 0){
			while($data = pg_fetch_assoc($res)) {
				unset($data['password']);
				$users[] = $data;
			}
		}
		return $users;
	}

	function refreshAPIKEY($userId){
		global $db;
		if((int)$userId == 0){
			return null;
		}
		$apikey = generateRandomString(32);

		$res = pg_query($db, "UPDATE users SET apikey = '".pg_escape_string($apikey)."' WHERE id = $userId") or die("Database Error");
		if(pg_affected_rows($res) == 1) {
			return $apikey;
		}
		else {
			return null;
		}
	}

	function getUsersByUserId($userId){
		global $db;
		$users = array();
		if((int)$userId == 0){
			return $users;
		}
		$res = pg_query($db, "SELECT * FROM users WHERE users_id = $userId ORDER BY id DESC") or die("Database Error");
		if(pg_num_rows($res) > 0){
			while($data = pg_fetch_assoc($res)) {
				$users[] = $data;
			}
		}
		return $users;
	}

	function getMapsByProjectId($projectId){
		global $db;
		$maps = array();
		if((int)$projectId == 0){
			return $maps;
		}
		$res = pg_query($db, "SELECT * FROM maps WHERE projects_id = $projectId AND status = 'true' ORDER BY id DESC") or die("Database Error");
		if(pg_num_rows($res) > 0){
			while($data = pg_fetch_assoc($res)) {
				$maps[] = $data;
			}
		}
		return $maps;
	}

	function getMaps($userId, $limit = 0) {
		global $db;
		$maps = array();
		if((int)$userId == 0){
			return $maps;
		}

		if($limit == 0) {
			$res = pg_query($db, "SELECT * FROM maps WHERE users_id = $userId AND status = 'true' ORDER BY id DESC") or die("Database Error");
		}
		else {
			$res = pg_query($db, "SELECT * FROM maps WHERE users_id = $userId AND status = 'true' ORDER BY id DESC LIMIT $limit") or die("Database Error");
		}
		
		if(pg_num_rows($res) > 0){
			while($data = pg_fetch_assoc($res)) {
				$maps[] = $data;
			}
		}
		return $maps;
	}
	
	function getMapsBySearchKeyword($keyword, $userId = 0){
		global $db;
		$maps = array();
		
		if((int)$userId == 0){
			$userId = (int)$_SESSION['user']['id'];
		}
		if((int)$userId == 0){
			return $maps;
		}
		
		$res = pg_query($db, "SELECT * FROM maps WHERE users_id = $userId AND name LIKE '%".pg_escape_string($keyword)."%' AND status = 'true' ORDER BY id DESC") or die("Database Error");
		if(pg_num_rows($res) > 0) {
			while($data = pg_fetch_assoc($res)) {
				$maps[] = $data;
			}
		}
		return $maps;
	}

	/*
	 * Only return maps created by API
	 */
	function getMapsOlderThan($days, $userId = 0) {
		global $db;
		$maps = array();
		
		if((int)$days == 0){
			return $maps;
		}
		if((int)$userId == 0){
			$userId = $_SESSION['user']['id'];
		}
		if((int)$userId == 0){
			return $maps;
		}
		
		$res = pg_query($db, "SELECT * FROM maps WHERE users_id = $userId AND source = 'api' AND createdat < (NOW() - INTERVAL '".$days." days') ORDER BY id DESC") or die("Database Error");
		if(pg_num_rows($res) > 0){
			while($data = pg_fetch_assoc($res)) {
				$maps[] = $data;
			}
		}
		return $maps;
	}
	
	function getMapsByApiKey($apikey){
		global $db;
		$maps = array();
		$res = pg_query($db, "SELECT * FROM maps WHERE users_id IN (SELECT id FROM users WHERE apikey = '".pg_escape_string($apikey)."') AND status = 'true' ORDER BY id DESC") or die("Database Error");
		if(pg_num_rows($res) > 0){
			while($data = pg_fetch_assoc($res)) {
				$maps[] = $data;
			}
		}
		return $maps;
	}

	function getMapsByIdAndApiKey($id, $apikey){
		global $db;
		$id = (int)$id;
		$maps = array();
		$res = pg_query($db, "SELECT * FROM maps WHERE users_id IN (SELECT id FROM users WHERE apikey = '".pg_escape_string($apikey)."') AND id = $id AND status = 'true' ORDER BY id DESC") or die("Database Error");
		if(pg_num_rows($res) > 0){
			while($data = pg_fetch_assoc($res)) {
				$maps[] = $data;
			}
		}
		return $maps;
	}

	function getMapByIdAndApiKey($id, $apikey){
		global $db;
		$id = (int)$id;
		$map = array();
		$res = pg_query($db, "SELECT * FROM maps WHERE users_id IN (SELECT id FROM users WHERE apikey = '".pg_escape_string($apikey)."') AND id = $id AND status = 'true'") or die("Database Error");
		if(pg_num_rows($res) > 0){
			if($data = pg_fetch_assoc($res)) {
				$map = $data;
			}
		}
		return $map;
	}

	function getMapsByUserId($userId, $limit = 0){
		return getMaps($userId, $limit);
	}

	function deleteProject($projectId, $userId, $forced = false){
		global $db;
		if((int)$projectId == 0 || (int)$userId == 0){
			return false;
		}
		if(count(getMapByProjectId($projectId, $userId)) > 0) {
			if(!$forced) {
				return false;
			}
			else {
				pg_query($db, "DELETE FROM maps WHERE projects_id = $projectId AND users_id = $userId") or die("Database Error");
			}
		}

		pg_query($db, "DELETE FROM projects WHERE id = $projectId AND users_id = $userId") or die("Database Error");

		return true;
	}

	function deleteMap($mapId, $userId){
		global $db;
		if((int)$mapId == 0 || (int)$userId == 0){
			return false;
		}

		if(!userHasMapAccess($userId, $mapId)) {
			return false;
		}

		pg_query($db, "DELETE FROM maps WHERE id = $mapId") or die("Database Error");
		pg_query($db, "DELETE FROM shapes WHERE maps_id = $mapId") or die("Database Error");

		return true;
	}

	function getMapById($mapId, $userId = 0){
		global $db;
		$map = array();
		if((int)$mapId == 0){
			return false;
		}
		$res = null;
		if($userId == 0){
			$res = pg_query($db, "SELECT * FROM maps WHERE id = $mapId") or die("Database Error");
		}
		else {
			if(!userHasMapAccess($userId, $mapId)) {
				return false;
			}
			$res = pg_query($db, "SELECT * FROM maps WHERE id = $mapId") or die("Database Error");
		}
		if(pg_num_rows($res) != 1) {
			return false;
		}
		else {
			if($data = pg_fetch_assoc($res)) {
				$map = $data;
			}
		}
		return $map;
	}

	function getMapByProjectId($projectId, $userId = 0){
		global $db;
		$map = array();
		if((int)$projectId == 0){
			return null;
		}
		$res = null;
		if($userId == 0){
			$res = pg_query($db, "SELECT * FROM maps WHERE projects_id = $projectId") or die("Database Error");
		}
		else {
			$res = pg_query($db, "SELECT * FROM maps WHERE projects_id = $projectId AND users_id = $userId") or die("Database Error");
		}
		if(pg_num_rows($res) != 1) {
			return null;
		}
		else {
			if($data = pg_fetch_assoc($res)) {
				$map = $data;
			}
		}
		return $map;
	}

	function getShapesByMapId($mapsId){
		global $db;
		$shapes = array();
		if((int)$mapsId == 0){
			return $shapes;
		}
		$res = pg_query($db, "SELECT * FROM shapes WHERE maps_id = $mapsId ORDER BY id ASC") or die("Database Error");
		if(pg_num_rows($res) > 0){
			while($data = pg_fetch_assoc($res)) {
				$shapes[] = $data;
			}
		}
		return $shapes;
	}

	function getShapeStyleById($shapeId){
		global $db;

		if((int)$shapeId == 0){
			return false;
		}
		$res = pg_query($db, "SELECT * FROM shapes WHERE id = $shapeId") or die("Database Error");
		if(pg_num_rows($res) > 0){
			if($data = pg_fetch_assoc($res)) {
				return $data['style'];
			}
		}
		return false;
	}

	function getShapesByType($mapsId, $type = 'Point') {
		global $db;
		$shapes = array();
		if((int)$mapsId == 0){
			return $shapes;
		}
		$res = pg_query($db, "SELECT * FROM shapes WHERE maps_id = $mapsId AND type = '".pg_escape_string($type)."' ORDER BY id ASC") or die("Database Error");
		if(pg_num_rows($res) > 0){
			while($data = pg_fetch_assoc($res)) {
				$shapes[] = $data;
			}
		}
		return $shapes;
	}

	function getMapsCount($userId) {
		return count(getMaps($userId));
	}

	function updateProfile($userId, $firstname, $lastname, $email) {
		global $db;

		if((int)$userId == 0){
			return false;
		}

		$res = pg_query($db, "SELECT * FROM users WHERE email = '".pg_escape_string($email)."' AND id <> $userId") or die("Database Error");
		if(pg_num_rows($res) > 0){
			return false;
		}

		$res = pg_query($db, "UPDATE users SET firstname = '".pg_escape_string($firstname)."', lastname = '".pg_escape_string($lastname)."', email = '".pg_escape_string($email)."' WHERE id = $userId") or die("Database Error");
		if(pg_affected_rows($res) == 1) {
			if($_SESSION['user']['id'] == $userId){
				$_SESSION['user']['firstname'] = $firstname;
				$_SESSION['user']['lastname']  = $lastname;
				$_SESSION['user']['email']     = $email;
			}
			return true;
		}
		else {
			return false;
		}
	}

	function changePassword($userId, $old, $new) {
		global $db;

		if((int)$userId == 0){
			return false;
		}

		$res = pg_query($db, "UPDATE users SET password = '".pg_escape_string(md5($new))."' WHERE password = '".pg_escape_string(md5($old))."' AND id = $userId") or die("Database Error");
		if(pg_affected_rows($res) == 1) {
			return true;
		}
		else {
			return false;
		}
	}

	function updateShapes($mapId, $properties, $type, $coordinates, $styles, $shapeCustomProperties, $userId = 0) {
		$mapId  = (int)$mapId;
		$userId = (int)$userId;
		
		if($userId == 0) {
			$userId = $_SESSION['user']['id'];
		}

		if(!getMapById($mapId, $userId)) {
			return false;
		}

		if(!userHasMapAccess($userId, $mapId)) {
			return false;
		}

		global $db;

		pg_query($db, "DELETE FROM shapes WHERE maps_id = $mapId");

		$query  = "INSERT INTO shapes (maps_id, properties, type, coordinates, style, customproperties) VALUES ";
		$values = array();
		for($i=0; $i<count($properties); $i++){
			$values[] = " ($mapId, '".pg_escape_string($properties[$i])."', '".pg_escape_string($type[$i])."', '".pg_escape_string($coordinates[$i])."', '".pg_escape_string($styles[$i])."', '".pg_escape_string($shapeCustomProperties[$i])."') ";
		}
		if(count($values)>0){
			$res = pg_query($db, $query." ".implode(",", $values)."; SELECT currval(pg_get_serial_sequence('shapes','id')) as last_insert_id;");
			$shapes_id = 0;
			if($d = pg_fetch_assoc($res)) {
				$shapes_id = $d['last_insert_id'];
				return $shapes_id;
			}
			else {
				return false;
			}
		}
		return true;
	}

	function updateShapesPoints($mapId, $properties, $type, $coordinates, $styles, $shapeCustomProperties) {
		$mapId  = (int)$mapId;
		$userId = $_SESSION['user']['id'];

		if(!getMapById($mapId, $userId)) {
			return false;
		}

		global $db;

		pg_query($db, "DELETE FROM shapes WHERE maps_id = $mapId AND type = 'Point'");

		$query  = "INSERT INTO shapes (maps_id, properties, type, coordinates, style, customproperties) VALUES ";
		$values = array();
		for($i=0; $i<count($properties); $i++){
			$values[] = " ($mapId, '".pg_escape_string($properties[$i])."', '".pg_escape_string($type[$i])."', '".pg_escape_string($coordinates[$i])."', '".pg_escape_string($styles[$i])."', '".pg_escape_string($shapeCustomProperties[$i])."') ";
		}
		if(count($values)>0){
			$res = pg_query($db, $query." ".implode(",", $values)."; SELECT currval(pg_get_serial_sequence('shapes','id')) as last_insert_id;");
			$shapes_id = 0;
			if($d = pg_fetch_assoc($res)) {
				$shapes_id = $d['last_insert_id'];
				return $shapes_id;
			}
			else {
				return false;
			}
		}
		return true;
	}

	function createMap($userId, $height, $width, $zoom, $defaultopen, $showsidebar, $status, $name, $mapcenter, $password = '', $filteredcolumns) {
		global $db;

		if((int)$userId == 0){
			return false;
		}

		$res = pg_query($db, "INSERT INTO maps(users_id, height, width, zoom, defaultopen, showsidebar, status, createdon, name, mapcenter, password, filteredcolumns) ".
							 "VALUES($userId, ".(int)$height.", ".(int)$width.", ".(int)$zoom.", ".$defaultopen.", ".$showsidebar.", ".$status.", ".time().", '".pg_escape_string($name)."', '".pg_escape_string($mapcenter)."', '".pg_escape_string($password)."', '".pg_escape_string($filteredcolumns)."');
							 SELECT currval(pg_get_serial_sequence('maps','id')) as last_insert_id;") or die("Database Error");
		$maps_id = 0;
		if($d = pg_fetch_assoc($res)) {
			$maps_id = $d['last_insert_id'];
		}

		return $maps_id;
	}

	function deleteShape($shapeId, $mapId, $userId){
		global $db;
		if((int)$shapeId == 0 || (int)$mapId == 0 || (int)$userId == 0){
			return null;
		}

		pg_query($db, "DELETE FROM shapes WHERE id = $shapeId AND maps_id IN (SELECT id FROM maps WHERE id = $mapId AND users_id = $userId)") or die("Database Error");
		return true;
	}

	function getLatLng($address){
		$prepAddr = str_replace(' ','+',$address);
		$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
		$output= json_decode($geocode);

		if(!$output->results[0]->geometry->location->lat || !$output->results[0]->geometry->location->lng) {
			return false;
		}
		else {
			return  array(
						'lat' => $output->results[0]->geometry->location->lat,
						'lng' => $output->results[0]->geometry->location->lng
					);
		}
	}

	function updateMap($maps_id, $users_id, $field_name, $field_value){
		global $db;

		$maps_id    = (int)$maps_id;
		$users_id   = (int)$users_id;

		if($maps_id == 0 || $users_id == 0){
			return false;
		}

		if(!userHasMapAccess($users_id, $maps_id)) {
			return false;
		}

		$res = pg_query($db, "UPDATE maps SET status = 'true', ".$field_name." = '".pg_escape_string($field_value)."' WHERE id = $maps_id") or die("Database Error");
		if(pg_affected_rows($res) == 1) {
			
			// Do the Cache Work Here
			$cacheDirectory = dirname(__FILE__)."/../cache";
			if(!is_dir($cacheDirectory)) {
				@mkdir($cacheDirectory);
			}
			
			@unlink($cacheDirectory."/".md5($maps_id).".cache");
			
			return true;
		}

		return false;
	}



	/****************************** Layers ************************************/

	/* Update */
	function updateLayers($userId, $layersId, $name, $url, $lkey, $accesstoken, $attribution){
		global $db;
		if((int)$userId == 0 || (int)$layersId == 0){
			return false;
		}

		$res = pg_query($db, "UPDATE layers SET name = '".pg_escape_string($name)."', url = '".pg_escape_string($url)."', lkey = '".pg_escape_string($lkey)."', accesstoken = '".pg_escape_string($accesstoken)."', attribution = '".pg_escape_string($attribution)."' WHERE id = $layersId AND users_id = $userId") or die("Database Error");
		if(pg_affected_rows($res) == 1) {
			return true;
		}

		return false;
	}

	function updateProject($userId, $projectsId, $name){
		global $db;
		if((int)$userId == 0 || (int)$projectsId == 0){
			return false;
		}

		$res = pg_query($db, "UPDATE projects SET name = '".pg_escape_string($name)."' WHERE id = $projectsId AND users_id = $userId") or die("Database Error");
		if(pg_affected_rows($res) == 1) {
			return true;
		}

		return false;
	}

	function updateGroup($userId, $groupId, $name){
		global $db;
		if((int)$userId == 0 || (int)$groupId == 0){
			return false;
		}

		$res = pg_query($db, "UPDATE groups SET name = '".pg_escape_string($name)."' WHERE id = $groupId AND users_id = $userId") or die("Database Error");
		if(pg_affected_rows($res) == 1) {
			return true;
		}

		return false;
	}

	function updateGroupHasLayers($id, $groupId, $layersId){
		global $db;
		if((int)$id == 0 || (int)$groupId == 0 || (int)$layersId == 0){
			return false;
		}
		$res = pg_query($db, "UPDATE group_has_layers SET groups_id = '".(int)$groupId."' AND layers_id = '".(int)$layersId."' WHERE id = $id") or die("Database Error");
		if(pg_affected_rows($res) == 1) {
			return true;
		}

		return false;
	}

	function updateProjectHasUsers($id, $projectId, $usersId){
		global $db;
		if((int)$id == 0 || (int)$projectId == 0 || (int)$usersId == 0){
			return false;
		}
		$res = pg_query($db, "UPDATE project_has_users SET projects_id = '".(int)$projectId."' AND users_id = '".(int)$usersId."' WHERE id = $id") or die("Database Error");
		if(pg_affected_rows($res) == 1) {
			return true;
		}

		return false;
	}

	function updateCSV($userId, $id, $formated_data) {
		global $db;
		if((int)$userId == 0 || (int)$id == 0) {
			return false;
		}

		$res = pg_query($db, "UPDATE csv SET csv_data = '', formated_data = '".pg_escape_string($formated_data)."' WHERE id = $id AND users_id = $userId") or die("Database Error");
		if(pg_affected_rows($res) == 1) {
			return true;
		}

		return false;
	}

	/* Delete */
	function deleteLayers($userId, $layersId){
		global $db;
		if((int)$userId == 0 || (int)$layersId == 0){
			return null;
		}

		pg_query($db, "DELETE FROM layers WHERE id = $layersId AND users_id = $userId") or die("Database Error");
		return true;
	}

	function deleteGroup($userId, $groupId){
		global $db;
		if((int)$userId == 0 || (int)$groupId == 0){
			return null;
		}

		pg_query($db, "DELETE FROM groups WHERE id = $groupId AND users_id = $userId") or die("Database Error");
		return true;
	}

	function deleteCSV($userId, $id){
		global $db;
		if((int)$userId == 0 || (int)$id == 0){
			return null;
		}

		pg_query($db, "DELETE FROM csv WHERE id = $id AND users_id = $userId") or die("Database Error");
		return true;
	}

	function deleteUser($userId, $id){
		global $db;
		if((int)$userId == 0 || (int)$id == 0){
			return null;
		}

		pg_query($db, "DELETE FROM users WHERE id = $id AND users_id = $userId") or die("Database Error");
		return true;
	}

	// check it later
	function deleteGroupHasLayers($id, $userId){
		global $db;
		if((int)$id == 0 || (int)$userId == 0) {
			return false;
		}

		pg_query($db, "DELETE FROM group_has_layers WHERE id = $id AND users_id IN (SELECT id FROM layers WHERE users_id = $userId) AND users_id IN (SELECT id FROM groups WHERE users_id = $userId)") or die("Database Error");
		return true;
	}

	/* Insert */
	function addLayers($userId, $name, $url, $key, $accesstoken, $attribution){
		global $db;
		if((int)$userId == 0){
			return false;
		}

		$res = pg_query($db, "INSERT INTO layers(users_id, name, url, lkey, accesstoken, attribution) VALUES('".(int)$userId."', '".pg_escape_string($name)."', '".pg_escape_string($url)."', '".pg_escape_string($key)."', '".pg_escape_string($accesstoken)."', '".pg_escape_string($attribution)."'); SELECT currval(pg_get_serial_sequence('layers','id')) as last_insert_id;") or die("Database Error");
		if($d = pg_fetch_assoc($res)){
			return $d['last_insert_id'];;
		}
		return false;
	}

	function addProject($userId, $name){
		global $db;
		if((int)$userId == 0){
			return false;
		}

		$res = pg_query($db, "INSERT INTO projects (users_id, name) VALUES('".(int)$userId."', '".pg_escape_string($name)."'); SELECT currval(pg_get_serial_sequence('projects','id')) as last_insert_id;") or die("Database Error");
		if($d = pg_fetch_assoc($res)){
			return $d['last_insert_id'];;
		}
		return false;
	}

	function addGroup($userId, $name){
		global $db;
		if((int)$userId == 0){
			return false;
		}

		$res = pg_query($db, "INSERT INTO groups (users_id, name) VALUES('".(int)$userId."', '".pg_escape_string($name)."'); SELECT currval(pg_get_serial_sequence('groups','id')) as last_insert_id;") or die("Database Error");
		if($d = pg_fetch_assoc($res)){
			return $d['last_insert_id'];;
		}
		return false;
	}

	function addGroupHasLayers($userId, $groupId, $layersList){
		global $db;
		if(count($layersList) == 0){
			$layersList = array();
		}
		for($i=0;$i<count($layersList);$i++){
			$layersList[$i] = (int)$layersList[$i];
		}
		$groupId = (int)$groupId;
		$userId = (int)$userId;
		if($groupId == 0)
			return false;

		pg_query($db, "DELETE FROM groups_has_layers WHERE groups_id = $groupId AND groups_id IN (SELECT id FROM groups WHERE users_id = $userId)") or die("Database Error");

		$query = "INSERT INTO groups_has_layers(groups_id, layers_id) VALUES ";
		$values = array();

		foreach($layersList as $key => $val){
			if($val == 0){
				unset($layersList[$key]);
			}
			else{
				$values[] = "(".(int)$groupId.", ".(int)$val.")";
			}
		}

		$res = "";
		if(count($values) > 0){
			$res = pg_query($db, $query. implode(',', $values)."; SELECT currval(pg_get_serial_sequence('groups_has_layers','id')) as last_insert_id;") or die("Database Error");
		}
		else{
			return true;
		}

		if($d = pg_fetch_assoc($res)){
			return $d['last_insert_id'];;
		}
		return false;
	}

	function addProjectHasUsers($userId, $projectId, $usersList){
		global $db;
		if(count($usersList) == 0){
			$usersList = array();
		}
		for($i=0;$i<count($usersList);$i++){
			$usersList[$i] = (int)$usersList[$i];
		}

		$projectId = (int)$projectId;
		$userId = (int)$userId;
		if($projectId == 0)
			return false;

		pg_query($db, "DELETE FROM project_has_users WHERE projects_id = $projectId AND projects_id IN (SELECT id FROM projects WHERE users_id = $userId)") or die("Database Error");

		$query = "INSERT INTO project_has_users(projects_id, users_id) VALUES ";
		$values = array();

		foreach($usersList as $key => $val){
			if($val == 0){
				unset($usersList[$key]);
			}
			else{
				$values[] = "(".(int)$projectId.", ".(int)$val.")";
			}
		}

		$res = "";
		if(count($values) > 0){
			$res = pg_query($db, $query. implode(',', $values)."; SELECT currval(pg_get_serial_sequence('project_has_users','id')) as last_insert_id;") or die("Database Error");
		}
		else{
			return true;
		}

		if($d = pg_fetch_assoc($res)){
			return $d['last_insert_id'];;
		}
		return false;
	}

	function addCSV($userId, $filename, $content, $delimiter, $enclosure, $escape){
		global $db;
		if((int)$userId == 0){
			return false;
		}

		$res = pg_query($db, "INSERT INTO csv(users_id, file_name, csv_data, delimiter, enclosure, escape) VALUES('".(int)$userId."', '".pg_escape_string($filename)."', '".pg_escape_string($content)."', '".pg_escape_string($delimiter)."', '".pg_escape_string($enclosure)."', '".pg_escape_string($escape)."'); SELECT currval(pg_get_serial_sequence('csv','id')) as last_insert_id;") or die("Database Error");
		if($d = pg_fetch_assoc($res)){
			return $d['last_insert_id'];
		}
		return false;
	}

	/* Select */
	function getProjectById($id){
		global $db;
		$project = array();
		if((int)$id == 0){
			return $project;
		}
		$res = pg_query($db, "SELECT * FROM projects WHERE id = $id") or die("Database Error");
		if(pg_num_rows($res) > 0){
			if($data = pg_fetch_assoc($res)) {
				$project = $data;
			}
		}
		return $project;
	}

	function getProjectsByUserId($userId){
		global $db;
		$projects = array();
		if((int)$userId == 0){
			return $projects;
		}
		$res = pg_query($db, "SELECT * FROM projects WHERE users_id = $userId ORDER BY id DESC") or die("Database Error");
		if(pg_num_rows($res) > 0){
			while($data = pg_fetch_assoc($res)) {
				$projects[] = $data;
			}
		}
		return $projects;
	}

	function getMyProjects($userId){
		global $db;
		$projects = array();
		if((int)$userId == 0){
			return $projects;
		}
		$res = pg_query($db, "SELECT * FROM projects WHERE id IN (SELECT projects_id FROM project_has_users WHERE users_id = $userId) ORDER BY id DESC") or die("Database Error");
		if(pg_num_rows($res) > 0){
			while($data = pg_fetch_assoc($res)) {
				$projects[] = $data;
			}
		}
		return $projects;
	}

	function getLayersByGroupId($userId, $groupId){
		global $db;
		$layers = array();
		if((int)$userId == 0 || (int)$groupId == 0){
			return $layers;
		}
		$res = pg_query($db, "SELECT * FROM layers WHERE users_id = $userId AND id IN (SELECT layers_id FROM groups_has_layers WHERE groups_id = $groupId) ORDER BY id DESC") or die("Database Error");
		if(pg_num_rows($res) > 0){
			while($data = pg_fetch_assoc($res)) {
				$layers[] = $data;
			}
		}
		return $layers;
	}

	function getLayerByIdAndUserId($userId, $layersId){
		global $db;
		$layer = array();
		if((int)$userId == 0 || (int)$layersId == 0){
			return $layer;
		}
		$res = pg_query($db, "SELECT * FROM layers WHERE users_id = $userId AND id = $layersId") or die("Database Error");
		if(pg_num_rows($res) > 0){
			while($data = pg_fetch_assoc($res)) {
				$layer = $data;
			}
		}
		return $layer;
	}

	function getProjectByIdAndUserId($userId, $projectsId){
		global $db;
		$project = array();
		if((int)$userId == 0 || (int)$projectsId == 0){
			return $project;
		}
		$res = pg_query($db, "SELECT * FROM projects WHERE users_id = $userId AND id = $projectsId LIMIT 1") or die("Database Error");
		if(pg_num_rows($res) > 0){
			if($data = pg_fetch_assoc($res)) {
				$project = $data;
			}
		}
		return $project;
	}

	function getLayerById($layersId){
		global $db;
		$layer = array();
		if((int)$layersId == 0){
			return $layer;
		}
		$res = pg_query($db, "SELECT * FROM layers WHERE id = $layersId") or die("Database Error");
		if(pg_num_rows($res) > 0){
			while($data = pg_fetch_assoc($res)) {
				$layer = $data;
			}
		}
		return $layer;
	}

	function getLayersByUserId($userId){
		global $db;
		$layers = array();
		if((int)$userId == 0){
			return $layers;
		}
		$res = pg_query($db, "SELECT * FROM layers WHERE users_id = $userId ORDER BY id DESC") or die("Database Error");
		if(pg_num_rows($res) > 0){
			while($data = pg_fetch_assoc($res)) {
				$layers[] = $data;
			}
		}
		return $layers;
	}

	function getGroupsByUserId($userId){
		global $db;
		$group = array();
		if((int)$userId == 0){
			return $group;
		}
		$res = pg_query($db, "SELECT * FROM groups WHERE users_id = $userId ORDER BY id DESC") or die("Database Error");
		if(pg_num_rows($res) > 0){
			while($data = pg_fetch_assoc($res)) {
				$group[] = $data;
			}
		}
		return $group;
	}

	function getGroupById($userId, $groupId){
		global $db;
		$group = array();
		if((int)$userId == 0 || (int)$groupId == 0){
			return $group;
		}
		$res = pg_query($db, "SELECT * FROM groups WHERE users_id = $userId AND id = $groupId") or die("Database Error");
		if(pg_num_rows($res) > 0){
			while($data = pg_fetch_assoc($res)) {
				$group = $data;
			}
		}
		return $group;
	}

	function getProjectHasUsersByProjectId($userId, $projectId) {
		global $db;
		$phu = array();
		if((int)$userId == 0 || (int)$projectId == 0){
			return $phu;
		}
		$res = pg_query($db, "SELECT * FROM project_has_users WHERE projects_id = $projectId AND users_id IN (SELECT id FROM users WHERE users_id = $userId) ORDER BY id DESC") or die("Database Error");
		if(pg_num_rows($res) > 0){
			while($data = pg_fetch_assoc($res)) {
				$phu[] = $data;
			}
		}
		return $phu;
	}

	function getGroupHasLayersByGroupId($userId, $groupId) {
		global $db;
		$ghl = array();
		if((int)$userId == 0 || (int)$groupId == 0){
			return $ghl;
		}
		$res = pg_query($db, "SELECT * FROM groups_has_layers WHERE groups_id = $groupId AND layers_id IN (SELECT id FROM layers WHERE users_id = $userId) ORDER BY id DESC") or die("Database Error");
		if(pg_num_rows($res) > 0){
			while($data = pg_fetch_assoc($res)) {
				$ghl[] = $data;
			}
		}
		return $ghl;
	}

	function getCSV($userId, $id){
		global $db;
		$csv = array();
		if((int)$userId == 0 || (int)$id == 0){
			return $csv;
		}
		$res = pg_query($db, "SELECT * FROM csv WHERE users_id = $userId AND id = $id") or die("Database Error");
		if(pg_num_rows($res) > 0){
			if($data = pg_fetch_assoc($res)) {
				$csv = $data;
			}
		}
		return $csv;
	}

	function getCSVsByUserId($userId){
		global $db;
		$csv = array();
		if((int)$userId == 0){
			return $csv;
		}
		$res = pg_query($db, "SELECT * FROM csv WHERE users_id = $userId") or die("Database Error");
		if(pg_num_rows($res) > 0){
			while($data = pg_fetch_assoc($res)) {
				$csv[] = $data;
			}
		}
		return $csv;
	}

	function processMapFile($map, $shapes, $targetFile, $isExporter = false) {
		global $db;
		$defaulLayer = getLayerById($map['layers_id']);
		$defaulLayer = "L.tileLayer('".$defaulLayer['url']."', {maxZoom: 18, id: '".$defaulLayer['lkey']."', token: '".$defaulLayer['accesstoken']."', attribution: '".$defaulLayer['attribution']."'+mbAttribution})";

		$baseLayers = array();
		$res = pg_query($db, "SELECT * FROM layers WHERE id IN (SELECT layers_id FROM groups_has_layers WHERE groups_id = ".(int)$map['groups_id'].")") or die("Database Error");
		if(pg_num_rows($res) > 0){
			while($data = pg_fetch_assoc($res)) {
				$baseLayers[] = "'".$data['name']."': L.tileLayer('".$data['url']."', {maxZoom: 18, id: '".$data['lkey']."', token: '".$data['accesstoken']."', attribution: '".$data['attribution']."'+mbAttribution})";
			}
		}
		$baseLayers = implode(",", $baseLayers);

		$content = file_get_contents($targetFile);
		$geoJSON = array(
				"type"     => "FeatureCollection",
				"features" => array()
			);

		if(is_array( $shapes) && count( $shapes)>0){
			$i=0;
			foreach($shapes as $shape){

				$geoJSON['features'][$i] = array (
											"type"       => "Feature",
											"properties" => json_decode($shape['properties']),
											"geometry"   => array (
														"type"        => $shape['type'],
														"coordinates" => json_decode($shape['coordinates'])
													),
											"style"      => json_decode($shape['style']),
											"customProperties" => json_decode($shape['customproperties']),
										);
				$i++;
			}
		} else {
			$first_lat = 0;
			$first_lng = 0;
		}

		$map['mapcenter'] = str_replace(array("[","]"), "", $map['mapcenter']);
		$match = explode(",", $map['mapcenter']);

		$first_lat = (float)$match[0];
		$first_lng = (float)$match[1];

		$jsonString = json_encode($geoJSON);

		$search  = array('[#ZOOM#]', '[#SET_MARKER#]', '[#SHOW_SIDEBAR#]', '[#BUTTON_STYLE#]', '[#JSON_STRING#]', '[#LAT#]', '[#LNG#]', '[#BASEURL#]', '[#CDNURL#]', '[#MAIN_DOMAIN#]', '[#SITE_NAME_FORMATED#]', '[#DEFAULT_LAYER#]', '[#BASE_LAYERS_ARRAY#]', '[#FILTERED_COLUMNS#]', '[#CLUSTER#]', '[#OVERLAY_ENABLE#]', '[#OVERLAY_TITLE#]', '[#OVERLAY_BLURB#]', '[#OVERLAY_CONTENT#]', '[#LEGEND_ENABLE#]', '[#LEGEND_CONTENT#]', '[#IMAGE_OVERLAYS#]', '[#MAP_ID#]', '[#SHOW_EXPORT#]', '[#SHOW_MEASURE#]', '[#SHOW_MINIMAP#]', '[#SHOW_SEARCH#]', '[#SHOW_FILELAYER#]', '[#SHOW_PLAYBACK#]', '[#GPX_TRACKS#]', '[#SHOW_STATIC_SIDEBAR#]', '[#STATIC_SIDEBAR_CONTENT#]', '[#SHOW_SVG#]', '[#MAP_BOUNDS#]');
		$replace = array($map['zoom'], ($map['defaultopen'] == 't')?'true':'false', ($map['showsidebar'] == 't')?'true':'false', $map['button_style'], $jsonString, $first_lat, $first_lng, BASEURL, CDNURL, MAIN_DOMAIN, SITE_NAME_FORMATED, $defaulLayer, $baseLayers, $map['filteredcolumns'], ($map['cluster'] == 't')?'true':'false', ($map['overlay_enable'] == 't')?'true':'false', htmlentities($map['overlay_title']), htmlentities($map['overlay_blurb']), htmlentities($map['overlay_content']), ($map['legend_enable'] == 't')?'true':'false', htmlentities($map['legend_content']), $map['image_overlays'], $map['id'], ($map['show_export'] == 't')?'true':'false', ($map['show_measure'] == 't')?'true':'false', ($map['show_minimap'] == 't')?'true':'false', ($map['show_search'] == 't')?'true':'false', ($map['show_filelayer'] == 't')?'true':'false', ($map['show_playback'] == 't')?'true':'false', $map['gpx_tracks'], ($map['show_static_sidebar'] == 't')?'true':'false', $map['static_sidebar_content'], ($map['show_svg'] == 't')?'true':'false', $map['map_bounds']);
		if(!$isExporter){
			$search  = array_merge($search, array('[#HEIGHT#]', '[#HEIGHT_UNIT#]', '[#WIDTH#]', '[#WIDTH_UNIT#]'));
			$replace = array_merge($replace, array($map['height'], 'px', $map['width'], 'px'));
		}

		return str_replace($search, $replace, $content);
	}

	function processMapTemplate($mapId, $templateName) {
		global $db;

		$folderName = generateRandomString(16);
		$path = '../downloads/html-template/'.$folderName.'/';

		$map = getMapById($mapId);
		if($map) {
			$shapes = getShapesByMapId($mapId);

			$defaulLayer = getLayerById($map['layers_id']);
			$defaulLayer = "L.tileLayer('".$defaulLayer['url']."', {maxZoom: 18, id: '".$defaulLayer['lkey']."', token: '".$defaulLayer['accesstoken']."', attribution: '".$defaulLayer['attribution']."'+mbAttribution})";

			$baseLayers = array();
			$res = pg_query($db, "SELECT * FROM layers WHERE id IN (SELECT layers_id FROM groups_has_layers WHERE groups_id = ".(int)$map['groups_id'].")") or die("Database Error");
			if(pg_num_rows($res) > 0){
				while($data = pg_fetch_assoc($res)) {
					$baseLayers[] = "'".$data['name']."': L.tileLayer('".$data['url']."', {maxZoom: 18, id: '".$data['lkey']."', token: '".$data['accesstoken']."', attribution: '".$data['attribution']."'+mbAttribution})";
				}
			}
			$baseLayers = implode(",", $baseLayers);

			//$content = file_get_contents('map/html-template/'.$templateName.'/index.html');
			$content = file_get_contents('map/view.tpl');
			$geoJSON = array(
					"type"     => "FeatureCollection",
					"features" => array()
				);

			if(is_array( $shapes) && count( $shapes)>0){
				$i=0;
				foreach($shapes as $shape){

					$geoJSON['features'][$i] = array (
												"type"       => "Feature",
												"properties" => json_decode($shape['properties']),
												"geometry"   => array (
															"type"        => $shape['type'],
															"coordinates" => json_decode($shape['coordinates'])
														),
												"style"      => json_decode($shape['style']),
												"customProperties" => json_decode($shape['customproperties']),
											);
					$i++;
				}
			} else {
				$first_lat = 0;
				$first_lng = 0;
			}

			$map['mapcenter'] = str_replace(array("[","]"), "", $map['mapcenter']);
			$match = explode(",", $map['mapcenter']);

			$first_lat = (float)$match[0];
			$first_lng = (float)$match[1];

			$jsonString = json_encode($geoJSON);

			$search  = array('[#HEIGHT#]', '[#HEIGHT_UNIT#]', '[#WIDTH#]', '[#WIDTH_UNIT#]', '[#ZOOM#]', '[#SET_MARKER#]', '[#SHOW_SIDEBAR#]', '[#BUTTON_STYLE#]', '[#JSON_STRING#]', '[#LAT#]', '[#LNG#]', '[#BASEURL#]', '[#CDNURL#]', '[#MAIN_DOMAIN#]', '[#SITE_NAME_FORMATED#]', '[#DEFAULT_LAYER#]', '[#BASE_LAYERS_ARRAY#]', '[#FILTERED_COLUMNS#]', '[#CLUSTER#]', '[#OVERLAY_ENABLE#]', '[#OVERLAY_TITLE#]', '[#OVERLAY_BLURB#]', '[#OVERLAY_CONTENT#]', '[#LEGEND_ENABLE#]', '[#LEGEND_CONTENT#]', '[#IMAGE_OVERLAYS#]', '[#MAP_ID#]', '[#SHOW_EXPORT#]', '[#SHOW_MEASURE#]', '[#SHOW_MINIMAP#]', '[#SHOW_SEARCH#]', '[#SHOW_FILELAYER#]', '[#SHOW_PLAYBACK#]', '[#GPX_TRACKS#]', '[#SHOW_STATIC_SIDEBAR#]', '[#STATIC_SIDEBAR_CONTENT#]', '[#SHOW_SVG#]', '[#MAP_BOUNDS#]');
			$replace = array('800', 'px', '100', '%', $map['zoom'], ($map['defaultopen'] == 't')?'true':'false', ($map['showsidebar'] == 't')?'true':'false', $map['button_style'], $jsonString, $first_lat, $first_lng, BASEURL, CDNURL, MAIN_DOMAIN, SITE_NAME_FORMATED, $defaulLayer, $baseLayers, $map['filteredcolumns'], ($map['cluster'] == 't')?'true':'false', ($map['overlay_enable'] == 't')?'true':'false', htmlentities($map['overlay_title']), htmlentities($map['overlay_blurb']), htmlentities($map['overlay_content']), ($map['legend_enable'] == 't')?'true':'false', htmlentities($map['legend_content']), $map['image_overlays'], $map['id'], ($map['show_export'] == 't')?'true':'false', ($map['show_measure'] == 't')?'true':'false', ($map['show_minimap'] == 't')?'true':'false', ($map['show_search'] == 't')?'true':'false', ($map['show_filelayer'] == 't')?'true':'false', ($map['show_playback'] == 't')?'true':'false', $map['gpx_tracks'], ($map['show_static_sidebar'] == 't')?'true':'false', $map['static_sidebar_content'], ($map['show_svg'] == 't')?'true':'false', $map['map_bounds']);


			$map_content = str_replace($search, $replace, $content);	/* it's whole compiled view.tpl */


			$shell_out = shell_exec("mkdir ".$path." 2>&1");
			if($shell_out == ""){
				shell_exec("cp -r map/html-template/$templateName/ $path 2>&1");

				$content = file_get_contents($path.$templateName."/index.html");
				$content = str_replace("[#MAP_CONTENT#]", $map_content, $content);
				file_put_contents($path.$templateName."/index.html", $content);

				shell_exec("
					cd $path
					zip -r $templateName $templateName/ 2>&1
				");
				$zipFile = file_get_contents("$path$templateName.zip");
				shell_exec("rm -r $path");

				return $zipFile;
			}
			exit();
		}
		else {
			die("Map Not Found!");
		}
	}

	function getPureJSON($mapId) {
		$map    = getMapById((int)$mapId);
		$shapes = getShapesByMapId($mapId);

		$geoJSON = array(
				"type"     => "FeatureCollection",
				"features" => array()
			);

		if(is_array( $shapes) && count( $shapes)>0){
			$i=0;
			foreach($shapes as $shape){
				$propertiesList = array();
				$properties = json_decode($shape['properties']);

				foreach($properties as $property) {
					$propertiesList[$property->name] = $property->value;
				}

				$geoJSON['features'][$i] = array (
											"type"       => "Feature",
											"properties" => $propertiesList,
											"geometry"   => array (
														"type"        => $shape['type'],
														"coordinates" => json_decode($shape['coordinates'])
													),
										);
				$i++;
			}
		}

		return json_encode($geoJSON);
	}

	function convertMapContent($sourceContent, $sourceFormat, $sourceExtension, $targetFormat, $targetExtension) {
		$response = array();
		$content = "";
		$query   = "ogr2ogr -f ";

		$temp_dir = generateRandomString(32);
		$target_dir = dirname(__FILE__).'/../downloads/ogr2ogr/'.$temp_dir;
		@mkdir($target_dir);
		$target_dir .= "/";
		$targetFileName = "temp.".$targetExtension;
		$sourceFileName = "temp.".$sourceExtension;
		file_put_contents($target_dir.$sourceFileName, $sourceContent);

		$query .= '"'.$targetFormat.'" "'.$target_dir.$targetFileName.'" ';
		$query .= '"'.$target_dir.$sourceFileName.'"';

		$shell = shell_exec($query." 2>&1");
		if(strlen($shell) > 5 && (!(strpos(strtolower($shell), 'failure') === FALSE))) {
			$response['success'] = false;
			$response['content'] = $shell;
		}
		else {
			$content = file_get_contents($target_dir.$targetFileName);

			$response['success'] = true;
			$response['content'] = $content;
		}

		shell_exec("rmdir -R ".$target_dir);
		return $response;
	}

	function uploadShare($name) {
		$target_dir = dirname(__FILE__)."/../app/img/share/";
		$target_file = $target_dir . $name . '.png';

		$imageFileType = pathinfo(basename($_FILES[$name]["name"]),PATHINFO_EXTENSION);

		// Check if image file is a actual image or fake image
		$check = getimagesize($_FILES[$name]["tmp_name"]);
		if($check !== false) {

		} else {
			return $name." File is not an image.";
		}

		// Check file size
		if ($_FILES[$name]["size"] > 300000) {
			return "Sorry, your file ".$name." is too large. Max allowed size is : 300kb";
		}

		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			return "Sorry, only JPG, JPEG, PNG & GIF files are allowed. ".$name." is not an image";
		}

		$content = file_get_contents($_FILES[$name]["tmp_name"]);
		file_put_contents($target_file, $content);

		return "";
	}

	function sendWelcomeEmail($userId, $password) {
		global $mailer;
		$user = getUserInfo($userId);

		if($user) {
			$bodyMessage = "Welcome to the ".SITE_NAME_FORMATED." Studio, here is your account details.<br/><b>First Name : </b> ".$user['firstname']."<br/><b>Last Name : </b> ".$user['lastname']."<br/><b>Email Address : </b> ".$user['email']."<br/><b>Password : </b> ".$password."<br/><br/> Please click the below button to login and verify your account.";

			$body = file_get_contents(MAIL_TEMPLATE_DIRECTORY."welcomeEmail.tpl");
			$body = str_replace(array("[#BASEURL#]", "[#FIRSTNAME#]", "[#BODY#]", "[#VERIFY_KEY#]", "[#COPYRIGHT_TEXT#]"), array(BASEURL, $user['firstname'], $bodyMessage, $user['activationkey'], COPYRIGHT_TEXT), $body);

			if($mailer->send(MAIL_FROM, MAIL_FROM_NAME, $user['email'], WELCOME_EMAIL_SUBJECT, $body)) {
				return true;
			}
		}
		else {
			return false;
		}

		return false;
	}

	function recover($email) {
		global $db;
		global $mailer;

		$password = generateRandomString(8);

		$res = pg_query($db, "UPDATE users SET password = '".pg_escape_string(md5($password))."' WHERE email = '".pg_escape_string($email)."'") or die("Database Error");
		if(pg_affected_rows($res) == 1) {

			$user = getUserByEmail($email);

			if($user) {
				$bodyMessage = "You've requested for the new Password, Your new Password is : <br/><b>$password </b> <br/><br/> Please click the below button to login.";

				$body = file_get_contents(MAIL_TEMPLATE_DIRECTORY."recoverPasswordEmail.tpl");
				$body = str_replace(array("[#BASEURL#]", "[#FIRSTNAME#]", "[#BODY#]", "[#COPYRIGHT_TEXT#]"), array(BASEURL, $user['firstname'], $bodyMessage, COPYRIGHT_TEXT), $body);

				if($mailer->send(MAIL_FROM, MAIL_FROM_NAME, $user['email'], SITE_NAME_FORMATED." Studio - Change Your Password", $body)) {
					return true;
				}
			}


			return true;
		}

		return false;
	}
	
	function purgMaps($days, $userId = 0) {
		global $db;
		
		if((int)$days == 0){
			return false;
		}
		if((int)$userId == 0){
			$userId = $_SESSION['user']['id'];
		}
		if((int)$userId == 0){
			return false;
		}
		
		$res = pg_query($db, "DELETE FROM maps WHERE users_id = $userId AND source = 'api' AND createdat < (NOW() - INTERVAL '".$days." days')") or die("Database Error");
		
		return pg_affected_rows($res);
	}
	
	function getBrowser() { 
		$u_agent = $_SERVER['HTTP_USER_AGENT']; 
		$bname = 'Unknown';
		$platform = 'Unknown';
		$version= "Unknown";

		//First get the platform?
		if (preg_match('/linux/i', $u_agent)) {
			$platform = 'linux';
		}
		elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
			$platform = 'mac';
		}
		elseif (preg_match('/windows|win32/i', $u_agent)) {
			$platform = 'windows';
		}
		
		// Next get the name of the useragent yes seperately and for good reason
		if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
		{ 
			$bname = 'Internet Explorer'; 
			$ub = "MSIE"; 
		} 
		elseif(preg_match('/Firefox/i',$u_agent)) 
		{ 
			$bname = 'Mozilla Firefox'; 
			$ub = "Firefox"; 
		} 
		elseif(preg_match('/Chrome/i',$u_agent)) 
		{ 
			$bname = 'Google Chrome'; 
			$ub = "Chrome"; 
		} 
		elseif(preg_match('/Safari/i',$u_agent)) 
		{ 
			$bname = 'Apple Safari'; 
			$ub = "Safari"; 
		} 
		elseif(preg_match('/Opera/i',$u_agent)) 
		{ 
			$bname = 'Opera'; 
			$ub = "Opera"; 
		} 
		elseif(preg_match('/Netscape/i',$u_agent)) 
		{ 
			$bname = 'Netscape'; 
			$ub = "Netscape"; 
		} 
		
		// finally get the correct version number
		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>' . join('|', $known) .
		')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		if (!preg_match_all($pattern, $u_agent, $matches)) {
			// we have no matching number just continue
		}
		
		// see how many we have
		$i = count($matches['browser']);
		if ($i != 1) {
			//we will have two since we are not using 'other' argument yet
			//see if version is before or after the name
			if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
				$version= $matches['version'][0];
			}
			else {
				$version= $matches['version'][1];
			}
		}
		else {
			$version= $matches['version'][0];
		}
		
		// check if we have a number
		if ($version==null || $version=="") {$version="?";}
		
		return array(
			'userAgent' => $u_agent,
			'name'      => $bname,
			'version'   => $version,
			'platform'  => $platform,
			'pattern'    => $pattern
		);
	} 
?>