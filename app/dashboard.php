<?PHP
	require_once(dirname(__FILE__)."/../include/master.inc.php");
	if(!isLogin()){
		redirect("login.php");
	}
	
	$PAGE = "DASHBOARD";
	$user = $_SESSION['user'];
	$total_maps = getMapsCount($user['id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <title>View Profile - <?=$user['firstname'].' '.$user['lastname']?></title>
   
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
   <link rel="stylesheet" href="../vendor/weather-icons/css/weather-icons.min.css">
   <!-- =============== APP STYLES ===============-->
   <link rel="stylesheet" href="css/app.css" id="maincss">
   <style type="text/css">
<!--
.style1 {color: #fff}
-->
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
            
         </nav>
         <!-- END Top Navbar-->
      </header>
      
	  <?PHP require_once(dirname(__FILE__)."/../include/sidebar.tpl.php") ?>
	  
      <!-- Main section-->
      <section>
		 <!-- Page content-->
		 <div class="content-wrapper">
			<div class="unwrap"><!-- background-image: url(img/profile-bg.jpg) -->
			   <div style="background:#585858;" class="bg-cover">
				  <div class="p-xl text-center text-white">
<h3 align="center" class="m0"><br />Welcome <?=$user['firstname'].' '.$user['lastname']?> </h3>
<p>&nbsp;</p>
				  <table width="100%" border="0">



  <tr>
   <td width="33%"><div align="center"><a href="edit_profile.php"><img src="img/user/09.jpg" alt="Image" border="0" class="img-thumbnail img-circle thumb128"></a>
    </div>
	
      <h3 align="center" class="m0"><br /><a href="edit_profile.php" class="style1"><?=$user['firstname'].' '.$user['lastname']?></a></h3>
			    <!--<p align="center"><a href="edit_profile.php" class="style1">Manage Profile</a></p>--></td>
    <td width="33%"><div align="center"><a href="map-create.php"><img src="img/user/easy-to-use.jpg" alt="Image" width="90" height="80" border="0" class="img-thumbnail img-circle thumb128"></a>
    </div>
      <h3 align="center" class="m0"><br /><a href="map-create.php" class="style1">Create New Map</a></h3>
			    <!--<p align="center">Create a new <?=SITE_NAME_FORMATED?> Map</p></td>-->
    <td width="38%"><div align="center"><a href="user-add.php"><img src="img/user/new-table.jpg" alt="Image" width="112" height="126" border="0" class="img-thumbnail img-circle thumb128"></a>
    </div>
      <h3 align="center" class="m0"><br /><a href="user-add.php" class="style1">Create New EndPoint</a></h3>
			    <!--<p align="center">Create a New  Data Table</p>--></td>
  </tr>
</table>

	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<table width="100%" border="0">
  <tr>
    <td width="20%"><div align="center"><a href="map.php"><img src="img/user/edit-map.jpg" alt="Image" width="75" height="75" border="0" class="img-thumbnail img-circle thumb64"></a>
    </div>
      
			    <p align="center"><a href="map.php" class="style1">My Maps</a></p></td>
				
    <td width="20%"><div align="center"><a href="user.php"><img src="img/user/view-layers.jpg" alt="Image" width="75" height="75" border="0" class="img-thumbnail img-circle thumb64"></a>
    </div>
      
			    <p align="center"><a href="user.php" class="style1">EndPoints and Users</a></p></td>
				
    <td width="20%"><div align="center"><a href="project.php"><img src="img/user/api-refresh.jpg" alt="Image" width="75" height="75" border="0" class="img-thumbnail img-circle thumb64"></a>
    </div>
      
			    <p align="center"><a href="project.php" class="style1">My Projects</a></p></td>
				
    <td width="20%"><div align="center"><a href="social-share.php"><img src="img/user/share-maps.jpg" alt="Image" width="75" height="75" border="0" class="img-thumbnail img-circle thumb64"></a>
    </div>
      
			    <p align="center"><a href="activity.php" class="style1">Statistics</a></p></td>
				
    <td><div align="center"><a href="csv.php"><img src="img/user/gdal-studio.jpg" alt="Image" width="75" height="75" border="0" class="img-thumbnail img-circle thumb64"></a>
    </div>
      
			    <p align="center"><a href="csv.php" class="style1">My Tables</a></p></td>
  </tr>
</table>

					 
				  </div>
			   </div>
			   
			   
			   <div class="text-center bg-gray-dark p-lg mb-xl">
				  <div class="row row-table">
					 <div class="col-xs-4 br">
						<p class="m0">
						</p>
					 </div>
					 <div class="col-xs-4 br">
						<h3 class="m0"><?=$total_maps?></h3>
						<p class="m0">Maps</p>
					 </div>
					 <div class="col-xs-4">
					 </div>
				  </div>
			   </div>
			   <div class="p-lg">
				  <div class="row">
					 <div class="col-lg-12">
						<div class="panel panel-default">
						   <div class="panel-body">
							  <div class="table-responsive">
							   <table class="table">
								  <tbody>
									 <tr>
										<th>First Name</th>
										<td><?=$user['firstname']?></td>
										<th>Last Name</th>
										<td><?=$user['lastname']?></td>
									 </tr>
									 <tr>
										<th>Email Address</th>
										<td><?=$user['email']?></td>
										<th>Total Maps</th>
										<td><?=$total_maps?></td>
									 </tr>
								  </tbody>
							   </table>
							  </div>
						   </div>
						</div>
					 </div>
				  </div>
			   </div>
			</div>
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
   <!-- MOMENT JS-->
   <script src="../vendor/moment/min/moment-with-locales.min.js"></script>
   <!-- SKYCONS-->
   <script src="../vendor/skycons/skycons.js"></script>
   <!-- DEMO-->
   <script src="js/demo/demo-flot.js"></script>
   <?PHP require_once(dirname(__FILE__)."/../include/footer-script.tpl.php"); ?>
   <!-- =============== APP SCRIPTS ===============-->
   <script src="js/app.js"></script>
</body>

</html>