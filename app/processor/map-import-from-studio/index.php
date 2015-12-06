<?PHP
	require_once(dirname(__FILE__)."/../../../include/master.inc.php");
	
	if(!isLogin() && isAdmin(getUserInfo())) {
		die("Your Session is expired!");
	}
	
	$url = $_GET['url'];
	$apikey = $_GET['apikey'];
	
	if($apikey == "" || $url == "") {
		die("URL and API Key is Required");
	}
	
	$maps = file_get_contents($url.'/api/exporter.api.php?action=allmaps&apikey='.$apikey) or die("Invalid URL");
	if($maps == "") {
		die("URL or API Key is Invalid");
	}
	
	$maps = (array)json_decode($maps);
	
	if($maps['success'] == true) {
		if(count($maps) > 0) {
			$labels = array();
			
			foreach($maps[0] as $key => $val) {
				if( $key == "users_id" ||
					$key == "height" ||
					$key == "width" ||
					$key == "zoom" ||
					$key == "showsidebar" ||
					$key == "defaultopen" ||
					$key == "status" ||
					$key == "createdon" ||
					$key == "name" ||
					$key == "layers_id" ||
					$key == "groups_id" ||
					$key == "setgrouptoopen" ||
					$key == "button_style" ||
					$key == "mapcenter" ||
					$key == "password" ||
					$key == "filteredcolumns" ||
					$key == "stylingcolumn" ||
					$key == "shapestyling" ||
					$key == "cluster" ||
					$key == "overlay_title" ||
					$key == "overlay_content" ||
					$key == "overlay_blurb" ||
					$key == "overlay_enable" ||
					$key == "legend_content" ||
					$key == "legend_enable" ||
					$key == "image_overlays" ||
					$key == "show_export" ||
					$key == "projects_id" ||
					$key == "show_measure" ||
					$key == "show_minimap" ||
					$key == "show_search" ||
					$key == "show_filelayer" ||
					$key == "show_playback" ||
					$key == "gpx_tracks" ||
					$key == "show_static_sidebar" ||
					$key == "static_sidebar_content" ||
					$key == "show_svg" ||
					$key == "source" ||
					$key == "map_views"
				) {
					$labels[] = $key;
				}
			}
			
			$sql = "INSERT INTO maps (".implode(',', $labels).") values ";
			
			$valuesArr = array();
			foreach($maps as &$map) {
				$map = (array)$map;
				foreach($map as $key => $v) {
					if( $key == "users_id" ||
						$key == "height" ||
						$key == "width" ||
						$key == "zoom" ||
						$key == "showsidebar" ||
						$key == "defaultopen" ||
						$key == "status" ||
						$key == "createdon" ||
						$key == "name" ||
						$key == "layers_id" ||
						$key == "groups_id" ||
						$key == "setgrouptoopen" ||
						$key == "button_style" ||
						$key == "mapcenter" ||
						$key == "password" ||
						$key == "filteredcolumns" ||
						$key == "stylingcolumn" ||
						$key == "shapestyling" ||
						$key == "cluster" ||
						$key == "overlay_title" ||
						$key == "overlay_content" ||
						$key == "overlay_blurb" ||
						$key == "overlay_enable" ||
						$key == "legend_content" ||
						$key == "legend_enable" ||
						$key == "image_overlays" ||
						$key == "show_export" ||
						$key == "projects_id" ||
						$key == "show_measure" ||
						$key == "show_minimap" ||
						$key == "show_search" ||
						$key == "show_filelayer" ||
						$key == "show_playback" ||
						$key == "gpx_tracks" ||
						$key == "show_static_sidebar" ||
						$key == "static_sidebar_content" ||
						$key == "show_svg" ||
						$key == "source" ||
						$key == "map_views"
					) {
						if($key == 'users_id') {
							$map[$key] = $_SESSION['user']['id'];
						}
						else {
							$map[$key] = "'".pg_escape_string($v)."'";
						}
					}
					else {
						unset($map[$key]);
					}
				}
				
				$valuesArr[] = "(".implode(',', $map).")";
			}
			
			$sql .= implode(',', $valuesArr);
			pg_query($sql) or exit("Error While saving Maps"); 
		}
	}
	else {
		die($maps['message']);
	}
	die("No map Found! Please check the API key or make sure there are maps available in your old studio account");
?>