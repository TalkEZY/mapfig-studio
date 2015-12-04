<?PHP
	require_once(dirname(__FILE__)."/../include/master.inc.php");
	require_once(dirname(__FILE__)."/../include/classes/statistics.class.php");
	
	$mapId = (int)$_GET['mapid'];
	$stats = new Statistics();
	$map = getMapById($mapId);
	
	
	$cacheDirectory = dirname(__FILE__)."/../cache";
	$cacheFile      = $cacheDirectory."/".md5($mapId).".cache";
	if(file_exists($cacheFile)) {	// Show file from cache
		$stats->addMapView($_SERVER['REMOTE_ADDR'], $mapId, $map['name'], $map['users_id']);
		echo file_get_contents($cacheFile);
		exit;
	}
	$user = getUserInfo();
	
	if($map) {
		if($map['password'] == "" || $_POST['password'] == $map['password'] || ($user && $user['id'] == $map['users_id'])) {
			$shapes = getShapesByMapId($mapId);
			$content = processMapFile($map, $shapes, dirname(__FILE__)."/map/view.tpl");
			
			if($map['password'] == "") {
				file_put_contents($cacheFile, $content);
			}
			$stats->addMapView($_SERVER['REMOTE_ADDR'], $mapId, $map['name'], $map['users_id']);
			echo $content;
			
			exit();
		}
	}
	else {
		die("Map Not Found!");
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <title>Unlock Map</title>
   
   <?PHP require_once(dirname(__FILE__)."/../include/header.tpl.php"); ?>
   
   
   <!-- =============== VENDOR STYLES ===============-->
   <!-- FONT AWESOME-->
   <link rel="stylesheet" href="../vendor/fontawesome/css/font-awesome.min.css">
   <!-- SIMPLE LINE ICONS-->
   <link rel="stylesheet" href="../vendor/simple-line-icons/css/simple-line-icons.css">
   <!-- =============== APP STYLES ===============-->
   <link rel="stylesheet" href="css/app.css" id="maincss">
   <style>
		
   </style>
</head>

<body style="width: <?=$map['width']?>px;">
   <div class="wrapper">
      <div class="abs-center wd-xl">
         <!-- START panel-->
         <div class="p">
            <img src="img/user/02.jpg" alt="Avatar" width="60" height="60" class="img-thumbnail img-circle center-block">
         </div>
         <div class="panel widget b0">
            <div class="panel-body">
               <p class="text-center">Please enter Password to unlock the map.</p>
               <form role="form" action="" method="post">
				  <div class="form-group has-feedback">
                     <input id="password" type="password" name="password" placeholder="Password" class="form-control">
                     <span class="fa fa-lock form-control-feedback text-muted"></span>
                  </div>
                  <div class="clearfix">
                     <div class="pull-right"><input type="submit" name="login" value="Unlock" class="btn btn-sm btn-primary"/></div>
                  </div>
               </form>
            </div>
         </div>
         </div>
      </div>
   </div>
   <!-- =============== VENDOR SCRIPTS ===============-->
   <!-- MODERNIZR-->
   <script src="../vendor/modernizr/modernizr.js"></script>
   <!-- BOOTSTRAP-->
   <script src="../vendor/bootstrap/dist/js/bootstrap.js"></script>
   <!-- STORAGE API-->
   <script src="../vendor/jQuery-Storage-API/jquery.storageapi.js"></script>
   <!-- PARSLEY-->
   <script src="../vendor/parsleyjs/dist/parsley.min.js"></script>
   <!-- =============== APP SCRIPTS ===============-->
   <script src="js/app.js"></script>
</body>

</html>