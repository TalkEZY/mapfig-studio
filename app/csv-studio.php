<?PHP
	require_once(dirname(__FILE__)."/../include/master.inc.php");
	if(!isLogin()){
		redirect("login.php");
	}
	
	$error   = "";
	
	if(strlen($_SESSION['response']['csv-studio']['error']) > 0){
		$error = '<div ng-show="authMsg" class="alert alert-danger text-center ng-binding">'.$_SESSION['response']['csv-studio']['error'].'</div>';
	}
	unset($_SESSION['response']['csv-studio']['error']);
	
	$PAGE = "CSV_STUDIO";
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <title>CSV Studio</title>
   
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
   <script type="text/javascript">
		var sourceFormat = Array();
		<?PHP
			$first = '';
			foreach($_SOURCE_FILE_FORMATS_UNZIP as $key => $value) { 
				if($first == ''){
					$first = $key;
				}
			echo "sourceFormat['".$key."'] = '".implode(",",$value)."';\n\t";
		} ?>
	</script>
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
	  
      <!-- Main section-->
      <section>
		 <!-- Page content-->
		 <div class="content-wrapper">
			<h3>CSV Studio
               <small></small>
            </h3>
            <div class="">
               <div class="col-lg-12">
                  <div class="panel panel-default">
					 <div class="panel-heading">CSV Studio</div>
					 <div class="col-lg-12"><?=$error?></div>
                     <div class="panel-body">
                        <div class="table-responsive">
							<form action="processor/csv-studio/index.php" method="post" enctype="multipart/form-data">
								<table class="table">
								  <tbody>
									 <tr>
										<td>Input Format: *</td>
										<td>
											<select name="sourceFormat" class="form-control" required="required" id="sourceFormat" tabindex="1">
												<?PHP
													foreach($_SOURCE_FILE_FORMATS_UNZIP as $key => $value) {
												?>
													<option value="<?=$key?>"><?=$key?></option>
												<?PHP
													}
												?>
											</select>
										</td>
									</tr>
									<tr>
										<td>Upload File: *</td>
										<td>
											<input type="file" required="required" name="sourceUpload" class="form-control" id="sourceUpload" tabindex="2" accept=".shp,.zip">
										</td>
									</tr>
									<tr>
										<td>Source SRS</td>
										<td>
											<input type="text" name="argument1" class="form-control" id="argument1" placeholder="(optional)" tabindex="3">
										</td>
									</tr>
									<tr>
										<td>Target SRS</td>
										<td>
											<input type="text" name="argument2" class="form-control" id="argument2" placeholder="(optional)" tabindex="4">
										</td>
									</tr>
									<tr>
										<td>LINEFORMAT</td>
										<td>
											<select name="LINEFORMAT" class="form-control" id="lineFormat" tabindex="5">
												<option value="">DEFAULT</option>
												<option value="CRLF">DOS format</option>
												<option value="LF">Unix format</option>
											</select>
										</td>
									</tr>
									<tr>
										<td>GEOMETRY</td>
										<td>
											<select name="GEOMETRY" class="form-control" id="geometry" tabindex="5">
												<option value="">DEFAULT</option>
												<option value="AS_WKT">AS_WKT</option>
												<option value="AS_XYZ">AS_XYZ</option>
												<option value="AS_XY">AS_XY</option>
												<option value="AS_YX">AS_YX</option>
											</select>
										</td>
									</tr>
									<tr>
										<td>CREATE CSVT</td>
										<td>
											<select name="CREATE_CSVT" class="form-control" id="createCSV" tabindex="5">
												<option value="">DEFAULT</option>
												<option value="YES">YES</option>
												<option value="NO">NO</option>
											</select>
										</td>
									</tr>
									<tr>
										<td>SEPARATOR</td>
										<td>
											<select name="SEPARATOR" class="form-control" id="separator" tabindex="5">
												<option value="">DEFAULT</option>
												<option value="COMMA">COMMA</option>
												<option value="SEMICOLON">SEMICOLON</option>
												<option value="TAB">TAB</option>
											</select>
										</td>
									</tr>
									<tr>
										<td>WRITE_BOM</td>
										<td>
											<select name="WRITE_BOM" class="form-control" id="writeBom" tabindex="5">
												<option value="">DEFAULT</option>
												<option value="YES">YES</option>
												<option value="NO">NO</option>
											</select>
										</td>
									</tr>
									<tr>
										<td>Where</td>
										<td>
											<div class="col-lg-5">
												<input type="text" name="argument6" class="form-control" id="argument6" placeholder="(optional)" tabindex="8"/>
											</div>
											<div class="col-lg-1"> = </div>
											<div class="col-lg-6">
												<input type="text" name="argument7" class="form-control" id="argument7" placeholder="(optional)" tabindex="9"/>
											</div>
										</td>
									 </tr>
								  </tbody>
								</table>
								
								<p style="display:none;">
									<select name="targetFormat" class="text-danger" id="targetFormat" style="display:none" tabindex="10" required="required" data-placement="top" data-toggle="tooltip" data-original-title="Input Format">
										<?PHP
											foreach($_TARGET_FILE_FORMATS as $key => $value) {
										?>
											<option value="<?=$key?>"><?=$key?></option>
										<?PHP
											}
										?>
									</select>
								</p>
								
								<br>
								<div class="pull-right">
									<input type="hidden" name="convert" value="csv-studio"/>
									<button class="btn btn-success"><i class="fa fa-share"></i> Convert</button>
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
   <script src="js/csv.js"></script>
   <!-- =============== APP SCRIPTS ===============-->
   <script src="js/app.js"></script>
   <script>
	$(document).ready(function(){
		$('#sourceUpload').attr('accept', sourceFormat['<?=$first?>']);
		$('#sourceFormat').change(function(){
			var current = $(this).val();
			$('#sourceUpload').attr('accept', sourceFormat[current]);
		});
	});
   </script>
</body>
</html>