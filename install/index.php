<?PHP
	if(file_get_contents("../include/db.config.php") != "") {
		header("Location: install.php?step=1&error=true");
		exit;
	}

	require_once("../include/site.settings.php");

	if(isset($_POST['submit']) && isset($_GET['step']) && $_GET['step'] == 2) {
		pg_connect("host=".$_POST['dbhost']." port=".$_POST['dbport']." dbname=".$_POST['dbname']." user=".$_POST['uname']." password=".$_POST['pwd']) or die("<meta http-equiv=\"refresh\" content=\"0;URL='index.php?step=2&error=Invalid+Credentials'\" />");
		pg_connect("host=".$_POST['dbhost']." port=".$_POST['dbport']." dbname=".$_POST['dbname_stats']." user=".$_POST['uname']." password=".$_POST['pwd']) or die("<meta http-equiv=\"refresh\" content=\"0;URL='index.php?step=2&error=Invalid+Credentials+For+Statistics+Database'\" />");

		$content = '<?PHP
				define("DB_HOST","'.$_POST['dbhost'].'");
				define("DB_USER","'.$_POST['uname'].'");
				define("DB_NAME","'.$_POST['dbname'].'");
				define("DB_NAME_STATS","'.$_POST['dbname_stats'].'");
				define("DB_PASS","'.$_POST['pwd'].'");
				define("DB_PORT","'.$_POST['dbport'].'");
			?>';
		file_put_contents("../include/db.config.php", $content) or die("<meta http-equiv=\"refresh\" content=\"0;URL='index.php?step=2&error=true&message=Permission+error+-+Can+not+open+the+db.config.php'\" />");


		require_once("../include/function.php");
		global $db;
		$script = str_replace(array("[#OWNER#]","[#USER_ID#]"), array(DB_USER, 1), file_get_contents("sql/script.sql"));
		$stats  = str_replace(array("[#OWNER#]","[#USER_ID#]"), array(DB_USER, 1), file_get_contents("sql/stats.sql"));
		pg_query($db, $script) or file_put_contents("../include/db.config.php", "");
		pg_query($stats_db, $stats)  or file_put_contents("../include/db.config.php", "");


		header("Location: install.php");
		exit;
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
		<p>Welcome to <?=SITE_NAME_FORMATED?> Studio. Before getting started, we need some information on the database(PostGreSQL). You will need to know the following items before proceeding.</p>
		<ol>
			<li>Database name</li>
			<li>Database username</li>
			<li>Database password</li>
			<li>Database host</li>
			<li>Database Port</li>
		</ol>
		<p>
			We&#8217;re going to use this information to create a <code>db.config.php</code> file.
			Need more help? <a href="http://docs.mapfig.com" target="_blank">We got it</a>.
		</p>
		<p>In all likelihood, these items were supplied to you by your Web Host. If you do not have this information, then you will need to contact them before you can continue. If you&#8217;re all ready&hellip;</p>

		<p class="step"><a href="index.php?step=2" class="button button-large">Let&#8217;s go!</a></p>
		<?PHP } ?>

		<?PHP 
			if(isset($_GET['error']) && $_GET['error'] != "true") {
				echo '<strong>'.$_GET['error'].'</strong>';
			}
			else if(isset($_GET['error'])) {
				echo '<strong>'.$_GET['message'].'</strong>';
			}
		?>

		<?PHP if(isset($_GET['step']) && $_GET['step'] == "2" && !isset($_GET['error'])) { ?>
		<!-- Step 2 -->
		<form method="post" action="index.php?step=2" method="post">
			<p>Below you should enter your database connection details. If you are not sure about these, contact your host.</p>
			<table class="form-table">
				<tr>
					<th scope="row"><label for="dbname">Application's Database Name</label></th>
					<td><input name="dbname" id="dbname" type="text" size="25" value="database_name" /></td>
					<td>The name of the database you want to run MapFig in.</td>
				</tr>
				<tr>
					<th scope="row"><label for="dbname_stats">Statistics Database Name</label></th>
					<td><input name="dbname_stats" id="dbname_stats" type="text" size="25" value="database_name_stats" /></td>
					<td>The name of the database you want to run MapFig's Stats in.</td>
				</tr>
				<tr>
					<th scope="row"><label for="uname">User Name</label></th>
					<td><input name="uname" id="uname" type="text" size="25" value="username" /></td>
					<td>Your Database username</td>
				</tr>
				<tr>
					<th scope="row"><label for="pwd">Password</label></th>
					<td><input name="pwd" id="pwd" type="text" size="25" value="password" autocomplete="off" /></td>
					<td>&hellip;and your Database password.</td>
				</tr>
				<tr>
					<th scope="row"><label for="dbhost">Database Host</label></th>
					<td><input name="dbhost" id="dbhost" type="text" size="25" value="localhost" /></td>
					<td>You should be able to get this info from your web host, if <code>localhost</code> does not work.</td>
				</tr>
				<tr>
					<th scope="row"><label for="dbport">Database Port</label></th>
					<td><input name="dbport" id="dbport" type="text" value="5432" size="25" /></td>
					<td>Your Database Port Number.</td>
				</tr>
			</table>
				<input type="hidden" name="language" value="en_CA" />
			<p class="step"><input name="submit" type="submit" value="Submit" class="button button-large" /></p>
		</form>
		<?PHP } ?>



		<?PHP if(isset($_GET['step']) && $_GET['step'] == "2" && isset($_GET['error']) && $_GET['error'] == "true") { ?>
		<!-- Error 1 -->
		<p>
		<h1>Error establishing a database connection</h1>
		<p>This either means that the username and password information in your <code>db.config.php</code> incorrect or we can't contact the database server at <code>localhost</code>. This could mean your host's database server is down.</p>
		<ul>
		&rarr;	<li>Are you sure you have the correct username and password?</li>
		&rarr;	<li>Are you sure that you have typed the correct hostname and port number?</li>
		&rarr;	<li>Are you sure that the database server is running?</li>
		</ul>
		<p>If you're unsure what these terms mean you should probably contact your host.</p>
		</p><p class="step"><a href="index.php?step=1" onclick="javascript:history.go(-1);return false;" class="button button-large">Try again</a></p>
		<?PHP } ?>




		<script type='text/javascript' src='js/jquery.js?ver=1.11.1'></script>
		<script type='text/javascript' src='js/jquery-migrate.min.js?ver=1.2.1'></script>
		<script type='text/javascript' src='js/language-chooser.min.js?ver=4.1.1'></script>
	</body>
</html>
