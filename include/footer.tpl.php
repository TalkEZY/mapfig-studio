	<!-- Page footer-->
      <footer>
        <span><?=COPYRIGHT_TEXT?></span>
      </footer>
	
	
	<script>
		function startHelpWizard() {
			BootstrapDialog.show({
				size: 'large',
				title: 'Help Wizard',
				message: helpWizardContent,
				buttons: [{
					label: '',
					icon: 'fa fa-check',
					cssClass: 'btn-primary',
					action: function(dialog) {
						
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
				$('.tabbable').closest('.modal-dialog').css('width','800px');
			}, 200);
			
			return false;
		}
	</script>
	
	
	<style>
		/* custom inclusion of right, left and below tabs */
		
		.tabs-left > .nav-tabs {
		  border-bottom: 0;
		}

		.tab-content > .tab-pane,
		.pill-content > .pill-pane {
		  display: none;
		}

		.tab-content > .active,
		.pill-content > .active {
		  display: block;
		}
		
		.tabs-left > .nav-tabs > li {
		  float: none;
		}

		.tabs-left > .nav-tabs > li > a {
		  min-width: 74px;
		  margin-right: 0;
		  margin-bottom: 3px;
		}

		.tabs-left > .nav-tabs {
		  float: left;
		  margin-right: 19px;
		  border-right: 1px solid #ddd;
		}

		.tabs-left > .nav-tabs > li > a {
		  margin-right: -1px;
		  -webkit-border-radius: 4px 0 0 4px;
			 -moz-border-radius: 4px 0 0 4px;
				  border-radius: 4px 0 0 4px;
		}

		.tabs-left > .nav-tabs > li > a:hover,
		.tabs-left > .nav-tabs > li > a:focus {
		  border-color: #eeeeee #dddddd #eeeeee #eeeeee;
		}

		.tabs-left > .nav-tabs .active > a,
		.tabs-left > .nav-tabs .active > a:hover,
		.tabs-left > .nav-tabs .active > a:focus {
		  border-color: #ddd transparent #ddd #ddd;
		  *border-right-color: #ffffff;
		}
	</style>