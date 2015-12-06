<?PHP
	class Statistics {
		
		private $db;
		private $stats_db;
		private $users_id;
		
		function __construct($users_id = 0) {
			global $db; // APP DB
			global $stats_db; // Stats DB
			$this->db = $db;
			$this->stats_db = $stats_db;
			
			$users_id = (int)$users_id;
			if($users_id == 0){
				$this->users_id = (int) $_SESSION['user']['id'];
			}
			else {
				$this->users_id = $users_id;
			}
		}
		
		function addMapView($ip, $mapId, $mapName, $createdBy_id) {
			$details = (array)json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
			
			$hostname = "";
			$city = "";
			$region = "";
			$country = "";
			$org = "";
			$postal = "";
			$phone = "";
			$loc = "0,0";
			
			if($details['hostname']) {
				$hostname = $details['hostname'];
				$city = $details['city'];
				$region = $details['region'];
				$country = $details['country'];
				$org = $details['org'];
				$postal = $details['postal'];
				$phone = $details['phone'];
				$loc = $details['loc'];;
			}
			
			$browser = getBrowser();
			
			$browser_name = $browser['name'];
			$browser_version = $browser['version'];
			$os = $browser['platform'];
			
			$user = getUserInfo($createdBy_id);
			$browser = $_SERVER['HTTP_USER_AGENT'];
			
			$res = pg_query($this->stats_db, "INSERT INTO statistics_maps_view (ip, maps_id, maps_name, apikey, hostname, city, region, country, loc, org, postal, phone, referer_url, browser_name, browser_version, os) 
			VALUES('".$ip."', ".(int)$mapId.", '".pg_escape_string($map_name)."', '".pg_escape_string($user['apikey'])."', '".pg_escape_string($hostname)."', '".pg_escape_string($city)."', '".pg_escape_string($region)."', '".pg_escape_string($country)."', '".pg_escape_string($loc)."', '".pg_escape_string($org)."', '".pg_escape_string($postal)."', '".pg_escape_string($phone)."', '".pg_escape_string($_SERVER['HTTP_REFERER'])."', '".pg_escape_string($browser_name)."', '".pg_escape_string($browser_version)."', '".pg_escape_string($os)."'); SELECT currval(pg_get_serial_sequence('statistics_maps_view','id')) as last_insert_id;") or die(pg_last_error());
			
			if($d = pg_fetch_assoc($res)) {
				$id = $d['last_insert_id'];
			}
			
			return $id;
		}
		
		function getRecentMapViews($timeframe, $country, $apikey, $browser_name) {
			$records = array();
			
			switch($timeframe) {
				
				case "3 Years":
					$i = 35;
					while($i >= 0) {
						$res = $this->getRecentMapViewsDateWise(strtotime("-$i months", strtotime(date('Y-m-01'))), strtotime("-".($i-3)." months", strtotime(date('Y-m-01'))), $country, $apikey, $browser_name);
						$res['date'] = date("M, Y", strtotime("-$i months", strtotime(date('Y-m-01'))));
						
						$records[] = $res;
						$i-=3;
					}
				break;
				
				case "1 Year":
					$i = 11;
					while($i >= 0) {
						$res = $this->getRecentMapViewsDateWise(strtotime("-$i months", strtotime(date('Y-m-01'))), strtotime("-".($i-1)." months", strtotime(date('Y-m-01'))), $country, $apikey, $browser_name);
						$res['date'] = date("M, Y", strtotime("-$i months", strtotime(date('Y-m-01'))));
						
						$records[] = $res;
						$i--;
					}
				break;
				
				case "3 Months" : 
					$i = 89;
					while($i >= 0) {
						$res = $this->getRecentMapViewsDateWise(strtotime("-$i days"), strtotime("-".($i-6)." days"), $country, $apikey, $browser_name);
						$res['date'] = date("jS M", strtotime("-$i days"));
						
						$records[] = $res;
						$i-=6;
					}
				break;
				
				case "1 Month" : 
					$i = 29;
					while($i >= 0) {
						$res = $this->getRecentMapViewsDateWise(strtotime("-$i days"), strtotime("-".($i-2)." days"), $country, $apikey, $browser_name);
						$res['date'] = date("jS M", strtotime("-$i days"));
						
						$records[] = $res;
						$i-=2;
					}
				break;
				
				case "1 Week" : 
					$i = 6;
					while($i >= 0) {
						$res = $this->getRecentMapViewsDateWise(strtotime("-$i days"), strtotime("-".($i-1)." days"), $country, $apikey, $browser_name);
						$res['date'] = date("D, jS M", strtotime("-$i days"));
						
						$records[] = $res;
						$i--;
					}
				break;
				
				case "1 Day" : 
					$i = 23;
					while($i >= 0) {
						$res = $this->getRecentMapViewsDateWise(strtotime("-$i hours"), strtotime("-".($i-2)." hours"), $country, $apikey, $browser_name);
						$res['date'] = date("g:i a", strtotime("-$i hours"));
						
						$records[] = $res;
						$i-=2;
					}
				break;
				
				case "12 Hours" : 
					$i = 11;
					while($i >= 0) {
						$res = $this->getRecentMapViewsDateWise(strtotime("-$i hours"), strtotime("-".($i-1)." hours"), $country, $apikey, $browser_name);
						$res['date'] = date("g:i a", strtotime("-$i hours"));
						
						$records[] = $res;
						$i--;
					}
				break;
				
				case "1 Hour" : 
					$i = 60;
					while($i >= 0) {
						$res = $this->getRecentMapViewsDateWise(strtotime("-$i minutes"), strtotime("-".($i-4)." minutes"), $country, $apikey, $browser_name);
						$res['date'] = date("g:i:s a", strtotime("-$i minutes"));
						
						$records[] = $res;
						$i-=4;
					}
				break;
			}
			
			return $records;
		}
		
		private function getRecentMapViewsDateWise($startDate, $endDate, $country, $apikey, $browser_name) {
			$where = "";
			if($country != "") {
				$where .= " s.country = '".pg_escape_string($country)."' AND ";
			}
			if($apikey != "" && isAdmin($_SESSION['user'])) {
				$where .= " s.apikey = '".pg_escape_string($apikey)."' AND ";
			}
			if($browser_name != "") {
				$where .= " s.browser_name = '".pg_escape_string($browser_name)."' AND ";
			}
			
			if($_SESSION['user']['users_id'] == 0) { // Admin
				
				$res = pg_query($this->stats_db, "
					SELECT COUNT(s.id)
						FROM statistics_maps_view s
						  WHERE
						  $where
						  s.viewed_at > to_timestamp($startDate) AND 
						  s.viewed_at < to_timestamp($endDate);
				") or die("Database Error");
				
			}
			else {
				
				$maps = getMaps($this->users_id);
				$maps_id = array();
				
				foreach($maps as $map) {
					$maps_id[] = $map['id'];
				}
				
				if(count($maps_id) == 0) {
					return array();
				}
				
				$res = pg_query($this->stats_db, "
					SELECT COUNT(s.id)
						FROM statistics_maps_view s
						  WHERE s.maps_id IN (".implode(",", $maps_id).") AND
						  $where
						  s.viewed_at > to_timestamp($startDate) AND 
						  s.viewed_at < to_timestamp($endDate);
				") or die("Database Error");
				
			}
			
			if($data = pg_fetch_assoc($res)) {
				return $data;
			}
			
			return array();
		}
		
		
		function getUniqueMapViews($timeframe, $country, $apikey, $browser_name) {
			$records = array();
			
			switch($timeframe) {
				
				case "3 Years":
					$i = 35;
					while($i >= 0) {
						$res = $this->getUniqueMapViewsDateWise(strtotime("-$i months", strtotime(date('Y-m-01'))), strtotime("-".($i-3)." months", strtotime(date('Y-m-01'))), $country, $apikey, $browser_name);
						$res['date'] = date("M, Y", strtotime("-$i months", strtotime(date('Y-m-01'))));
						
						$records[] = $res;
						$i-=3;
					}
				break;
				
				case "1 Year":
					$i = 11;
					while($i >= 0) {
						$res = $this->getUniqueMapViewsDateWise(strtotime("-$i months", strtotime(date('Y-m-01'))), strtotime("-".($i-1)." months", strtotime(date('Y-m-01'))), $country, $apikey, $browser_name);
						$res['date'] = date("M, Y", strtotime("-$i months", strtotime(date('Y-m-01'))));
						
						$records[] = $res;
						$i--;
					}
				break;
				
				case "3 Months" : 
					$i = 89;
					while($i >= 0) {
						$res = $this->getUniqueMapViewsDateWise(strtotime("-$i days"), strtotime("-".($i-6)." days"), $country, $apikey, $browser_name);
						$res['date'] = date("jS M", strtotime("-$i days"));
						
						$records[] = $res;
						$i-=6;
					}
				break;
				
				case "1 Month" : 
					$i = 29;
					while($i >= 0) {
						$res = $this->getUniqueMapViewsDateWise(strtotime("-$i days"), strtotime("-".($i-2)." days"), $country, $apikey, $browser_name);
						$res['date'] = date("jS M", strtotime("-$i days"));
						
						$records[] = $res;
						$i-=2;
					}
				break;
				
				case "1 Week" : 
					$i = 6;
					while($i >= 0) {
						$res = $this->getUniqueMapViewsDateWise(strtotime("-$i days"), strtotime("-".($i-1)." days"), $country, $apikey, $browser_name);
						$res['date'] = date("D, jS M", strtotime("-$i days"));
						
						$records[] = $res;
						$i--;
					}
				break;
				
				case "1 Day" : 
					$i = 23;
					while($i >= 0) {
						$res = $this->getUniqueMapViewsDateWise(strtotime("-$i hours"), strtotime("-".($i-2)." hours"), $country, $apikey, $browser_name);
						$res['date'] = date("g:i a", strtotime("-$i hours"));
						
						$records[] = $res;
						$i-=2;
					}
				break;
				
				case "12 Hours" : 
					$i = 11;
					while($i >= 0) {
						$res = $this->getUniqueMapViewsDateWise(strtotime("-$i hours"), strtotime("-".($i-1)." hours"), $country, $apikey, $browser_name);
						$res['date'] = date("g:i a", strtotime("-$i hours"));
						
						$records[] = $res;
						$i--;
					}
				break;
				
				case "1 Hour" : 
					$i = 60;
					while($i >= 0) {
						$res = $this->getUniqueMapViewsDateWise(strtotime("-$i minutes"), strtotime("-".($i-4)." minutes"), $country, $apikey, $browser_name);
						$res['date'] = date("g:i:s a", strtotime("-$i minutes"));
						
						$records[] = $res;
						$i-=4;
					}
				break;
			}
			
			return $records;
		}
		
		private function getUniqueMapViewsDateWise($startDate, $endDate, $country, $apikey, $browser_name) {
			$where = "";
			if($country != "") {
				$where .= " s.country = '".pg_escape_string($country)."' AND ";
			}
			if($apikey != "" && isAdmin($_SESSION['user'])) {
				$where .= " s.apikey = '".pg_escape_string($apikey)."' AND ";
			}
			if($browser_name != "") {
				$where .= " s.browser_name = '".pg_escape_string($browser_name)."' AND ";
			}
			
			if($_SESSION['user']['users_id'] == 0) { // Admin
				
				$res = pg_query($this->stats_db, "
					SELECT COUNT(DISTINCT s.ip)
						FROM statistics_maps_view s
						  WHERE
						  $where
						  s.viewed_at > to_timestamp($startDate) AND 
						  s.viewed_at < to_timestamp($endDate);
				") or die("Database Error");
				
			}
			else {
				
				$maps = getMaps($this->users_id);
				$maps_id = array();
				
				foreach($maps as $map) {
					$maps_id[] = $map['id'];
				}
				
				if(count($maps_id) == 0) {
					return array();
				}
				
				$res = pg_query($this->stats_db, "
					SELECT COUNT(DISTINCT s.ip)
						FROM statistics_maps_view s
						  WHERE s.maps_id IN (".implode(",", $maps_id).") AND
						  $where
						  s.viewed_at > to_timestamp($startDate) AND 
						  s.viewed_at < to_timestamp($endDate);
				") or die("Database Error");
				
			}
			
			if($data = pg_fetch_assoc($res)) {
				return $data;
			}
			
			return array();
		}
		
		function getStatistics($startDate, $country, $apikey, $browser_name) {
			$records = array();
			$maps_id = array();
			
			$where = "";
			if($country != "") {
				$where .= " s.country = '".pg_escape_string($country)."' AND ";
			}
			if($apikey != "" && isAdmin($_SESSION['user'])) {
				$where .= " s.apikey = '".pg_escape_string($apikey)."' AND ";
			}
			if($browser_name != "") {
				$where .= " s.browser_name = '".pg_escape_string($browser_name)."' AND ";
			}
			
			if($_SESSION['user']['users_id'] == 0) { // Admin
				
				$res = pg_query($this->stats_db, "
					SELECT s.*
						FROM statistics_maps_view s
						  WHERE
							$where
								s.viewed_at > to_timestamp($startDate);
				") or die("Database Error");
				
			}
			else {
				
				$maps = getMaps($this->users_id);
				foreach($maps as $map) {
					$maps_id[] = $map['id'];
				}
				
				if(count($maps_id) == 0) {
					return $records;
				}
				
				$res = pg_query($this->stats_db, "
					SELECT s.*
						FROM statistics_maps_view s
						  WHERE s.maps_id IN (".implode(",", $maps_id).") AND
							$where
								s.viewed_at > to_timestamp($startDate);
				") or die("Database Error");
				
			}
			
			while($data = pg_fetch_assoc($res)) {
				$records[]= $data;
			}
			
			return $records;
		}
		
		function purgStatistics($days) {
			
			if((int)$days == 0){
				return false;
			}
			
			$maps_id = array();
				
			$maps = getMaps($this->users_id);
			foreach($maps as $map) {
				$maps_id[] = $map['id'];
			}
			
			if(count($maps_id) == 0) {
				return $records;
			}
			
			$res = pg_query($this->stats_db, " DELETE 
							FROM statistics_maps_view 
								WHERE maps_id IN (".implode(",", $maps_id).") AND 
								viewed_at < (NOW() - INTERVAL '".$days." days')") or die("Database Error");
			
			return pg_affected_rows($res);
		}
		
		function getBrowsers() {
			$browsers = array();
			
			$res = pg_query($this->stats_db, "SELECT DISTINCT browser_name FROM statistics_maps_view WHERE browser_name <> '' ORDER BY browser_name ASC") or die(pg_last_error());
			if(pg_num_rows($res) > 0){
				while($data = pg_fetch_assoc($res)) {
					$browsers[] = $data;
				}
			}
			return $browsers;
		}
	}
?>