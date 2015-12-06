<?PHP
	if(file_get_contents("../include/db.config.php") == "") {
		header("Location: index.php");
		exit;
	}
	
	require_once("../include/site.settings.php");
	require_once("../include/function.php");
	
	$users = getAllSuperUsers();
	if(count($users) > 0) {
		header("Location: ../");
		exit;
	}
	
	$error = "";
	if(isset($_POST['submit']) && isset($_GET['step']) && $_GET['step'] == 2) {
		if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$error = "Invalid Email!";
		}
		else if(strlen($_POST['firstname']) < 2 || strlen($_POST['firstname']) > 255){
			$error = "First Name too short/long";
		}
		else if(strlen($_POST['lastname']) < 2 || strlen($_POST['lastname']) > 255){
			$error = "Last Name too short/long";
		}
		else if(strlen($_POST['password'])<8) {
			$error = "Password should be min of 8 characters long!";
		}
		else if($_POST['password'] != $_POST['password2']) {
			$error = "Password not matched!";
		}
		else if(register($_POST['firstname'], $_POST['lastname'], $_POST['email'],$_POST['password']) !== FALSE) {
			$_SESSION['response']['login']['success'] = "An Activation email is sent to your account. Please check and verify.";
			redirect("../");
		}
		else {
			$error = "User already exists";
		}
	}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta name="viewport" content="width=device-width" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Studio &rsaquo; Setup Configuration File</title>
		<link rel='stylesheet' id='buttons-css'  href='css/buttons.min.css?ver=4.1.1' type='text/css' media='all' />
		<link rel='stylesheet' id='open-sans-css'  href='https//fonts.googleapis.com/css?family=Open+Sans%3A300italic%2C400italic%2C600italic%2C300%2C400%2C600&#038;subset=latin%2Clatin-ext&#038;ver=4.1.1' type='text/css' media='all' />
		<link rel='stylesheet' id='install-css'  href='css/install.min.css?ver=4.1.1' type='text/css' media='all' />
	</head>
	<body class="wp-core-ui">
		<h1 id="logo"><a href="/" tabindex="-1"><?=SITE_NAME_FORMATED?></a></h1>
		
		
		
		
		<?PHP if((!isset($_GET['step']) || $_GET['step'] == "1") && !isset($_GET['error'])) { ?>
		<!-- Step 1 -->
		<p>All right! You&#8217;ve made it through this part of the installation. <?=SITE_NAME_FORMATED?> can now communicate with your database. If you are ready, time now to&hellip;</p>
		<p class="step"><a href="install.php?step=2" class="button button-large">Run the install</a></p>
		<?PHP } ?>
		
		
		
		
		<?PHP if(isset($_GET['step']) && $_GET['step'] == "1" && isset($_GET['error']) && $_GET['error'] == "true") { ?>
		<!-- Error 1 -->
		<p>The file 'db.config.php' already exists. If you need to reset any of the configuration items in this file, please <a href="<?=HELP_URL?>">Contact us</a>. You may try <a href="install.php?step=2">installing now</a>.</p>
		<?PHP } ?>
		
		
		
		
		<?PHP if(isset($_GET['step']) && $_GET['step'] == "2") { ?>
		<!-- Step 2 -->
		<h1>Welcome</h1>
		<p style="color:red;"><?=$error?></p>
		<p>Please provide the following information. Don't worry, you can always change these settings later.</p>
		<form id="setup" method="post" action="install.php?step=2" novalidate="novalidate">
			<table class="form-table">
				<tbody>
				<tr>
					<th scope="row"><label for="firstname">First Name</label></th>
					<td>
						<input name="firstname" type="text" id="firstname" size="25" value="<?=(isset($_POST['firstname']))?$_POST['firstname']:''?>">
						<p>First Name can have only alphanumeric characters, underscores and hyphens.</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="lastname">Last Name</label></th>
					<td>
						<input name="lastname" type="text" id="lastname" size="25" value="<?=(isset($_POST['lastname']))?$_POST['lastname']:''?>">
						<p>Last Name can have only alphanumeric characters, underscores and hyphens.</p>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="pass1">Password, twice</label>
						<p>Password fields are required</p>
					</th>
					<td>
						<input name="password" type="password" id="pass1" size="25" value="">
						<p><input name="password2" type="password" id="pass2" size="25" value=""></p>
						<p>Hint: The password should be at least Eight characters long. To make it stronger, use upper and lower case letters, numbers, and symbols like ! " ? $ % ^ &amp; ).</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="email">Your E-mail</label></th>
					<td><input name="email" type="email" id="email" size="25" value="<?=(isset($_POST['email']))?$_POST['email']:''?>">
					<p>Double-check your email address before continuing.</p></td>
				</tr>
			</tbody></table>
			<p class="step"><input type="submit" name="submit" value="Install Studio" class="button button-large"></p>
		</form>
		<?PHP } ?>
		
		
		
		
		
		
		
		
		<script type='text/javascript' src='js/jquery.js?ver=1.11.1'></script>
		<script type='text/javascript' src='js/jquery-migrate.min.js?ver=1.2.1'></script>
		<script type='text/javascript' src='js/language-chooser.min.js?ver=4.1.1'></script>
	</body>
</html>
