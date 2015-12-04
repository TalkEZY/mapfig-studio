<?PHP
	require_once(dirname(__FILE__)."/../include/master.inc.php");
	if(!isLogin()){
		redirect("login.php");
	}
	
	$user = $_SESSION['user'];
	
	$map = getMapById($_GET['id'], $user['id']);
	if(!$map) {
		redirect("csv.php");
	}
	
	$csv = new CSV();
	$rows = $csv->createCSVFromMapId($map['id']);
	$shapeIds = $csv->getShapeIds();
	
	$defaultProperty = $csv->getDefaultProperty();
	
	$error   = "";
	
	if(strlen($_SESSION['response']['csv-edit']['error']) > 0){
		$error = '<div ng-show="authMsg" class="alert alert-danger text-center ng-binding">'.$_SESSION['response']['csv-edit']['error'].'</div>';
	}
	unset($_SESSION['response']['csv-edit']['error']);
	
	$PAGE = "CSV_VIEW";
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <title>Edit Table Map</title>
   
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
   <link rel="stylesheet" href="../vendor/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css">
   <!-- WEATHER ICONS-->
   <link rel="stylesheet" href="../vendor/weather-icons/css/weather-icons.min.css">
   <!-- CHOSEN-->
   <link rel="stylesheet" href="../vendor/chosen_v1.2.0/chosen.min.css">
   <!-- =============== APP STYLES ===============-->
   <link rel="stylesheet" href="css/app.css" id="maincss">
   
   <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
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
			<h3>Edit Table Map
               <small></small>
            </h3>
            <div class="">
				<div class="panel col-lg-12">
				   <table id="map" style="clear: both" class="table">
					  <tbody>
						 <tr>
							<th>Created By</th>
							<td>
							   <?=$user['firstname'].' '.$user['lastname']?>
							</td>
							<th>Table Name</th>
							<td>
							   <a id="name" href="#" data-type="text" data-pk="" data-title="Enter Map Name!"><?=$map['name']?></a>
							</td>
						 </tr>
					  </tbody>
				   </table>
				</div>
               <div class="col-lg-12">
                  <div class="panel panel-default">
					 <div class="panel-heading">
						Add/Edit/Delete Columns/Rows and click "Save" (Note: Latitude/Longitude are required)
						<br/>
						First Row will be treated as 'Header/Column Name'
						<div class="pull-right">
							<button class="btn btn-info" id="get_latlng">Get Lat/Lng</button>
						</div>
					 </div>
					 <div class="col-lg-12"><?=$error?></div>
                     <div class="panel-body">
                        <div class="col-lg-12" style="overflow: auto;">
							<div id="csv-editor" style="height:400px;"><div class="loader" style="width:100px; padding-top:120px; margin:0 auto;"><i class="fa fa-spinner fa-spin" style="font-size: 100px;"></i></div></div>
                        </div>
						<div style="clear:both;"></div>
						<br/>
						<div class="col-lg-12">
							<div class="pull-right">
								<form action="processor/csv-edit/index.php" method="post">
									<input type="hidden" name="csv_data" id="csv_data"/>
									<input type="hidden" name="defaultProperty" id="defaultProperty" value="<?=$defaultProperty?>"/>
									
									<input type="hidden" name="stylingColumn" value="<?=$map['stylingcolumn']?>"/>
									<input type="hidden" name="shapeStyling" id="shapeStyling"/>
									
									<input type="hidden" name="filteredColumns" id="filteredColumns"/>
									
									<input type="hidden" name="csv_id" value="<?=$map['id']?>"/>
									<input type="hidden" name="map-name" value="<?=$map['name']?>"/>
									<input type="hidden" name="map-password" value="<?=$map['password']?>"/>
									<input type="hidden" name="map-height" value="<?=$map['height']?>"/>
									<input type="hidden" name="map-width" value="<?=$map['width']?>"/>
									<input type="hidden" name="map-zoom" value="<?=$map['zoom']?>"/>
									<input type="hidden" name="shape-ids" value="<?=implode(',',$shapeIds)?>"/>
									
									<button onClick="editTableOptions(); return false;" class="btn btn-info"><i class="fa fa-edit"></i> Edit Table Options</button>
									<button id="save" class="btn btn-success"><i class="icon-map"></i> Save</button>
								</form>
							</div>
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
   <!-- CHOSEN-->
   <script src="../vendor/chosen_v1.2.0/chosen.jquery.min.js"></script>
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
   <script src="js/map.csv.js"></script>
   
	<script src="handsontable/js/handsontable.full.min.js"></script>
	<link rel="stylesheet" media="screen" href="handsontable/css/handsontable.full.min.css">  
	<script>
		function getData() {
			return <?=json_encode($rows)?>;
		}
		var $container = $("#csv-editor");
		$container.handsontable({
			data: getData(),
			startRows: 20,
			startCols: 26,
			minRows: 20,
			minCols: 26,
			maxRows: <?=CSV_ROWS_LIMIT+1?>,
			minSpareRows: 1,
			autoColumnWidths: 300,
			rowHeaders: true,
			colHeaders: true,
			contextMenu: true
		});
		var hotInstance = $container.handsontable('getInstance');
		
		$(document).ready(function(){
			hotInstance.addHook('afterChange',function(){
				toggleGetLatLngButton();
			});
			
			$('.loader').hide();
			
			$('#save').click(function(e){
				e.preventDefault();
				
				$('#csv_data').val(JSON.stringify(hotInstance.getData()));
				$(this).closest('form').submit();
				return true;
				/* Skip anything after  */
				
				
			});
		});
		
		function editTableOptions() {
			var columns = getHeader();
			var html = "";
			
			value = $('#defaultProperty').val();
			
			$.each(columns, function(index, column){
				html += '<option value="'+column+'" '+((value==column)?'selected':'')+'>'+column+'</option>';
			});
			
			BootstrapDialog.show({
				title: 'Choose Location Column to display on Sidebar.',
				message: '\
					<div class="panel panel-default">\
						<select class="chosen-select form-control" name="selectedDefault">\
							'+html+'\
						</select>\
					</div>\
				',
				buttons: [{
					label: '',
					icon: 'fa fa-check',
					cssClass: 'btn-primary',
					action: function(dialog) {
						var value = $('select[name=selectedDefault]').val();
						if(value != "") {
							$('#defaultProperty').val(value);
							
							shapeStylingModal();
							dialog.close();
						}
						else {
							Alert("Please select a unique Column, Its required.", "error");
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
		}
	</script>
	
	<script>
		var tempTotalLocations = 0;
		var selectedIndexes = new Array();
		
		var globalRows = [];
		var globalCoords = [];
		var globalInterval = undefined;
		var globalCount = 0;
		var currentLocationsCount = 0;
		
		var progressBar = null;
		
		$(document).ready(function(){
			toggleGetLatLngButton();
			
			$("#get_latlng").click(function() {
				if(!hasLatLng()) {
					var header = getHeader();
					
					var html = '';
					$.each(header, function(key, value) {
						value = value.replace(/"/g, '');
						html += '<option value="'+value+'">"'+value+'"</option>';
					});
					
					BootstrapDialog.show({
						title: 'Choose fields to geocode',
						message: '\
							<div id="selectColumnNamesToGetLatLng">\
								<div class="panel panel-default">\
									<select multiple class="chosen-select form-control" name="fields">\
										'+html+'\
									</select>\
								</div>\
							</div>\
						',
						buttons: [{
							label: '',
							icon: 'fa fa-check',
							cssClass: 'btn-primary',
							action: function(dialog) {
								if(validateSelectedValues()) {
									removeLatLng(); // if/any exists
									produceLatLng();
									
									toggleGetLatLngButton();
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
					
					setTimeout(function() {
						$('.chosen-select').chosen();
					}, 200)
				}
			});
		});
		
		function toggleGetLatLngButton() {
			if(hasLatLng()) {
				$("#get_latlng").attr('disabled','disabled');
			}
			else {
				$("#get_latlng").removeAttr('disabled');
			}
		}
		
		function hasLatLng() {
			return false;
			
			var rows = hotInstance.getData();
			var counter = 0;
			$.each(rows[0], function(key, value){
				if(value && (value.toLowerCase() == "latitude" || value.toLowerCase() == "longitude")) {
					counter++;
				}
			});
			
			return (counter == 2);
		}
		
		function getHeaderRow() { //get whole first row
			var rows = hotInstance.getData();
			return rows[0];
		}
		
		function getHeader() { // header without null and lat/lng columns
			var rows = hotInstance.getData();
			var header = new Array();
			$.each(rows[0], function(key, value){
				if(value && value != "" && value.toLowerCase() != "latitude" && value.toLowerCase() != "longitude") {
					header.push(value);
				}
			});
			
			return header;
		}
		
		function getColumnIndex(columnName) { // index in CSV
			var row = getHeaderRow();
			var index = -1;
			$.each(row, function(key, value) {
				if(value && value != "" && value.toLowerCase() == columnName.replace(/"/g, '').toLowerCase()) {
					index = key;
					return false;
				}
			});
			
			return index;
		}
		
		function getLastColumnIndex() {
			var row = getHeaderRow();
			index = 0;
			
			$.each(row, function(key, value) {
				if(value) {
					index = key;
				}
			});
			return ++index;
		}
		
		function validateSelectedValues() {
			var columns = $('select[name=fields]').val();
			var retVal  = true;
			selectedIndexes = new Array();
			
			if(!columns || columns.length == 0) {
				Alert("Please Select atleast one Column", "danger");
				return !retVal;
			}
			
			$.each(columns, function(index, column){
				idx = getColumnIndex(column);
				if(idx == -1) {
					retVal = false
				}
				else {
					selectedIndexes.push(idx);
				}
			});
			
			if(!retVal) {
				Alert("Selected Columns not found", "warning");
			}
			
			return retVal;
		}
		
		function produceLatLng() {
			var lastIndex  = getLastColumnIndex();
			globalRows = hotInstance.getData();
			
			var locations  = [];
			
			progressBar = createProgressBar();
			
			$.each(globalRows, function(rowIndex, row) {
				if(rowIndex != 0) { // first row is head
					loc = "";
					$.each(selectedIndexes, function(key, index) {
						if(row[index] && row[index] != "") {
							loc += row[index] + " ";
						}
					});
					
					loc = $.trim(loc);
					if(loc.length > 0) {
						locations.push(loc);
					}
				}
			});
			
			globalCoords = [];
			globalCount = 0;
			currentLocationsCount = 0;
			
			if(locations.length > 0) {
				globalInterval = setInterval(function() {
					someFunction(locations, lastIndex, progressBar);
				}, 1100);
			}
			else {
				updateProgressBar(progressBar, 100);
			}
		}
		
		
		
		function someFunction(locations, lastIndex, progressBar) {
			var locationsCount = (locations) ? locations.length : 0;
			
			globalRows[0][lastIndex]   = "Latitude";
			globalRows[0][lastIndex+1] = "Longitude";
			
			
				currAddress = locations[currentLocationsCount].toString();
				var geocoder = new google.maps.Geocoder();
				if (geocoder) {
					geocoder.geocode({ 'address': currAddress }, function (results, status) {
						globalCount++;
						updateProgressBar(progressBar, Math.floor((globalCount/locationsCount)*100));
						if (status == google.maps.GeocoderStatus.OK) {
							
							var latitude = results[0].geometry.location.lat();
							var longitude = results[0].geometry.location.lng();
							
							globalCoords.push([latitude, longitude]);
						}
						else {
							globalCoords.push([0, 0]);
						}
						
						if(globalCount == locationsCount) { // All the rows Processed. this one was the last one
							for(var j=0; j<globalCoords.length; j++) {
								globalRows[j+1][lastIndex]   = globalCoords[j][0];
								globalRows[j+1][lastIndex+1] = globalCoords[j][1];
							}
							hotInstance.loadData(globalRows);
							clearInterval(globalInterval);
							updateProgressBar(progressBar, 100);
						}
					});
				}
				currentLocationsCount++;
		}
		
		
		
		function removeLatLng() {
			index = getColumnIndex('latitude');
			if(index != -1) {
				hotInstance.alter('remove_col',index);
			}
			
			index = getColumnIndex('longitude');
			if(index != -1) {
				hotInstance.alter('remove_col',index);
			}
		}
		
		function createProgressBar() {
			var dialogInstance = new BootstrapDialog();
			dialogInstance.setTitle(null);
			dialogInstance.setMessage('\
				<div id="csvProgressBar">\
					<div class="progress">\
						<div class="progress-bar progress-bar-striped active" role="progressbar"\
							aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">\
							0%\
						</div>\
					</div>\
				</div>\
			');
			dialogInstance.setType(BootstrapDialog.TYPE_SUCCESS);
			dialogInstance.setClosable(false);
			dialogInstance.open();
			
			dialogInstance.getModalHeader().hide();
			dialogInstance.getModalFooter().hide();
			
			return dialogInstance;
		}
		
		function updateProgressBar(dialogInstance, percentage) { // progress in percentage
			if(percentage == 100) {
				dialogInstance.close();
			}
			
			body = dialogInstance.getModalBody();
			obj  = body.find('#csvProgressBar div.progress-bar.progress-bar-striped.active');
			
			obj.attr('aria-valuenow',percentage);
			obj.css('width',percentage+'%');
			obj.text(percentage+'% Completed');
		}
	</script>
	
	
	
	
	
	<script>
		var distinctStylings = [];
	
		/* Distinct Styling Part */
		function shapeStylingModal() {
			var columns = getHeader();
			var html = "";
			
			var col = $('input[name=stylingColumn]').val();
			
			$.each(columns, function(index, column){
				html += '<option value="'+column+'" '+((col==column)?'selected':'')+'>'+column+'</option>';
			});
			
			BootstrapDialog.show({
				title: 'Select Column to style shapes',
				message: '\
					<div class="panel panel-default">\
						<select class="chosen-select form-control" id="stylingColumn">\
							'+html+'\
						</select>\
					</div>\
				',
				buttons: [{
					label: 'Style Shapes',
					icon: 'fa fa-check',
					cssClass: 'btn-primary',
					action: function(dialog) {
						$('input[name=stylingColumn]').val($('#stylingColumn').val());
						renderStyles($('#stylingColumn').val());
						
						dialog.close();
					}
				}, {
					label: 'Skip and Continue',
					icon: 'fa fa-share',
					cssClass: 'btn-info',
					action: function(dialog) {
						//$('input[name=stylingColumn]').val('');
						
						applyFilter();
						dialog.close();
					}
				}, {
					label: 'Cancle',
					icon: 'fa fa-remove',
					cssClass: '',
					action: function(dialog) {
						dialog.close();
					}
				}]
			});
		}
		
		function getDistinctValues(column) {
			var rows = $.extend(true, [], hotInstance.getData()); // deep copy
			var idx = getColumnIndex(column);
			var distincts = [];
			
			if(idx != -1) {
				rows.shift();
				$.each(rows, function(index, row){
					if(row[idx] && row[idx] != "" && row[idx] != null && $.inArray(row[idx], distincts) == -1) {
						distincts.push(row[idx]);
					}
				});
			}
			
			return distincts;
		}
		
		function renderStyles(column) {
			var distincts = getDistinctValues(column);
			var html = '\
				<div class="panel-body">\
					<div class="table-responsive" style="height: 200px;">\
						<table class="table table-bordered table-hover">\
							<thead>\
								<tr>\
									<th>Column Value</th>\
									<th>Marker Color</th>\
									<th>Marker Icon</th>\
								</tr>\
							</thead>\
							<tbody id="styleList">';
			
			$.each(distincts, function(index, distinct) {
				
				html += '\
					<tr>\
						<td>'+distinct+'</td>\
						<td>\
							<select class="form-control">\
								<option value="">Marker Color</option>\
								<option value="red">Red</option>\
								<option value="blue">Blue</option>\
								<option value="green">Green</option>\
								<option value="purple">Purple</option>\
								<option value="orange">Orange</option>\
								<option value="darkred">Darkred</option>\
								<option value="lightred">Lightred</option>\
								<option value="beige">Beige</option>\
								<option value="darkblue">Darkblue</option>\
								<option value="darkpurple">Darkpurple</option>\
								<option value="white">White</option>\
								<option value="pink">Pink</option>\
								<option value="lightblue">Lightblue</option>\
								<option value="lightgreen">Lightgreen</option>\
								<option value="gray">Gray</option>\
								<option value="black">Black</option>\
								<option value="cadetblue">Cadet Blue</option>\
								<option value="brown">Brown</option>\
								<option value="lightgray">Lightgray</option>\
							</select>\
						</td>\
						<td>\
							<select class="form-control">\
								<option value="">Marker Icon</option>\
								<option value="adjust">Adjust</option>\
								<option value="anchor">Anchor</option>\
								<option value="archive">Archive</option>\
								<option value="area-chart">Area Chart</option>\
								<option value="arrows">Arrows</option>\
								<option value="arrows-h">Arrows H</option>\
								<option value="arrows-v">Arrows V</option>\
								<option value="asterisk">Asterisk</option>\
								<option value="at">At</option>\
								<option value="automobile">Automobile</option>\
								<option value="ban">Ban</option>\
								<option value="bank">Bank</option>\
								<option value="bar-chart">Bar Chart</option>\
								<option value="bar-chart-o">Bar Chart O</option>\
								<option value="barcode">Barcode</option>\
								<option value="bars">Bars</option>\
								<option value="bed">Bed</option>\
								<option value="beer">Beer</option>\
								<option value="bell">Bell</option>\
								<option value="bell-o">Bell O</option>\
								<option value="bell-slash">Bell Slash</option>\
								<option value="bell-slash-o">Bell Slash O</option>\
								<option value="bicycle">Bicycle</option>\
								<option value="binoculars">Binoculars</option>\
								<option value="birthday-cake">Birthday Cake</option>\
								<option value="bolt">Bolt</option>\
								<option value="bomb">Bomb</option>\
								<option value="book">Book</option>\
								<option value="bookmark">Bookmark</option>\
								<option value="bookmark-o">Bookmark O</option>\
								<option value="briefcase">Briefcase</option>\
								<option value="bug">Bug</option>\
								<option value="building">Building</option>\
								<option value="building-o">Building O</option>\
								<option value="bullhorn">Bullhorn</option>\
								<option value="bullseye">Bullseye</option>\
								<option value="bus">Bus</option>\
								<option value="cab">Cab (Alias)</option>\
								<option value="calculator">Calculator</option>\
								<option value="calendar">Calendar</option>\
								<option value="calendar-o">Calendar O</option>\
								<option value="camera">Camera</option>\
								<option value="camera-retro">Camera Retro</option>\
								<option value="car">Car</option>\
								<option value="caret-square-o-down">Caret Square O Down</option>\
								<option value="caret-square-o-left">Caret Square O Left</option>\
								<option value="caret-square-o-right">Caret Square O Right</option>\
								<option value="caret-square-o-up">Caret Square O Up</option>\
								<option value="cart-arrow-down">Cart Arrow Down</option>\
								<option value="cart-plus">Cart Plus</option>\
								<option value="cc">CC</option>\
								<option value="certificate">Certificate</option>\
								<option value="check">Check</option>\
								<option value="check-circle">Check Circle</option>\
								<option value="check-circle-o">Check Circle O</option>\
								<option value="check-square">Check Square</option>\
								<option value="check-square-o">Check Square O</option>\
								<option value="child">Child</option>\
								<option value="circle">Circle</option>\
								<option value="circle-o">Circle O</option>\
								<option value="circle-o-notch">Circle O Notch</option>\
								<option value="circle-thin">Circle Thin</option>\
								<option value="clock-o">Clock O</option>\
								<option value="close">Close (Alias)</option>\
								<option value="cloud">Cloud</option>\
								<option value="cloud-download">Cloud Download</option>\
								<option value="cloud-upload">Cloud Upload</option>\
								<option value="code">Code</option>\
								<option value="code-fork">Code Fork</option>\
								<option value="coffee">Coffee</option>\
								<option value="cog">Cog</option>\
								<option value="cogs">Cogs</option>\
								<option value="comment">Comment</option>\
								<option value="comment-o">Comment O</option>\
								<option value="comments">Comments</option>\
								<option value="comments-o">Comments O</option>\
								<option value="compass">Compass</option>\
								<option value="copyright">Copyright</option>\
								<option value="credit-card">Credit Card</option>\
								<option value="crop">Crop</option>\
								<option value="crosshairs">Crosshairs</option>\
								<option value="cube">Cube</option>\
								<option value="cubes">Cubes</option>\
								<option value="cutlery">Cutlery</option>\
								<option value="dashboard">Dashboard</option>\
								<option value="database">Database</option>\
								<option value="desktop">Desktop</option>\
								<option value="diamond">Diamond</option>\
								<option value="dot-circle-o">Dot Circle O</option>\
								<option value="download">Download</option>\
								<option value="edit">Edit</option>\
								<option value="ellipsis-h">Ellipsis H</option>\
								<option value="ellipsis-v">Ellipsis V</option>\
								<option value="envelope">Envelope</option>\
								<option value="envelope-o">Envelope O</option>\
								<option value="envelope-square">Envelope Square</option>\
								<option value="eraser">Eraser</option>\
								<option value="exchange">Exchange</option>\
								<option value="exclamation">Exclamation</option>\
								<option value="exclamation-circle">Exclamation Circle</option>\
								<option value="exclamation-triangle">Exclamation Triangle</option>\
								<option value="external-link">External Link</option>\
								<option value="external-link-square">External Link Square</option>\
								<option value="eye">Eye</option>\
								<option value="eye-slash">Eye Slash</option>\
								<option value="eyedropper">Eye Dropper</option>\
								<option value="fax">Fax</option>\
								<option value="female">Female</option>\
								<option value="fighter-jet">Fighter Jet</option>\
								<option value="file-archive-o">File Archive O</option>\
								<option value="file-audio-o">File Audio O</option>\
								<option value="file-code-o">File Code O</option>\
								<option value="file-excel-o">File Excel O</option>\
								<option value="file-image-o">File Image O</option>\
								<option value="file-movie-o">File Movie O</option>\
								<option value="pdf-o">Pdf O</option>\
								<option value="file-photo-o">File Photo O</option>\
								<option value="file-picture-o">File Picture O</option>\
								<option value="file-powerpoint-o">File Powerpoint O</option>\
								<option value="file-sound-o">File Sound O</option>\
								<option value="file-video-o">File Video O</option>\
								<option value="file-word-o">File Word O</option>\
								<option value="file-zip-o">File Zip O</option>\
								<option value="film">Film</option>\
								<option value="filter">Filter</option>\
								<option value="fire">Fire</option>\
								<option value="fire-extinguisher">Fire Extinguisher</option>\
								<option value="flag">Flag</option>\
								<option value="flag-checkered">Flag Checkered</option>\
								<option value="flag-o">Flag O</option>\
								<option value="flash">Flash</option>\
								<option value="flask">Flask</option>\
								<option value="folder">Folder</option>\
								<option value="folder-o">Folder O</option>\
								<option value="folder-open">Folder Open</option>\
								<option value="folder-open-o">Folder Open O</option>\
								<option value="frown-o">Frown O</option>\
								<option value="futbol-o">Futbol O</option>\
								<option value="gamepad">Game Pad</option>\
								<option value="gavel">Gavel</option>\
								<option value="gear">Gear</option>\
								<option value="gears">Gears</option>\
								<option value="genderless">Gender Less</option>\
								<option value="gift">Gift</option>\
								<option value="glass">Glass</option>\
								<option value="globe">Globe</option>\
								<option value="Graduation Cap">Graduation Cap</option>\
								<option value="group">Group</option>\
								<option value="hdd-o">Hdd O</option>\
								<option value="headphones">Head Phones</option>\
								<option value="heart">Heart</option>\
								<option value="heart-o">Heart O</option>\
								<option value="heartbeat">Heartbeat</option>\
								<option value="history">History</option>\
								<option value="home">Home</option>\
								<option value="hotel">Hotel</option>\
								<option value="image">Image</option>\
								<option value="inbox">Inbox</option>\
								<option value="info">Info</option>\
								<option value="info-circle">Info Circle</option>\
								<option value="institution">Institution</option>\
								<option value="key">Key</option>\
								<option value="keyboard-o">Keyboard O</option>\
								<option value="language">Language</option>\
								<option value="laptop">Laptop</option>\
								<option value="leaf">Leaf</option>\
								<option value="legal">Legal</option>\
								<option value="lemon-o">Lemon O</option>\
								<option value="level-down">Level Down</option>\
								<option value="level-up">Level Up</option>\
								<option value="life-bouy">Life Bouy</option>\
								<option value="life-buoy">Life Buoy</option>\
								<option value="life-ring">Life Ring</option>\
								<option value="life-saver">Life Saver</option>\
								<option value="lightbulb-o">Light bulb O</option>\
								<option value="line-chart">Line Chart</option>\
								<option value="location-arrow">Location Arrow</option>\
								<option value="lock">Lock</option>\
								<option value="magic">Magic</option>\
								<option value="magnet">Magnet</option>\
								<option value="mail-forward">Mail Forward</option>\
								<option value="mail-reply">Mail Reply</option>\
								<option value="mail-reply-all">Mail Reply All</option>\
								<option value="male">Male</option>\
								<option value="map-marker">Map Marker</option>\
								<option value="meh-o">Meh O</option>\
								<option value="microphone">Microphone</option>\
								<option value="microphone-slash">Microphone Slash</option>\
								<option value="minus">Minus</option>\
								<option value="minus-circle">Minus Circle</option>\
								<option value="minus-square">Minus Square</option>\
								<option value="minus-square-o">Minus Square O</option>\
								<option value="mobile">Mobile</option>\
								<option value="mobile-phone">Mobile Phone</option>\
								<option value="money">Money</option>\
								<option value="moon-o">Moon O</option>\
								<option value="mortar-board">Mortar Board</option>\
								<option value="motorcycle">Motorcycle</option>\
								<option value="music">Music</option>\
								<option value="navicon">NavIcon</option>\
								<option value="newspaper-o">Newspaper O</option>\
								<option value="paint-brush">Paint Brush</option>\
								<option value="paper-plane">Paper Plane</option>\
								<option value="paper-plane-o">Paper Plane O</option>\
								<option value="paw">Paw</option>\
								<option value="pencil">Pencil</option>\
								<option value="pencil-square">Pencil Square</option>\
								<option value="pencil-square-o">Pencil Square O</option>\
								<option value="phone">Phone</option>\
								<option value="phone-square">Phone Square</option>\
								<option value="photo">Photo</option>\
								<option value="picture-o">Picture O</option>\
								<option value="pie-chart">Pie Chart</option>\
								<option value="plane">Plane</option>\
								<option value="plug">Plug</option>\
								<option value="plus">Plus</option>\
								<option value="plus-circle">Plus Circle</option>\
								<option value="plus-square">Plus Square</option>\
								<option value="plus-square-o">Plus Square O</option>\
								<option value="power-off">Power Off</option>\
								<option value="print">Print</option>\
								<option value="puzzle-piece">Puzzle Piece</option>\
								<option value="qrcode">QR Code</option>\
								<option value="question">Question</option>\
								<option value="question-circle">Question Circle</option>\
								<option value="quote-left">Quote Left</option>\
								<option value="quote-right">Quote Right</option>\
								<option value="random">Random</option>\
								<option value="recycle">Recycle</option>\
								<option value="refresh">Refresh</option>\
								<option value="remove">Remove</option>\
								<option value="reorder">Reorder</option>\
								<option value="reply">Reply</option>\
								<option value="reply-all">Reply All</option>\
								<option value="retweet">Re Tweet</option>\
								<option value="road">Road</option>\
								<option value="rocket">Rocket</option>\
								<option value="rss">RSS</option>\
								<option value="rss-square">RSS Square</option>\
								<option value="search">Search</option>\
								<option value="search-minus">Search Minus</option>\
								<option value="search-plus">Search Plus</option>\
								<option value="send">Send</option>\
								<option value="send-o">Send O</option>\
								<option value="server">Server</option>\
								<option value="share">Share</option>\
								<option value="share-alt">Share ALT</option>\
								<option value="share-alt-square">Share ALT Square</option>\
								<option value="share-square">Share Square</option>\
								<option value="share-square-o">Share Square O</option>\
								<option value="shield">Shield</option>\
								<option value="ship">Ship</option>\
								<option value="shopping-cart">Shopping Cart</option>\
								<option value="sign-in">Sign In</option>\
								<option value="sign-out">Sign Out</option>\
								<option value="signal">Signal</option>\
								<option value="sitemap">Sitemap</option>\
								<option value="sliders">Sliders</option>\
								<option value="smile-o">Smile O</option>\
								<option value="soccer-ball-o">Soccer Ball O</option>\
								<option value="sort">Sort</option>\
								<option value="sort-alpha-asc">Sort Alpha Asc</option>\
								<option value="sort-alpha-desc">Sort Alpha Desc</option>\
								<option value="sort-amount-asc">Sort Amount Asc</option>\
								<option value="sort-amount-desc">Sort Amount Desc</option>\
								<option value="sort-asc">Sort Asc</option>\
								<option value="sort-desc">Sort Desc</option>\
								<option value="sort-down">Sort Down</option>\
								<option value="sort-numeric-asc">Sort Numeric Asc</option>\
								<option value="sort-numeric-desc">Sort Numeric Desc</option>\
								<option value="sort-up">Sort Up</option>\
								<option value="space-shuttle">Space Shuttle</option>\
								<option value="spinner">Spinner</option>\
								<option value="spoon">Spoon</option>\
								<option value="square">Square</option>\
								<option value="square-o">Square O</option>\
								<option value="star">Star</option>\
								<option value="star-half">Star Half</option>\
								<option value="star-half-empty">Star Half Empty</option>\
								<option value="star-half-full">Star Half Full</option>\
								<option value="star-half-o">Star Half O</option>\
								<option value="star-o">Star O</option>\
								<option value="street-view">Street View</option>\
								<option value="suitcase">Suitcase</option>\
								<option value="sun-o">Sun O</option>\
								<option value="support">Support</option>\
								<option value="tablet">Tablet</option>\
								<option value="tachometer">Tachometer</option>\
								<option value="tag">Tag</option>\
								<option value="tags">Tags</option>\
								<option value="tasks">Tasks</option>\
								<option value="taxi">Taxi</option>\
								<option value="terminal">Terminal</option>\
								<option value="thumb-tack">Thumb Tack</option>\
								<option value="thumb-down">Thumb Down</option>\
								<option value="thumb-o-down">Thumb O Down</option>\
								<option value="thumb-o-up">Thumb Down Up</option>\
								<option value="ticket">Ticket</option>\
								<option value="times">Times</option>\
								<option value="times-circle">Times Circle</option>\
								<option value="times-circle-o">Times Circle O</option>\
								<option value="tint">Tint</option>\
								<option value="toggle-down">Toggle Down</option>\
								<option value="toggle-left">Toggle left</option>\
								<option value="toggle-off">Toggle Off</option>\
								<option value="toggle-on">Toggle On</option>\
								<option value="toggle-right">Toggle Right</option>\
								<option value="toggle-up">Toggle Up</option>\
								<option value="trash">Trash</option>\
								<option value="trash-o">Trash O</option>\
								<option value="tree">Tree</option>\
								<option value="trophy">Trophy</option>\
								<option value="truck">Truck</option>\
								<option value="tty">TTY</option>\
								<option value="umbrella">Umbrella</option>\
								<option value="university">University</option>\
								<option value="unlock">Unlock</option>\
								<option value="unlock-alt">Unlock ALT</option>\
								<option value="unsorted">Unsorted</option>\
								<option value="upload">Upload</option>\
								<option value="user">User</option>\
								<option value="user-plus">User Plus</option>\
								<option value="user-secret">User Secret</option>\
								<option value="user-times">User Times</option>\
								<option value="users">Users</option>\
								<option value="video-camera">Video Camera</option>\
								<option value="volume-down">Volume Down</option>\
								<option value="volume-off">Volume Off</option>\
								<option value="volume-up">Volume Up</option>\
								<option value="warning">Warning</option>\
								<option value="wheelchair">Wheelchair</option>\
								<option value="wifi">Wifi</option>\
								<option value="wrench">Wrench</option>\
							</select>\
						</td>\
					</tr>\
				';
			});
			
			html += '\
							</tbody>\
						</table>\
					</div>\
				</div>\
			';
			
			
			
			BootstrapDialog.show({
				title: 'Apply Styles',
				message: '\
					<div class="panel panel-default">\
							'+html+'\
					</div>\
				',
				buttons: [{
					label: 'Save and Continue',
					icon: 'fa fa-check',
					cssClass: 'btn-primary',
					action: function(dialog) {
						distinctStylings = [];
						
						$('#styleList').find('tr').each(function(index, tr) {
							var tds = $(this).find('td');
							distinctStylings.push(new Array($.trim($(tds[0]).text()), '{"icon":"'+$($(tds[2]).find('select')[0]).val()+'","prefix":"fa","markerColor":"'+$($(tds[1]).find('select')[0]).val()+'"}'));
						});
						
						$('#shapeStyling').val(JSON.stringify(distinctStylings));
						
						dialog.close();
						applyFilter();
					}
				}, {
					label: 'Skip and Continue',
					icon: 'fa fa-share',
					cssClass: 'btn-info',
					action: function(dialog) {
						//$('input[name=stylingColumn]').val('');
						
						applyFilter();
						dialog.close();
					}
				}, {
					label: 'Cancle',
					icon: 'fa fa-remove',
					cssClass: '',
					action: function(dialog) {
						dialog.close();
					}
				}]
			});
			
			setTimeout(function(){
				$('#styleList').find('tr').each(function(index, tr) {
					var tds = $(this).find('td');
					
					idx = getIndexByDistinctValue($.trim($(tds[0]).text()));
					if(idx != -1) {
						var json = JSON.parse(distinctStylings[idx][1]);
						$($(tds[2]).find('select')[0]).val(json.icon);
						$($(tds[1]).find('select')[0]).val(json.markerColor);
					}
				});
			}, 200);
		}
		
		function getIndexByDistinctValue (str) {
			var index = -1;
			$.each(distinctStylings, function(key, value){
				if(value[0] == str) {
					index = key
					return false;
				}
			});
			
			return index;
		}
	</script>
	
	
	<script>
		var filteredColumns = [];
		
		/* Apply Filter Part Start */
		function applyFilter() {
			var header = getHeader();
			
			var fc = JSON.parse($('#filteredColumns').val());
			var html = '';
			$.each(header, function(key, value) {
				value = value.replace(/"/g, '');
				html += '<option value="'+value+'" '+((fc[0] == value)?"selected":"")+'>'+value+'</option>';
			});
			
			BootstrapDialog.show({
				title: 'Select Columns to Apply Filter',
				message: '\
					<div id="selectColumnNamesToApplyFilter">\
						<div class="panel panel-default">\
							<select class="form-control" name="fields">\
								'+html+'\
							</select>\
						</div>\
					</div>\
				',
				buttons: [{
					label: 'Save and Continue',
					icon: 'fa fa-check',
					cssClass: 'btn-primary',
					action: function(dialog) {
						// TODO
						if(validateFilteredValues()) {
							$('input[name=filteredColumns]').val(JSON.stringify(filteredColumns));
							
							dialog.close();
							//$('#save').closest('form').submit();
						}
					}
				}, {
					label: 'Skip',
					icon: 'fa fa-share',
					cssClass: 'btn-info',
					action: function(dialog) {
						$('input[name=filteredColumns]').val('');
						
						dialog.close();
						//$('#save').closest('form').submit();
					}
				}, {
					label: 'Cancle',
					icon: 'fa fa-remove',
					cssClass: '',
					action: function(dialog) {
						dialog.close();
					}
				}]
			});
			
			setTimeout(function(){
				//$('.chosen-select').chosen();
			}, 200);
		}
		
		function validateFilteredValues() {
			var columns = $('select[name=fields]').val();
			var retVal  = true;
			filteredColumns = [];
			
			filteredColumns.push(columns);
			/*
			if(!columns || columns.length == 0) {
				Alert("Please Select atleast one Column", "danger");
				return !retVal;
			}
			
			$.each(columns, function(index, column){
				idx = getColumnIndex(column);
				if(idx == -1) {
					retVal = false
				}
				else {
					filteredColumns.push(column);
				}
			});
			
			if(!retVal) {
				Alert("Selected Columns not found", "warning");
			}
			*/
			return retVal;
		}
	</script>
	
	
	
	
	<script>
		$(document).ready(function(){
			$('#filteredColumns').val('<?=$map['filteredcolumns']?>');
			
			distinctStylings = JSON.parse('<?=str_replace('\"', '\\\"', $map['shapestyling'])?>');
			$('#shapeStyling').val(JSON.stringify(distinctStylings));
		});
	</script>
</body>
</html>