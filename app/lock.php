<?PHP
	require_once(dirname(__FILE__)."/../include/master.inc.php");
	$userInfo = getUserInfo();
	logout();
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <title>Login</title>
   
   <?PHP require_once(dirname(__FILE__)."/../include/header.tpl.php"); ?>
   
   
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
      <div class="abs-center wd-xl">
         <!-- START panel-->
         <div class="p">
            <img src="img/user/02.jpg" alt="Avatar" width="60" height="60" class="img-thumbnail img-circle center-block">
         </div>
         <div class="panel widget b0">
            <div class="panel-body">
               <p class="text-center">Please login to unlock your screen.</p>
               <form role="form" action="processor/login/index.php" method="post">
                  <input type="hidden" name="email" value="<?=$userInfo['email']?>">
				  <div class="form-group has-feedback">
                     <input id="exampleInputPassword1" type="password" name="password" placeholder="Password" class="form-control">
                     <span class="fa fa-lock form-control-feedback text-muted"></span>
                  </div>
                  <div class="clearfix">
                     <div class="pull-left mt-sm">
                        <a href="recover.php" class="text-muted">
                           <small>Forgot your password?</small>
                        </a>
                     </div>
                     <div class="pull-right"><input type="submit" name="login" value="Unlock" class="btn btn-sm btn-primary"/>
                     </div>
                  </div>
               </form>
            </div>
         </div>
         <!-- END panel-->
         <div class="p-lg text-center">
            <span><?=COPYRIGHT_TEXT?></span>
         </div>
      </div>
   </div>
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