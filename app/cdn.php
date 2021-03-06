<?PHP
	require_once(dirname(__FILE__)."/../include/master.inc.php");
	if(!isLogin()){
		redirect("login.php");
	}
	
	$PAGE = "CDN";
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <title>CDN Documentation</title>
   
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
	  
      <!-- Main section-->
      <section>
         <!-- Page content-->
         <div class="content-wrapper">
            <div class="content-heading">
               
               CDN Documentation
            </div>
			
			
			Libraries and Static Files :
			
			
			
			
			
			            <div class="list-group">
               <a href="#" class="list-group-item">
                  <table class="wd-wide">
                     <tbody>
                        <tr>
                           <td class="wd-xs">
                              <div class="ph">
                                 <img src="img/cdn.png" alt="" class="media-box-object img-responsive img-rounded thumb64">
                              </div>
                           </td>
                           <td>
                              <div class="ph">
                                 <h4 class="media-box-heading">Leaflet</h4>
                                 <small class="text-muted">Leaftlet 0.7.3</small>
                              </div>
                           </td>
                           <td class="wd-sm hidden-xs hidden-sm">
                              <div class="ph">
                                 <p class="m0">Value</p>
                                 <small class="text-muted"><?=CDNURL?>leaflet/leaflet-0.7.34/</small></div>
                           </td>
                           <td class="wd-xs hidden-xs hidden-sm">
                              <div class="ph">
                                 <p class="m0 text-muted">
                                    <em class="icon-users mr fa-lg"></em></p>
                              </div>
                           </td>
                           <td class="wd-xs hidden-xs hidden-sm">
                              <div class="ph">
                                 <p class="m0 text-muted">
                                    <em class="icon-doc mr fa-lg"></em></p>
                              </div>
                           </td>
                           <td class="wd-sm">
                              <div class="ph">
                                 <progressbar value="50" type="purple" class="m0 progress-xs"></progressbar>
                              </div>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </a>
            </div>
			<div class="list-group">
               <a href="#" class="list-group-item">
                  <table class="wd-wide">
                     <tbody>
                        <tr>
                           <td class="wd-xs">
                              <div class="ph">
                                 <img src="img/cdn.png" alt="" class="media-box-object img-responsive img-rounded thumb64">
                              </div>
                           </td>
                           <td>
                              <div class="ph">
                                 <h4 class="media-box-heading">Leaflet </h4>
                                 <small class="text-muted">Leafelt 0.6.4</small>
                              </div>
                           </td>
                           <td class="wd-sm hidden-xs hidden-sm">
                              <div class="ph">
                                 <p class="m0">Value</p>
                                 <small class="text-muted"><?=CDNURL?>leaflet/leaflet-0.6.4/</small></div>
                           </td>
                           <td class="wd-xs hidden-xs hidden-sm">
                              <div class="ph">
                                 <p class="m0 text-muted">
                                    <em class="icon-users mr fa-lg"></em></p>
                              </div>
                           </td>
                           <td class="wd-xs hidden-xs hidden-sm">
                              <div class="ph">
                                 <p class="m0 text-muted">
                                    <em class="icon-doc mr fa-lg"></em></p>
                              </div>
                           </td>
                           <td class="wd-sm">
                              <div class="ph"></div>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </a>
            </div>
			
			
			<div class="list-group">
               <a href="#" class="list-group-item">
                  <table width="466" class="wd-wide">
                     <tbody>
                        <tr>
                           <td class="wd-xs">
                              <div class="ph">
                                 <img src="img/cdn.png" alt="" class="media-box-object img-responsive img-rounded thumb64">
                              </div>
                           </td>
                           <td>
                              <div class="ph">
                                 <h4 class="media-box-heading">Leaflet</h4>
                                 <small class="text-muted">Leaflet-Master</small>
                              </div>
                           </td>
                           <td class="wd-sm hidden-xs hidden-sm">
                              <div class="ph">
                                 <p class="m0">Value</p>
                                 <small class="text-muted"><?=CDNURL?>leaflet/leaflet-master</small></div>
                           </td>
                          <td class="wd-xs hidden-xs hidden-sm">&nbsp;</td>
                           <td class="wd-xs hidden-xs hidden-sm">&nbsp;</td>
                           <td class="wd-sm">
                              <div class="ph"></div>
                           </td>
                        </tr>
                     </tbody>
               </table>
               </a>
            </div>
			
			
			<div class="list-group">
               <a href="#" class="list-group-item">
                  <table class="wd-wide">
                     <tbody>
                        <tr>
                           <td class="wd-xs">
                              <div class="ph">
                                 <img src="img/cdn.png" alt="" class="media-box-object img-responsive img-rounded thumb64">
                              </div>
                           </td>
                           <td>
                              <div class="ph">
                                 <h4 class="media-box-heading">Bootstrap </h4>
                                 <small class="text-muted">Map focus </small>
                              </div>
                           </td>
                           <td class="wd-sm hidden-xs hidden-sm">
                              <div class="ph">
                                 <p class="m0">Value</p>
                                 <small class="text-muted">Integer</small>
                              </div>
                           </td>
                           <td class="wd-xs hidden-xs hidden-sm">
                              <div class="ph">
                                 <p class="m0 text-muted">
                                    <em class="icon-users mr fa-lg"></em></p>
                              </div>
                           </td>
                           <td class="wd-xs hidden-xs hidden-sm">
                              <div class="ph">
                                 <p class="m0 text-muted">
                                    <em class="icon-doc mr fa-lg"></em></p>
                              </div>
                           </td>
                           <td class="wd-sm">
                              <div class="ph"></div>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </a>
            </div>
			
			
			<div class="list-group">
               <a href="#" class="list-group-item">
                  <table class="wd-wide">
                     <tbody>
                        <tr>
                           <td class="wd-xs">
                              <div class="ph">
                                 <img src="img/cdn.png" alt="" class="media-box-object img-responsive img-rounded thumb64">
                              </div>
                           </td>
                           <td>
                              <div class="ph">
                                 <h4 class="media-box-heading">More Libs...</h4>
                                 <small class="text-muted">Additional Libs </small>
                             </div>
                           </td>
                           <td class="wd-sm hidden-xs hidden-sm">
                              <div class="ph">
                                 <p class="m0">Last change</p>
                                 <small class="text-muted">Yesterday at 10:20 pm</small>
                              </div>
                           </td>
                           <td class="wd-xs hidden-xs hidden-sm">
                              <div class="ph">
                                 <p class="m0 text-muted">
                                    <em class="icon-users mr fa-lg"></em></p>
                              </div>
                           </td>
                           <td class="wd-xs hidden-xs hidden-sm">
                              <div class="ph">
                                 <p class="m0 text-muted">
                                    <em class="icon-doc mr fa-lg"></em></p>
                              </div>
                           </td>
                           <td class="wd-sm">
                              <div class="ph"></div>
                           </td>
                        </tr>
						
						
                     </tbody>
                  </table>
				  
				  
				  <!-- END Multiple List group-->
            </div>
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