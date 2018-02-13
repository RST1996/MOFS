<?php
	require 'PHPMailer/PHPMailerAutoload.php';
	class MOFSMailer extends PHPMailer
	{
		public $SMTPOptions = array(
		    'ssl' => array(
		        'verify_peer' => false,
		        'verify_peer_name' => false,
		        'allow_self_signed' => true
		    )
		);
		public $Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
		public $SMTPAuth = true;                     // Enable SMTP authentication
		public $Username = 'rst.1996.dev@gmail.com';          // SMTP username
		public $Password = ''; // SMTP password
		public $SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted
		public $Port = 465;                          // TCP port to connect to
	}
?>