<?PHP
	require_once(dirname(__FILE__)."/../include/master.inc.php");
	if(!isLogin()){
		redirect("login.php");
	}
	$user  = getUserInfo();
	
	if(isset($_GET['action']) && $_GET['action'] == 'delete'){
		deleteMap((int)$_GET['id'], $user['id']);
	}
	
	$maps = getMapsByUserId($user['id'], 25);
	$PAGE = "MAP_VIEW";
	$directoryList = array();
	
	$dirs = scandir("map/html-template/");
	rsort($dirs);
	foreach ($dirs as $dir) {
		if ($dir != '.' && $dir != '..') {
			$directoryList[] = $dir;
		}
	}
	
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <title>Maps Deployed</title>
   
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
            <h3>Deployed Maps
               <small></small>
            </h3>
            <div class="">
               <div class="col-lg-12">
                  <div class="panel panel-default">
					<div class="pull-right" style="margin: 10px 30px 0 0;width: 30%;">
						<div id="datatable1_filter" class="dataTables_filter">
							<form action="map-search.php"><input type="search" class="form-control input-sm" placeholder="Type Map Title/Name and hit enter ..." value="<?PHP echo $_GET['q']; ?>" name="q" aria-controls="datatable1"></form>
						</div>
					</div>
                     <div class="panel-heading">
						<span class="pull-left">Map List</span>
						<?PHP if(isAdmin($user)) { ?><a href= "#" class="btn btn-info pull-right" id="import-from-free-account"> Import your Shared Studio Maps</a><? } ?>
						<div style="clear:both;"></div>
					</div>
                     <div class="panel-body">
                        <div class="table-responsive">
                           <table class="table table-hover">
                              <thead>
                                 <tr>
                                    <th>Map ID</th>
                                    <th>Name</th>
                                    <th>Height</th>
                                    <th>Width</th>
                                    <th>Zoom</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
								<?PHP foreach($maps as $map) { ?>
                                 <tr>
                                    <td><?=$map['id']?></td>
                                    <td><?=$map['name']?></td>
                                    <td><?=$map['height']?></td>
                                    <td><?=$map['width']?></td>
                                    <td><?=$map['zoom']?></td>
                                    <td>
										<a href="map-edit.php?id=<?=$map['id']?>" class="btn btn-sm btn-info" title="Edit"><i class="fa fa-edit"></i></a> 
										<a href="<?=BASEURL?>app/map-view.php?mapid=<?=$map['id']?>" target="_blank" class="btn btn-sm btn-default" title="View"><i class="icon-eye"></i></a> 
										<a href="<?=BASEURL?>app/map-download-html.php?mapid=<?=$map['id']?>" class="btn btn-sm btn-success" title="Download Html Map"><i class="fa fa-download"></i> HTML</a> 
										<a href="<?=BASEURL?>app/map-download-json.php?mapid=<?=$map['id']?>" class="btn btn-sm btn-success" title="Download JSON Code"><i class="fa fa-download"> JSON</i></a>
										<a href="<?=BASEURL?>app/map-download-template.php?mapid=<?=$map['id']?>" class="btn btn-sm btn-success" title="Download Complete Template App" onClick="return downloadWebApp(this);"><i class="fa fa-download"> Web App</i></a>
										<a href="#" onClick="return openPrompt(<?=$map['id']?>)" class="btn btn-sm btn-inverse" title="Get iFrame Code"><i class="fa fa-copy"> iFrame Code</i></a>
										<textarea style="display:none;" id="iframe_<?=$map['id']?>"><iframe src='<?=BASEURL?>app/map-view.php?mapid=<?=$map['id']?>' height="<?=$map['height']?>" width="<?=$map['width']?>" style="border: none;"></iframe></textarea>
										<a href="map.php?action=delete&id=<?=$map['id']?>" class="btn btn-sm btn-danger" title="Delete Map"><i class="fa fa-remove"></i> </a>
									</td>
                                 </tr>
								<?PHP } ?>
                              </tbody>
                           </table>
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
   <script src="js/bootbox.js"></script>
   
   <script>
	function openPrompt(mapId) {
		var val = $('textarea#iframe_' + mapId).val();
		bootbox.prompt({
		  title: "Copy the below Code",
		  value: val,
		  callback: function(result) {
			
		  }
		});
		return false;
	}
	
	var global_webApp_href;
	function downloadWebApp(obj) {
		global_webApp_href = $(obj).attr('href');
		var options = '<option value="">[Select]</option>';
		
		<?PHP foreach($directoryList as $dir) {
			echo "options += '<option value=\"$dir\">$dir</option>';";
		}
		?>
		
		BootstrapDialog.show({
			title: 'Select Template to Download',
			message: '<select id="templateSelection" class="form-control">'+options+'</select>',
			buttons: [{
				label: '',
				icon: 'fa fa-check',
				cssClass: 'btn-primary',
				action: function(dialog) {
					var template = $('#templateSelection').val();
					if(template == "") {
						Alert("Please Select a Template", "error");
					}
					else {
						window.location = global_webApp_href+"&template="+template;
						dialog.close();
					}
				}
			}, {
				label: '',
				icon: 'fa fa-remove',
				cssClass: '',
				action: function(dialog) {
					dialog.close();
				}
			}]
		});
		
		return false;
	}
	
	$(document).ready(function() {
		$('#import-from-free-account').click(function(e) {
			e.preventDefault();
			BootstrapDialog.show({
				title: 'Enter old Studio\'s Details!',
				message: '<input type="url" class="form-control" id="import_url" value="http://studio.mapfig.com/" placeholder="Old Studio URL"/><br/>\
						  <input type="text" class="form-control" id="import_apikey" placeholder="Old Studio API Key"/>',
				buttons: [{
					label: 'Import',
					icon: 'fa fa-check',
					cssClass: 'btn-primary',
					action: function(dialog) {
						var url = $('#import_url').val();
						var apikey = $('#import_apikey').val();
						
						if(url == "" || apikey == "") {
							Alert("Api Key and Url is required", "error");
						}
						else {
							$.ajax( "processor/map-import-from-studio/index.php?url="+url+"&apikey="+apikey)
								.done(function(data) {
									if(data == "") {
										Alert("Maps Imported Successfully!", "success");
										location.reload();
									}
									else {
										Alert(data, "error");
									}
									dialog.close();
								})
								.fail(function() {
									Alert( "Request is not completed. Please check your internet connection and try again", "warning" );
									dialog.close();
								});
						}
					}
				}, {
					label: 'Cancel',
					icon: 'fa fa-remove',
					cssClass: '',
					action: function(dialog) {
						dialog.close();
					}
				}]
			});
		});
	});
   </script>
   
</body>

</html>