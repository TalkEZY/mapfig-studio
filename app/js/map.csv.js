// Xeditable Demo
// ----------------------------------- 

(function(window, document, $, undefined){
    
    $(function(){
		
		var nameVal;
		var zoomVal;
		var heightVal;
		var widthVal;
		
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

       // TABLE
       // ----------------------------------- 

	   $('#map a#name').editable({
			url: 'processor/csv-map-edit/index.php',
            type: 'text',
			validate: function(value) {
				if($.trim(value) === '') return 'This field is required';
				nameVal = $.trim(value);
			},
            name: 'name',
			error: function(xhr) {
				if(xhr.status == 500) return 'Internal server error';  
			},
			success: function(data) {
				if(data != "")
					return data;
				$('input[name=map-name]').val(nameVal);
			}
        });
		$('#map a#height').editable({
			url: 'processor/csv-map-edit/index.php',
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
				$('input[name=map-height]').val(heightVal);
			}
        });
		$('#map a#width').editable({
			url: 'processor/csv-map-edit/index.php',
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
				$('input[name=map-width]').val(widthVal);
			}
        });
		
		$('#map a#zoom').editable({
			url: 'processor/csv-map-edit/index.php',
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
				$('input[name=map-zoom]').val(zoomVal);
			}
        });
		
		$('#map a#password').editable({
			url: 'processor/csv-map-edit/index.php',
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
				$('input[name=map-password]').val(passwordVal);
			}
        });
    });

})(window, document, window.jQuery);
