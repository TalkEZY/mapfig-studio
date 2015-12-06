<?PHP
	require_once(dirname(__FILE__)."/../library/phpmailer/PHPMailerAutoload.php");
	class Mail {
		private $smtpAuth;
		private $smtpSecure;
		private $host;
		private $port;
		private $username;
		private $password;
		private $mail;
		
		public function __construct($smtpAuth, $smtpSecure, $host, $port, $username, $password) {
			$this->smtpAuth = $smtpAuth;
			$this->smtpSecure = $smtpSecure;
			$this->host = $host;
			$this->port = $port;
			$this->username = $username;
			$this->password = $password;
			
			$this->mail             = new PHPMailer();
		}
		
		public function send($from, $fromName, $to, $subject, $body) {
			$this->mail->IsSMTP();
			$this->mail->SMTPAuth   = $this->smtpAuth;
			$this->mail->SMTPSecure = $this->smtpSecure;
			$this->mail->Host       = $this->host;
			$this->mail->Port       = $this->port;
			$this->mail->Username   = $this->username;
			$this->mail->Password   = $this->password;
			
			$this->mail->SetFrom($from, $fromName);
			$this->mail->MsgHTML($body);
			
			$this->mail->Subject    = $subject;
			$this->mail->AddAddress($to, "");
			
			return $this->mail->Send();
		}
	}
?>