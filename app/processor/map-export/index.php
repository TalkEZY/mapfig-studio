<?PHP
	require_once(dirname(__FILE__)."/../../../include/master.inc.php");
	
	$mapId = (int)$_GET['mapid'];
	$map = getMapById($mapId);
	$user = getUserInfo();
	
	if($map) {
		if($map['password'] == "" || $_POST['password'] == $map['password'] || ($user && $user['id'] == $map['users_id'])) {
			$shapes = getShapesByMapId($mapId);
			$content = "";
			
			switch ($_GET['format']) {
				case 'geojson':
					$content = getPureJSON($mapId);
					break;
				case 'csv':
				case 'gpx':
				case 'kml':
				case 'shp':
				case 'dgn':
				case 'dxf':
				case 'gxt':
				case 'bna':
				case 'georss':
				case 'gmt':
					
					$maping = array(
						"shp"	 => "ESRI Shapefile",
						"csv"	 => "CSV",
						"kml"	 => "KML",
						"gpx" 	 => "GPX",
						"dgn" 	 => "DGN",
						"dxf" 	 => "dxf",
						"gxt"	 => "GeoConcept",
						"bna" 	 => "BNA",
						"georss" => "GeoRSS",
						"gmt" 	 => "GMT"
					);
					
					$jsonString = getPureJSON($mapId);
					$response = convertMapContent($jsonString, "GeoJSON", 'geojson', $maping[$_GET['format']], $_GET['format']);
					if(!$response['success']) {
						die(str_replace("(use -skipfailures to skip errors)", "", $response['content']));
					}
					else {
						$content = $response['content'];
					}
					
					break;
				case 'html':
					$content = processMapFile($map, $shapes, dirname(__FILE__)."/../../map/view.tpl");
					break;
				case 'iframe':
					$content = '<iframe src="'.BASEURL.'app/map-view.php?mapid='.$mapId.'" height="'.$map['height'].'" width="'.$map['width'].'"></iframe>';
					break;
				default:
					die("Invalid Request");
			}
			
			header("Content-Disposition: attachment; filename=map.".$_GET['format']);
			header("Content-Length: ".strlen($content));
			
			echo $content;
			exit;
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
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   <meta name="description" content="Bootstrap Admin App + jQuery">
   <meta name="keywords" content="app, responsive, jquery, bootstrap, dashboard, admin">
   <title>Unlock Map</title>
   
   <?PHP require_once(dirname(__FILE__)."/../../../include/header.tpl.php"); ?>
   
   
   <!-- =============== VENDOR STYLES ===============-->
   <!-- FONT AWESOME-->
   <link rel="stylesheet" href="../../../vendor/fontawesome/css/font-awesome.min.css">
   <!-- SIMPLE LINE ICONS-->
   <link rel="stylesheet" href="../../../vendor/simple-line-icons/css/simple-line-icons.css">
   <!-- =============== APP STYLES ===============-->
   <link rel="stylesheet" href="../../css/app.css" id="maincss">
</head>

<body style="width: <?=$map['width']?>px;">
   <div class="wrapper">
      <div class="abs-center wd-xl">
         <!-- START panel-->
         <div class="p">
            <img src="../../img/user/02.jpg" alt="Avatar" width="60" height="60" class="img-thumbnail img-circle center-block">
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
   <script src="../../../vendor/modernizr/modernizr.js"></script>
   <!-- BOOTSTRAP-->
   <script src="../../../vendor/bootstrap/dist/js/bootstrap.js"></script>
   <!-- STORAGE API-->
   <script src="../../../vendor/jQuery-Storage-API/jquery.storageapi.js"></script>
   <!-- PARSLEY-->
   <script src="../../../vendor/parsleyjs/dist/parsley.min.js"></script>
   <!-- =============== APP SCRIPTS ===============-->
   <script src="../../js/app.js"></script>
</body>

</html>