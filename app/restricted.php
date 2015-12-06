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
   <title>Access Denied</title>
   
   <?PHP require_once(dirname(__FILE__)."/../include/header.tpl.php"); ?>
   
   
   <!-- =============== VENDOR STYLES ===============-->
   <!-- FONT AWESOME-->
   <link rel="stylesheet" href="../vendor/fontawesome/css/font-awesome.min.css">
   <!-- SIMPLE LINE ICONS-->
   <link rel="stylesheet" href="../vendor/simple-line-icons/css/simple-line-icons.css">
   <!-- =============== APP STYLES ===============-->
   <link rel="stylesheet" href="css/app.css" id="maincss">
   <link href='https://fonts.googleapis.com/css?family=Lato:300,400,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>  
    <!-- Global CSS -->
   <!--<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">-->

    <!-- Plugins CSS -->    
    
    <link rel="stylesheet" href="assets/plugins/pe-icon-7-stroke/css/pe-icon-7-stroke.css"> 
    <link rel="stylesheet" href="assets/plugins/animate-css/animate.min.css">
    
    <!-- Theme CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/styles.css">


<!--DAVID-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://www.acugis.com/L5L54/css/normalize.css" />
    <link rel="stylesheet" href="https://www.acugis.com/L5L54/css/foundation.css" />
    <link rel="stylesheet" href="https://www.acugis.com/L5L54/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://www.acugis.com/L5L54/css/flexslider.css" />
    <link rel="stylesheet" href="https://www.acugis.com/L5L54/css/simpletextrotator.css" />
    <link rel="stylesheet" href="https://www.acugis.com/L5L54/css/owl.carousel.css">
    <link rel="stylesheet" href="https://www.acugis.com/L5L54/css/owl.theme.css">
    <link rel="stylesheet" href="https://www.acugis.com/L5L54/css/slicknav.css">
    <link rel="stylesheet" href="https://www.acugis.com/L5L54/css/tooltipster.css" />
    <link rel="stylesheet" href="https://www.acugis.com/L5L54/style.css" />
    <script src="https://www.acugis.com/L5L54/js/vendor/modernizr.js"></script>
    <style type="text/css">
<!--
.style2 {
	color: #FF0000;
	font-weight: bold;
}
-->
    </style>
    
    <!--DAVID-->



</head>

<body class="aside-collapsed">
   <div class="wrapper">
   
   <!--DAVID-->

       <!-- HEADER -->
<div class="top">
<div class="top-nav">
<div class="row">
  <div class="small-12 large-6 medium-6 columns">
    <ul class="top-list">
 <li><i  class="fa fa-phone"></i> USA:&nbsp; 1-702-922-7130</li>
  <li><i  class="fa fa-phone"></i> EU:&nbsp;&nbsp; 44-208-819-9664</li>
  <li><i  class="fa fa-envelope-o"></i> <a href="">sales@acugis.com</a></li>
</ul>
  </div>
  <div class="small-12 large-6 medium-6 columns">
    <ul id="menu-topmenu" class="top-list-right">
     <li><a href="#" data-reveal-id="LoginModal">LOGIN</a></li>
    <li><a href="https://www.acugis.com/acugis-help.html">HELP</a></li>
	<li><a href="https://www.acugis.com/free-leaflet-plugins.html">PLUGINS</a></li>
    <li><a href="https://www.acugis.com/free-gis-tools.html">TOOLS</a></li>
	<li><a href="https://www.acugis.com/leaflet-studios.html">STUDIOS</a></li>
    </ul>
   </div>
  </div>
  </div>

   <div class="row">
  <div class="small-12 large-3 medium-3 columns">
  <div class="logo"><a href="index.html"><img src="https://www.acugis.com/L5L54/images/logo.png" alt=""></a></div>
  </div>
<div class="small-12 large-9 medium-9 columns">

<!--  NAVIGATION MENU AREA -->
    <nav class="desktop-menu">
     <ul class="sf-menu">
     <li><a href="https://www.acugis.com/index.html">HOME</a></li>
     <li><a href="https://www.acugis.com/about-us.htm">About</a>
	 <ul class="sub-menu">
<li><a href="https://www.acugis.com/hosting-locations.html">Data Centres and Certifications</a></li>
<li><a href="https://www.acugis.com/Hosting_TOS.html">Terns of Service</a></li>
<li><a href="https://www.acugis.com/privacy-policy.html">Privacy Policy</a></li> 
<li><a href="https://www.acugis.com/SLA.html">SLA</a></li>
<li><a href="https://www.acugis.com/acugis-hosting-services.html">Services</a></li>
</ul>
</li>	 
	 
	
	 <li><a href="https://www.acugis.com/geoserver-hosting.htm">GeoServer</a></li>
     <li><a href="https://www.acugis.com/postgis-hosting.htm">PostGIS</a></li>
     <li><a href="https://www.acugis.com/neatline-hosting.htm">Neatline</a></li>
     <li><a href="https://www.acugis.com/cartaro-hosting.htm">Cartaro</a></li>
<li><a href="https://www.acugis.com/wordpress-leaflet-hosting.html">WordPress</a></li>
<li><a href="https://www.acugis.com/contact-us.html">Contact</a></li>
</ul>
  </nav>

<!--  MOBILE MENU AREA -->
  <nav class="mobile-menu">
    <ul>
  <li><a href="https://www.acugis.com/index.html">HOME</a></li>
     <li><a href="https://www.acugis.com/about-us.htm">About</a>
	 <ul class="sub-menu">
<li><a href="https://www.acugis.com/hosting-locations.html">Data Centres and Certifications</a></li>
<li><a href="https://www.acugis.com/Hosting_TOS.html">Terns of Service</a></li>
<li><a href="https://www.acugis.com/privacy-policy.html">Privacy Policy</a></li> 
<li><a href="https://www.acugis.com/SLA.html">SLA</a></li>
<li><a href="https://www.acugis.com/acugis-hosting-services.html">Services</a></li>
</ul>
</li>	  
	 
	
	 <li><a href="https://www.acugis.com/geoserver-hosting.htm">GeoServer</a></li>
     <li><a href="https://www.acugis.com/postgis-hosting.htm">PostGIS</a></li>
     <li><a href="https://www.acugis.com/neatline-hosting.htm">Neatline</a></li>
     <li><a href="https://www.acugis.com/cartaro-hosting.htm">Cartaro</a></li>
<li><a href="https://www.acugis.com/wordpress-leaflet-hosting.html">WordPress </a></li>
<li><a href="https://www.acugis.com/contact-us.html">Contact</a></li>
</ul>
  </nav>
  <!--  END OF MOBILE MENU AREA -->

  <!-- END OF NAVIGATION MENU AREA -->
  </div>
  </div>

  </div>
  <div class="bigline"></div>
<!-- END OF HEADER -->


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
               <p class="text-center pv">SIGNUP FOR ACUGIS Leaflet STUDIO </p>
               <div align="center"><span class="style2">Restricted to AcuGIS Clients</span>
			     <?=$error?>
               </div>
               <p class="pt-lg text-center">Have an account?</p><a href="login.php" class="btn btn-block btn-default">Login</a>
            </div>
         </div>
         <!-- END panel-->
         <div class="p-lg text-center">
            <span><?=COPYRIGHT_TEXT?></span>
         </div>
      </div>
   </div>
   
   <!-- FOOTER -->
<div class="footer"> 
<div class="row">

<div class="small-12 large-3 medium-3 columns">
<h2>Hosting Services</h2>
<ul>
<li><a href="https://www.acugis.com/geoserver-hosting.htm">GeoServer Hosting</a></li>
        <li><a href="https://www.acugis.com/postgis-hosting.htm">PostGIS Hosting</a></li>
        <li><a href="https://www.acugis.com/neatline-hosting.htm">Neatline Hosting</a></li>
        <li><a href="https://www.acugis.com/cartaro-hosting.htm">Cartaro Hosting</a></li>
        <li><a href="https://www.acugis.com/wordpress-leaflet-hosting.html">WordPress Hosting</a></li>
        <li><a href="https://www.acugis.com/opengeo-suite-hosting.html">OpenGeo Suite Hosting</a></li>
        <li><a href="https://www.acugis.com/dedicated-cloud-hosting.htm">Dedicated Hosting</a></li>
        <li><a href="https://www.acugis.com/security-appliances.html">Security Appliances</a></li>

</ul>
</div>

<div class="small-12 large-3 medium-3 columns">
<h2>Company</h2>
<ul>
<li><a href="https://www.acugis.com/about-us.htm">About us</a></li>
        <li><a href="https://www.acugis.com/hosting-locations.html">Data Centres</a></li>
        <li><a href="https://www.acugis.com/Hosting_TOS.html">Terms of Service</a></li>
        <li><a href="https://www.acugis.com/privacy-policy.htm">Privacy Policy</a></li>
        <li><a href="https://www.acugis.com/SLA.html">SLA</a></li>
        <li><a href="https://www.acugis.com/docs/acugis-site-map/">Site Map</a></li>
        <li><a href="https://www.acugis.com/government.html">Government</a></li>
        <li><a href="https://www.acugis.com/academic-discounts.html">Educational Programs</a></li>
</ul>
</div>

<div class="small-12 large-3 medium-3 columns">
<h2>Contact Us</h2>
<ul class="contact">
<li><i class="fa fa-map-marker"></i>Las Vegas, NV, USA</li>
<li><i class="fa fa-phone"></i>USA 1-702-922-7130</li>
<li><i class="fa fa-phone"></i>EU 44-208-819-9664</li>
<li><i class="fa fa-envelope-o"></i> <a href="https://www.acugis.com/contact-us.html">info@acugis.com</a></li>
<li><i class="fa fa-envelope-o"></i> <a href="https://www.acugis.com/contact-us.html">sales@acugis.com</a></li>
</ul>
</div>

<div class="small-12 large-3 medium-3 columns">
<h2>Security and Compliance</h2>
<!-- Begin DigiCert site seal HTML and JavaScript -->
<div id="DigiCertClickID_TtwDu9zx" data-language="en_US">
	<!--<a href="https://www.digicert.com/ssl.htm">SSL</a>-->
</div>
<script type="text/javascript">
var __dcid = __dcid || [];__dcid.push(["DigiCertClickID_TtwDu9zx", "10", "l", "black", "TtwDu9zx"]);(function(){var cid=document.createElement("script");cid.async=true;cid.src="//seal.digicert.com/seals/cascade/seal.min.js";var s = document.getElementsByTagName("script");var ls = s[(s.length - 1)];ls.parentNode.insertBefore(cid, ls.nextSibling);}());
</script>
<!-- End DigiCert site seal HTML and JavaScript -->
<br> <br>
<h2 align="left"><a href="hosting-locations.html">View All Certifications</a></h2>
<!-- Begin MailChimp Signup Form -->

<div id="mc_embed_signup">
<p><img src="https://www.acugis.com/L5L54/images/SSAE16-US-EU-FRAMEWORK.png" width="265" height="52" align="middle"></p>
</div>
</div>
<!--End mc_embed_signup-->

</div>
</div>
<!-- END OF FOOTER -->

<!-- COPYRIGHT / SOCIAL LINKS -->
<div class="copyright"> 
<div class="row">

<div class="small-12 large-6 medium-6 columns">
<p><?=COPYRIGHT_TEXT?> </p>
</div>
<div class="small-12 large-6 medium-6 columns">
<div class="social">
    <ul>
      <li><a href="http://www.facebook.com/AcuGIS" title="facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
      <li><a href="http://twitter.com/AcuGIS" title="twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
      <li><a href="https://plus.google.com/101806022223479865639" title="google+" target="_blank"><i class="fa fa-google"></i></a></li>
	  <li><a href="https://www.linkedin.com/company/acugis" title="linkedin" target="_blank"><i class="fa fa-linkedin"></i></a></li>
      <li><a href="http://blog.acugis.com/pg1/feed/entries/atom" title="rss" target="_blank"><i class="fa fa-rss"></i></a></li>
      <li><a href="https://github.com/AcuGIS" title="github" target="_blank"><i class="fa fa-github"></i></a></li>
    </ul>
      </div>
</div>

</div>
</div>
<!-- END OF COPYRIGHT / SOCIAL LINKS -->

<a href="#top" id="back-to-top"><img src="images/icons/to_top.png" alt="back to top"></a>

<!-- LOGIN MODAL -->
<div id="LoginModal" class="reveal-modal tiny" data-reveal>
  <!-- LOGIN FORM -->
<div class="login-container">
<div class="row">
<div class="small-12 small-centered large-12 large-centered medium-12 medium-centered columns">
<div class="login-form">

<img src="images/acugis-logo.png" alt="AcuGIS Login">
<form method="post" action="https://www.acugis.com/members/dologin.php?systpl=acugis">
Email Address: <input type="text" name="username" size="50" />
Password: <input type="password" name="password" size="20" />
<input type="submit" value="Login" />
</form>
</div>

</div>
</div>
</div> 
<!-- END OF LOGIN FORM --> 
<a class="close-reveal-modal">&#215;</a>     
</div>
<!-- END OF LOGIN MODAL -->
   
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