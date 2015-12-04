<?PHP
	require_once(dirname(__FILE__)."/../include/master.inc.php");
	if(isLogin()){
		redirect("dashboard.php");
	}
	$error = "";
	$success = "";
	if(isset($_SESSION['response']['login']['error'])){
		$error = '<div ng-show="authMsg" class="alert alert-danger text-center ng-binding">'.$_SESSION['response']['login']['error'].'</div>';
	}
	else if(isset($_SESSION['response']['login']['success'])){
		$success = '<div ng-show="authMsg" class="alert alert-success text-center ng-binding">'.$_SESSION['response']['login']['success'].'</div>';
	}
	unset($_SESSION['response']['login']['error']);
	unset($_SESSION['response']['login']['success']);
	
	
	include_once(dirname(__FILE__)."/oath/twitter/inc/twitteroauth.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />	
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<!-- stylesheets -->
	<link rel="stylesheet" type="text/css" href="newtemplate/css/compiled/theme.css">

	<!-- javascript -->
	<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->
	<?PHP require_once(dirname(__FILE__)."/../include/header.tpl.php"); ?>
	<script src="newtemplate/js/bootstrap/bootstrap.min.js"></script>
	<script src="newtemplate/js/theme.js"></script>

	<!--[if lt IE 9]>
      <script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->




</head>
<body id="signup">
	<div class="container">
		<div class="row header">
			<div class="col-md-12">
				<h3 class="logo">
					<a href="#"><img src="img/mapfig-mobile.png"></a>
				</h3>
				<h4>Sign in to your account.</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="wrapper clearfix">
					<div class="formy">
						<div class="row">
							<div class="col-md-12">
								<?=$error.$success?>
								<form role="form" action="processor/login/index.php" method="post">
							  		<div class="form-group">
							    		<label for="email">Email address</label>
							    		<input type="email" class="form-control" id="email" name="email" />
							  		</div>
							  		<div class="form-group">
							    		<label for="password">Password</label>
							    		<input type="password" class="form-control" id="password" name="password" />
							  		</div>
							  		<div class="checkbox">
							    		<label>
							      			<input type="checkbox" name="remember"> Remember me
							    		</label>
							  		</div>
									
									<input type="submit" name="login" id="login" class="submit" value="Sign in to my account" style="display:none;"/>
									
							  		<div class="submit">
							  			<a href="#" onclick="document.getElementById('login').click(); return false;" class="button-clear">
								  			<span>Sign in to my account</span>
								  		</a>
<p>&nbsp;</p>
                                                                             
							  		</div>
								</form>
							</div>
						</div>						
					</div>
				</div>
				<div class="already-account">
<div align="center"><a href="recover.php"> Forgot your Password? </a></div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>