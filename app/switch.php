<?PHP
	require_once(dirname(__FILE__)."/../include/master.inc.php");
	if(!isLogin()){
		redirect("login.php");
	}
	
	$id = (int)$_GET['id'];
	if($id == 0) { // If Sub User Requests to switch
		if(isAdmin(getUserInfo($_SESSION['user']['switcher_id']))) {
			$_SESSION['user'] = getUserInfo($_SESSION['user']['switcher_id']);
			$_SESSION['user']['switcher_id'] = $_SESSION['user']['id'];
			redirect("user.php");
		}
	}
	else { // If Super User requests to switch account - switched to the given Id if authorized!
		global $db;
		
		$res = pg_query($db, "SELECT * FROM users WHERE users_id = ".$_SESSION['user']['id']." AND id = ".$id) or die("Database Error");
		if(pg_num_rows($res) == 1){
			if($data = pg_fetch_assoc($res)) {
				$switcher_id = $_SESSION['user']['switcher_id'];
				$_SESSION['user'] = $data;
				$_SESSION['user']['switcher_id'] = $switcher_id;
			}
		}
		
		redirect("index.php");
	}
	redirect("index.php");
?>