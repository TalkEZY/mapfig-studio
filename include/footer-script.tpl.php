	<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.2/js/bootstrap-dialog.js'></script>
	<link href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.2/css/bootstrap-dialog.css' rel='stylesheet' />
	
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
		
		$('a.btn.btn-danger').click(function(e){
			var text = $.trim($(this).text());
			
			if(text == "Remove" || text == "Delete" || $(this).find('i.fa.fa-remove').length == 1) {
				var href = $(this).attr('href');
				e.preventDefault();
				
				BootstrapDialog.confirm("Are you Sure you want to delete it?", function(result){
					if(result) {
						window.location = href;
					}
				});
			}
		});
	</script>