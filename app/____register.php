<?PHP
	require_once(dirname(__FILE__)."/../include/master.inc.php");
	if(isLogin()){
		redirect("dashboard.php");
	}
	$error = "";
	if(isset($_SESSION['response']['register']['error'])){
		$error = '<div ng-show="authMsg" class="alert alert-danger text-center ng-binding">'.$_SESSION['response']['register']['error'].'</div>';
	}
	unset($_SESSION['response']['register']['error']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   <meta name="description" content="MapFig Registration Portal">
   <meta name="keywords" content="">
   <title>MapFig Registration Portal</title>
   
   <?PHP require_once(dirname(__FILE__)."/../include/header.tpl.php"); ?>
   
   
   <!-- =============== VENDOR STYLES ===============-->
   <!-- FONT AWESOME-->
   <link rel="stylesheet" href="../vendor/fontawesome/css/font-awesome.min.css">
   <!-- SIMPLE LINE ICONS-->
   <link rel="stylesheet" href="../vendor/simple-line-icons/css/simple-line-icons.css">
   <!-- =============== APP STYLES ===============-->
   <link rel="stylesheet" href="css/app.css" id="maincss">
   <link href='http://fonts.googleapis.com/css?family=Lato:300,400,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>  
    <!-- Global CSS -->
   <!--<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">-->

    <!-- Plugins CSS -->    
    
    <link rel="stylesheet" href="assets/plugins/pe-icon-7-stroke/css/pe-icon-7-stroke.css"> 
    <link rel="stylesheet" href="assets/plugins/animate-css/animate.min.css">
    
    <!-- Theme CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/styles.css">
</head>

<body class="aside-collapsed">
   <div class="wrapper">
   
   <!--DAVID-->

        <!-- ******HEADER****** --> 
        <header id="header" class="header">  
            <div class="container">            
                <h1 class="logo pull-left">
                    <a href="https://www.petiole.org">
                        <span class="logo-title"><img src="assets/images/site/mapfiglogo-head.png"></span>
                    </a>
                </h1><!--//logo-->              
                <nav id="main-nav" class="main-nav navbar-right" role="navigation">
                    <div class="navbar-header">
                        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button><!--//nav-toggle-->
                    </div><!--//navbar-header-->            
                    <div class="navbar-collapse collapse" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                           <li class="nav-item"><a href="http://docs.mapfig.com" target="_blank">Docs</a></li>
                                                 <li class="nav-item"><a href="http://mapfig.org" target="_blank">MapFig</a></li>                        </ul><!--//nav-->
                    </div><!--//navabr-collapse-->
                </nav><!--//main-nav-->           
            </div><!--//container-->
        </header><!--//header-->


<!--DAVID-->

   
   
   
      <div class="block-center mt-xl wd-xl">
         <!-- START panel-->
         <div class="panel panel-dark panel-flat">
            <div class="panel-heading text-center">
               <a href="#">
                  <img src="img/login-logo.png" alt="Image" class="block-center img-rounded">
               </a>
            </div>
            <div class="panel-body">
               <p class="text-center pv">SIGNUP TO GET INSTANT ACCESS.</p>
               <form role="form" method="post" action="processor/register/index.php" data-parsley-validate="" novalidate="" class="mb-lg">
                  <div class="form-group has-feedback">
                     <label for="signupInputFirstName" class="text-muted">First Name</label>
                     <input id="signupInputFirstName" type="text" placeholder="Enter First Name" name="firstname" autocomplete="off" required class="form-control">
                     <span class="fa fa-user form-control-feedback text-muted"></span>
                  </div>
				  <div class="form-group has-feedback">
                     <label for="signupInputLastName" class="text-muted">Last Name</label>
                     <input id="signupInputLastName" type="lastname" placeholder="Enter Last Name" name="lastname" autocomplete="off" required class="form-control">
                     <span class="fa fa-user form-control-feedback text-muted"></span>
                  </div>
				  <div class="form-group has-feedback">
                     <label for="signupInputEmail1" class="text-muted">Email address</label>
                     <input id="signupInputEmail1" type="email" placeholder="Enter email" name="email" autocomplete="off" required class="form-control">
                     <span class="fa fa-envelope form-control-feedback text-muted"></span>
                  </div>
                  <div class="form-group has-feedback">
                     <label for="signupInputPassword1" class="text-muted">Password</label>
                     <input id="signupInputPassword1" type="password" placeholder="Password" name="password" autocomplete="off" required class="form-control">
                     <span class="fa fa-lock form-control-feedback text-muted"></span>
                  </div>
                  <div class="form-group has-feedback">
                     <label for="signupInputRePassword1" class="text-muted">Retype Password</label>
                     <input id="signupInputRePassword1" type="password" placeholder="Retype Password" autocomplete="off" required data-parsley-equalto="#signupInputPassword1" class="form-control">
                     <span class="fa fa-lock form-control-feedback text-muted"></span>
                  </div>
                  <div class="clearfix">
                     <div class="checkbox c-checkbox pull-left mt0">
                        <label>
                           <input type="checkbox" value="" required name="agreed">
                           <span class="fa fa-check"></span>I agree with the <a href="https://www.enciva.com/Hosting_TOS.htm" target="_blank">terms</a>
                        </label>
                     </div>
                  </div>
                  <button type="submit" name="register" class="btn btn-block btn-primary mt-lg">Create account</button>
               </form>
			   <?=$error?>
               <p class="pt-lg text-center">Have an account?</p><a href="login.php" class="btn btn-block btn-default">Signup</a>
            </div>
         </div>
         <!-- END panel-->
         <div class="p-lg text-center">
            <span>&copy;</span>
            <span>2015</span>
            <span>-</span>
            <span>Enciva LLC</span>
            <br>
            <span>MapFig LTD and Enciva LLC</span>
         </div>
      </div>
   </div>
   
   <!-- ******FOOTER****** --> 
    <footer class="footer">
        <div class="footer-content">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-5 col-sm-7 col-sm-12 about">
                        <div class="footer-col-inner">
                            <h3 class="title">About Us</h3>
                           <p>MapFig is an Open Source project sponsored by AcuGIS, a world-leader in GIS hosting solutions. Hosting individuals, corporations, and research and academic institutions in over 40 countries world wide. Our goal is to make creating and deploying custom maps to your website as simple and affordable as possible.</p>
                            <p><a class="more" href="http://mapfig.org" target="_blank">Learn more <i class="fa fa-long-arrow-right"></i></a></p>
                            
                        </div><!--//footer-col-inner-->
                    </div><!--//foooter-col-->
                    <div class="footer-col col-md-3 col-sm-4 col-md-offset-1 links">
                        <div class="footer-col-inner">
                            <h3 class="title">Links</h3>
                            <ul class="list-unstyled">
                                <li><a href="http://mapfig.org/about.html" target="_blank"><i class="fa fa-caret-right"></i>About Us</a></li>
																								<li><a href="http://mapfig.org" target="_blank"><i class="fa fa-caret-right"></i>MapFig Studio Server</a></li>
																                                <li><a href="https://www.petiole.org/help.html" target="_blank"><i class="fa fa-caret-right"></i>Help!</a></li>
																								<li><a href="https://www.petiole.org/contact.html" target="_blank"><i class="fa fa-caret-right"></i>Contact</a></li>
																                                <li><a href="https://www.petiole.org/tos.html" target="_blank"><i class="fa fa-caret-right"></i>Terms of Services</a></li>
								                                <li><a href="https://www.petiole.org/privacy-policy.html" target="_blank"><i class="fa fa-caret-right"></i>Privacy Policy</a></li>
                            </ul>
                        </div><!--//footer-col-inner-->
                    </div><!--//foooter-col-->                 
                    <div class="footer-col col-md-3 col-sm-12 contact">
                        <div class="footer-col-inner">
                            <h3 class="title">Get in touch</h3>
                            <div class="row">
                                <p class="tel col-md-12 col-sm-4"><i class="fa fa-phone"></i>USA: 702 922 7130</p>
								<p class="tel col-md-12 col-sm-4"><i class="fa fa-phone"></i>EU: 44 208 819 9664</p>
                                <p class="email col-md-12 col-sm-4"><i class="fa fa-envelope"></i><a href="#">info@mapfig.com</a></p>
<p class="email col-md-12 col-sm-4"><i class="fa fa-globe"></i><a href="https://www.petiole.org" target="_blank"">MapFig.com</a></p>
<p class="email col-md-12 col-sm-4"><i class="fa fa-globe"></i><a href="http://mapfig.org" target="_blank"">MapFig.org</a></p>

                            </div>
                        </div><!--//footer-col-inner-->            
                    </div><!--//foooter-col-->   
                </div><!--//row-->
            </div><!--//container-->        
        </div><!--//footer-content-->
        <div class="bottom-bar">
            <div class="container">
                <div class="row">
                    <small class="copyright col-md-6 col-sm-6 col-xs-12">Copyright @ 2015 MapFig | Envia LLC <a href="http://mapfig.org/" target="_blank">MapFig Ltd</a></small>                    <ul class="social col-md-6 col-sm-6 col-xs-12 list-inline">
                        <li><a href="https://twitter.com/mapfig" target="_blank"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="https://www.facebook.com/mapfig" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="http://www.linkedin.com/company/mapfig" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                        <li class="last"><a href="https://www.github.com/MapFig" target="_blank"><i class="fa fa-github"></i></a></li>                    </ul><!--//social-->
                </div><!--//row-->
            </div><!--//container-->
        </div><!--//bottom-bar-->
    </footer><!--//footer-->
   
   <!-- =============== VENDOR SCRIPTS ===============-->
   <!-- MODERNIZR-->
   <script src="../vendor/modernizr/modernizr.js"></script>
   <!-- BOOTSTRAP-->
   <script src="../vendor/bootstrap/dist/js/bootstrap.js"></script>
   <!-- STORAGE API-->
   <script src="../vendor/jQuery-Storage-API/jquery.storageapi.js"></script>
   <!-- PARSLEY-->
   <script src="../vendor/parsleyjs/dist/parsley.min.js"></script>
   <!-- =============== APP SCRIPTS ===============-->
   <script src="js/app.js"></script>
</body>

</html>