<?PHP
	require_once(dirname(__FILE__)."/../include/master.inc.php");
	if(isLogin()){
		redirect("dashboard.php");
	}
	$error   = "";
	$success = "";
	if(isset($_SESSION['response']['recover']['error'])) {
		$error = '<div ng-show="authMsg" class="alert alert-danger text-center ng-binding">'.$_SESSION['response']['recover']['error'].'</div>';
	}
	else if(isset($_SESSION['response']['recover']['success'])) {
		$success = '<div ng-show="authMsg" class="alert alert-success text-center ng-binding">'.$_SESSION['response']['recover']['success'].'</div>';
	}
	unset($_SESSION['response']['recover']['error']);
	unset($_SESSION['response']['recover']['success']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <title>Forget Password? Recover Now</title>
   <!-- =============== VENDOR STYLES ===============-->
   <!-- FONT AWESOME-->
   <link rel="stylesheet" href="../vendor/fontawesome/css/font-awesome.min.css">
   <!-- SIMPLE LINE ICONS-->
   <link rel="stylesheet" href="../vendor/simple-line-icons/css/simple-line-icons.css">
   <!-- =============== APP STYLES ===============-->
   <link rel="stylesheet" href="css/app.css" id="maincss">
</head>

<body class="aside-collapsed">
   <div class="wrapper">
      <div class="block-center mt-xl wd-xl">
         <!-- START panel-->


<div align="center">
					<a href="login.php"><img src="img/mapfig-mobile-recover.png"></a>
				</div>
<p>&nbsp;</p><p>&nbsp;</p>


         <div class="panel panel-light panel-flat">

            
            <div class="panel-body">
               <p class="text-center pv">PASSWORD RESET</p>
			   <?=$error.$success?>
               <form role="form" action="processor/recover/index.php" method="post">
                  <p class="text-center">Enter your email to receive instructions on how to reset your password.</p>
                  <div class="form-group has-feedback">
                     <label for="resetInputEmail1" class="text-muted">Email address</label>
                     <input id="resetInputEmail1" type="email" name="email" placeholder="Enter email" autocomplete="off" class="form-control">
                     <span class="fa fa-envelope form-control-feedback text-muted"></span>
                  </div>
                  <button type="submit" name="recover" class="btn btn-danger btn-block">Reset</button>
               </form>
            </div>
         </div>

         <!-- END panel-->


         <div class="p-lg text-center">
            <small class="copyright col-md-12 col-sm-12 col-xs-12">&copy;  <a href="https://www.petiole.org" target="_blank">MapFig, Inc. </a></small>
<p>&nbsp;</p>
<small class="copyright col-md-12 col-sm-12 col-xs-12" font color="white"> <a href="login.php" target="_blank">Back to Login </a></small>



         </div>
      </div>





   </div>

   <!-- =============== VENDOR SCRIPTS ===============-->
   <!-- MODERNIZR-->
   <script src="../vendor/modernizr/modernizr.js"></script>
   <!-- JQUERY-->
   <script src="../vendor/jquery/dist/jquery.js"></script>
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