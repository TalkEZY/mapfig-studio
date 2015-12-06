<?PHP
	require_once(dirname(__FILE__)."/../include/master.inc.php");
	if(!isLogin()){
		redirect("login.php");
	}
	
	$PAGE = "SOCIAL_SHARE_SETTINGS";
	
	
	$success = "";
	$error = "";
	
	if(isset($_POST['save'])) {
		foreach($_FILES as $index => $file) {
			if(in_array($index, array('default','facebook','twitter','email','linkedin','pinterest')) && $file['error'] == 0 && $file['size'] > 0) {
				$res = uploadShare($index);
				if($res != "") {
					$error .= $res.'<br>';
				}
				else {
					$success .= $index.' image is Successfully uploaded<br>';
				}
			}
		}
	}
	
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <title>Social Share Settings</title>
   
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
      
	  <?PHP require_once(dirname(__FILE__)."/../include/sidebar.tpl.php"); ?>
	  
      <section>
         <!-- Page content-->
         <div class="content-wrapper">
            <h3>Social Share Settings
               <small></small>
            </h3>
            <div class="">
               <div class="col-lg-12">
				  
                  <div class="panel panel-default">
                     <div class="panel-heading">Share Settings</div>
                     <div class="panel-body">
                        <form action="" method="post" enctype="multipart/form-data">
							<div class="col-md-5">
								<label>Default Share Image</label>
								<br>
								<input type="file" name="default">
							</div>
							<div class="col-md-7">
								<img src="<?=BASEURL?>app/img/share/default.png" style="max-height:100px; max-width:100px;">
							</div>
							<div style="clear: both;"></div>
							<hr>
							
							<div class="col-md-5">
								<label>Facebook Share Image</label>
								<br>
								<input type="file" name="facebook">
							</div>
							<div class="col-md-7">
								<img src="<?=BASEURL?>app/img/share/facebook.png" style="max-height:100px; max-width:100px;">
							</div>
							<div style="clear: both;"></div>
							<hr>
							
							<div class="col-md-5">
								<label>Twitter Share Image</label>
								<br>
								<input type="file" name="twitter">
							</div>
							<div class="col-md-7">
								<img src="<?=BASEURL?>app/img/share/twitter.png" style="max-height:100px; max-width:100px;">
							</div>
							<div style="clear: both;"></div>
							<hr>
							
							<div class="col-md-5">
								<label>Pinterest Share Image</label>
								<br>
								<input type="file" name="pinterest">
							</div>
							<div class="col-md-7">
								<img src="<?=BASEURL?>app/img/share/pinterest.png" style="max-height:100px; max-width:100px;">
							</div>
							<div style="clear: both;"></div>
							<hr>
							
							<div class="col-md-5">
								<label>LinkedIn Share Image</label>
								<br>
								<input type="file" name="linkedin">
							</div>
							<div class="col-md-7">
								<img src="<?=BASEURL?>app/img/share/linkedin.png" style="max-height:100px; max-width:100px;">
							</div>
							<div style="clear: both;"></div>
							<hr>
							
							<div class="col-md-5">
								<label>Email Share Image</label>
								<br>
								<input type="file" name="email">
							</div>
							<div class="col-md-7">
								<img src="<?=BASEURL?>app/img/share/email.png" style="max-height:100px; max-width:100px;">
							</div>
							
							<div style="clear:both"></div>
							<br/>
							<input type="submit" name="save" value="Save!" class="btn btn-success pull-right">
						</form>
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
   <script src="js/bootbox.js"></script>
   
	<script type="text/javascript">var switchTo5x=true;</script>
	<script type="text/javascript" src="https://ws.sharethis.com/button/buttons.js"></script>
	<script type="text/javascript">stLight.options({publisher: "e9d95ec2-5d7f-4db8-88c5-4fc99c1099e4", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
   
</body>

</html>