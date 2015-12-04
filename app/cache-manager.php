<?PHP
	require_once(dirname(__FILE__)."/../include/master.inc.php");
	if(!isLogin()){
		redirect("login.php");
	}
	
	$error   = "";
	$success = "";
	if(strlen($_SESSION['response']['cache-manager']['error']) > 0){
		$error = '<div ng-show="authMsg" class="alert alert-danger text-center ng-binding">'.$_SESSION['response']['cache-manager']['error'].'</div>';
	}
	else if(strlen($_SESSION['response']['cache-manager']['success']) > 0){
		$success = '<div ng-show="authMsg" class="alert alert-success text-center ng-binding">'.$_SESSION['response']['cache-manager']['success'].'</div>';
	}
	
	$showManagerMessage = false;
	if(isAdmin($_SESSION['user']) && isset($_SESSION['response']['cache-manager']['success'])) {
		$showManagerMessage = true;
	}
	
	unset($_SESSION['response']['cache-manager']['error']);
	unset($_SESSION['response']['cache-manager']['success']);
	
	$PAGE = "CACHE_MANAGER";
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <title>Cache and Database Manager</title>
   
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
               <?PHP if($user['membership_id'] == 1) { ?>
				<a href="https://www.petiole.org/portal/cart.php" target="_blank" title="Upgrade to Personal Account, Just $5 per Year!" class="btn btn-primary pull-right" style="margin-top: 12px;">
					Upgrade to Personal Account, Just $5 per Year!
				</a>
				<? } ?>
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
	  
      <!-- Main section-->
      <section>
		 <!-- Page content-->
		 <div class="content-wrapper">
			<h3>Cache and Database Manager
               <small></small>
            </h3>
            <div style="margin: 0 auto;float: none;" class="col-lg-6">
               <div class="col-lg-12">
                  <div class="panel panel-default">
                     <div class="panel-heading">Cache and Database Manager</div>
					 <div class="col-lg-12"><?=$error.$success?></div>
                     <div class="panel-body">
                        <div class="table-responsive">
							<form action="processor/cache-manager/index.php" method="post">
								<table class="table">
								  <tbody>
									 <tr>
										<td><input type="checkbox" name="cache" checked="checked" value="1"> Purge Cache (API Maps Only)</td>
									</tr>
									<tr>
										<td><input type="checkbox" name="maps_database" checked="checked" value="1"> Purge Database (API Maps Only)</td>
									</tr>
									<tr>
										<td><input type="checkbox" name="maps_history" checked="checked" value="1"> Purge Maps View History</td>
									</tr>
								  </tbody>
								</table>
								<br>
								<p style="text-align:center;">Older Than <input type="number" name="days" value="10" class="form-control" style="width:70px; display:inline;"> Days </p>
								<br>
								<div class="pull-right">
									<button name="submit" id="purge" class="btn btn-success"><i class="fa fa-save"></i> Purge</button>
								</div>
							</form>
                        </div>
                     </div>
                  </div>
               </div>
			   <div style="clear: both;"></div>
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
   
   <script>
		$(document).ready(function() {
			<?PHP if($showManagerMessage) { ?>
			BootstrapDialog.confirm("You have cleared cache, do you wish to vacuum your database to remove bloat?", function(result){
				if(result) {
					window.location = "vacuum-analyze.php";
				}
			});
			<?PHP } ?>
			
			<?PHP if($_GET['msg']) { ?>
				Alert("<?PHP echo $_GET['msg'] ?>", "info");
			<?PHP } ?>
			
			var purge_form = false;
			$("#purge").click(function(e) {
				if(!purge_form) {
					e.preventDefault();
					BootstrapDialog.confirm("Are you sure you want to continue?", function(result){
						if(result) {
							purge_form = true;
							$("#purge").click();
						}
					});
				}
			});
		});
   </script>
</body>

</html>