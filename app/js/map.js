// Xeditable Demo
// ----------------------------------- 

(function(window, document, $, undefined){
    
    $(function(){
		
		var zoomVal;
		var heightVal;
		var widthVal;
		var buttonstyleVal;
		var setMarkerVal;
		var showSidebarVal;
		var showMeasureVal;
		var showMiniMapVal;
		var showPlayBackVal;
		var showStaticSidebarVal;
		var showSVGVal;
		var clusterVal;
		var setGroupToOpenVal;
		
		var setOverlayEnable;
		var setLegendEnable;
		var setShowExport;
		
        // Font Awesome support
        $.fn.editableform.buttons =
          '<button type="submit" class="btn btn-primary btn-sm editable-submit">'+
            '<i class="fa fa-fw fa-check"></i>'+
          '</button>'+
          '<button type="button" class="btn btn-default btn-sm editable-cancel">'+
            '<i class="fa fa-fw fa-times"></i>'+
          '</button>';

       //defaults
       $.fn.editable.defaults.url = '../server/xeditable.res';

        //enable / disable
       $('#enable').click(function() {
           $('#user .editable').editable('toggleDisabled');
       });
        
        //editables 
        $('#username').editable({
               url: '../server/xeditable.res',
               type: 'text',
               pk: 1,
               name: 'username',
               title: 'Enter username'
        });
        
        $('#firstname').editable({
            validate: function(value) {
               if($.trim(value) === '') return 'This field is required';
            }
        });
        
        $('#sex').editable({
            prepend: "not selected",
            source: [
                {value: 1, text: 'Male'},
                {value: 2, text: 'Female'}
            ],
            display: function(value, sourceData) {
                 var colors = {"": "gray", 1: "green", 2: "blue"},
                     elem = $.grep(sourceData, function(o){return o.value == value;});
                     
                 if(elem.length) {
                     $(this).text(elem[0].text).css("color", colors[value]);
                 } else {
                     $(this).empty();
                 }
            }
        });
        
        $('#status').editable();
        
        $('#group').editable({
           showbuttons: false
        });
            
        $('#dob').editable();
              
        $('#event').editable({
            placement: 'right',
            combodate: {
                firstItem: 'name'
            }
        });
               
        $('#comments').editable({
            showbuttons: 'bottom'
        });
        
        $('#note').editable();
        $('#pencil').click(function(e) {
            e.stopPropagation();
            e.preventDefault();
            $('#note').editable('toggle');
       });
        
       $('#fruits').editable({
           pk: 1,
           limit: 3,
           source: [
            {value: 1, text: 'banana'},
            {value: 2, text: 'peach'},
            {value: 3, text: 'apple'},
            {value: 4, text: 'watermelon'},
            {value: 5, text: 'orange'}
           ]
        });
             
       $('#user .editable').on('hidden', function(e, reason){
            if(reason === 'save' || reason === 'nochange') {
                var $next = $(this).closest('tr').next().find('.editable');
                if($('#autoopen').is(':checked')) {
                    setTimeout(function() {
                        $next.editable('show');
                    }, 300);
                } else {
                    $next.focus();
                }
            }
       });
       
       // TABLE
       // ----------------------------------- 

	   $('#map a#name').editable({
			url: 'processor/map-edit/index.php',
            type: 'text',
			validate: function(value) {
				if($.trim(value) === '') return 'This field is required';
			},
            name: 'name',
			error: function(xhr) {
				if(xhr.status == 500) return 'Internal server error';  
			},
			success: function(data) {
				if(data != "")
					return data;
			}
        });
		$('#map a#height').editable({
			url: 'processor/map-edit/index.php',
            type: 'text',
			validate: function(value) {
				if($.trim(value) === '') return 'This field is required';
				if(!$.isNumeric($.trim(value))) return 'Please enter Numeric Value';
				heightVal = $.trim(value);
			},
            name: 'height',
            title: 'Enter Map Height',
			error: function(xhr) {
				if(xhr.status == 500) return 'Internal server error';  
			},
			success: function(data) {
				if(data != "")
					return data;
				
				map._sizeChanged = true
				$('#map_canvas').css('height',heightVal);
				
				showStaticSidebarUpdate();
				staticSidebarPopupResize();
			}
        });
		$('#map a#width').editable({
			url: 'processor/map-edit/index.php',
            type: 'text',
			validate: function(value) {
				if($.trim(value) === '') return 'This field is required';
				if(!$.isNumeric($.trim(value))) return 'Please enter Numeric Value';
				widthVal = $.trim(value);
			},
            name: 'width',
            title: 'Enter Map Width',
			error: function(xhr) {
				if(xhr.status == 500) return 'Internal server error';  
			},
			success: function(data) {
				if(data != "")
					return data;
				
				map._sizeChanged = true
				$('#map_canvas').css('width',widthVal);
				showStaticSidebarUpdate();
			}
        });
		
		/*$('#map a#zoom').editable({
			url: 'processor/map-edit/index.php',
            type: 'text',
			validate: function(value) {
				if($.trim(value) === '') return 'This field is required';
				if(!$.isNumeric($.trim(value))) return 'Please enter Numeric Value';
				zoomVal = $.trim(value);
			},
            name: 'zoom',
            title: 'Map Zoom (0 - 18)',
			error: function(xhr) {
				if(xhr.status == 500) return 'Internal server error';  
			},
			success: function(data) {
				if(data != "")
					return data;
				map.setZoom(zoomVal);
				updateMap();
			}
        });*/
		
		$('#map a#defaultopen').editable({
			url: 'processor/map-edit/index.php',
			validate: function(value) {
				if($.trim(value) === '') return 'This field is required';
				setMarkerVal = ($.trim(value) == 't');
				
			},
            source: [
				{value: '', text: '[Select]'},
				{value: 't', text: 'Yes'},
				{value: 'f', text: 'No'}
			],
			error: function(xhr) {
				if(xhr.status == 500) return 'Internal server error';  
			},
			success: function(data) {
				if(data != "")
					return data;
				set_marker = setMarkerVal;
				updateMap();
			}
        });
		$('#map a#showsidebar').editable({
			url: 'processor/map-edit/index.php',
			validate: function(value) {
				if($.trim(value) === '') return 'This field is required';
				showSidebarVal = ($.trim(value) == 't');
			},
            source: [
				{value: '', text: '[Select]'},
				{value: 't', text: 'Yes'},
				{value: 'f', text: 'No'}
			],
			error: function(xhr) {
				if(xhr.status == 500) return 'Internal server error';  
			},
			success: function(data) {
				if(data != "")
					return data;
				show_sidebar = showSidebarVal;
				updateMap();
			}
        });
		
		$('#map a#show_measure').editable({
			url: 'processor/map-edit/index.php',
			validate: function(value) {
				if($.trim(value) === '') return 'This field is required';
				showMeasureVal = ($.trim(value) == 't');
			},
            source: [
				{value: '', text: '[Select]'},
				{value: 't', text: 'Yes'},
				{value: 'f', text: 'No'}
			],
			error: function(xhr) {
				if(xhr.status == 500) return 'Internal server error';  
			},
			success: function(data) {
				if(data != "")
					return data;
				isShowMeasure = showMeasureVal;
				updateMap();
			}
        });
		
		$('#map a#show_minimap').editable({
			url: 'processor/map-edit/index.php',
			validate: function(value) {
				if($.trim(value) === '') return 'This field is required';
				showMiniMapVal = ($.trim(value) == 't');
			},
            source: [
				{value: '', text: '[Select]'},
				{value: 't', text: 'Yes'},
				{value: 'f', text: 'No'}
			],
			error: function(xhr) {
				if(xhr.status == 500) return 'Internal server error';  
			},
			success: function(data) {
				if(data != "")
					return data;
				isShowMiniMap = showMiniMapVal;
				updateMap();
			}
        });
		
		$('#map a#show_playback').editable({
			url: 'processor/map-edit/index.php',
			validate: function(value) {
				if($.trim(value) === '') return 'This field is required';
				showPlayBackVal = ($.trim(value) == 't');
			},
            source: [
				{value: '', text: '[Select]'},
				{value: 't', text: 'Yes'},
				{value: 'f', text: 'No'}
			],
			error: function(xhr) {
				if(xhr.status == 500) return 'Internal server error';  
			},
			success: function(data) {
				if(data != "")
					return data;
				isShowPlayBack = showPlayBackVal;
				updateMap();
			}
        });
		
		$('#map a#show_static_sidebar').editable({
			url: 'processor/map-edit/index.php',
			validate: function(value) {
				if($.trim(value) === '') return 'This field is required';
				showStaticSidebarVal = ($.trim(value) == 't');
			},
            source: [
				{value: '', text: '[Select]'},
				{value: 't', text: 'Yes'},
				{value: 'f', text: 'No'}
			],
			error: function(xhr) {
				if(xhr.status == 500) return 'Internal server error';  
			},
			success: function(data) {
				if(data != "")
					return data;
				isShowStaticSidebar = showStaticSidebarVal;
				updateMap();
			}
        });
		
		$('#map a#show_svg').editable({
			url: 'processor/map-edit/index.php',
			validate: function(value) {
				if($.trim(value) === '') return 'This field is required';
				showSVGVal = ($.trim(value) == 't');
			},
            source: [
				{value: '', text: '[Select]'},
				{value: 't', text: 'Yes'},
				{value: 'f', text: 'No'}
			],
			error: function(xhr) {
				if(xhr.status == 500) return 'Internal server error';  
			},
			success: function(data) {
				if(data != "")
					return data;
				isShowSVG = showSVGVal;
				showSVGUpdate();
			}
        });
		
		$('#map a#show_search').editable({
			url: 'processor/map-edit/index.php',
			validate: function(value) {
				if($.trim(value) === '') return 'This field is required';
				showSearchVal = ($.trim(value) == 't');
			},
            source: [
				{value: '', text: '[Select]'},
				{value: 't', text: 'Yes'},
				{value: 'f', text: 'No'}
			],
			error: function(xhr) {
				if(xhr.status == 500) return 'Internal server error';  
			},
			success: function(data) {
				if(data != "")
					return data;
				isShowSearch = showSearchVal;
				updateMap();
			}
        });
		
		$('#map a#show_filelayer').editable({
			url: 'processor/map-edit/index.php',
			validate: function(value) {
				if($.trim(value) === '') return 'This field is required';
				showFileLayerVal = ($.trim(value) == 't');
			},
            source: [
				{value: '', text: '[Select]'},
				{value: 't', text: 'Yes'},
				{value: 'f', text: 'No'}
			],
			error: function(xhr) {
				if(xhr.status == 500) return 'Internal server error';  
			},
			success: function(data) {
				if(data != "")
					return data;
				isShowFileLayer = showFileLayerVal;
				updateMap();
			}
        });
		
		$('#map a#cluster').editable({
			url: 'processor/map-edit/index.php',
			validate: function(value) {
				if($.trim(value) === '') return 'This field is required';
				clusterVal = ($.trim(value) == 't');
			},
            source: [
				{value: 't', text: 'Yes'},
				{value: 'f', text: 'No'}
			],
			error: function(xhr) {
				if(xhr.status == 500) return 'Internal server error';  
			},
			success: function(data) {
				if(data != "")
					return data;
				
				//toggleCluster();
			}
        });
		
		$('#map a#setgrouptoopen').editable({
			url: 'processor/map-edit/index.php',
			validate: function(value) {
				if($.trim(value) === '') return 'This field is required';
				setGroupToOpenVal = ($.trim(value) == 't');
				
			},
            source: [
				{value: '', text: '[Select]'},
				{value: 't', text: 'Yes'},
				{value: 'f', text: 'No'}
			],
			error: function(xhr) {
				if(xhr.status == 500) return 'Internal server error';  
			},
			success: function(data) {
				if(data != "")
					return data;
				setgrouptoopen = setGroupToOpenVal;
				updateMap();
			}
        });
		
		$('#map a#password').editable({
			url: 'processor/map-edit/index.php',
            type: 'text',
            validate: function(value) {
				passwordVal = value;
			},
			name: 'password',
			error: function(xhr) {
				if(xhr.status == 500) return 'Internal server error';  
			},
			success: function(data) {
				if(data != "")
					return data;
			}
        });
		
		$('#map a#button_style').editable({
			url: 'processor/map-edit/index.php',
			validate: function(value) {
				buttonstyleVal = value;
			},
            source: [
				{value: 'default', text: 'White'},
				{value: 'info', text: 'Lignt Blue'},
				{value: 'primary', text: 'Dark Blue'},
				{value: 'warning', text: 'Yellow'},
				{value: 'success', text: 'Green'},
				{value: 'danger', text: 'Red'}
			],
			error: function(xhr) {
				if(xhr.status == 500) return 'Internal server error';  
			},
			success: function(data) {
				if(data != "")
					return data;
				
				buttonStyle = buttonstyleVal;
				updateMap();
			}
        });
		
		
		$('#map a#overlay_enable').editable({
			url: 'processor/map-edit/index.php',
			validate: function(value) {
				if($.trim(value) === '') return 'This field is required';
				setOverlayEnable = ($.trim(value) == 't');
				
			},
            source: [
				{value: 't', text: 'Yes'},
				{value: 'f', text: 'No'}
			],
			error: function(xhr) {
				if(xhr.status == 500) return 'Internal server error';  
			},
			success: function(data) {
				if(data != "")
					return data;
				
				isOverlayEnable = setOverlayEnable;
				updateMap();
			}
        });
		
		$('#map a#legend_enable').editable({
			url: 'processor/map-edit/index.php',
			validate: function(value) {
				if($.trim(value) === '') return 'This field is required';
				setLegendEnable = ($.trim(value) == 't');
			},
            source: [
				{value: 't', text: 'Yes'},
				{value: 'f', text: 'No'}
			],
			error: function(xhr) {
				if(xhr.status == 500) return 'Internal server error';  
			},
			success: function(data) {
				if(data != "")
					return data;
				
				isLegendEnable = setLegendEnable;
				updateMap();
			}
        });
		
		$('#map a#show_export').editable({
			url: 'processor/map-edit/index.php',
			validate: function(value) {
				if($.trim(value) === '') return 'This field is required';
				setShowExport = ($.trim(value) == 't');
				
			},
            source: [
				{value: 't', text: 'Yes'},
				{value: 'f', text: 'No'}
			],
			error: function(xhr) {
				if(xhr.status == 500) return 'Internal server error';  
			},
			success: function(data) {
				if(data != "")
					return data;
				
				isShowExport = setShowExport;
				updateMap();
			}
        });
		
    });

})(window, document, window.jQuery);
