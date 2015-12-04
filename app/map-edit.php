<?PHP
	require_once(dirname(__FILE__)."/../include/master.inc.php");
	if(!isLogin()){
		redirect("login.php");
	}
	$user = getUserInfo();
	
	if(isset($_GET['action']) && $_GET['action'] == 'delete'){
		deleteMarker((int)$_GET['marker_id'], (int)$_GET['id'], $user['id']);
		redirect("map-edit.php?id=".(int)$_GET['id']);
	}
	
	$map  = getMapById((int)$_GET['id'], (int)$user['id']);
	
	if(!$map){
		redirect("map.php");
	}
	$shapes = getShapesByMapId((int)$map['id']);
	
	$create_update = "Update";
	
	if($_GET['action'] == 'create'){
		$PAGE = "MAP_CREATE";
		$create_update = "Create";
	}
	else {
		$PAGE = "MAP_VIEW";
	}
	
	$layers = getLayersByUserId($user['id']);
	$groups = getGroupsByUserId($user['id']);
	
	if(isAdmin($user)) {
		$projects = getProjectsByUserId($user['id']);
	}
	else {
		$projects = getMyProjects($user['id']);
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <title><?=$create_update?> Map</title>
   
   <?PHP require_once(dirname(__FILE__)."/../include/header.tpl.php"); ?>
   
   <!-- =============== VENDOR STYLES ===============-->
   <!-- FONT AWESOME-->
   <link rel="stylesheet" href="../vendor/fontawesome/css/font-awesome.min.css">
   <!-- SIMPLE LINE ICONS-->
   <link rel="stylesheet" href="../vendor/simple-line-icons/css/simple-line-icons.css">
   <!-- ANIMATE.CSS-->
   <link rel="stylesheet" href="../vendor/animate.css/animate.min.css">
   <!-- WHIRL (spinners)-->
   <link rel="stylesheet" href="../vendor/whirl/dist/whirl.css">
   <!-- =============== PAGE VENDOR STYLES ===============-->
   <!-- WEATHER ICONS-->
   <link rel="stylesheet" href="../vendor/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css">
   <!-- =============== APP STYLES ===============-->
   <link rel="stylesheet" href="css/app.css" id="maincss">
   
   <script src="tinymce/js/tinymce/tinymce.min.js"></script>
   
	<style>
		.panel#panel {
			opacity: 0.85 !important;
			position: absolute !important;
			z-index: 1010 !important;
			padding: 0 !important;
			margin-left: -20px !important;
			background: transparent !important;
			-webkit-box-shadow: 0 0px 0px rgba(0, 0, 0, 0) !important;
			box-shadow: 0 0 0 rgba(0, 0, 0, 0) !important;
			border: 0 !important;
			width: 100% !important;
		}
		#map.table.table-bordered td {
			border: 0!important;
		}
		#map td > *:not(.popover) {
			color: white !important;
		}
		#map_settings {
			-webkit-box-shadow: 10px 4px 24px 0px rgba(0,0,0,0.75);
			-moz-box-shadow: 10px 4px 24px 0px rgba(0,0,0,0.75);
			box-shadow: 10px 4px 24px 0px rgba(0,0,0,0.75);
		}
		#map_settings_action {
		  text-decoration: none;
		  padding-right: 17px;
		  border-radius: 0 0 7px 7px !important;
		  background-color: #000000 !important;
		  border-color: #c6c6c6 !important;
		  -webkit-box-shadow: 0px 4px 24px 0px rgba(0,0,0,0.75);
		  -moz-box-shadow: 0px 4px 24px 0px rgba(0,0,0,0.75);
		  box-shadow: 0px 4px 24px 0px rgba(0,0,0,0.75);
		  font-size: 17px;
		  float: right;
		  margin-right: 100px;
		  margin-top: -1px;
		  color: #fff;
		}
	</style>
   
</head>

<body class="aside-collapsed">
   <div class="wrapper">
      <!-- top navbar-->
      <header class="topnavbar-wrapper">
         <!-- START Top Navbar-->
         <nav role="navigation" class="navbar topnavbar">
            <!-- START navbar header-->
            <div class="navbar-header">
               <a href="#/" class="navbar-brand">
                  <div class="brand-logo">
                     <img src="img/logo.png" alt="App Logo" class="img-responsive">
                  </div>
                  <div class="brand-logo-collapsed">
                     <img src="img/logo-single.png" alt="App Logo" class="img-responsive">
                  </div>
               </a>
            </div>
            <!-- END navbar header-->
            <!-- START Nav wrapper-->
            <div class="nav-wrapper">
               <!-- START Left navbar-->
               <ul class="nav navbar-nav">
                  <li>
                     <!-- Button used to collapse the left sidebar. Only visible on tablet and desktops-->
                     <a href="#" data-toggle-state="aside-collapsed" class="hidden-xs">
                        <em class="fa fa-navicon"></em>
                     </a>
                     <!-- Button to show/hide the sidebar on mobile. Visible on mobile only.-->
                     <a href="#" data-toggle-state="aside-toggled" data-no-persist="true" class="visible-xs sidebar-toggle">
                        <em class="fa fa-navicon"></em>
                     </a>
                  </li>
                  <!-- START User avatar toggle-->
                  <li>
                     <!-- Button used to collapse the left sidebar. Only visible on tablet and desktops-->
                     <a href="#user-block" data-toggle="collapse">
                        <em class="icon-user"></em>
                     </a>
                  </li>
                  <!-- END User avatar toggle-->
                  <!-- START lock screen-->
                  <li>
                     <a href="lock.php" title="Lock screen">
                        <em class="icon-lock"></em>
                     </a>
                  </li>
                  <!-- END lock screen-->
               </ul>
               <!-- END Left navbar-->
               <!-- START Right Navbar-->
               <ul class="nav navbar-nav navbar-right">
				  <!-- Search icon-->
				  <li>
                     <a href="#" data-search-open="">
                        <em class="icon-magnifier"></em>
                     </a>
                  </li>
                  <li>
                     <a href="http://docs.mapfig.com/" target="_blank" title="Launch Help Wizard">
                        <em class="fa fa-question-circle"></em>
                     </a>
                  </li>
				  <!-- Fullscreen (only desktops)-->
                  <li class="visible-lg">
                     <a href="#" data-toggle-fullscreen="">
                        <em class="fa fa-expand"></em>
                     </a>
                  </li>
               </ul>
               <!-- END Right Navbar-->
            </div>
            <!-- END Nav wrapper-->
			<!-- START Search form-->
            <form role="search" action="map-search.php" class="navbar-form">
               <div class="form-group has-feedback">
                  <input type="text" placeholder="Type Map Title/Name and hit enter ..." name="q" class="form-control">
                  <div data-search-dismiss="" class="fa fa-times form-control-feedback"></div>
               </div>
               <button type="submit" class="hidden btn btn-default">Submit</button>
            </form>
            <!-- END Search form-->
            
         </nav>
         <!-- END Top Navbar-->
      </header>
      
	  <?PHP require_once(dirname(__FILE__)."/../include/sidebar.tpl.php") ?>
	  
      <section>
         <!-- Page content-->
         <div class="content-wrapper">
            <h3 style="margin-bottom: -1px;"><?=$create_update?> Map
               <small></small>
            </h3>
            <div class="panel" id="panel">
				<div id="map_settings" style="background: black; display: none;">
				   <table id="map" style="clear: both" class="table table-bordered">
					  <tbody>
						 <tr>
							<td><b>Map Id</b></th>
							<td>
								<span><?=$map['id']?></span>
							</td>
							<td><b>Created By</b></th>
							<td><span>
								<?PHP
									$u = getUserInfo($map['users_id']);
									echo $u['firstname'].' '.$u['lastname'];
								?></span>
							</td>
							<td><b>Map Name</b></th>
							<td>
							   <a id="name" href="#" data-type="text" data-pk="<?=$map['id']?>" data-title="Enter Map Name!"><?=$map['name']?></a>
							</td>
							<td><b>Map Password</b></th>
							<td>
								<a id="password" href="#" data-pk="<?=$map['id']?>" data-title="Set Password if you want to make it private"><?=$map['password']?></a>
							</td>
						 </tr>
						 <tr>
							<td><b>Map Height</b></th>
							<td>
							   <a id="height" href="#" data-pk="<?=$map['id']?>" data-title="Map Height"><?=$map['height']?></a><span> px</span>
							</td>
							<td><b>Map Width</b></th>
							<td>
								<a id="width" href="#" data-pk="<?=$map['id']?>" data-title="Map WIdth"><?=$map['width']?></a><span> px</span>
							</td>
							
							<td><b>Open Pop-Up</b></th>
							<td>
							   <a id="defaultopen" href="#" data-type="select" data-name="defaultopen" data-value="<?=$map['defaultopen']?>" data-pk="<?=$map['id']?>" data-title="Open Pop-Up By Default"></a>
							</td>
							<td><b>Select Buttons Color</b></th>
							<td>
							   <a id="button_style" href="#" data-type="select" data-name="button_style" data-value="<?=$map['button_style']?>" data-pk="<?=$map['id']?>" data-title="Select Buttons Color"></a>
							</td>
						 </tr>
						 <tr>
							<td><b>Show Sidebar</b></th>
							<td>
							   <a id="showsidebar" href="#" data-type="select" data-name="showsidebar" data-value="<?=$map['showsidebar']?>" data-pk="<?=$map['id']?>" data-title="Show Sidebar?"></a>
							</td>
							<td><b>Base Map</b></th>
							<td>
							   <a id="layers_id" href="#" data-type="select" data-name="layers_id" data-value="<?=$map['layers_id']?>" data-pk="<?=$map['id']?>" data-title="Select Base Layer"></a>
							</td>
							<td><b>Layer Group</b></th>
							<td>
							   <a id="groups_id" href="#" data-type="select" data-name="groups_id" data-value="<?=$map['groups_id']?>" data-pk="<?=$map['id']?>" data-title="Select Layer Group"></a>
							</td>
							<td><b>Use Marker Cluster</b></th>
							<td>
							   <a id="cluster" href="#" data-type="select" data-name="cluster" data-value="<?=$map['cluster']?>" data-pk="<?=$map['id']?>" data-title="Use Marker Cluster?"></a>
							</td>
						 </tr>
						 <tr>
							<td><b>Show Overlay</b></th>
							<td>
							   <a id="overlay_enable" href="#" data-type="select" data-name="overlay_enable" data-value="<?=$map['overlay_enable']?>" data-pk="<?=$map['id']?>" data-title="Show Overlay?"></a>
							</td>
							<td><b>Edit Overlay</b></th>
							<td>
							   <a href="#" class="btn btn-info btn-sm" id="edit_overlay"><i class="fa fa-edit"></i></a>
							</td>
							<td><b>Show Legend</b></th>
							<td>
							   <a id="legend_enable" href="#" data-type="select" data-name="legend_enable" data-value="<?=$map['legend_enable']?>" data-pk="<?=$map['id']?>" data-title="Show Legend?"></a>
							</td>
							<td><b>Legend Content</b></th>
							<td>
							   <a href="#" class="btn btn-info btn-sm" id="edit_legend"><i class="fa fa-edit"></i></a>
							</td>
						 </tr>
						 <tr>
							<td><b>Geo-Image Overlays</b></td>
							<td>
							   <a href="#" class="btn btn-info btn-sm" id="edit_image_overlays"><i class="fa fa-edit"></i></a>
							</td>
							<td><b>Show Export Button</b></td>
							<td>
							   <a id="show_export" href="#" data-type="select" data-name="show_export" data-value="<?=$map['show_export']?>" data-pk="<?=$map['id']?>" data-title="Show Export Button?"></a>
							</td>
							<td><b>Assign to Project</b></td>
							<td>
							   <a id="projects_id" href="#" data-type="select" data-name="projects_id" data-value="<?=$map['projects_id']?>" data-pk="<?=$map['id']?>" data-title="Select Project?"></a>
							</td>
							<td><b>Show Measure Button</b></td>
							<td>
							   <a id="show_measure" href="#" data-type="select" data-name="show_measure" data-value="<?=$map['show_measure']?>" data-pk="<?=$map['id']?>" data-title="Show Measure Button?"></a>
							</td>
						 </tr>
						 <tr>
							<td><b>Show MiniMap</b></td>
							<td>
							   <a id="show_minimap" href="#" data-type="select" data-name="show_minimap" data-value="<?=$map['show_minimap']?>" data-pk="<?=$map['id']?>" data-title="Show MiniMap?"></a>
							</td>
							<td><b>Show Search</b></td>
							<td>
							   <a id="show_search" href="#" data-type="select" data-name="show_search" data-value="<?=$map['show_search']?>" data-pk="<?=$map['id']?>" data-title="Show Search?"></a>
							</td>
							<td><b>Show Local File Upload</b></td>
							<td>
							   <a id="show_filelayer" href="#" data-type="select" data-name="show_filelayer" data-value="<?=$map['show_filelayer']?>" data-pk="<?=$map['id']?>" data-title="Show Local File Upload?"></a>
							</td>
							<td><b>Show Timeline Control</b></td>
							<td>
							   <a id="show_playback" href="#" data-type="select" data-name="show_playback" data-value="<?=$map['show_playback']?>" data-pk="<?=$map['id']?>" data-title="Show Timeline Control?"></a>
							</td>
							<!--<td colspan="2" align="right">
								<a class="btn btn-info" href="http://docs.mapfig.com/" target="_blank"  title="Launch Help Wizard"><i class="fa fa-question-circle"></i> Launch Help Wizard</a>
							</td>-->
						 </tr>
						 <tr>
							<td><b>Show IntroBox</b></td>
							<td>
							   <a id="show_static_sidebar" href="#" data-type="select" data-name="show_static_sidebar" data-value="<?=$map['show_static_sidebar']?>" data-pk="<?=$map['id']?>" data-title="Show IntroBox?"></a>
							</td>
							<td><b>IntroBox Content</b></td>
							<td>
							   <a href="#" class="btn btn-info btn-sm" id="edit_static_sidebar_content"><i class="fa fa-edit"></i></a>
							</td>
							<td><b>Show as SVG</b></td>
							<td>
							   <a id="show_svg" href="#" data-type="select" data-name="show_svg" data-value="<?=$map['show_svg']?>" data-pk="<?=$map['id']?>" data-title="Show As SVG?"></a>
							</td>
							<td><b>Map Bounds</b></td>
							<td>
							   <a href="#" class="btn btn-info btn-sm" id="edit_map_bounds"><i class="fa fa-edit"></i></a>
							</td>
							<!-- <td align="right">
								<a class="btn btn-info" href="http://docs.mapfig.com/" target="_blank" title="Launch Help Wizard"><i class="fa fa-question-circle"></i> Launch Help Wizard</a>
							</td> -->
						 </tr>
					  </tbody>
				   </table>
				</div>
				<a id="map_settings_action" href="#"><i class="fa fa-angle-down" style="padding: 10px 2px 10px 17px;"></i>Map Settings</a>
            </div>
			
			<div class="col-lg-12" style="overflow: auto; margin-top: 50px;">
				
				
				
				<?PHP
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
					
					$content = file_get_contents('map/preview.tpl');
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
						
						/*
						if(preg_match_all("/(\-?\d+(\.\d+)?),(\-?\d+(\.\d+)?)/", $shape['coordinates'], $matches)) {
							$match = $matches[0][0];
							$match = str_replace(array("[","]"), "", $match);
							
							$match = explode(",", $match);
							$first_lat = $match[1];
							$first_lng = $match[0];
						}
						else {
							$first_lat = 0;
							$first_lng = 0;
						}
						*/
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
					$replace = array($map['height'], 'px', $map['width'], 'px', $map['zoom'], ($map['defaultopen'] == 't')?'true':'false', ($map['showsidebar'] == 't')?'true':'false', $map['button_style'], $jsonString, $first_lat, $first_lng, BASEURL, CDNURL, MAIN_DOMAIN, SITE_NAME_FORMATED, $defaulLayer, $baseLayers, $map['filteredcolumns'], ($map['cluster'] == 't')?'true':'false', ($map['overlay_enable'] == 't')?'true':'false', htmlentities($map['overlay_title']), htmlentities($map['overlay_blurb']), htmlentities($map['overlay_content']), ($map['legend_enable'] == 't')?'true':'false', htmlentities($map['legend_content']), $map['image_overlays'], $map['id'], ($map['show_export'] == 't')?'true':'false', ($map['show_measure'] == 't')?'true':'false', ($map['show_minimap'] == 't')?'true':'false', ($map['show_search'] == 't')?'true':'false', ($map['show_filelayer'] == 't')?'true':'false', ($map['show_playback'] == 't')?'true':'false', $map['gpx_tracks'], ($map['show_static_sidebar'] == 't')?'true':'false', $map['static_sidebar_content'], ($map['show_svg'] == 't')?'true':'false', $map['map_bounds']);
					
					echo str_replace($search, $replace, $content);
				?>
				
				
				
				
				
            </div>
			<div style="clear: both;"></div>
			<br>
			<div class="panel col-lg-12">
				<table class="col-lg-8 pull-left" style="margin-top:10px;">
					<tr>
						<td style="width: 100px;">Map Center</td>
						<td style="width: 45%;">
							<p class="input-group">
								<input name="latitude" disabled="" type="text" class="form-control">
								<span class="input-group-addon">&nbsp; Latitude &nbsp;</span>
							</p>
							<p class="input-group">
								<input name="longitude" disabled="" type="text" class="form-control">
								<span class="input-group-addon">Longitude</span>
							</p>
						</td>
						<td style="width: 150px; text-align:center;">Zoom Level</td>
						<td style="width: 100px;">
							<input name="zoom" disabled="" type="text" class="form-control" id="disabled-zoom" value="<?=$map['zoom']?>">
						</td>
					</tr>
				</table>
				<form action="processor/shape-edit/index.php" method="post" id="shape-edit" class="pull-right" style="margin-top: 15px;margin-bottom: 35px;">
				   <input type="hidden" name="id" value="<?=$map['id']?>"/>
				   <input type="hidden" name="shapes" id="shapes"/>
				   <input type="hidden" name="shapeStyles" id="shapeStyles"/>
				   <input type="hidden" name="mapcenter" id="mapcenter"/>
				   <input type="hidden" name="zoom" id="zoom" value="<?=$map['zoom']?>"/>
				   <input type="hidden" name="shapeCustomProperties" id="shapeCustomProperties"/>
				   
				   <input type="hidden" name="gpx_tracks" id="gpx_tracks" value="<?=$map['gpx_tracks']?>"/>
				   <input type="hidden" name="map_bounds" id="map_bounds" value="<?=$map['map_bounds']?>"/>
				   
				   <input type="hidden" name="overlay_title"/>
				   <input type="hidden" name="overlay_blurb"/>
				   <input type="hidden" name="overlay_content"/>
				   <input type="hidden" name="legend_content"/>
				   
				   <input type="hidden" name="image_overlays"/>
				   
				   <input type="hidden" name="static_sidebar_content"/>
				   
				   <input type="button" value="Save All changes" name="save" id="save" class="btn btn-primary"/>
				</form>
            </div>
			<div style="clear: both;"></div>
         </div>
      </section>
      <?PHP require_once(dirname(__FILE__)."/../include/footer.tpl.php"); ?>
   </div>
   <!-- =============== VENDOR SCRIPTS ===============-->
   <!-- MODERNIZR-->
   <script src="../vendor/modernizr/modernizr.js"></script>
   <!-- BOOTSTRAP-->
   <script src="../vendor/bootstrap/dist/js/bootstrap.js"></script>
   <!-- STORAGE API-->
   <script src="../vendor/jQuery-Storage-API/jquery.storageapi.js"></script>
   <!-- JQUERY EASING-->
   <script src="../vendor/jquery.easing/js/jquery.easing.js"></script>
   <!-- ANIMO-->
   <script src="../vendor/animo.js/animo.js"></script>
   <!-- SLIMSCROLL-->
   <script src="../vendor/slimScroll/jquery.slimscroll.min.js"></script>
   <!-- SCREENFULL-->
   <script src="../vendor/screenfull/dist/screenfull.min.js"></script>
   <!-- LOCALIZE-->
   <script src="../vendor/jquery-localize-i18n/dist/jquery.localize.js"></script>
   <!-- RTL demo-->
   <script src="js/demo/demo-rtl.js"></script>
   <!-- =============== PAGE VENDOR SCRIPTS ===============-->
   <!-- SPARKLINE-->
   <script src="vendor/sparklines/jquery.sparkline.min.js"></script>
   <!-- FLOT CHART-->
   <script src="../vendor/Flot/jquery.flot.js"></script>
   <script src="../vendor/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
   <script src="../vendor/Flot/jquery.flot.resize.js"></script>
   <script src="../vendor/Flot/jquery.flot.pie.js"></script>
   <script src="../vendor/Flot/jquery.flot.time.js"></script>
   <script src="../vendor/Flot/jquery.flot.categories.js"></script>
   <script src="../vendor/flot-spline/js/jquery.flot.spline.min.js"></script>
   <!-- CLASSY LOADER-->
   <script src="../vendor/jquery-classyloader/js/jquery.classyloader.min.js"></script>
   <!-- XEDITABLE-->
   <script src="../vendor/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
   <!-- MOMENT JS-->
   <script src="../vendor/moment/min/moment-with-locales.min.js"></script>
   <!-- SKYCONS-->
   <script src="../vendor/skycons/skycons.js"></script>
   <!-- DEMO-->
   <script src="js/demo/demo-flot.js"></script>
   <?PHP require_once(dirname(__FILE__)."/../include/footer-script.tpl.php"); ?>
   <!-- =============== APP SCRIPTS ===============-->
   <script src="js/app.js"></script>
   
	<script>
		var layersIdVal, groupsIdVal;
		
		function tinyMCEInit(textarea) {
			if(textarea) {
				tinyMCE.remove('#'+textarea);
			}
			tinyMCE.remove('#imageOverlayPopupContentInput');
			tinyMCE.remove('#modalPropertyValue');
			tinyMCE.remove('#edit_overlay_content');
			tinyMCE.remove('#edit_legend_content');
			tinymce.init({
				selector: "textarea",
				theme: "modern",
				plugins: [
					"advlist autolink lists link image charmap print preview hr anchor pagebreak",
					"searchreplace wordcount visualblocks visualchars code fullscreen",
					"insertdatetime media nonbreaking save table contextmenu directionality",
					"emoticons template paste textcolor colorpicker textpattern jbimages mapshapes"
				],
				toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
				toolbar2: "print preview media | forecolor backcolor emoticons | mapshapes",
				image_advtab: true,
				relative_urls: false,
				remove_script_host : false,
				convert_urls : true,
				autosave_ask_before_unload: false,
				extended_valid_elements : "a[onclick|style|href|title|id|class|target]"
			});
		}
		
		$(document).ready(function(){
			tinyMCEInit();
			
			$('#map a#projects_id').editable({
				url: 'processor/map-edit/index.php',
				validate: function(value) {
					if($.trim(value) === '') return 'This field is required';
				},
				source: [
					{value: '0', text: '[Select]'},
					<?PHP
					$select = array();
					foreach($projects as $project) {
						$select[] = "{value: '".$project['id']."', text: '".$project['name']."'}";
					}
					echo implode(',', $select);
					?>
				],
				error: function(xhr) {
					if(xhr.status == 500) return 'Internal server error';  
				},
				success: function(data) {
					
				}
			});
			
			$('#map a#layers_id').editable({
				url: 'processor/map-edit/index.php',
				validate: function(value) {
					if($.trim(value) === '') return 'This field is required';
				},
				source: [
					{value: '1', text: '[Select]'},
					<?PHP
					$select = array();
					foreach($layers as $layer) {
						$select[] = "{value: '".$layer['id']."', text: '".$layer['name']."'}";
					}
					echo implode(',', $select);
					?>
				],
				error: function(xhr) {
					if(xhr.status == 500) return 'Internal server error';  
				},
				success: function(data) {
					updateMap();
					map.removeLayer(defaultLayer);
					
					data = jQuery.parseJSON(data);
					defaultLayer = new L.TileLayer(data.url, {'id' : data.key, 'token' : data.accesstoken, maxZoom: 18, attribution: data.attribution+mbAttribution});
					
					map.addLayer(defaultLayer);
				}
			});
			
			$('#map a#groups_id').editable({
				url: 'processor/map-edit/index.php',
				validate: function(value) {
					if($.trim(value) === '') return 'This field is required';
				},
				source: [
					{value: '0', text: '[Select]'},
					<?PHP
					$select = array();
					foreach($groups as $group) {
						$select[] = "{value: '".$group['id']."', text: '".$group['name']."'}";
					}
					echo implode(',', $select);
					?>
				],
				error: function(xhr) {
					if(xhr.status == 500) return 'Internal server error';  
				},
				success: function(data) {
					updateMap();
					map.removeControl(layerSelector);
					
					data = jQuery.parseJSON(data);
					
					baseLayers = {}
					$.each(data, function(idx, obj) {
						baseLayers[obj.name] = new L.TileLayer(obj.url, {maxZoom: 18, id: obj.key, token : obj.accesstoken, attribution: '© '+obj.attribution+mbAttribution});
					});
					
					layerSelector = L.control.layers(baseLayers, overlays)
					map.addControl(layerSelector);
				}
			});
		});
		
		var helpWizardContent = '\
			<div class="tabbable tabs-left">\
				<ul class="nav nav-tabs">\
				  <li class="active"><a href="#a" data-toggle="tab">MOMENTUM / Octav Rolan 1</a></li>\
				  <li><a href="#b" data-toggle="tab">MOMENTUM / Octav Rolan 2</a></li>\
				  <li><a href="#c" data-toggle="tab">MOMENTUM / Octav Rolan 3</a></li>\
				</ul>\
				<div class="tab-content" style="border-style: none;">\
				 <div class="tab-pane active" id="a">\
					<object width="500" height="300">\
						<param name="allowfullscreen" value="true" />\
						<param name="allowscriptaccess" value="always" />\
						<param name="movie" value="https://vimeo.com/moogaloop.swf?clip_id=120344655&amp;server=vimeo.com&amp;color=00adef&amp;fullscreen=1" />\
						<embed src="https://vimeo.com/moogaloop.swf?clip_id=120344655&amp;server=vimeo.com&amp;color=00adef&amp;fullscreen=1"\
							type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="500" height="300"></embed>\
					</object>\
				 </div>\
				 <div class="tab-pane" id="b">\
					<object width="500" height="300">\
						<param name="allowfullscreen" value="true" />\
						<param name="allowscriptaccess" value="always" />\
						<param name="movie" value="https://vimeo.com/moogaloop.swf?clip_id=120344655&amp;server=vimeo.com&amp;color=00adef&amp;fullscreen=1" />\
						<embed src="https://vimeo.com/moogaloop.swf?clip_id=120344655&amp;server=vimeo.com&amp;color=00adef&amp;fullscreen=1"\
							type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="500" height="300"></embed>\
					</object>\
				 </div>\
				 <div class="tab-pane" id="c">\
					<object width="500" height="300">\
						<param name="allowfullscreen" value="true" />\
						<param name="allowscriptaccess" value="always" />\
						<param name="movie" value="https://vimeo.com/moogaloop.swf?clip_id=120344655&amp;server=vimeo.com&amp;color=00adef&amp;fullscreen=1" />\
						<embed src="https://vimeo.com/moogaloop.swf?clip_id=120344655&amp;server=vimeo.com&amp;color=00adef&amp;fullscreen=1"\
							type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="500" height="300"></embed>\
					</object>\
				 </div>\
				</div>\
			</div>\
			<div style="clear:both"></div>\
		';
		
		$('#map_settings_action').click(function(e){
			e.preventDefault();
			$('#map_settings').slideToggle();
			$(this).find('i').attr("class", function() {
				if ($(this).is(".fa-angle-down")) {
					return "fa fa-angle-up";
				} else {
					return "fa fa-angle-down";
				}
			});
		});
	</script>
	<script src="js/map.js"></script>
</body>
</html>