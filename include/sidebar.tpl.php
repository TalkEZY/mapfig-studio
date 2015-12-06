<?PHP $user = getUserInfo(); ?>

<?PHP
	if(isset($_SESSION['user']['switcher_id']) && $user['id'] != $_SESSION['user']['switcher_id']) {
	$u = getUserInfo($_SESSION['user']['switcher_id']);
?>
	<div style="direction: ltr; color: #DBDBDB; font: 400 13px/32px &quot;Open Sans&quot;,sans-serif; height: 32px; position: fixed; top: 0; left: 0; width: 100%; min-width: 600px; z-index: 99999; background: #222;" class="col-lg-12">
		<span class="pull-left">You're logged in as </span> <b style="font-weight: 900;">&nbsp;<?=$user['firstname'].' '.$user['lastname']?>&nbsp;</b> Switch back to <a href="switch.php"><b style="font-weight: 900; text-decoration: none; color: #fff;">&nbsp;<?=$u['firstname'].' '.$u['lastname']?>&nbsp;</b></a>
	</div>
	<style>
		body {
			margin-top: 32px !important;
		}
	</style>
<?PHP } ?>
	<style>
		@media only screen and (min-width: 768px) {
			.aside-collapsed .sidebar > .nav > li > a > span {
				display: block !important;
				font-size: 11px;
			}
			
			.aside-collapsed .wrapper {
				min-height: 1300px;
			}
		}
		
		.sidebar > .nav > li.active, .sidebar > .nav > li.open, .sidebar > .nav > li.active > a, .sidebar > .nav > li.open > a, .sidebar > .nav > li.active .nav, .sidebar > .nav > li.open .nav {
			background-color: #1F1F1F !important;
			color: #FFFFFF !important;
		}
		.sidebar > .nav > li.active > a > em, .sidebar > .nav > li.open > a > em {
			color: #FFFFFF !important;
			font-weight: bolder;
		}
		.aside-collapsed .sidebar > .nav > li > a > span {
			display: block !important;
			font-size: 11px;
			font-weight: bolder !important;
		}
		.sidebar > .nav > li > a:focus, .sidebar > .nav > li > .nav-item:focus, .sidebar > .nav > li > a:hover, .sidebar > .nav > li > .nav-item:hover {
			color: #FFFFFF !important;
			background-color: #1F1F1F !important;
		}
		.sidebar > .nav > li {
			border-left: 0px !important;
			border-bottom: 1px solid #1F1F1F;
		}
		
		@media only screen and (min-width: 768px) {
			.aside-collapsed .wrapper > .aside > .nav-floating ul {
				background: #0f0f0f;
				box-shadow: 0 0 5px 3px rgba(0,0,0,.15);
				border-radius: 6px;
				margin-left: 5px;
				min-width: 150px;
				opacity: 0.95;
				bottom: auto !important;
			}
		}
		.aside-collapsed .wrapper > .aside > .nav-floating {
			bottom: auto !important;
		}
		
		.sidebar-subnav > li > a:focus, .sidebar-subnav > li > .nav-item:focus, .sidebar-subnav > li > a:hover, .sidebar-subnav > li > .nav-item:hover {
			color: #FFFFFF;
		}
		.sidebar-subnav > li > a:focus, .sidebar-subnav > li > a:hover {
			background-color: #000 !important;
			border-radius: 5px;
		}
		.sidebar-subnav > li > a, .sidebar-subnav > li > .nav-item {
			background-color: inherit !important;
			color: #FFFFFF !important;
			padding: 5px 10px !important;
		}
		.sidebar-subnav > li {
			padding: 1px 6px !important;
		}
		.sidebar-subnav > li:first-child {
			padding-top: 5px !important;
		}
		.sidebar-subnav > li:last-child {
			padding-bottom: 5px !important;
		}
		.sidebar-subnav-container.nav-floating:after {
			content: '';
			position: absolute!important;
			top: 48%;
			right: 100%;
			width: 0;
			height: 0;
			left: 0px;
			border-right: 6px solid #0f0f0f;
			border-top: 6px solid transparent;
			border-bottom: 6px solid transparent;
		}
		.sidebar-subnav {
			background-color: #0f0f0f;
		}
		.nav.navbar-nav li:first-child {
			display: none;
		}
		
		.wrapper > .aside {
			z-index: 1014;
		}
		.topnavbar-wrapper .navbar .nav>li>a {
			float: none !important;
			padding: 17px 15px !important;;
			color: white !important;
			text-shadow: none !important;;
		}
		.aside .sidebar [class^="icon-"], .aside .sidebar [class*=" icon-"] {
			height: auto !important;
			vertical-align: middle !important;
			background-image: none !important;
			margin-top: 0 !important;
		}
	</style>

	<!-- sidebar-->
      <aside class="aside">
         <!-- START Sidebar (left)-->
         <div class="aside-inner">
            <nav class="sidebar">
               <!-- START sidebar nav-->
               <ul class="nav">
                  <!-- START user info-->
                  <li class="has-user-block">
                     <div id="user-block" class="collapse">
                        <div class="item user-block">
                           <!-- User picture-->
                           <div class="user-block-picture">
                              <div class="user-block-status">
                                 <!-- DAVID ADD -->
                                 <a href="https://www.<?=MAIN_DOMAIN?>/portal/clientarea.php" target="_blank">
                                 <img src="img/user/02.jpg" alt="Avatar" width="60" height="60" class="img-thumbnail img-circle"></a>
                                 <div class="circle circle-success circle-lg"></div>
                              </div>
                           </div>
                           <!-- Name and Job-->
                           <div class="user-block-info">
                              <span class="user-block-name">Hello, <?=$_SESSION['user']['lastname']?></span>
                              <span class="user-block-role">User</span>
                           </div>
                        </div>
                     </div>
                  </li>
                  <!-- END user info-->
                  <!-- Iterates over all sidebar items-->
                  <li class="nav-heading ">
                     <span>Main Navigation</span>
                  </li>
                  <li <?=($PAGE == "DASHBOARD") ? 'class="active"' : ''?>>
                     <a href="dashboard.php" title="Dashboard">
                        <em class="icon-speedometer"></em>
                        <span data-localize="sidebar.nav.DASHBOARD">Dashboard</span>
                     </a>
                  </li>
				  <li <?=($PAGE == "ACTIVITY") ? 'class="active"' : ''?>>
                     <a href="activity.php" title="Activity">
                        <em class="icon-graph"></em>
                        <span data-localize="sidebar.nav.ACTIVITY">Activity</span>
                     </a>
                  </li>
				 
				  
				   <li <?=(in_array($PAGE, array('VIEW_PROFILE','EDIT_PROFILE', 'CHANGE_PASSWORD')))? 'class="active"' : ''?>>
                     <a href="#profile" title="Profile" data-toggle="collapse">
                        <em class="icon-user"></em>
                        <span data-localize="sidebar.nav.PROFILE">Profile</span>
                     </a>
					 <div class="sidebar-subnav-container">
						 <ul id="profile" class="nav sidebar-subnav collapse">
							<li <?=($PAGE=="VIEW_PROFILE")? 'class="active"' : ''?>>
							   <a href="view_profile.php" title="View Profile">
								  <em></em>
								  <span>View Profile</span>
							   </a>
							</li>
							<li <?=($PAGE=="EDIT_PROFILE")? 'class="active"' : ''?>>
							   <a href="edit_profile.php" title="Edit Profile">
								  <em></em>
								  <span>Edit Profile</span>
							   </a>
							</li>
							<li <?=($PAGE=="CHANGE_PASSWORD")? 'class="active"' : ''?>>
							   <a href="change_password.php" title="Change Password">
								  <em></em>
								  <span>Change Password</span>
							   </a>
							</li>
						 </ul>
					  </div>
                  </li>
				  
				  <li <?=(in_array($PAGE, array('API')))? 'class="active"' : ''?>>
					<a href="api.php" title="API KEY">
					  <em class="icon-key"></em>
					  <span>API KEY</span>
				    </a>
                  </li>




				  <li <?=($PAGE == "CACHE_MANAGER") ? 'class="active"' : ''?>>
                     <a href="cache-manager.php" title="Cache Manager">
                        <em class="fa fa-cogs"></em>
                        <span data-localize="sidebar.nav.CACHE_MANAGER">Cache</span>
                     </a>
                  </li>
				  
				  
				   <?PHP if(isAdmin($user)) { ?>
				  <li <?=(in_array($PAGE, array('USER_VIEW','USER_ADD')))? 'class="active"' : ''?>>
                     <a href="#users" title="Users" data-toggle="collapse">
                        <em class="fa fa-signal"></em>
                        <span data-localize="sidebar.nav.USERS">EndPoints</span>
                     </a>
					 <div class="sidebar-subnav-container">
						 <ul id="users" class="nav sidebar-subnav collapse">
							<li <?=($PAGE=="USER_VIEW")? 'class="active"' : ''?>>
							   <a href="user.php" title="View EndPoints">
								  <em></em>
								  <span>View EndPoints</span>
							   </a>
							</li>
							<li <?=($PAGE=="USER_ADD")? 'class="active"' : ''?>>
							   <a href="user-add.php" title="Add EndPoint">
								  <em></em>
								  <span>Add EndPoint</span>
							   </a>
							</li>
						 </ul>
					  </div>
                  </li>
				  <?PHP } ?>
				  
				  
				  
				 
				  <li <?=(in_array($PAGE, array('VIEW_LAYERS','ADD_LAYERS','EDIT_LAYERS','VIEW_GROUP','ADD_GROUP','EDIT_GROUP','ASSIGN_LAYERS_TO_GROUP')))? 'class="active"' : ''?>>
                     <a href="#layers" title="Layers" data-toggle="collapse">
                        <em class="icon-layers"></em>
                        <span data-localize="sidebar.nav.LAYERS">Base Maps</span>
                     </a>
					 <div class="sidebar-subnav-container">
						 <ul id="layers" class="nav sidebar-subnav collapse">
							<li <?=($PAGE=="VIEW_LAYERS")? 'class="active"' : ''?>>
							   <a href="layers.php" title="View Layers">
								  <em></em>
								  <span>View Base Maps</span>
							   </a>
							</li>
							<li <?=($PAGE=="ADD_LAYERS")? 'class="active"' : ''?>>
							   <a href="layers-add.php" title="Add Base Maps">
								  <em></em>
								  <span>Add Base Maps</span>
							   </a>
							</li>
							<li <?=($PAGE=="VIEW_GROUP")? 'class="active"' : ''?>>
							   <a href="group.php" title="View Map Groups">
								  <em></em>
								  <span>View Map Groups</span>
							   </a>
							</li>
							<li <?=($PAGE=="ADD_GROUP")? 'class="active"' : ''?>>
							   <a href="group-add.php" title="Add Map Group">
								  <em></em>
								  <span>Add Map Group</span>
							   </a>
							</li>
						 </ul>
					  </div>
                  </li>
				  
				  <li <?=(in_array($PAGE, array('PROJECT_VIEW','PROJECT_ADD','PROJECT_EDIT','ASSIGN_PROJECT_TO_USERS','PROJECT_MAPS')))? 'class="active"' : ''?>>
                     <a href="#project" title="Project" data-toggle="collapse">
                        <em class="fa fa-folder-open-o"></em>
                        <span data-localize="sidebar.nav.PROJECT">Projects</span>
                     </a>
                     <div class="sidebar-subnav-container">
						 <ul id="project" class="nav sidebar-subnav collapse">
							<li <?=($PAGE=="PROJECT_VIEW")? 'class="active"' : ''?>>
							   <a href="project.php" title="View Project">
								  <em></em>
								  <span>View Project</span>
							   </a>
							</li>
							<?PHP if(isAdmin($user)) { ?>
							<li <?=($PAGE=="PROJECT_ADD")? 'class="active"' : ''?>>
							   <a href="project-add.php" title="Create Project">
								  <em></em>
								  <span>Create Project</span>
							   </a>
							</li>
							<?PHP } ?>
						 </ul>
					  </div>
                  </li>
				  
				  <li <?=(in_array($PAGE, array('MAP_VIEW','MAP_CREATE')))? 'class="active"' : ''?>>
                     <a href="#map" title="Map" data-toggle="collapse">
                        <em class="icon-map"></em>
                        <span data-localize="sidebar.nav.MAP">Map Studio</span>
                     </a>
                     <div class="sidebar-subnav-container">
						 <ul id="map" class="nav sidebar-subnav collapse">
							<li <?=($PAGE=="MAP_VIEW")? 'class="active"' : ''?>>
							   <a href="map.php" title="View Map">
								  <em></em>
								  <span>View maps</span>
							   </a>
							</li>
							<li <?=($PAGE=="MAP_CREATE")? 'class="active"' : ''?>>
							   <a href="map-create.php" title="Create Map">
								  <em></em>
								  <span>Create Map</span>
							   </a>
							</li>
						 </ul>
					  </div>
                  </li>
				  
				  <li <?=(in_array($PAGE, array('CSV_IMPORT','CSV_VIEW','CSV_STUDIO')))? 'class="active"' : ''?>>
                     <a href="#csv" title="CSV" data-toggle="collapse">
                        <em class="fa fa-database"></em>
                        <span data-localize="sidebar.nav.CSV">Data Tables</span>
                     </a>
                     <div class="sidebar-subnav-container">
						 <ul id="csv" class="nav sidebar-subnav collapse">
							<li <?=($PAGE=="CSV_VIEW")? 'class="active"' : ''?>>
							   <a href="csv.php" title="View Tables">
								  <em></em>
								  <span>View Tables</span>
							   </a>
							</li>
							<li <?=($PAGE=="CSV_CREATE")? 'class="active"' : ''?>>
							   <a href="csv-create.php" title="Create Table">
								  <em></em>
								  <span>Create Table</span>
							   </a>
							</li>
							<li <?=($PAGE=="CSV_IMPORT")? 'class="active"' : ''?>>
							   <a href="csv-import.php" title="Import CSV">
								  <em></em>
								  <span>Import Table</span>
							   </a>
							</li>
							<li <?=($PAGE=="CSV_STUDIO")? 'class="active"' : ''?>>
							   <a href="csv-studio.php" title="CSV Studio">
								  <em></em>
								  <span>CSV Studio</span>
							   </a>
							</li>
						 </ul>
					  </div>
                  </li>
				  
			




	 
				  
				  
				  
				  
				  
				  <li <?=($PAGE == "PLUGINS_DOWNLOAD") ? 'class="active"' : ''?>>
                     <a href="plugins-download.php" title="Download SDKs">
                        <em class="fa fa-code"></em>
                        <span data-localize="sidebar.nav.DOWNLOAD_PLUGIN">SDKs</span>
                     </a>
                  </li>











				  <li <?=(in_array($PAGE, array('SOCIAL_SHARE','SOCIAL_SHARE_SETTINGS')))? 'class="active"' : ''?>>
                     <a href="#social" title="Social Share" data-toggle="collapse">
                        <em class="fa fa-share"></em>
                        <span data-localize="sidebar.nav.SOCIAL">Social Share</span>
                     </a>
					 <div class="sidebar-subnav-container">
						 <ul id="social" class="nav sidebar-subnav collapse">
							<li <?=($PAGE=="SOCIAL_SHARE")? 'class="active"' : ''?>>
							   <a href="social-share.php" title="Share Map">
								  <em></em>
								  <span>Share Map</span>
							   </a>
							</li>
							<li <?=($PAGE=="SOCIAL_SHARE_SETTINGS")? 'class="active"' : ''?>>
							   <a href="social-share-settings.php" title="Share Settings">
								  <em></em>
								  <span>Share Settings</span>
							   </a>
							</li>
						 </ul>
					  </div>
                  </li>






				  
				  <li <?=($PAGE == "LOGOUT") ? 'class="active"' : ''?>>
                     <a href="logout.php" title="Logout">
                        <em class="icon-logout"></em>
                        <span data-localize="sidebar.nav.LOGOUT">Logout</span>
                     </a>
                  </li>
               </ul>
               <!-- END sidebar nav-->
            </nav>
         </div>
         <!-- END Sidebar (left)-->
      </aside>
      <!-- offsidebar-->