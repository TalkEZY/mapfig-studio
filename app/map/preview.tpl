	<div id="map_width_container">
		<link rel="stylesheet" href="[#BASEURL#]app/map/leaflet/dist/leaflet.css" />
		<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" />
		<link rel="stylesheet" href="[#BASEURL#]app/map/leaflet/dist/leaflet.awesome-markers.css" />
		
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
		
		<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
		
		<script src="[#BASEURL#]app/colorpicker/js/colpick.js" type="text/javascript"></script>
		<link rel="stylesheet" href="[#BASEURL#]app/colorpicker/css/colpick.css" type="text/css"/>
		
		<link rel="stylesheet" href="[#BASEURL#]app/css/mapbox.css" type="text/css"/>
		
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
		
		<script src='[#BASEURL#]app/js/togeojson.js'></script>
		
		<script src="[#CDNURL#]d3.v3.min.js" type="text/javascript"></script>
		<script src="d3.geo.projection.js" type="text/javascript"></script>
		
		<link rel="stylesheet" href="[#CDNURL#]global-custom.css" />
		
		
		<style>
			.btnButtonStyle.btn-sm {
				padding: 3px 8px !important;
			}
			
			.loader {
				width: [#WIDTH#][#WIDTH_UNIT#];
				height: [#HEIGHT#][#HEIGHT_UNIT#];
				position: absolute;
				z-index: 1001;
				background-color: rgba(226, 226, 226, 0.87);
			}
		</style>
		
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
		var featureGroup  = new L.FeatureGroup();//(isClusterGroup)? new L.MarkerClusterGroup() : new L.FeatureGroup();
		var _featureGroup = new L.FeatureGroup();
		
		drawControl = new L.Control.Draw({
			edit: {
				featureGroup: featureGroup
			}
		});
		
		var mbAttribution = ' contributors | <a href="https://www.[#MAIN_DOMAIN#]" target="_blank">[#SITE_NAME_FORMATED#]</a>';
		var defaultLayer = [#DEFAULT_LAYER#];
		var defaultLayerMiniMap = [#DEFAULT_LAYER#];
		
		var globalJSON = [#JSON_STRING#];
		var markerLayers = new Array();
		
		var map_scale = L.control.scale({position:'bottomleft', maxWidth: 100, metric: true, imperial: true, updateWhenIdle: false});
		
		var map;
		var drawControl;
		
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
		map.addControl(L.exportControl({ codeid: 'app/processor/map-export/index.php', position: 'topleft', endpoint: '[#BASEURL#]', getFormatFrom: 'app/processor/map-export-format/index.php', mapid: [#MAP_ID#] }));
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
					'<a class="leaflet-control-sidefilter-button leaflet-bar-part sidefilter-buttons" id="sidefilter-button-reorder" href="#" onClick="return false;" title="Filter Bar Toggle"><i class="fa fa-filter"></i></a>' +
					'<div id="sidefilter-buttons" style="max-height: 300px; overflow: auto;">' +
						'<ul class="list-unstyled leaflet-sidefilter">' +
							
						'</ul>' +
					'</div>' +
				'</div>'
			);
		}
		
		
		featureGroup.addTo(map);
		drawControl.addTo(map);
		
		function changeAddressCheckbox(obj){
			var layers = getLayers();
			index = $(obj).parent().index();
			
			if($(obj).is(':checked')) {
				featureGroup.addLayer(layers[index]);
				if(set_marker){
					setTimeout(function(){
						if(layers.length ==1){
							layers[index].fire('click');
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
			}, 1000);
		});
		
		$(document).ready(function(){
			if(!show_sidebar){
				$('#sidebarhideshow').hide();
			}
			if(!isShowExport){
				$('.leaflet-control-export').hide();
			}
			if(!isShowMeasure){
				$('.leaflet-control-draw-measure').hide();
			}
			if(!isShowMiniMap){
				$('.leaflet-control-minimap').hide();
			}
			if(!isShowSearch){
				$('.leaflet-control-search').hide();
			}
			if(!isShowFileLayer){
				$('.leaflet-control-filelayer').hide();
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
				layerControlColorStyle();
			},100);
			
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
			
			$('input[name=overlay_title]').val(overlayTitle);
			$('input[name=overlay_blurb]').val(overlayBlurb);
			$('input[name=overlay_content]').val($('#about2 #tabsAbout').html());
		}
		function legendUpdate() {
			if(isLegendEnable) {
				$('#trgrLegend').show();
			}
			else {
				$('#trgrLegend, #pnlLegend').hide();
			}
			
			$('#layerSelector').html($('<textarea/>').html(legendContent).val());
			$('input[name=legend_content]').val($('#layerSelector').html());
		}
		function imageOverlaysUpdate(update) {
			var imageBounds = null;
			
			$.each(imageOverlaysLayers, function(key, value) {
				map.removeLayer(value);
			});
			
			imageOverlaysLayers = [];
			imageOverlaysPopups = [];
			
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
			
			if(update && imageOverlaysLayers.length > 0) {
				map.fitBounds(imageBounds);
			}
			
			$('input[name=image_overlays]').val(JSON.stringify(imageOverlays));
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
			
			$('#static-popup').css('max-height',height).css('min-width',150);
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
	</script>
	
	
	<script>
		var layerProperties             = new Array(); // global variable to keep properties in the form of key pair value 
		var shapeStyles                 = new Array();
		var shapeCustomProperties       = new Array();
		
		/* Editable Part Start */
		var publicLayer = null;
		var editMode = false;
		
		function updateMapCenter() {
			canter = map.getCenter();
			$('input[name=latitude]').val(canter.lat);
			$('input[name=longitude]').val(canter.lng);
			
			$('#mapcenter').val('['+canter.lat+','+canter.lng+']');
		}
		
		map.on('moveend', function(e) {
			updateMapCenter();
		});
		
		map.on('draw:created', function(e) {
			var type  = e.layerType;
			var layer = e.layer;
			
			featureGroup.addLayer(layer);
			_featureGroup.addLayer(layer);
			
			layer.on("click", function(){
				if(editMode) {
					layerDialog(layer);
					setTimeout(function(){
						map.closePopup();
					},50);
				}
				else {
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
				}
			});
			bindPopup(layer);
			
			layerProperties.push(new Array(layer, new Array()));
			
			/* Custom Properties i.e popup from top etc. */
			cp = {};
			cp['get_direction']         = false;
			cp['bootstrap_popup']       = false;
			cp['show_address_on_popup'] = true;
			cp['hide_label']            = true;
			shapeCustomProperties.push(cp);
			
			/* Shape Style */
			if(layer instanceof L.Marker) {
				style = {};
				style['icon'] = '';
				style['prefix'] = 'fa';
				style['markerColor'] = '';
			}
			else if(layer instanceof L.MultiPolygon ||
					layer instanceof L.Polyline ||
					layer instanceof L.Rectangle ||
					layer instanceof L.Circle) {
					
				style = {};
				style['color'] = '#ff0000';
				style['opacity'] = 0.5;
				style['weight'] = 5;
				style['fillColor'] = '#ff0000';
				style['fillOpacity'] = 0.2;
				
				layer.setStyle(style);
			}
			shapeStyles.push(style);
			
			/* Custom Properties */
			properties = new Array();
			
			row = {};
			row['name']            = 'Location';
			row['value']           = '';
			row['defaultProperty'] = true;
			properties.push(row);
			
			row = {};
			row['name']            = 'Pop-Up Content';
			row['value']           = '';
			row['defaultProperty'] = false;
			properties.push(row);
			
			setPropertiesByLayer(layer, properties);
			
			
			layerDialog(layer);
		});
		
		map.on('draw:editstart', function(e) {
			setTimeout(function(){
				var layers = featureGroup.getLayers();
				$.each(layers, function(index, layer) {
					index = getLayerIndex(layer);
					if(layer instanceof L.Marker){
						if(shapeStyles[index].markerColor) {
							layer.setIcon(L.AwesomeMarkers.icon(shapeStyles[index]));
						}
					}
					else if (layer instanceof L.Polyline ||
						layer instanceof L.Polygon ||
						layer instanceof L.Rectangle ||
						layer instanceof L.Circle) {
						layer.setStyle(shapeStyles[index]);
					}
				});
			}, 50);
			
			draw_editStart();
			editMode = true;
		});
		
		map.on('draw:editstop', function(e) {
			setTimeout(function(){
				var layers = featureGroup.getLayers();
				$.each(layers, function(index, layer) {
					index = getLayerIndex(layer);
					if(layer instanceof L.Marker){
						if(shapeStyles[index].markerColor) {
							layer.setIcon(L.AwesomeMarkers.icon(shapeStyles[index]));
						}
					}
					else if (layer instanceof L.Polyline ||
						layer instanceof L.Polygon ||
						layer instanceof L.Rectangle ||
						layer instanceof L.Circle) {
						layer.setStyle(shapeStyles[index]);
					}
				});
			}, 50);
			
			editMode = false;
			draw_editStop(e);
		});
		
		map.on('draw:deleted', function(e) {
			var layers = e.layers;
			layers.eachLayer(function (layer) {
				if (layer instanceof L.MultiPolygon ||
					layer instanceof L.Polyline ||
					layer instanceof L.Rectangle ||
					layer instanceof L.Circle ||
					layer instanceof L.Marker) {
					deleteLayer(layer);
				}
			});
		});
		
		var getShapes = function(drawnItems) {
			var shapes = [];
			
			drawnItems.eachLayer(function(layer) {
				// Note: Rectangle extends Polygon. Polygon extends Polyline.
				// Therefore, all of them are instances of Polyline
				if (layer instanceof L.MultiPolygon ||
					layer instanceof L.Polyline ||
					layer instanceof L.Rectangle ||
					layer instanceof L.Circle ||
					layer instanceof L.Marker) {
					shapes.push(layer);
				}
			});
			return shapes;
		};
		
		function addProp(propName, propValue, isDefault, layer) {
			targetTr = $('#propForm #menuProperties table tbody > tr');
			targetTbody = $('#propForm #menuProperties table tbody');
			
			checked = (isDefault)? 'checked' : '';
			
			if(propName == "Location") {
				targetTbody.append('<tr><td>'+propName+'</td><td><input id="autoFillAddress" class="form-control" placeholder="Enter Location" value="'+propValue+'"/><div style="display:none;" name="propertyHiddenValue">'+propValue+'</div></td><td style="display:none;"><input type="radio" '+checked+'></td></tr>');
			}
			else if(propName == "Pop-Up Content") {
				targetTbody.append('<tr><td>'+propName+'</td><td><button onClick="editValue(this)" class="btn btn-info btn-xs" title="Edit Pop-Up Content"><i class="fa fa-edit"></i></button><div style="display:none;" name="propertyHiddenValue">'+propValue+'</div></td><td style="display:none;"><input type="radio" '+checked+'></td></tr>');
			}
			else {
				targetTbody.append('<tr><td>'+propName+'</td><td><input class="form-control" placeholder="Enter Value" value="'+propValue+'" onChange="$(this).parent().find(\'div[name=propertyHiddenValue]\').html($(this).val())"/><div style="display:none;" name="propertyHiddenValue">'+propValue+'</div></td><td style="display:none;"><input type="radio" '+checked+'></td></tr>');
			}
		}
		
		function deleteLayer(layer) {
			index = getLayerIndex(layer);
			
			layerProperties.splice(index, 1);
			shapeStyles.splice(index, 1);
			shapeCustomProperties.splice(index, 1);
			
			_featureGroup.removeLayer(layer);
		}
		
		function removeProp(obj) {
			$(obj).closest('tr').fadeOut(400, function(){$(this).remove();});
		}
		
		var editValueObj;
		function editValue(obj) {
			var propertyName = $(obj).closest('tr').find('td').eq(0).text();
			var value = $(obj).closest('tr').find('div[name=propertyHiddenValue]').html();
			editValueObj = obj;
			
			showEditPropertyValueModal(propertyName);
			setTimeout(function(){
				tinyMCEInit();
				setTimeout(function(){
					tinyMCE.get('modalPropertyValue').setContent(value);
				}, 500);
			}, 300);
		}
		
		function renderPropertiesOnPopup(layer) {
			for(i=0; i<layerProperties.length; i++) {
				if(layerProperties[i][0] == layer) {
					properties = layerProperties[i][1];
					if(properties && properties.length>0) {
						for(j=0;j<properties.length; j++) {
							addProp(properties[j].name, properties[j].value, properties[j].defaultProperty, layer);
						}
					}
				}
			}
		}
		
		function renderStyleOnPopup(layer) {
			index = getLayerIndex(layer);
			style = shapeStyles[index];
			customProperties = shapeCustomProperties[index];
			
			if(layer instanceof L.Marker) {
				$('#propForm #menuStyle table tbody').append('\
					<tr>\
						<td>\
							Icon\
						</td>\
						<td>\
							<select id="icon" class="form-control">\
								<option value="">Select Marker Icon</option>\
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
								<option value="graduation-cap">Graduation Cap</option>\
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
					<tr>\
						<td>\
							Marker Color\
						</td>\
						<td>\
							<input type="hidden" id="prefix" value="'+style.prefix+'"/>\
							<select class="form-control" id="markerColor">\
								<option value="">Select Marker Colour</option>\
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
					</tr>\
				');
				$('#icon').val(style.icon);
				$('#markerColor').val(style.markerColor);
			}
			else if(layer instanceof L.MultiPolygon ||
					layer instanceof L.Polyline ||
					layer instanceof L.Rectangle ||
					layer instanceof L.Circle) {
				$('#propForm #menuStyle table tbody').append('\
					<tr>\
						<td>\
							Color\
						</td>\
						<td>\
							<input type="text" id="color" readonly class="form-control" placeholder="Stroke Color" value="'+style.color+'"/>\
						</td>\
					</tr>\
					<tr>\
						<td>\
							Opacity (range: 0-1)\
						</td>\
						<td>\
							<input type="number" id="opacity" step="0.1" class="form-control" placeholder="Stroke Opacity (range 0 to 1)" value="'+style.opacity+'"/>\
						</td>\
					</tr>\
					<tr>\
						<td>\
							Weight\
						</td>\
						<td>\
							<input type="number" id="weight" class="form-control" placeholder="Stroke Weight" value="'+style.weight+'"/>\
						</td>\
					</tr>\
					<tr>\
						<td>\
							Fill Color\
						</td>\
						<td>\
							<input type="text" id="fillColor" readonly class="form-control" placeholder="Fill color" value="'+style.fillColor+'"/>\
						</td>\
					</tr>\
					<tr>\
						<td>\
							Fill Opacity (range: 0-1)\
						</td>\
						<td>\
							<input type="number" id="fillOpacity" step="0.1" class="form-control" placeholder="Fill Opacity (range 0 to 1)" value="'+style.fillOpacity+'"/>\
						</td>\
					</tr>\
				');
				setTimeout(function(){
					$('#color').colpick({
						layout:'rgbhex',
						submit:0,
						color: $('#color').val().replace('#', ''),
						onChange:function(hsb,hex,rgb,el,bySetColor) {
							$(el).css('border-color','#'+hex);
							if(!bySetColor) $(el).val('#'+hex);
						}
					});
					$('#fillColor').colpick({
						layout:'rgbhex',
						submit:0,
						color: $('#fillColor').val().replace('#', ''),
						onChange:function(hsb,hex,rgb,el,bySetColor) {
							$(el).css('border-color','#'+hex);
							if(!bySetColor) $(el).val('#'+hex);
						}
					});
					$('#get_direction, #show_address_on_popup').closest('tr').hide();
				}, 50);
			}
			
			/* For Custom Properties */
			$('#propForm #menuCustomProperties table tbody').append('\
				<tr>\
					<td>\
						Add Google Maps Directions Link\
					</td>\
					<td>\
						<input type="checkbox" id="get_direction" '+((customProperties.get_direction == true)?"checked":"")+'/>\
					</td>\
				</tr>\
				<tr>\
					<td>\
						Display Modal InfoBox\
					</td>\
					<td>\
						<input type="checkbox" id="bootstrap_popup" '+((customProperties.bootstrap_popup == true)?"checked":"")+'/>\
					</td>\
				</tr>\
				<tr>\
					<td>\
						Include Location on Popup\
					</td>\
					<td>\
						<input type="checkbox" id="show_address_on_popup" '+((customProperties.show_address_on_popup == true)?"checked":"")+'/>\
					</td>\
				</tr>\
				<tr>\
					<td>\
						Hide Label From Popup\
					</td>\
					<td>\
						<input type="checkbox" id="hide_label" '+((customProperties.hide_label == true)?"checked":"")+'/>\
					</td>\
				</tr>\
			');
		}
		
		function layerDialog(layer) {
			publicLayer = layer;
			message = '\
				<div id="propForm">\
					<div role="tabpanel" class="panel">\
					   <ul role="tablist" class="nav nav-tabs nav-justified">\
						  <li role="presentation" class="active">\
							 <a href="#menuProperties" aria-controls="menuProperties" onClick="$(this).addClass(\'active\');$(\'#menuCustomProperties,#menuStyle\').removeClass(\'active\');" role="tab" data-toggle="tab">\
								<em class="fa fa-cogs fa-fw"></em>Properties</a>\
						  </li>\
						  <li role="presentation">\
							 <a href="#menuCustomProperties" aria-controls="menuCustomProperties" onClick="$(this).addClass(\'active\');$(\'#menuProperties,#menuStyle\').removeClass(\'active\');" role="tab" data-toggle="tab">\
								<em class="fa fa-cog fa-fw"></em>Advance</a>\
						  </li>\
						  <li role="presentation">\
							 <a href="#menuStyle" aria-controls="menuStyle" onClick="$(this).addClass(\'active\');$(\'#menuProperties,#menuCustomProperties\').removeClass(\'active\');" role="tab" data-toggle="tab">\
								<em class="fa fa-legal fa-fw"></em>Styling</a>\
						  </li>\
					   </ul>\
					   <div class="tab-content p0">\
						  <div id="menuProperties" role="tabpanel" class="tab-pane active">\
							<div class="panel-body">\
								<div class="table-responsive" style="height: 200px;">\
									<table class="table table-striped table-bordered table-hover">\
										<tbody>\
										</tbody>\
									</table>\
								</div>\
							</div>\
						  </div>\
						  <div id="menuCustomProperties" role="tabpanel" class="tab-pane">\
							<div class="panel-body">\
								<div class="table-responsive" style="height: 200px;">\
									<table class="table table-striped table-bordered table-hover">\
										<tbody>\
										</tbody>\
									</table>\
								</div>\
							</div>\
						  </div>\
						  <div id="menuStyle" role="tabpanel" class="tab-pane">\
							 <div class="panel-body">\
								<div class="table-responsive" style="height: 200px;">\
									<table class="table table-striped table-bordered table-hover">\
										<tbody>\
										</tbody>\
									</table>\
								</div>\
							 </div>\
						  </div>\
					   </div>\
					</div>\
				</div>\
			';
			BootstrapDialog.show({
				title: 'Add/Edit Properties And Styles',
				message: message,
				buttons: [{
					label: '',
					icon: 'fa fa-check',
					cssClass: 'btn-primary',
					action: function(dialog) {
						properties = new Array();
						
						$('#propForm #menuProperties table tbody tr').each(function(){
							name    = $.trim($(this).find('td:nth-child(1)').text());
							value   = $.trim($(this).find('td:nth-child(2) div[name=propertyHiddenValue]').html());
							Default = $(this).find('td:nth-child(3) input').is(':checked');
							
							row = {};
							row['name']            = name;
							row['value']           = value;
							row['defaultProperty'] = Default;
							
							properties.push(row);
						});
						
						stl = {};
						$('#propForm #menuStyle table tbody tr input, #propForm #menuStyle table tbody tr select').each(function(){
							name  = $(this).attr('id');
							value = $(this).val();
							
							stl[name]  = value;
						});
						
						cp = {};
						$('#propForm #menuCustomProperties table tbody tr input[type=checkbox]').each(function(){
							name  = $(this).attr('id');
							value = $(this).is(':checked');
							
							cp[name]  = value;
						});
						
						for(i=0; i<layerProperties.length; i++) {
							if(layerProperties[i][0] == layer) {
								layerProperties[i][1] = properties;
								shapeStyles[i] = stl;
								shapeCustomProperties[i] = cp;
								break;
							}
						}
						
						reRenderShapeStylesOnMap(layer);
						bindPopup(layer);
						
						renderSideBar();
						renderSideFilter();
						
						dialog.close();
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
			setTimeout(function(){
				renderPropertiesOnPopup(layer);
				renderStyleOnPopup(layer);
				
				if(layer instanceof L.Marker) {
					autocomplete = new google.maps.places.Autocomplete((document.getElementById("autoFillAddress")),{ types: ["geocode"] });
					google.maps.event.addListener(autocomplete, "place_changed", function() {
						lat = autocomplete.getPlace().geometry.location.lat();
						lng = autocomplete.getPlace().geometry.location.lng();
						
						$('#autoFillAddress').parent().find('div[name=propertyHiddenValue]').html(autocomplete.getPlace().formatted_address);
						
						index = getLayerIndex(publicLayer);
						layerProperties[index][0].setLatLng([lat,lng]);
						map.setView([lat, lng], map.getZoom());
					});
				}
				
				$('#autoFillAddress').change(function(){
					if(!(publicLayer instanceof L.Marker)) {
						$(this).parent().find('div[name=propertyHiddenValue]').html($(this).val());
					}
				});
			}, 300);
		}
		
		function showEditPropertyValueModal(propertyName) {
			var dd = BootstrapDialog.show({
				title: 'Edit Property (\''+propertyName+'\') Value',
				message: '\
					<div id="PropertyValueEditModal">\
						<div class="panel panel-default">\
							<textarea id="modalPropertyValue"></textarea>\
						</div>\
					</div>\
				',
				buttons: [{
					label: '',
					icon: 'fa fa-check',
					cssClass: 'btn-primary',
					action: function(dialog) {
						val = tinyMCE.get('modalPropertyValue').getContent();
						$(editValueObj).closest('tr').find('div[name=propertyHiddenValue]').html(val);
						
						dialog.close();
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
			
			dd.getModal().removeAttr('tabindex');
		}
		
		function reRenderShapeStylesOnMap(layer) {	// Render on Map after updating
			for(i=0; i<layerProperties.length; i++) {
				if(layerProperties[i][0] == layer) {
					if(layer instanceof L.Marker) {
						if(shapeStyles[i].markerColor) {
							layer.setIcon(L.AwesomeMarkers.icon(shapeStyles[i]));
						}
					}
					else if(layer instanceof L.MultiPolygon ||
							layer instanceof L.Polyline ||
							layer instanceof L.Rectangle ||
							layer instanceof L.Circle) {
						layer.setStyle(shapeStyles[i]);
					}
					return true;
				}
			}
			return false;
		}
		
		function setPropertiesByLayer(layer, properties) {
			for(i=0; i<layerProperties.length; i++) {
				if(layerProperties[i][0] == layer) {
					layerProperties[i][1] = properties;
					return;
				}
			}
		}
		
		$(document).ready(function(){
			updateMapCenter();
			
			$('#save').click(function(){
				/* Cancel if any control is active */
				$('#control-tip-buttons a').each(function(){
					if($(this).text().trim() == "Cancel"){
						$(this).click();
					}
				});
				
				var finalShapeData = new Array();
				var shapes = getShapes(_featureGroup);
				
				$.each(shapes, function(index, shape) {
					properties = getPropertiesByLayer(shape);
					shpJson = shape.toGeoJSON();
					shpJson.properties = JSON.stringify(properties);
					finalShapeData.push(shpJson);
				});
				finalShapeData = JSON.stringify(finalShapeData);
				
				$('input#shapes').val(finalShapeData);
				$('input#shapeCustomProperties').val(JSON.stringify(shapeCustomProperties));
				$('input#shapeStyles').val(JSON.stringify(shapeStyles));
				$('input#gpx_tracks').val(JSON.stringify(GPXTracks));
				$('input#map_bounds').val(JSON.stringify(MapBounds));
				
				$('#shape-edit').submit();
			});
			
			$('.leaflet-draw-draw-circle').remove();
		});
		/* Editable Part End */
		
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
			layer.addTo(_featureGroup);
			
			layer.on("click", function(){
				if(editMode) {
					layerDialog(layer);
					setTimeout(function(){
						map.closePopup();
					},50);
				}
				else {
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
			popupContent = getPopupContent(layer);
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
			setTimeout(function(){
				$('.leaflet-control-layers form.leaflet-control-layers-list input[type=radio]').click(function(){
					map.removeLayer(defaultLayer);
				});
			},200);
		});
	</script>
	
	<style>
		.btn-custom{
			color:#fff;
			background-color:#51a746;
			border-color:#7ec575
		}
		.btn-custom.active, .btn-custom.focus, .btn-custom:active, .btn-custom:focus, .btn-custom:hover{
			color:#fff;
			background-color:#ffac88;
			border-color:#ffc3a0
		}
		.btn-custom.active,.btn-custom:active{
			background-image:none
		}
		
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
							  .css({'display':'block','text-indent':'0px'});
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
			
			
			layerControlColorStyle();
			
			
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
		
		function layerControlColorStyle() {
			/* Layers Control Start */
			$control = $('.leaflet-control-layers');
			$control.removeClass('bg bg-success bg-default bg-primary bg-info bg-warning').addClass('bg bg-'+buttonStyle+' bgButtonStyle');
			
			$control.find('a').removeClass('btn btn-success btn-default btn-primary btn-info btn-warning').addClass('btn btn-'+buttonStyle+' btnButtonStyle btn-'+buttonSize);
			$control.find('#sidebar-buttons').removeClass('bg bg-success bg-default bg-primary bg-info bg-warning').addClass('bg bg-'+buttonStyle+' bgButtonStyle');
			/* Layers Control End */
		}
	</script>
	
	
	
	
	
	
	
	
	
	
	<script>
		var progressBar = null;
		function createProgressBar() {
			var dialogInstance = new BootstrapDialog();
			dialogInstance.setTitle(null);
			dialogInstance.setMessage('\
				<div id="importProgressBar">\
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
			obj  = body.find('#importProgressBar div.progress-bar.progress-bar-striped.active');
			
			obj.attr('aria-valuenow',percentage);
			obj.css('width',percentage+'%');
			obj.text(percentage+'% Completed');
		}
		
		var globalLastFileFormat = '';
		function initiateUpload() {
			if($('#data-importer').val() == "") {
				globalLastFileFormat = '';
				return;
			}
			
			var temp = $('form#data-importer-form input[type=file]').val().split('.');
			globalLastFileFormat = temp[temp.length-1];
			
			progressBar = createProgressBar();
			var formData = new FormData($('form#data-importer-form')[0]);
			$.ajax({
				url: 'processor/file-import/index.php',  //Server script to process data
				type: 'POST',
				xhr: function() {  // Custom XMLHttpRequest
					var myXhr = $.ajaxSettings.xhr();
					if(myXhr.upload){ // Check if upload property exists
						myXhr.upload.addEventListener('progress',function(e){
							if(e.lengthComputable){
								updateProgressBar(progressBar, Math.floor((e.loaded/e.total)*100));
							}
						}, false); // For handling the progress of the upload
					}
					return myXhr;
				},
				success: function(data) {
					if(globalLastFileFormat.toLowerCase() == 'geojson') {
						globalLastFileFormat = 'json';
					}
					
					if(globalLastFileFormat.toLowerCase() == 'kml' || globalLastFileFormat.toLowerCase() == 'gpx' || globalLastFileFormat.toLowerCase() == 'json') {
						var jsonData;
						if(globalLastFileFormat.toLowerCase() != 'json') {
							jsonData = JSON.parse(JSON.stringify(toGeoJSON[globalLastFileFormat.toLowerCase()]((new DOMParser()).parseFromString(data, 'text/xml')), null, 4));
						}
						else {
							try {
								jsonData = JSON.parse(data);
							}
							catch(err) {
								Alert("Invalid File", 'error');
								return ;
							}
						}
						
						
						// Prepare JSON for Studio APP
						$.each(jsonData.features, function(index, feature) {
							newProp = [];
							
							var hasLocation = false;
							var hasPopUpContent = false;
							
							$.each(feature.properties, function(idx, val){
								if(idx.toLowerCase() == "location") {
									idx = "Location";
									hasLocation = !hasLocation;
								}
								if(idx.toLowerCase() == "pop-up content") {
									idx = "Pop-Up Content";
									hasPopUpContent = !hasPopUpContent;
								}
								
								newProp.push({
											"name": idx,
											"value": val,
											"defaultProperty":(idx == "Location")
										});
							});
							
							
							if(!hasLocation) {
								newProp.push({
											"name": "Location",
											"value":"No Name",
											"defaultProperty":true
										});
							}
							if(!hasPopUpContent) {
								newProp.push({
											"name": "Pop-Up Content",
											"value":"",
											"defaultProperty":false
										});
							}
							
							jsonData.features[index].properties = newProp;
							
							if(jsonData.features[index].geometry.type == "Point") {
								jsonData.features[index]['style'] = JSON.parse('{"icon":"","prefix":"fa","markerColor":""}');
								jsonData.features[index]['customProperties'] = JSON.parse('{"get_direction":false,"bootstrap_popup":false,"show_address_on_popup":true,"hide_label":false}');
							}
							else {
								jsonData.features[index]['style'] = JSON.parse('{"color":"#ff0000","opacity":"0.5","weight":"5","fillColor":"#ff0000","fillOpacity":"0.2"}');
								jsonData.features[index]['customProperties'] = JSON.parse('{"get_direction":false,"bootstrap_popup":false,"show_address_on_popup":true,"hide_label":true}');
							}
							
							/*if(feature.geometry.type == "Point") {
								val = feature.geometry.coordinates;
								val.splice(2,1);
								jsonData.features[index].geometry.coordinates = val;
							}
							else if(feature.geometry.type == "LineString") {
								$.each(feature.geometry.coordinates, function(idx, val){
									val.splice(2,1);
									jsonData.features[index].geometry.coordinates[idx] = val;
								});
							}
							else if(feature.geometry.type == "Polygon") {
								$.each(feature.geometry.coordinates, function(idx1, subCoordinates){
									$.each(subCoordinates, function(idx2, val){
										val.splice(2,1);
										jsonData.features[index].geometry.coordinates[idx1][idx2] = val;
									});
								});
							}*/
						});
					}
					else {
						Alert("Invalid File","error");
						return;
					}
					
					Alert("Data Successfully imported on Map", 'success');
					
					loadJson(jsonData);
					globalLastFileFormat = '';
				},
				error: function(e){
					Alert("Error While Uploading the file", "error");
					progressBar.close();
				},
				// Form data
				data: formData,
				//Options to tell jQuery not to process data or worry about content-type.
				cache: false,
				contentType: false,
				processData: false
			});
			
			$('form#data-importer-form input[type=file]').val('');
		}
		$(document).ready(function(){
			$('.leaflet-draw.leaflet-control').hide();
			
			$('#map_canvas').prepend('\
				<div id="data" class="module app animate row1">\
					<div class="draw-controls js-tabs row1 block contain dark fill-blue pull-left" style="width:80%;">\
						<a href="csv.php" class="col4 button unround keyline-left icon" title="Data Block" style="background: #703811;"><i class="fa fa-database"></i> CSV</a>\
						<a href="#" id="draw-polyline" class="col4 button unround keyline-left icon polyline" title="Draw a line"><i class="fa fa-minus"></i> Line</a>\
						<a href="#" id="draw-polygon" class="col4 button unround keyline-left icon polygon" title="Draw a polygon"><i class="fa fa-diamond"></i> Polygon</a>\
						<a href="#" id="draw-rectangle" class="col4 button unround keyline-left icon rectangle" title="Draw a Rectangle"><i class="fa fa-square-o"></i> Rectangle</a>\
						<a href="#" id="draw-marker" class="col4 button unround keyline-left place-marker icon marker" title="Place marker"><i class="fa fa-map-marker"></i> Marker</a>\
					</div>\
					<div class="draw-controls js-tabs row1 block contain dark fill-blue pull-right" style="width:18%">\
						<a href="#" id="edit-edit" class="pin-right button unround keyline-left icon edit" title="Edit"><i class="fa fa-edit"></i></a>\
						<a href="#" id="edit-remove" class="pin-right button unround keyline-left icon delete pull-right" title="Delete"><i class="fa fa-remove"></i></a>\
					</div>\
					<div id="marker-help" class="animate pin-top fill-white row1 small active">\
						<div class="small pad1x clearfix truncate">\
							<i class="fa fa-info-circle"></i>\
							<span class="inline pad1y" id="control-tip-info"> Select the Shape to draw on Map or <a href="#" class="btn btn-primary btn-xs" onClick="$(\'#data-importer\').click(); return false;" style="color:white;">click here to import</a> gpx, json or kml.</span>\
							<form method="post" id="data-importer-form" style="display:none;" enctype="multipart/form-data"><input type="file" name="file" id="data-importer" onChange="initiateUpload();" accept=".geojson,.json,.gpx,.kml"/></form>\
							<span id="control-tip-buttons">\
								\
							<span>\
						</div>\
					</div>\
				</div>\
			');
			
			$('.draw-controls > a').click(function(e){
				if($(this).attr('href') == "#") {
					e.preventDefault();
					
					var id = $(this).attr('id');
					$('.leaflet-draw-'+id)[0].click();
				}
			});
			
			map.on('draw:drawstart', function(e){
				draw_editStart(e);
			});
			map.on('draw:deletestart', function(e){
				draw_editStart(e);
			});
			
			map.on('draw:editstop', function(e){
				draw_editStop(e)
			});
			map.on('draw:drawstop', function(e){
				draw_editStop(e)
			});
			map.on('draw:deletestop', function(e){
				draw_editStop(e)
			});
		});
		
		function draw_editStart(e) {
			var idx = 0;
			setTimeout(function(){
				info = $('.leaflet-draw-tooltip').text().replace('Click cancel to undo changes.','');
				$('#control-tip-info').html(info);
				
				$('#control-tip-buttons').text('');
				$('.leaflet-draw-actions li').each(function(index){
					var obj = $(this);
					if(obj.parent().css('display') == 'block') {
						var value = obj.text();
						var icon = '';
						
						if(/cancel/i.test(value)) {
							icon = 'remove';
						}
						else if(/save/i.test(value)) {
							icon = 'save';
						}
						else {
							icon = 'trash';
						}
						
						Actions = '<a href="#" onClick="return tipButtonsclick('+(idx++)+');" class="button-top pin-right unround button quiet icon close pad1 inline"><i class="fa fa-'+icon+'"></i> '+obj.text()+'</a>';
						$('#control-tip-buttons').prepend(Actions);
					}
				});
			},100);
		}
		function draw_editStop(e) {
			$('#control-tip-info').html('Select the Shape to draw on Map or <a href="#" class="btn btn-primary btn-xs" onClick="$(\'#data-importer\').click(); return false;" style="color:white;">click here to import</a> gpx, json or kml.');
			$('#control-tip-buttons').text('');
		}
		
		function tipButtonsclick(index) {
			var action = undefined;
			$('.leaflet-draw-actions').each(function(index) {
				if($(this).css('display') == 'block') {
					action = $(this);
				}
			});
			
			if(action) {
				action.find('a')[index].click();
			}
			
			return false;
		}
	</script>
	
	
	<script>
		map.on('zoomend', function() {
			$('#zoom, #disabled-zoom').val(map.getZoom());
			updateMap();
		});
		
		$('#edit_overlay').click(function(e){
			e.preventDefault()
			var overlay = '\
				<div class="table-responsive" id="overlay_modal">\
					<table class="table table-striped table-bordered table-hover">\
						<tbody>\
							<tr>\
								<td>Title</td>\
								<td><input class="form-control" placeholder="Enter Overlay Title" id="edit_overlay_title" autocomplete="off"></td>\
							</tr>\
							<tr>\
								<td>Blurb</td>\
								<td><input class="form-control" placeholder="Enter Overlay Blurb (Optional)" id="edit_overlay_blurb" autocomplete="off"></td>\
							</tr>\
							<tr>\
								<td colspan="2"><textarea class="form-control" style="min-height:100px;" id="edit_overlay_content"></textarea></td>\
							</tr>\
						</tbody>\
					</table>\
				</div>\
			';
			var dd = BootstrapDialog.show({
				title: 'Update Overlay',
				message: overlay,
				buttons: [{
					label: '',
					icon: 'fa fa-check',
					cssClass: 'btn-primary',
					action: function(dialog) {
						overlayTitle   = $('#edit_overlay_title').val();
						overlayBlurb   = $('#edit_overlay_blurb').val();
						overlayContent = tinyMCE.get('edit_overlay_content').getContent();
						
						updateMap();
						dialog.close();
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
			
			setTimeout(function(){
				tinyMCEInit();
				setTimeout(function(){
					tinyMCE.get('edit_overlay_content').setContent($('<textarea/>').html(overlayContent).val());
					$('#edit_overlay_title').val(overlayTitle);
					$('#edit_overlay_blurb').val(overlayBlurb);
				}, 500);
			}, 300);
			
			dd.getModal().removeAttr('tabindex');
		});
		
		$('#edit_legend').click(function(e){
			e.preventDefault()
			var legend = '\
				<textarea class="form-control" style="min-height:100px;" id="edit_legend_content"></textarea>\
			';
			var dd = BootstrapDialog.show({
				title: 'Update Legend',
				message: legend,
				buttons: [{
					label: '',
					icon: 'fa fa-check',
					cssClass: 'btn-primary',
					action: function(dialog) {
						legendContent = tinyMCE.get('edit_legend_content').getContent();
						updateMap();
						dialog.close();
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
			
			setTimeout(function(){
				tinyMCEInit();
				setTimeout(function(){
					tinyMCE.get('edit_legend_content').setContent($('<textarea/>').html(legendContent).val());
				}, 500);
			}, 300);
			
			dd.getModal().removeAttr('tabindex');
		});
	</script>
	
	
	<script>
		function toggleCluster() {
			layers = featureGroup.getLayers();
			map.removeLayer(featureGroup);
			
			if(isClusterGroup) {
				featureGroup = new L.FeatureGroup();
			}
			else {
				featureGroup = new L.MarkerClusterGroup();
			}
			
			$.each(layers, function(index, layer) {
				featureGroup.addLayer(layer);
			});
			
			isClusterGroup = !isClusterGroup;
			map.addLayer(featureGroup);
			
			$('.leaflet-control-layers form.leaflet-control-layers-list input[type=checkbox]').click();
		}
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
			if($('.exhibit').css('right') == '0px') { //close the IntroBox
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
	</script>
	
	
	
	
	
	
	
	<script>
		$("#edit_image_overlays").click(function(e) {
			e.preventDefault();
			
			var overlays = '\
				<div class="table-responsive" id="image_overlays_modal">\
					<table class="table table-striped table-bordered table-hover">\
						<thead>\
							<tr>\
								<th>\
									Overlay Name\
								</th>\
								<th>\
									Selected Image\
								</th>\
								<th>\
									Bounds\
								</th>\
								<th>\
									Pop-Up Contents\
								</th>\
								<th>\
									Remove\
								</th>\
							</tr>\
						</thead>\
						<tbody>\
							\
						</tbody>\
					</table>\
					<button type="button" onClick="$(\'#image_overlays_upload\').click(); return false;" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add Overlay</button>\
					<form method="post" id="image-overlays-form" style="display:none;" enctype="multipart/form-data"><input type="file" name="image_overlays_file" id="image_overlays_upload" accept="image/*"/></form>\
				</div>\
			';
			
			BootstrapDialog.show({
				title: 'Add/Remove Image Overlays',
				message: overlays,
				buttons: [{
					label: 'Save',
					icon: 'fa fa-check',
					cssClass: 'btn-primary',
					action: function(dialog) {
						isOk = true;
						$('#image_overlays_modal tbody tr').each(function(index, obj) {
							if($(this).find('.image_overlays_bounds_input').val() == '') {
								isOk = false;
								$(this).css('boder','2px solid #f05050;');
							}
							else {
								$(this).css('boder','');
							}
						});
						if(!isOk) {
							Alert("Please Select the Coordinates for all the overlays","error");
							return false;
						}
						
						imageOverlays = [];
						$('#image_overlays_modal tbody tr').each(function(index, obj) {
							temp = {};
							temp['name'] = $(this).find('.image_overlays_name').val();
							temp['src'] = $(this).find('.image_overlays_img').attr('src');
							temp['bounds'] = $(this).find('.image_overlays_bounds_input').val();
							temp['popupcontent'] = $(this).find('.image_overlays_popupcontent_input').html();
							
							imageOverlays.push(temp);
						});
						
						imageOverlaysUpdate(true);
						dialog.close();
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
			
			setTimeout(function(){
				$.each(imageOverlays, function(key, value) {
					$('#image_overlays_modal tbody').append('\
						<tr>\
							<td>\
								<input type="text" class="form-control image_overlays_name" value="'+value.name+'"/>\
							</td>\
							<td>\
								<img src="'+value.src+'" class="image_overlays_img" style="height:60px;width:100px" alt="'+value.name+'" title="'+value.name+'"/>\
							</td>\
							<td>\
								<a href="#" onClick="return image_overlays_bounds_click(this)" class="btn btn-info"><i class="fa fa-edit"></i> Set Image Coordinates</a>\
								<input type="hidden" class="image_overlays_bounds_input" value="'+value.bounds+'"/>\
							</td>\
							<td>\
								<a href="#" onClick="return image_overlays_popupcontent_click(this)" class="btn btn-info"><i class="fa fa-edit"></i> Set Pop-Up Content</a>\
								<div style="display:none;" class="image_overlays_popupcontent_input">'+value.popupcontent+'</div>\
							</td>\
							<td>\
								<button class="btn btn-danger" onClick="$(this).parent().parent().remove();"><i class="fa fa-remove"></i></button>\
							</td>\
						</tr>\
					');
				});
				
				$('#image_overlays_upload').change(function(){
					if($(this).val() != "") {
						progressBar = createProgressBar();
						var formData = new FormData($('form#image-overlays-form')[0]);
						$.ajax({
							url: 'processor/image-overlays/index.php',  //Server script to process data
							type: 'POST',
							xhr: function() {  // Custom XMLHttpRequest
								var myXhr = $.ajaxSettings.xhr();
								if(myXhr.upload){ // Check if upload property exists
									myXhr.upload.addEventListener('progress',function(e){
										if(e.lengthComputable){
											updateProgressBar(progressBar, Math.floor((e.loaded/e.total)*100));
										}
									}, false); // For handling the progress of the upload
								}
								return myXhr;
							},
							success: function(data) {
								data = JSON.parse(data);
								if(data.success) {
									$('#image_overlays_modal tbody').append('\
										<tr>\
											<td>\
												<input type="text" class="form-control image_overlays_name" value="'+data.name+'"/>\
											</td>\
											<td>\
												<img src="'+BASEURL+data.src+'" class="image_overlays_img" style="height:60px;width:100px" alt="'+data.name+'" title="'+data.name+'"/>\
											</td>\
											<td>\
												<a href="#" onClick="return image_overlays_bounds_click(this)" class="btn btn-info"><i class="fa fa-edit"></i> Set Image Coordinates</a>\
												<input type="hidden" class="image_overlays_bounds_input" value=""/>\
											</td>\
											<td>\
												<a href="#" onClick="return image_overlays_popupcontent_click(this)" class="btn btn-info"><i class="fa fa-edit"></i> Set Pop-Up Content</a>\
												<div style="display:none;" class="image_overlays_popupcontent_input"></div>\
											</td>\
											<td>\
												<button class="btn btn-danger" onClick="$(this).parent().parent().remove();"><i class="fa fa-remove"></i></button>\
											</td>\
										</tr>\
									').hide().slideDown();
								}
								else {
									Alert(data.message);
								}
							},
							error: function(e){
								Alert("Error While Uploading the file", "error");
								progressBar.close();
							},
							// Form data
							data: formData,
							//Options to tell jQuery not to process data or worry about content-type.
							cache: false,
							contentType: false,
							processData: false
						});
					}
					
					$(this).val('');
				});
			}, 200);
		});
		
		var globalTempBoundsObj = null;
		var globalTempPopupcontentObj = null;
		var image_overlays_get_coordinatesObj = null;
		var image_overlays_lat_lng = [];
		
		function image_overlays_popupcontent_click(obj) {
			globalTempPopupcontentObj = obj;
			var content = '\
				<div class="table-responsive" id="image_overlays_modal">\
					<table class="table table-striped table-bordered table-hover">\
						<tr>\
							<td>\
								<textarea id="imageOverlayPopupContentInput"></textarea>\
							</td>\
						</tr>\
					</table>\
				</div>\
			';
			
			BootstrapDialog.show({
				title: 'Enter the Popup Content',
				message: content,
				buttons: [{
					label: 'Save',
					icon: 'fa fa-check',
					cssClass: 'btn-primary',
					action: function(dialog) {
						con = $(globalTempPopupcontentObj).parent().find('.image_overlays_popupcontent_input');
						$(con).html(tinyMCE.get('imageOverlayPopupContentInput').getContent());
						dialog.close();
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
			
			setTimeout(function(){
				con = $(globalTempPopupcontentObj).parent().find('.image_overlays_popupcontent_input').html();
				$('#imageOverlayPopupContentInput').html(con);
				
				tinyMCEInit();
			}, 300);
		}
		
		function image_overlays_bounds_click(obj) {
			globalTempBoundsObj = obj;
			var bounds = '\
				<div class="table-responsive" id="image_overlays_modal">\
					<table class="table table-striped table-bordered table-hover">\
						<tr>\
							<th>\
								Bottom Left Coordinates\
							</th>\
							<td>\
								<input type="text" id="latitudeBL" placeholder="Latitude" class="form-control"/>\
							</td>\
							<td>\
								<input type="text" id="longitudeBL" placeholder="Longitude" class="form-control"/>\
							</td>\
							<td>\
								<a href="#" onClick="return false;" class="btn btn-info btn-xs image_overlays_get_coordinates">Populate Coordinates</a>\
							</td>\
						</tr>\
						<tr>\
							<th>\
								Upper Right Coordinates\
							</th>\
							<td>\
								<input type="text" id="latitudeUR" placeholder="Latitude" class="form-control"/>\
							</td>\
							<td>\
								<input type="text" id="longitudeUR" placeholder="Longitude" class="form-control"/>\
							</td>\
							<td>\
								<a href="#" onClick="return false;" class="btn btn-info btn-xs image_overlays_get_coordinates">Populate Coordinates</a>\
							</td>\
						</tr>\
					</table>\
				</div>\
			';
			
			BootstrapDialog.show({
				title: 'Enter the Image Coordinates',
				message: bounds,
				buttons: [{
					label: 'Save',
					icon: 'fa fa-check',
					cssClass: 'btn-primary',
					action: function(dialog) {
						if(!parseFloat($('#latitudeUR').val()) ||
						!parseFloat($('#longitudeUR').val()) ||
						!parseFloat($('#latitudeBL').val()) ||
						!parseFloat($('#longitudeBL').val())) {
							Alert("Please Enter the correct Coordinates", "error");
						}
						else{
							bnds = [];
							bnds.push(new Array(parseFloat($('#latitudeBL').val()),parseFloat($('#longitudeBL').val())));
							bnds.push(new Array(parseFloat($('#latitudeUR').val()),parseFloat($('#longitudeUR').val())));
							
							$(globalTempBoundsObj).parent().find('.image_overlays_bounds_input').val(JSON.stringify(bnds));
							dialog.close();
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
			
			setTimeout(function(){
				val = $(globalTempBoundsObj).parent().find('.image_overlays_bounds_input').val();
				if(val) {
					val = JSON.parse(val);
					$('#latitudeUR').val(val[1][1]);
					$('#longitudeUR').val(val[1][0]);
					
					$('#latitudeBL').val(val[0][1]);
					$('#longitudeBL').val(val[0][0]);
				}
				
				$('.image_overlays_get_coordinates').click(function() {
					image_overlays_get_coordinatesObj = $(this);
					BootstrapDialog.show({
						title: 'Enter the Address to get coordinates',
						message: '<input id="image_overlays_get_coordinates_get_coordinates" class="form-control"/>',
						buttons: [{
							label: '',
							icon: 'fa fa-check',
							cssClass: 'btn-primary',
							action: function(dialog) {
								$($(image_overlays_get_coordinatesObj).parent().parent().find('input')[0]).val(image_overlays_lat_lng[0]);
								$($(image_overlays_get_coordinatesObj).parent().parent().find('input')[1]).val(image_overlays_lat_lng[1]);
								
								dialog.close();
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
					
					setTimeout(function(){
						autocomplete = new google.maps.places.Autocomplete((document.getElementById("image_overlays_get_coordinates_get_coordinates")),{ types: ["geocode"] });
						google.maps.event.addListener(autocomplete, "place_changed", function() {
							lat = autocomplete.getPlace().geometry.location.lat();
							lng = autocomplete.getPlace().geometry.location.lng();
							
							image_overlays_lat_lng = [];
							
							image_overlays_lat_lng.push(lat);
							image_overlays_lat_lng.push(lng);
						});
					}, 200);
				});
			}, 200);
			
			return false;
		}
		
		
		$('#edit_static_sidebar_content').click(function(e){
			e.preventDefault()
			var ssidebar = '\
				<textarea class="form-control" style="min-height:100px;" id="edit_static_sidebar_content_textarea"></textarea>\
			';
			var dd = BootstrapDialog.show({
				title: 'Update IntroBox',
				message: ssidebar,
				buttons: [{
					label: '',
					icon: 'fa fa-check',
					cssClass: 'btn-primary',
					action: function(dialog) {
						staticSidebarContent = tinyMCE.get('edit_static_sidebar_content_textarea').getContent();
						updateMap();
						dialog.close();
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
			
			setTimeout(function(){
				$('#edit_static_sidebar_content_textarea').val($('<textarea/>').html(staticSidebarContent).val());
				tinyMCEInit('edit_static_sidebar_content_textarea');
			}, 300);
			
			dd.getModal().removeAttr('tabindex');
		});
		
		
		$('#edit_map_bounds').click(function(e){
			e.preventDefault()
			
			var latitudeSW = "";
			var longitudeSW = "";
			var latitudeNE = "";
			var longitudeNE = "";
			
			if(MapBounds.length == 2) {
				latitudeSW = MapBounds[0][0];
				longitudeSW = MapBounds[0][1];
				latitudeNE = MapBounds[1][0];
				longitudeNE = MapBounds[1][1];
			}
			
			var bounds = '\
				<div class="table-responsive" id="image_overlays_modal">\
					<table class="table table-striped table-bordered table-hover">\
						<tr>\
							<th>\
								South West Coordinates\
							</th>\
							<td>\
								<input type="text" id="latitudeSW" placeholder="Latitude" value="'+latitudeSW+'" class="form-control"/>\
							</td>\
							<td>\
								<input type="text" id="longitudeSW" placeholder="Longitude" value="'+longitudeSW+'" class="form-control"/>\
							</td>\
							<td>\
								<a href="#" onClick="return false;" class="btn btn-info btn-xs image_overlays_get_coordinates">Populate Coordinates</a>\
							</td>\
						</tr>\
						<tr>\
							<th>\
								North East Coordinates\
							</th>\
							<td>\
								<input type="text" id="latitudeNE" placeholder="Latitude" value="'+latitudeNE+'" class="form-control"/>\
							</td>\
							<td>\
								<input type="text" id="longitudeNE" placeholder="Longitude" value="'+longitudeNE+'" class="form-control"/>\
							</td>\
							<td>\
								<a href="#" onClick="return false;" class="btn btn-info btn-xs image_overlays_get_coordinates">Populate Coordinates</a>\
							</td>\
						</tr>\
					</table>\
				</div>\
			';
			var dd = BootstrapDialog.show({
				title: 'Set the Map Bounds',
				message: bounds,
				buttons: [{
					label: '',
					icon: 'fa fa-check',
					cssClass: 'btn-primary',
					action: function(dialog) {
						if(parseFloat($('#latitudeSW').val()) &&
							parseFloat($('#longitudeSW').val()) &&
							parseFloat($('#latitudeNE').val()) &&
							parseFloat($('#longitudeNE').val())) {
							
							MapBounds = new Array();
							MapBounds.push([parseFloat($('#latitudeSW').val()), parseFloat($('#longitudeSW').val())]);
							MapBounds.push([parseFloat($('#latitudeNE').val()), parseFloat($('#longitudeNE').val())]);
							
							updateMap();
							dialog.close();
						}
						else {
							MapBounds = new Array();
							
							updateMap();
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
			
			setTimeout(function(){
				$('.image_overlays_get_coordinates').click(function() {
					image_overlays_get_coordinatesObj = $(this);
					BootstrapDialog.show({
						title: 'Enter the Address to get coordinates',
						message: '<input id="image_overlays_get_coordinates_get_coordinates" class="form-control"/>',
						buttons: [{
							label: '',
							icon: 'fa fa-check',
							cssClass: 'btn-primary',
							action: function(dialog) {
								$($(image_overlays_get_coordinatesObj).parent().parent().find('input')[0]).val(image_overlays_lat_lng[0]);
								$($(image_overlays_get_coordinatesObj).parent().parent().find('input')[1]).val(image_overlays_lat_lng[1]);
								
								dialog.close();
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
					
					setTimeout(function(){
						autocomplete = new google.maps.places.Autocomplete((document.getElementById("image_overlays_get_coordinates_get_coordinates")),{ types: ["geocode"] });
						google.maps.event.addListener(autocomplete, "place_changed", function() {
							lat = autocomplete.getPlace().geometry.location.lat();
							lng = autocomplete.getPlace().geometry.location.lng();
							
							image_overlays_lat_lng = [];
							
							image_overlays_lat_lng.push(lat);
							image_overlays_lat_lng.push(lng);
						});
					}, 200);
				});
			}, 500);
			
			dd.getModal().removeAttr('tabindex');
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
</div>