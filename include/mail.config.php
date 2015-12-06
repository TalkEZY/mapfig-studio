<?PHP
	define("MAIL_SMTPAUTH", true);
	define("MAIL_SMTPSECURE", "tls");
	define("MAIL_HOST", "mail.domain.com");
	define("MAIL_PORT", 587);
	define("MAIL_USERNAME", "verify@domain.com");
	define("MAIL_PASSWORD", "Password");
	define("MAIL_FROM", "verify@domain.com");
	define("MAIL_FROM_NAME", "Verify Petiole");

	define("WELCOME_EMAIL_SUBJECT", "Petiole Studio Registration Confirmation!");



	define("MAIL_TEMPLATE_DIRECTORY", dirname(__FILE__)."/../templates/emails/");
?>