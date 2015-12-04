<html>
	<head>
		<link rel="stylesheet" href="[#BASEURL#]app/css/app.css" />
		<link rel="stylesheet" href="[#BASEURL#]app/map/leaflet/dist/leaflet.awesome-markers.css" />
		<link rel="stylesheet" href="[#BASEURL#]app/map/leaflet/dist/leaflet.css" />
		<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" />
		
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
		<script src="[#BASEURL#]app/map/leaflet/dist/leaflet.js"></script>
		<script src="[#BASEURL#]app/map/leaflet/dist/leaflet.awesome-markers.js"></script>
		
		<script src='[#CDNURL#]Leaflet.fullscreen.min.js'></script>
		<link href='[#CDNURL#]leaflet.fullscreen.css' rel='stylesheet' />
		
		<script src='[#CDNURL#]L.Control.Locate.js'></script>
		<link href='[#CDNURL#]L.Control.Locate.css' rel='stylesheet' />
		<!--[if lt IE 9]>
		  <link href='[#CDNURL#]L.Control.Locate.ie.css' rel='stylesheet' />
		<![endif]-->
		
		<link href='[#CDNURL#]leaflet.draw.css' rel='stylesheet' />
		<script src='[#CDNURL#]leaflet.draw.js'></script>
		
		<script src='[#CDNURL#]leaflet.markercluster.js'></script>
		<link href='[#CDNURL#]MarkerCluster.css' rel='stylesheet' />
		<link href='[#CDNURL#]MarkerCluster.Default.css' rel='stylesheet' />
		
		<script src='[#CDNURL#]Leaflet.Search.js'></script>
		<script src='[#CDNURL#]ExportControl.js'></script>
		
		<script src='[#CDNURL#]Leaflet.StaticSidebar.js'></script>
		
		<link href="[#CDNURL#]leaflet.measurecontrol.css" rel="stylesheet">
		<script src='[#CDNURL#]leaflet.measurecontrol.js'></script>
		
		<link href="[#CDNURL#]Control.MiniMap.css" rel="stylesheet">
		<script src='[#CDNURL#]Control.MiniMap.js'></script>
		
		<script src='[#CDNURL#]leaflet.filelayer.js'></script>
		
		<script src='[#CDNURL#]permalink.js'></script>
		
		<link  href="[#CDNURL#]timepicker/bootstrap-combined.custom.min.css" rel="stylesheet" type="text/css" />
		<link  href="[#CDNURL#]timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
		<script src='[#CDNURL#]timepicker/bootstrap-timepicker.js'></script>
		<link  href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />
		<script src='https://code.jquery.com/ui/1.10.3/jquery-ui.min.js'></script>
		<script src='[#CDNURL#]LeafletPlayback.js'></script>
		<script src='[#CDNURL#]L.Control.Playback.js'></script>
		
		<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.2/js/bootstrap-dialog.js'></script>
		<link href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.2/css/bootstrap-dialog.css' rel='stylesheet' />

		<script src="[#CDNURL#]d3.v3.min.js" type="text/javascript"></script>
		
		<link rel="stylesheet" href="[#CDNURL#]global-custom.css" />
		<script>
			function Alert(message, type) {
				title = ""
				if(!message)
					message = "";
				switch(type) {
					case "default":
						type = BootstrapDialog.TYPE_DEFAULT;
						title = "Information!";
						break;
					case "info":
						type = BootstrapDialog.TYPE_INFO;
						title = "Information!";
						break;
					case "primary":
						type = BootstrapDialog.TYPE_PRIMARY;
						title = "Information!";
						break;
					case "success":
						type = BootstrapDialog.TYPE_SUCCESS;
						title = "Success!";
						break;
					case "warning":
						type = BootstrapDialog.TYPE_WARNING;
						title = "Warning!";
						break;
					case "danger":
					case "error":
						type = BootstrapDialog.TYPE_DANGER;
						title = "Error!";
						break;
					default :
						type = BootstrapDialog.TYPE_DEFAULT;
						title = "Information!";
				}
				bd = BootstrapDialog.alert(message);
				bd.setType(type);
				bd.setTitle(title);
			}
		</script>
		
		<style>
			.btnButtonStyle.btn-sm {
				padding: 6px 8px;
			}
			.modal-backdrop.fade.in {
				z-index: 1024;
			}
			a#aboutTrigger {
				top: 15px;
			}
			#about2 {
				top: 10px;
			}
			.leaflet-control-playback .navbar-inner .pull-right .ctrl #load-tracks-btn {
				display: none;
			}
			
			.loader {
				width: [#WIDTH#][#WIDTH_UNIT#];
				height: [#HEIGHT#][#HEIGHT_UNIT#];
				position: absolute;
				z-index: 1001;
				background-color: rgba(226, 226, 226, 0.87);
			}
		</style>
	</head>
	<body>
		<div id="map_canvas" style="height: [#HEIGHT#][#HEIGHT_UNIT#]; width:[#WIDTH#][#WIDTH_UNIT#];">
			<!-- Loader Start -->
			<div class="loader">
				<div class="loader-container">
					<i class="fa fa-spinner fa-spin" style="font-size: 100px;"></i>
					<p>Loading Map...</p>
				</div>
			</div>
			<script>
				var size = 140; //loader size
				$('.loader .loader-container').css("margin-top", ([#HEIGHT#]/2) - size/2)
						   .css("margin-left", ([#WIDTH#]/2) - size/2);
				$(document).ready(function() {
					setTimeout(function() {$('.loader').hide();}, 1000);
				});
			</script>
			<!-- Loader End -->
		</div>
		
		<div style="display:none;" id="textarea_overlay_content">[#OVERLAY_CONTENT#]</div>
		<div style="display:none;" id="textarea_legend_content">[#LEGEND_CONTENT#]</div>
		<textarea style="display:none;" id="textarea_image_overlays">[#IMAGE_OVERLAYS#]</textarea>
		<div style="display:none;" id="textarea_static_sidebar_content">[#STATIC_SIDEBAR_CONTENT#]</div>
		
		<div class="overlay_container">
			<div id="about2">
				<div id="tabsAbout"></div>
				<a id="closeAbout" class="ui-dialog-titlebar-close ui-corner-all" href="#" role="button" style="position:absolute;top:18px;right:18px;width:20px;height:20px; color:#FFF;">
					<i class="fa fa-remove"></i>
				</a>
			</div>
			<a id="aboutTrigger" class="" href="#">
				<span style="font-weight:bold; font-size: 13px;"></span><br />
				<span class="aboutBlurb"></span>
			</a>
		</div>
		
		<!--<div class="mapfa-modaldialog">
			<div class="mapfa-modal mapfa-fade" id="mapfa-myModal" tabindex="-1" role="dialog" aria-labelledby="mapfa-myModalLabel" aria-hidden="false" style="display: none;">
				<div class="mapfa-modal-backdrop mapfa-fade mapfa-in" style="height: 100%;"></div>
				<div class="mapfa-modal-dialog">
					<div class="mapfa-modal-content">
						<div class="mapfa-modal-body"></div>
						<div class="mapfa-modal-footer">
							<button class="mapfa-button mapfa-btn mapfa-btn-default" onClick="mapClosePopup()">Close</button>
						</div>
					</div>
				</div>
			</div>
		</div>-->
		<div class="bubble static bound selected" id="static-popup" style="display: none;">
			<a name="close" class="close" id="static-popup-close" onClick="mapClosePopup();"><i class="fa fa-close"></i></a>
			<div class="content body" rv-html="record:body" rv-show="record:body" id="static-popup-content"></div>
		</div>
	</body>
	<script>
		var set_marker      = [#SET_MARKER#];
		var show_sidebar    = [#SHOW_SIDEBAR#];
		var buttonStyle     = "[#BUTTON_STYLE#]";
		
		var isOverlayEnable = [#OVERLAY_ENABLE#];
		var overlayTitle    = "[#OVERLAY_TITLE#]";
		var overlayBlurb    = "[#OVERLAY_BLURB#]";
		var overlayContent  = $("#textarea_overlay_content").text();
		
		var isLegendEnable  = [#LEGEND_ENABLE#];
		var legendContent   = $("#textarea_legend_content").text();
		
		var isShowExport    = [#SHOW_EXPORT#];
		var isShowMeasure   = [#SHOW_MEASURE#];
		var isShowMiniMap   = [#SHOW_MINIMAP#];
		var isShowSearch    = [#SHOW_SEARCH#];
		var isShowFileLayer = [#SHOW_FILELAYER#];
		var isShowPlayBack  = [#SHOW_PLAYBACK#];
		
		var isShowSVG       = [#SHOW_SVG#];
		var globalSVG       = null;
		
		var isShowStaticSidebar  = [#SHOW_STATIC_SIDEBAR#];
		var staticSidebarContent = $("#textarea_static_sidebar_content").html();
		
		var GPXTracks       = [#GPX_TRACKS#];
		
		var MapBounds       = [#MAP_BOUNDS#];
		
		var imageOverlays   = JSON.parse($("#textarea_image_overlays").val());
		var imageOverlaysLayers = [];
		var imageOverlaysPopups = [];
		var globalTempI = 0;
		
		var filteredColumns = JSON.parse('[#FILTERED_COLUMNS#]');
		
		var buttonSize = 'sm';
		
		var isClusterGroup = [#CLUSTER#];
		var featureGroup  = (isClusterGroup && !isShowSVG)? new L.MarkerClusterGroup() : new L.FeatureGroup();
		
		var mbAttribution = ' contributors | <a href="https://www.[#MAIN_DOMAIN#]" target="_blank">[#SITE_NAME_FORMATED#]</a>';
		var defaultLayer = [#DEFAULT_LAYER#];
		var defaultLayerMiniMap = [#DEFAULT_LAYER#];
		
		var globalJSON = [#JSON_STRING#];
		var markerLayers = new Array();
		
		var map_scale = L.control.scale({position:'bottomleft', maxWidth: 100, metric: true, imperial: true, updateWhenIdle: false});
		
		var map;
		
		var baseLayers = {
			[#BASE_LAYERS_ARRAY#]
		};
		
		var overlays = {
			"Map Points": featureGroup
		};
		
		var layerSelector = L.control.layers(baseLayers, overlays);
		
		map = new L.Map("map_canvas", { dragging: true, touchZoom: true, scrollWheelZoom: true, doubleClickZoom: true, boxzoom: true, trackResize: true, worldCopyJump: false, closePopupOnClick: true, keyboard: true, keyboardPanOffset: 80, keyboardZoomOffset: 1, inertia: true, inertiaDeceleration: 3000, inertiaMaxSpeed: 1500, zoomControl: true, crs: L.CRS.EPSG3857, fullscreenControl: true, layers: [defaultLayer, featureGroup] });
		map.setView([[#LAT#], [#LNG#]], [#ZOOM#]);

		function onEachFeature(feature, layer) {
			var prop  = feature.properties;
			var style = prop.style;
			var cons  = prop.constants;
			
			renderShape(feature, layer);
		}
		
		L.control.locate({
			position: 'bottomright', 
			drawCircle: true,
			follow: true,
			setView: true,
			keepCurrentZoomLevel: true,
			remainActive: false,
			circleStyle: {},
			markerStyle: {},
			followCircleStyle: {},
			followMarkerStyle: {},
			icon: 'icon-cross-hairs',
			circlePadding: [0,0],
			metric: true,
			showPopup: true,
			strings: {
				title: 'I am Here',
				popup: 'You are within {distance} {unit} from this point',
				outsideMapBoundsMsg: 'You seem located outside the boundaries of the map'
			},
			locateOptions: { watch: true }
		}).addTo(map);
		map.addControl(L.control.search());
		map.addControl(new L.Control.Permalink());
		//map_scale.addTo(map);
		if(isShowExport) {
			map.addControl(L.exportControl({ codeid: 'app/processor/map-export/index.php', position: 'topleft', endpoint: '[#BASEURL#]', getFormatFrom: 'app/processor/map-export-format/index.php', mapid: [#MAP_ID#] }));
		}
		new L.Control.MiniMap(defaultLayerMiniMap, {toggleDisplay: true}).addTo(map)._minimize(true);
		
		// Add FileLayer Control
		var style = { color: 'yellow', opacity: 1.0, fillOpacity: 0.3, weight: 4, clickable: false };
		L.Control.FileLayerLoad.LABEL = '<i class="fa fa-folder-open"></i>';
		L.Control.fileLayerLoad({
			fitBounds: true,
			layerOptions: {
				style: style,
				pointToLayer: function (data, latlng) {
					return L.marker(latlng, {
						icon: propIcon
					})
				}
			}
		}).addTo(map);
		
		var playbackOptions = {        
			// layer and marker options
			layer: {
				pointToLayer : function(featureData, latlng){
					var result = {};
					
					if (featureData && featureData.properties && featureData.properties.path_options){
						result = featureData.properties.path_options;
					}
					
					if (!result.radius){
						result.radius = 5;
					}
					
					return new L.CircleMarker(latlng, result);
				}
			},
			marker: function(){
				return {};
			}        
		};
		
		// Initialize custom control
		tTracks = [];
		$.each(GPXTracks, function(k, v) {
			tTracks.push(v.value);
		});
		var pbControl = new L.Playback(map, tTracks, null, playbackOptions);
		var trackControl = new L.Playback.Control(pbControl);
		map.addControl(trackControl);
		
		
		$('.leaflet-top.leaflet-left').append(
			'<div id="sidebarhideshow" class="leaflet-control-sidebar leaflet-bar leaflet-control" style="z-index:11;">' +
				'<a class="leaflet-control-sidebar-button leaflet-bar-part sidebar-buttons" id="sidebar-button-reorder" href="#" onClick="return false;" title="Sidebar Toggle"><i class="fa fa-reorder"></i></a>' +
				'<div id="sidebar-buttons" style="max-height: 300px; overflow: auto;">' +
					'<ul class="list-unstyled leaflet-sidebar">' +
						
					'</ul>' +
				'</div>' +
			'</div>'
		);
		
		if(filteredColumns.length && filteredColumns.length > 0) {
			$('.leaflet-top.leaflet-left').append(
				'<div id="sidefilterhideshow" class="leaflet-control-sidefilter leaflet-bar leaflet-control" style="z-index:10;">' +
					'<a class="leaflet-control-sidefilter-button leaflet-bar-part sidefilter-buttons" id="sidefilter-button-reorder" style="padding-top: 7px;" href="#" onClick="return false;" title="Filter Bar Toggle"><i class="fa fa-filter"></i></a>' +
					'<div id="sidefilter-buttons" style="max-height: 300px; overflow: auto;">' +
						'<ul class="list-unstyled leaflet-sidefilter">' +
							
						'</ul>' +
					'</div>' +
				'</div>'
			);
		}
		
		featureGroup.addTo(map);
		
		function changeAddressCheckbox(obj){
			var layers = getLayers();
			index = $(obj).parent().index();
			
			if($(obj).is(':checked')) {
				featureGroup.addLayer(layers[index]);
				if(set_marker){
					setTimeout(function(){
						if(layers.length ==1){
							layers[index].fire('click');
							openPopup(layers[index]);
						}
					}, 1000);
				}
			}
			else {
				featureGroup.removeLayer(layers[index]);
			}
		}
		
		function filterAction(obj) {
			var layers = getLayers();
			text = $.trim($(obj).parent().text());
			
			$.each(layers, function(index, layer) {
				props = getPropertiesByLayer(layer);
				
				$.each(props, function(idx, prop) {
					if(prop.name == filteredColumns[0] && prop.value == text) {
						if($(obj).is(':checked')) {
							featureGroup.addLayer(layer);
						}
						else {
							featureGroup.removeLayer(layer);
						}
					}
				});
			});
		}
		
		function clickOnSidebarAddress(obj){
			var layers = getLayers();
			index = $(obj).parent().index();
			setTimeout(function(){
				layers[index].openPopup();
				openPopup(layers[index]);
			}, 50);
		}
		
		var animating = false;
		
		$(document).ready(function(){
			setTimeout(function(){
				$('#sidebar-button-reorder').click(function(){
					if(animating) return;
					
					var element = $('#sidebar-buttons');
					animating = true;
					
					if(element.css('left') == '-50px') {
						element.show();
						element.animate( {opacity: '1', left: '0px'}, 400, function(){ animating = false; } );
					}
					else {
						element.animate( {opacity: '0', left: '-50px'}, 400, function(){ animating = false; element.hide(); } );
					}
				});
				
				$('#sidefilter-button-reorder').click(function(){
					if(animating) return;
					
					var element = $('#sidefilter-buttons');
					animating = true;
					
					if(element.css('left') == '-50px') {
						element.show();
						element.animate( {opacity: '1', left: '0px'}, 400, function(){ animating = false; } );
					}
					else {
						element.animate( {opacity: '0', left: '-50px'}, 400, function(){ animating = false; element.hide(); } );
					}
				});
			}, 200);
		});
		
		$(document).ready(function(){
			if(!show_sidebar){
				$('#sidebarhideshow').hide();
			}
			
			$('.leaflet-control-minimap .leaflet-control-sidebar, .leaflet-control-minimap #sidefilterhideshow').remove();
			
			layerSelector.addTo(map);
			map.addControl(L.Control.measureControl({position:'topright'}));
			
			loadSVG(globalJSON);
			loadJson(globalJSON);
			updateMap();
		});
		
		function updateMap() {
			var layers = getLayers();
			
			renderSideBar();
			renderSideFilter();
			
			if(layers.length == 1){
				if(set_marker) {  // set marker to popup
					layers[0].fire('click');
				}
			}
			
			$('.btnButtonStyle').removeClass('btn-success btn-danger btn-info btn-default btn-warning btn-primary').addClass('btn-'+buttonStyle);
			$('.bgButtonStyle').removeClass('bg-success bg-danger bg-info bg-default bg-warning bg-primary').addClass('bg-'+buttonStyle);
			
			setTimeout(function(){
				overlayUpdate();
				legendUpdate();
				imageOverlaysUpdate();
				
				showExportUpdate();
				showMeasureUpdate();
				showMiniMapUpdate();
				showSearchUpdate();
				showFileLayerUpdate();
				showStaticSidebarUpdate();
				staticSidebarContentUpdate();
				staticSidebarPopupResize();
				showPlayBackUpdate();
				showSVGUpdate();
				
				updateMapBounds();
			}, 200);
		}
		
		function updateMapBounds() {
			if(MapBounds.length == 2) {
				var southWest = L.latLng(MapBounds[0][0], MapBounds[0][1]),
					northEast = L.latLng(MapBounds[1][0], MapBounds[1][1]),
					bounds = L.latLngBounds(southWest, northEast);
				
				map.setMaxBounds(bounds);
			}
			else {
				MapBounds = new Array();
				map.setMaxBounds(null);
			}
		}
		
		function overlayUpdate() {
			if(isOverlayEnable) {
				$('#aboutTrigger').show();
			}
			else {
				$('#aboutTrigger').hide();
			}
			
			$('#aboutTrigger span').text(overlayTitle);
			$('#aboutTrigger .aboutBlurb').html(overlayBlurb);
			$('#about2 #tabsAbout').html($('<textarea/>').html(overlayContent).val());
		}
		function legendUpdate() {
			if(isLegendEnable) {
				$('#trgrLegend').show();
			}
			else {
				$('#trgrLegend, #pnlLegend').hide();
			}
			
			$('#layerSelector').html($('<textarea/>').html(legendContent).val());
		}
		function imageOverlaysUpdate() {
			$.each(imageOverlays, function(key, value) {
				var imageUrl = value.src;
				var pcon = value.popupcontent;
				// This is the trickiest part - you'll need accurate coordinates for the
				// corners of the image. You can find and create appropriate values at
				// http://maps.nypl.org/warper/ or
				// http://www.georeferencer.org/
				imageBounds = L.latLngBounds(JSON.parse(value.bounds));
				
				// See full documentation for the ImageOverlay type:
				// http://leafletjs.com/reference.html#imageoverlay
				var overlay = L.imageOverlay(imageUrl, imageBounds)
					.addTo(map);
				
				var popup = L.popup().setContent(pcon);
				popup.setLatLng([imageBounds.getCenter().lat,imageBounds.getCenter().lng]);
				imageOverlaysPopups.push(popup);
				
				L.DomEvent.on(overlay._image, 'click', function(e) {
					globalTempI = 0;
					var dis = this;
					$.each(imageOverlaysLayers, function(k, v) {
						if(dis == v._image) {
							setTimeout(function(){
								imageOverlaysPopups[globalTempI].addTo(map);
							}, 100);
							return false;
						}
						globalTempI++;
					});
				});
				
				imageOverlaysLayers.push(overlay);
			});
		}
		
		function showExportUpdate() {
			if(isShowExport){
				$('.leaflet-control-export').show();
			}
			else {
				$('.leaflet-control-export').hide();
			}
		}
		
		function showMeasureUpdate() {
			if(isShowMeasure){
				$('.leaflet-control-draw-measure').show();
			}
			else {
				$('.leaflet-control-draw-measure').hide();
			}
		}
		
		function showMiniMapUpdate() {
			if(isShowMiniMap){
				$('.leaflet-control-minimap').show();
			}
			else {
				$('.leaflet-control-minimap').hide();
			}
		}
		
		function showSearchUpdate() {
			if(isShowSearch){
				$('.leaflet-control-search').show();
			}
			else {
				$('.leaflet-control-search').hide();
			}
		}
		
		function showFileLayerUpdate() {
			if(isShowFileLayer){
				$('.leaflet-control-filelayer').show();
			}
			else {
				$('.leaflet-control-filelayer').hide();
			}
		}
		
		function showStaticSidebarUpdate() {
			m_width = $("#map_canvas").width();
			width = (m_width/2)-40;
			m_height = $("#map_canvas").height();
			height = m_height-80;
			
			$('.exhibit').css("width",width+"px").css("height","100%");
			
			if(isShowStaticSidebar){
				$('#exhibit_slider_button, .exhibit').show();
			}
			else {
				$('#exhibit_slider_button, .exhibit').hide();
				
				$('#exhibit_slider_button_icon').removeClass('fa-arrow-right fa-arrow-left').addClass('fa-arrow-left');
				$('.exhibit').animate( {right: -$('.exhibit').width()-40-2}, 400);
				$('.leaflet-bottom.leaflet-right, .leaflet-top.leaflet-right, #pnlLegend, #trgrLegend').animate( {right: 0}, 400);
				$('#exhibit_slider_button').animate( {right: -3}, 400);
			}
		}
		
		function staticSidebarContentUpdate() {
			$(".exhibit #neatline").html($('<textarea/>').html(staticSidebarContent).val());
			$('input[name=static_sidebar_content]').val($(".exhibit #neatline").html());
		}
		
		function staticSidebarPopupResize() {
			m_height = $("#map_canvas").height();
			height = m_height-40;
			
			$('#static-popup').css('max-height',height).css('min-width',250);
		}
		
		function showPlayBackUpdate(update) {
			if(update) {
				pbControl.destroy();
				
				$.each(GPXTracks, function(k, v) {
					pbControl.addData(v.value);
				});
			}
			
			if(isShowPlayBack){
				$('.leaflet-control-playback, .leaflet-control-layers.leaflet-control-layers-expanded').show();
			}
			else {
				pbControl.destroy();
				GPXTracks = [];
				$('.leaflet-control-playback, .leaflet-control-layers.leaflet-control-layers-expanded').hide();
			}
		}
		
		function showSVGUpdate() {
			if(globalSVG) {
				if(isShowSVG) {
					$.each(globalSVG, function(i, v) {
						$(v).show();
					});
				}
				else {
					$.each(globalSVG, function(i, v) {
						$(v).hide();
					});
				}
			}
		}
		
		function loadJson(json) {
			L.geoJson(json, {
				onEachFeature: onEachFeature
			});
		}
		
		function mapClosePopup() {
			//$('#mapfa-myModal').removeClass('mapfa-in').fadeOut(0);
			$('#static-popup').fadeOut();
		}
		function mapOpenPopup(layer) {
			popupContent = getPopupContent(layer)
			$('#static-popup-content').html(popupContent);
			$('#static-popup').fadeIn();
			
			//$('.mapfa-modal-body').html(popupContent);
			//$('#mapfa-myModal').addClass('mapfa-in').fadeIn(0);
			//mapPopupCentralized();
		}
		
		function mapPopupCentralized(){
			width  = $(window).width();
			
			w = 600;
			margin_left = (width-w)/2;
			$dialog = $('.mapfa-modal-dialog');
			$dialog.css('margin-top',150)
				   .css('width',w)
				   .css('margin-left',margin_left);
		}
		
		var layerProperties             = new Array(); // global variable to keep properties in the form of key pair value 
		var shapeStyles                 = new Array();
		var shapeCustomProperties       = new Array();
		
		function renderSideBar() {
			if(show_sidebar)
				$('#sidebarhideshow').show();
			else {
				$('#sidebarhideshow').hide();
			}
			target = $('#sidebar-buttons ul.leaflet-sidebar');
			target.html('');
			$.each(layerProperties, function(key, value){
				lable = "";
				properties = value[1];
				if(properties && properties.length>0) {
					for(j=0;j<properties.length; j++) {
						if(properties[j].defaultProperty) {
							lable = properties[j].value;
						}
					}
				}
				if(lable == "") {
					lable = "No Location";
				}
				target.append('<li><input type="checkbox" onClick="changeAddressCheckbox(this)" checked><a onClick="clickOnSidebarAddress(this)">'+ lable +'</a><div class="clear"></div></li>');
			});
		}
		
		function renderSideFilter(level) {
			if(!level) {
				level = 0;
			}
			
			if(filteredColumns.length > 0) {
				target = $('#sidefilter-buttons ul.leaflet-sidefilter');
				target.html('');
				
				filterTemp = [];
				
				$.each(layerProperties, function(key, value){
					properties = value[1];
					
					if(properties && properties.length>0) {
						for(j=0;j<properties.length; j++) {
							if(properties[j].name == filteredColumns[level] && $.inArray(properties[j].value, filterTemp) == -1) {
								filterTemp.push(properties[j].value);
							}
						}
					}
				});
				
				$.each(filterTemp, function(index, value){
					target.append('<li><input type="checkbox" onClick="filterAction(this)" checked><a>'+ value +'</a><div class="clear"></div></li>');
				});
			}
			else {
				$('#sidefilterhideshow').hide();
			}
		}
		
		function getPropertiesByLayer(layer) {
			for(i=0; i<layerProperties.length; i++) {
				if(layerProperties[i][0] == layer) {
					return layerProperties[i][1];
				}
			}
			return {};
		}
		
		function getCustomPropertiesByLayer(layer) {
			for(i=0; i<layerProperties.length; i++) {
				if(layerProperties[i][0] == layer) {
					return shapeCustomProperties[i];
				}
			}
			return {};
		}
		
		function getLayerIndex(layer) {
			for(i=0; i<layerProperties.length; i++) {
				if(layerProperties[i][0] == layer) {
					return i;
				}
			}
		}
		
		function getLayers() {
			layers = new Array();
			for(i=0; i<layerProperties.length; i++) {
				layers.push(layerProperties[i][0]);
			}
			return layers;
		}
		
		function renderShape(feature, layer) { // From DB
			var style = feature.style;
			var cp    = feature.customProperties;
			var properties = new Array();
			
			if(style) {
				if(layer instanceof L.Marker) {
					if(style.markerColor) {
						layer.setIcon(L.AwesomeMarkers.icon(style));
					}
				}
				else {
					layer.setStyle(style);
				}
			}
			
			layer.addTo(featureGroup);
			layer.on("click", function(){
				if(isShowSVG) {
					map.closePopup();
					if(layer instanceof L.Marker) {
						map.panTo(layer.getLatLng());
					}
					else {
						map.fitBounds(new L.featureGroup([layer]).getBounds());
					}
					setTimeout(function() {
						openPopup(layer);
					}, 300);
				}
				else {
					openPopup(layer);
				}
			});
			
			feature.properties.forEach(function(obj){
				row = {};
				row['name']  = obj.name;
				row['value'] = obj.value;
				row['defaultProperty'] = obj.defaultProperty;
				properties.push(row);
			});
			
			layerProperties.push(new Array(layer, properties));
			shapeStyles.push(style); //styles is JSON Object
			shapeCustomProperties.push(cp);
			
			renderSideBar();
			renderSideFilter();
			bindPopup(layer);
		}
		
		function bindPopup(layer) {
			popupContent = getPopupContent(layer)
			layer.bindPopup(popupContent);
		}
		
		function getPopupContent(layer) {
			popupContent     = "";
			properties       = getPropertiesByLayer(layer);
			customProperties = getCustomPropertiesByLayer(layer);
			
			$.each(properties, function(index, property) {
				if(!customProperties.hide_label) {
					if(property.name != "Location") {
						popupContent += '<b>'+property.name+'</b> : ';
					}
				}
				if(customProperties.bootstrap_popup) {
					
				}
				if(customProperties.show_address_on_popup) {
					if(property.name == "Location") {
						popupContent += '<b class="title" id="static-popup-title">'+property.value+'</b><br/>';
						return true; // continue and skip next statements
					}
				}
				if(property.name != "Location") {
					popupContent += property.value+'<br/>';
				}
			});
			
			if(customProperties.get_direction) {
				$.each(properties, function(index, property) { // Find "Address" in properties
					if(property.name == "Location") {
						address = property.value;
						popupContent += '<a href="https://www.google.com/maps/dir//'+address+'" target="_blank">Get Directions</a>';
						return false; // break
					}
				});
			}
			
			return popupContent;
		}
		
		function openPopup(layer) {
			if(isShowSVG) {
				layer.openPopup();
			}
			mapClosePopup();
			index = getLayerIndex(layer);
			
			if(shapeCustomProperties[index].bootstrap_popup) {
				setTimeout(function(){
					map.closePopup();
					mapOpenPopup(layer);
				}, 50);
			}
		}
		$(document).ready(function(){
			$('.leaflet-control-layers form.leaflet-control-layers-list input[type=radio]').click(function(){
				map.removeLayer(defaultLayer);
			});
		});
	</script>
	
	<style>
		.pac-container {
			z-index: 1050!important;
		}
		.btn.btn-default, .bg.bg-default{
			background-color: #FFF!important;
		}
	</style>
	
	
	<script>
		$(document).ready(function(){
			/* Zoom Control Start */
			$control = $('.leaflet-control-zoom:not(.leaflet-control-filelayer)');
			$control.removeClass('leaflet-bar').addClass('bg bg-'+buttonStyle+' bgButtonStyle').css({'box-shadow': '0 1px 5px rgba(0, 0, 0, 0.65)','border-radius': '4px'});
			
			$control.find('a.leaflet-control-zoom-in').html('<i class="fa fa-plus"></i>');
			$control.find('a.leaflet-control-zoom-out').html('<i class="fa fa-minus"></i>');
			
			$control.find('a').removeClass('leaflet-control-zoom-in leaflet-control-zoom-out')
							  .addClass('btn btn-'+buttonStyle+' btnButtonStyle btn-'+buttonSize)
							  .css({'display':'block','text-indent':'0px','border-color':'none'});
			/* Zoom Control End */
			
			
			/* Locate Control Start */
			$control = $('.leaflet-control-locate');
			$control.removeClass('leaflet-bar').addClass('bg bg-'+buttonStyle+' bgButtonStyle').css({'box-shadow': '0 1px 5px rgba(0, 0, 0, 0.65)','border-radius': '4px'});
			
			$control.find('a.leaflet-bar-part').html('<i class="fa fa-location-arrow"></i>');
			
			$control.find('a').addClass('btn btn-'+buttonStyle+' btnButtonStyle btn-'+buttonSize)
							  .css({'display':'block','text-indent':'0px','background-image':'none'});
			/* Locate Control End */
			
			
			/* FullScreen Start */
			$control = $('.leaflet-control-fullscreen');
			$control.removeClass('leaflet-bar').addClass('bg bg-'+buttonStyle+' bgButtonStyle').css({'box-shadow': '0 1px 5px rgba(0, 0, 0, 0.65)','border-radius': '4px'});
			
			$control.find('a').addClass('btn btn-'+buttonStyle+' btnButtonStyle btn-'+buttonSize)
							  .css({'display':'block','text-indent':'0px','background-color':'inherit','width':'28px','height':'27px'});
			/* FullScreen Control End */
			
			
			/* Draw Control Start */
			$control = $('.leaflet-draw-toolbar');
			$control.removeClass('leaflet-bar').addClass('bg bg-'+buttonStyle+' bgButtonStyle').css({'box-shadow': '0 1px 5px rgba(0, 0, 0, 0.65)','border-radius': '4px','width':'52px'});
			
			$control.find('a').addClass('btn btn-'+buttonStyle+' btnButtonStyle btn-'+buttonSize)
							  .css({'display':'block','text-indent':'0px'});
			$control.find('a.leaflet-draw-draw-polyline').css({'background-position':'11px 7px', 'height':'39px','width':'52px'});
			$control.find('a.leaflet-draw-draw-polygon').css({'background-position':'-19px 7px','height':'39px','width':'52px'});
			$control.find('a.leaflet-draw-draw-rectangle').html('<i class="fa fa-square-o"></i>').css('background-image','none');
			$control.find('a.leaflet-draw-draw-circle').html('<i class="fa fa-circle-o"></i>').css('background-image','none');
			$control.find('a.leaflet-draw-draw-marker').html('<i class="fa fa-map-marker"></i>').css('background-image','none');
			$control.find('a.leaflet-draw-edit-edit').html('<i class="fa fa-edit"></i>').css('background-image','none');
			$control.find('a.leaflet-draw-edit-remove').html('<i class="fa fa-remove"></i>').css('background-image','none');
			
			$('.leaflet-draw-actions').css({'left':'52px','top':'5px'});
			/* Draw Control End */
			
			
			/* Layers Control Start */
			$control = $('.leaflet-control-layers');
			$control.addClass('bg bg-'+buttonStyle+' bgButtonStyle');
			
			$control.find('a').addClass('btn btn-'+buttonStyle+' btnButtonStyle btn-'+buttonSize);
			$control.find('#sidebar-buttons').addClass('bg bg-'+buttonStyle+' bgButtonStyle');
			/* Layers Control End */
			
			
			/* Sidebar Control Start */
			$control = $('.leaflet-control-sidebar');
			$control.removeClass('leaflet-bar').addClass('bg bg-'+buttonStyle+' bgButtonStyle').css({'box-shadow': '0 1px 5px rgba(0, 0, 0, 0.65)','border-radius': '4px'});
			
			$control.find('a.leaflet-control-sidebar-button').addClass('btn btn-'+buttonStyle+' btnButtonStyle btn-'+buttonSize)
							  .css({'display':'block','text-indent':'0px'});
			$control.find('#sidebar-buttons').addClass('bg bg-'+buttonStyle+' bgButtonStyle');
			/* Sidebar Control End */
			
			
			/* Sidefilter Control Start */
			$control = $('.leaflet-control-sidefilter');
			$control.removeClass('leaflet-bar').addClass('bg bg-'+buttonStyle+' bgButtonStyle').css({'box-shadow': '0 1px 5px rgba(0, 0, 0, 0.65)','border-radius': '4px'});
			
			$control.find('a.leaflet-control-sidefilter-button').addClass('btn btn-'+buttonStyle+' btnButtonStyle btn-'+buttonSize)
							  .css({'display':'block','text-indent':'0px'});
			$control.find('#sidefilter-buttons').addClass('bg bg-'+buttonStyle+' bgButtonStyle');
			/* Sidefilter Control End */
			
			
			/* Search Control Start */
			$control = $('.leaflet-control-search');
			$control.removeClass('leaflet-bar');
			
			$control.find('a').addClass('btn btn-'+buttonStyle+' btnButtonStyle btn-'+buttonSize)
							  .css({'display':'block','text-indent':'0px','box-shadow':'rgba(0, 0, 0, 0.65098) 0px 1px 5px','border-radius':'4px'});
			/* Search Control End */
			
			
			/* Export Control Start */
			$control = $('.leaflet-control-export');
			$control.removeClass('leaflet-bar');
			
			$($control.find("div")[1]).addClass('bg bg-'+buttonStyle+' bgButtonStyle');
			
			$($control.find("div")[0]).find('a').addClass('btn btn-'+buttonStyle+' btnButtonStyle btn-'+buttonSize)
							  .css({'display':'block','text-indent':'0px','box-shadow':'rgba(0, 0, 0, 0.65098) 0px 1px 5px','border-radius':'4px'});
			
			$($control.find("div")[1]).find('a').css('color','inherit');
			/* Export Control End */
			
			
			/* Measure Control Start */
			$control = $('.leaflet-control-draw-measure').parent();
			$control.removeClass('leaflet-bar');
			
			$control.find('a').html('<i class="fa fa-minus" style="opacity: 0;"></i>');
			$control.find('a').addClass('btn btn-'+buttonStyle+' btnButtonStyle btn-'+buttonSize)
							  .css({'display':'block','text-indent':'0px','box-shadow':'rgba(0, 0, 0, 0.65098) 0px 1px 5px','border-radius':'4px','background-position':'7px 7px','background-repeat':'no-repeat'});
			/* Measure Control End */
			
			
			/* FileLayer Control Start */
			$control = $('.leaflet-control-filelayer.leaflet-control-zoom');
			$control.removeClass('leaflet-bar');
			
			$control.find('a').addClass('btn btn-'+buttonStyle+' btnButtonStyle btn-'+buttonSize).removeClass('leaflet-control-zoom-in')
							  .css({'display':'block','text-indent':'0px','box-shadow':'rgba(0, 0, 0, 0.65098) 0px 1px 5px','border-radius':'4px','width':'29px'});
			/* FileLayer Control End */
		});
	</script>
	
	<script>
		$('#map_canvas').append('\
			<div class="overlay_container" style="z-index: 2; position: absolute; right: 0; left: 0; bottom: 10px;">\
				<div id="pnlLegend" class="panel" style="margin-bottom:0;">\
					<div id="layerSelector">\
						\
					</div>\
				</div>\
				<a id="trgrLegend" class="trigger" href="#">Legend</a>\
			</div>\
		');
		
		// Add exhibit
		map.addControl(L.control.staticsidebar());
		
		target = $('.leaflet-control-staticsidebar');
		target.appendTo('#map_canvas');
		target.removeClass('leaflet-control');
		
		
		$('.leaflet-bottom.leaflet-right, .leaflet-top.leaflet-right, #pnlLegend, #trgrLegend').css('right',($("#map_canvas").width()/2)-40);
		$('.exhibit').css('right',0);
		
		$('.exhibit .close, #exhibit_slider_button').click(function() {
			if($('.exhibit').css('right') == '0px') { //close the static sidebar
				$('#exhibit_slider_button_icon').removeClass('fa-arrow-right fa-arrow-left').addClass('fa-arrow-left');
				$('.exhibit').animate( {right: -$('.exhibit').width()-40-2}, 400);
				$('.leaflet-bottom.leaflet-right, .leaflet-top.leaflet-right, #pnlLegend, #trgrLegend').animate( {right: 0}, 400);
				$('#exhibit_slider_button').animate( {right: -3}, 400);
			}
			else {
				$('#exhibit_slider_button_icon').removeClass('fa-arrow-right fa-arrow-left').addClass('fa-arrow-right');
				$('.exhibit').animate( {right: 0}, 400);
				$('.leaflet-bottom.leaflet-right, .leaflet-top.leaflet-right, #pnlLegend, #trgrLegend').animate( {right: ($("#map_canvas").width()/2)-40}, 400);
				$('#exhibit_slider_button').animate( {right: ($("#map_canvas").width()/2)-40-3}, 400);
			}
		});
		
		var aboutDefaultSize={width:850,height:1000};
		$("#aboutTrigger").click(function(e){
			e.preventDefault();
			var width=(aboutDefaultSize.width>$(map._container).width()-200)?$(map._container).width()-200:aboutDefaultSize.width;
			var height=(aboutDefaultSize.height>$(map._container).height()-200)?$(map._container).height()-200:aboutDefaultSize.height;
			$("#about2").css({width:width,height:height});
			$("#about2").toggle("fast");
			$("#aboutTrigger").toggleClass("open");
		});
		
		$("#closeAbout").click(function(e){
			e.preventDefault();
			$("#about2").toggle("fast");
			$("#aboutTrigger").toggleClass("open");
		});
		
		$('#trgrLegend').click(function(){
			$('#pnlLegend').toggle('fast');
			$(this).toggleClass('active');
			return false;
		});
		
		
		
		
		
		
		
		
		
		
		
		function loadSVG(json) {
			var svgHeight = 0;
			var svgWidth  = 0;
			
			var svg = d3.select(map.getPanes().overlayPane).append("svg").on('click', function () {
				var coordinates = [0, 0];
				coordinates = d3.mouse(this);
				var x = coordinates[0];
				var y = coordinates[1];
				console.log(coordinates);
			}),
			g = svg.append("g").attr("class", "leaflet-zoom-hide");
			globalSVG = svg;
			
			var transform = d3.geo.transform({point: projectPoint});
			/*path = d3.geo.path().projection(transform);
			collection = JSON.parse(JSON.stringify(json));
			
			var centered;
			var feature =  g.selectAll("path")
							.data(collection.features)
							.enter()
							.append("path")
							.attr("d", path)
							.attr("class", "feature")
							.on("click", svgPathClicked);;
			
			map.on("viewreset", reset1);
			reset1();
			
			// Reposition the SVG to cover the features.
			function reset1() {
				var bounds = path.bounds(collection),
				topLeft = bounds[0],
				bottomRight = bounds[1];
				
				svgHeight = bottomRight[1] - topLeft[1];
				svgWidth  = bottomRight[0] - topLeft[0];
				
				svg.attr("width", svgWidth)
					.attr("height", svgHeight)
					.style("left", topLeft[0] + "px")
					.style("top", topLeft[1] + "px");
				
				g.attr("transform", "translate(" + -topLeft[0] + "," + -topLeft[1] + ")");
				
				feature.attr("d", path);
			}
			*/
			
			// Use Leaflet to implement a D3 geometric transformation.
			function projectPoint(x, y) {
				var point = map.latLngToLayerPoint(new L.LatLng(y, x));
				this.stream.point(point.x, point.y);
			}
			
			/*
			function svgPathClicked(d, I) {
				d.geometry.coordinates;
				if (d && centered !== d) {
					var centroid = path.centroid(d);
					x = centroid[0];
					y = centroid[1];
					k = 4;
					centered = d;
				} else {
					x = svgWidth;
					y = svgHeight;
					k = 1;
					centered = null;
				}
				
				
				temp = getLayers();
				setTimeout(function(){
					layers[I].openPopup();
					openPopup(layers[I]);
				}, 50);
			}
			*/	
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
			
			d3.json("[#BASEURL#]app/map-view-json.php?mapid=[#MAP_ID#]", function(collection) {
				// this is not needed right now, but for future we may need
				// to implement some filtering. This uses the d3 filter function
				// featuresdata is an array of point objects

				var featuresdata = collection.features.filter(function(d) {
					return d.properties.id == "route".toLowerCase();
				});
				
				if(featuresdata.length > 0) {
					//d3.geo.path translates GeoJSON to SVG path codes.
					//essentially a path generator. In this case it's
					// a path generator referencing our custom "projection"
					// which is the Leaflet method latLngToLayerPoint inside
					// our function called projectPoint
					var d3path = d3.geo.path().projection(transform);


					// Here we're creating a FUNCTION to generate a line
					// from input points. Since input points will be in 
					// Lat/Long they need to be converted to map units
					// with applyLatLngToLayer
					var toLine = d3.svg.line()
						.interpolate("linear")
						.x(function(d) {
							return applyLatLngToLayer(d).x
						})
						.y(function(d) {
							return applyLatLngToLayer(d).y
						});


					// From now on we are essentially appending our features to the
					// group element. We're adding a class with the line name
					// and we're making them invisible

					// these are the points that make up the path
					// they are unnecessary so I've make them
					// transparent for now
					var ptFeatures = g.selectAll("circle")
						.data(featuresdata)
						.enter()
						.append("circle")
						.attr("r", 3)
						.attr("class", "waypoints");

					// Here we will make the points into a single
					// line/path. Note that we surround the featuresdata
					// with [] to tell d3 to treat all the points as a
					// single line. For now these are basically points
					// but below we set the "d" attribute using the 
					// line creator function from above.
					var linePath = g.selectAll(".lineConnect")
						.data([featuresdata])
						.enter()
						.append("path")
						.attr("class", "lineConnect");

					// This will be our traveling circle it will
					// travel along our path
					var marker = g.append("circle")
						.attr("r", 10)
						.attr("id", "marker")
						.attr("class", "travelMarker");


					// For simplicity I hard-coded this! I'm taking
					// the first and the last object (the origin)
					// and destination and adding them separately to
					// better style them. There is probably a better
					// way to do this!
					
					var originANDdestination = [featuresdata[0], featuresdata[featuresdata.length-1]]

					var begend = g.selectAll(".drinks")
						.data(originANDdestination)
						.enter()
						.append("circle", ".drinks")
						.attr("r", 5)
						.style("fill", "red")
						.style("opacity", "1");

					// when the user zooms in or out you need to reset
					// the view
					map.on("viewreset", reset2);

					// this puts stuff on the map! 
					reset2();
					transition();

					// Reposition the SVG to cover the features.
					function reset2() {
						var bounds = d3path.bounds(collection),
							topLeft = bounds[0],
							bottomRight = bounds[1];
						
						// for the points we need to convert from latlong
						// to map units
						begend.attr("transform",
							function(d) {
								return "translate(" +
									applyLatLngToLayer(d).x + "," +
									applyLatLngToLayer(d).y + ")";
							});

						ptFeatures.attr("transform",
							function(d) {
								return "translate(" +
									applyLatLngToLayer(d).x + "," +
									applyLatLngToLayer(d).y + ")";
							});

						// again, not best practice, but I'm harding coding
						// the starting point

						marker.attr("transform",
							function() {
								var y = featuresdata[0].geometry.coordinates[1]
								var x = featuresdata[0].geometry.coordinates[0]
								return "translate(" +
									map.latLngToLayerPoint(new L.LatLng(y, x)).x + "," +
									map.latLngToLayerPoint(new L.LatLng(y, x)).y + ")";
							});


						// Setting the size and location of the overall SVG container
						svg.attr("width", bottomRight[0] - topLeft[0] + 120)
							.attr("height", bottomRight[1] - topLeft[1] + 120)
							.style("left", topLeft[0] - 50 + "px")
							.style("top", topLeft[1] - 50 + "px");


						// linePath.attr("d", d3path);
						linePath.attr("d", toLine)
						// ptPath.attr("d", d3path);
						g.attr("transform", "translate(" + (-topLeft[0] + 50) + "," + (-topLeft[1] + 50) + ")");

					} // end reset

					// the transition function could have been done above using
					// chaining but it's cleaner to have a separate function.
					// the transition. Dash array expects "500, 30" where 
					// 500 is the length of the "dash" 30 is the length of the
					// gap. So if you had a line that is 500 long and you used
					// "500, 0" you would have a solid line. If you had "500,500"
					// you would have a 500px line followed by a 500px gap. This
					// can be manipulated by starting with a complete gap "0,500"
					// then a small line "1,500" then bigger line "2,500" and so 
					// on. The values themselves ("0,500", "1,500" etc) are being
					// fed to the attrTween operator
					function transition() {
						linePath.transition()
							.duration(7500)
							.attrTween("stroke-dasharray", tweenDash)
							.each("end", function() {
								d3.select(this).call(transition);// infinite loop
							}); 
					} //end transition

					// this function feeds the attrTween operator above with the 
					// stroke and dash lengths
					function tweenDash() {
						return function(t) {
							//total length of path (single value)
							var l = linePath.node().getTotalLength(); 
						
							// this is creating a function called interpolate which takes
							// as input a single value 0-1. The function will interpolate
							// between the numbers embedded in a string. An example might
							// be interpolatString("0,500", "500,500") in which case
							// the first number would interpolate through 0-500 and the
							// second number through 500-500 (always 500). So, then
							// if you used interpolate(0.5) you would get "250, 500"
							// when input into the attrTween above this means give me
							// a line of length 250 followed by a gap of 500. Since the
							// total line length, though is only 500 to begin with this
							// essentially says give me a line of 250px followed by a gap
							// of 250px.
							interpolate = d3.interpolateString("0," + l, l + "," + l);
							//t is fraction of time 0-1 since transition began
							var marker = d3.select("#marker");
							
							// p is the point on the line (coordinates) at a given length
							// along the line. In this case if l=50 and we're midway through
							// the time then this would 25.
							var p = linePath.node().getPointAtLength(t * l);

							//Move the marker to that point
							marker.attr("transform", "translate(" + p.x + "," + p.y + ")"); //move marker
							//console.log(interpolate(t))
							return interpolate(t);
						}
					} //end tweenDash
				}
			});
			
			$("body").append('\
				<style id="svg-style">\
					path {\
						fill-opacity: .2;\
					}\
					path:hover {\
						fill-opacity: .4;\
					}\
					\
					.travelMarker {\
						fill: yellow;\
						opacity: 0.75;\
					}\
					.waypoints {\
						fill: black;\
						opacity: 0;\
					}\
					.drinks {\
						stroke: black;\
						fill: red;\
					}\
					.lineConnect {\
						fill: none;\
						stroke: black;\
						opacity: 1;\
					}\
					.locnames {\
						fill: black;\
						text-shadow: 1px 1px 1px #FFF, 3px 3px 5px #000;\
						font-weight: bold;\
						font-size: 13px;\
					}\
				</style>\
			');
			
			function applyLatLngToLayer(d) {
				var y = d.geometry.coordinates[1];
				var x = d.geometry.coordinates[0];
				return map.latLngToLayerPoint(new L.LatLng(y, x));
			}
		}
	</script>
</html>