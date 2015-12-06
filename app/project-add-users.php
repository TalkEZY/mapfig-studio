<?PHP
	require_once(dirname(__FILE__)."/../include/master.inc.php");
	if(!isLogin()){
		redirect("login.php");
	}
	
	$user  = getUserInfo();
	
	if(!$user || !isAdmin($user)) {
		redirect("index.php");
	}
	
	$error   = "";
	$success = "";
	if(strlen($_SESSION['response']['project-add-users']['error']) > 0){
		$error = '<div ng-show="authMsg" class="alert alert-danger text-center ng-binding">'.$_SESSION['response']['project-add-users']['error'].'</div>';
	}
	else if(strlen($_SESSION['response']['project-add-users']['success']) > 0){
		$success = '<div ng-show="authMsg" class="alert alert-success text-center ng-binding">'.$_SESSION['response']['project-add-users']['success'].'</div>';
	}
	unset($_SESSION['response']['project-add-users']['error']);
	unset($_SESSION['response']['project-add-users']['success']);
	
	$PAGE = "ASSIGN_PROJECT_TO_USERS";
	$user = $_SESSION['user'];
	
	$project = getProjectByIdAndUserId($user['id'], $_GET['id']);
	if(!$project)
		redirect("project.php");
	
	$users = getUsersByUserId($user['id']);
	$projectHasUsers = getProjectHasUsersByProjectId($user['id'], $_GET['id']);
	
	$assignedUsers = array();
	foreach($projectHasUsers as $phu){
		$assignedUsers[] = $phu['users_id'];
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <title>Assign Users to Project</title>
   
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
			<h3>Assign Users to Project (<?=$project['name']?>)
               <small></small>
            </h3>
            <div class="">
               <div class="col-lg-12">
                  <div class="panel panel-default">
                     <div class="panel-heading">Project Name : <?=$project['name']?></div>
					 <div class="col-lg-12"><?=$error.$success?></div>
                     <div class="panel-body">
                        <div class="table-responsive">
							<form action="processor/project-add-users/index.php" method="post">
							<input type="hidden" name="id" class="form-control" value="<?=$project['id']?>">
								<table class="table">
								  <tbody>
									 <tr>
										<td width="45%">
											<b>Available Users</b>
											<select multiple class="form-control" id="leftSelect" style="height: 150px;">
											<?PHP 
												foreach($users as $user) {
													
													if(!in_array($user['id'], $assignedUsers)) {
														echo '<option value="'.$user['id'].'">'.$user['firstname'].' '.$user['lastname'].'</option>';
													}
												}
											?>
											</select>
										</td>
										<td width="5%">
											<br/>
											<button onClick="return false;" id="btnRight" class="btn btn-info"><i class="fa fa-arrow-right"></i></button>
											<br/><br/>
											<button onClick="return false;" id="btnLeft" class="btn btn-info"><i class="fa fa-arrow-left"></i></button>
										</td>
										<td width="45%">
											<b>Assigned Users</b>
											<select multiple name="assigned[]" id="rightSelect" class="form-control" style="height: 150px;">
											<?PHP 
												foreach($users as $user) {
													if(in_array($user['id'], $assignedUsers))
														echo '<option value="'.$user['id'].'">'.$user['firstname'].' '.$user['lastname'].'</option>';
												}
											?>
											</select>
										</td>
									 </tr>
								  </tbody>
								</table>
								<br>
								<div class="pull-right">
									<button name="save" id="save" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
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
		$(document).ready(function(){
			$("#btnLeft").click(function () {
				var selectedItem = $("#rightSelect option:selected");
				$("#leftSelect").append(selectedItem);
			});

			$("#btnRight").click(function () {
				var selectedItem = $("#leftSelect option:selected");
				$("#rightSelect").append(selectedItem);
			});
			
			$("#save").click(function () {
				$("#rightSelect option").attr('selected','selected');
			});
		});
	</script>
</body>

</html>