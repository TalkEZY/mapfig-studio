<?PHP
	require_once(dirname(__FILE__)."/db.config.php");
	require_once(dirname(__FILE__)."/site.config.php");
	require_once(dirname(__FILE__)."/site.settings.php");
	require_once(dirname(__FILE__)."/csv.config.php");
	require_once(dirname(__FILE__)."/FlxZipArchive.php");
	require_once(dirname(__FILE__)."/csvFunctions.php");
	require_once(dirname(__FILE__)."/function.php");
	
	require_once(dirname(__FILE__)."/user.config.php");
	
	require_once(dirname(__FILE__)."/mail.config.php");
	require_once(dirname(__FILE__)."/classes/mail.class.php");
	
	$mailer = new Mail(MAIL_SMTPAUTH, MAIL_SMTPSECURE, MAIL_HOST, MAIL_PORT, MAIL_USERNAME, MAIL_PASSWORD);
?>