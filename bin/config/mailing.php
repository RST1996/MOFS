<?php
require 'PHPMailer/PHPMailerAutoload.php';

	$mail = new PHPMailer;

	$mail->isSMTP();                            // Set mailer to use SMTP
	$mail->SMTPOptions = array(
	    'ssl' => array(
	        'verify_peer' => false,
	        'verify_peer_name' => false,
	        'allow_self_signed' => true
	    )
	);
	$mail->Host = 'mail.gcoej.ac.in';             // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                     // Enable SMTP authentication
	$mail->Username = 'test@gcoej.ac.in';          // SMTP username
	$mail->Password = ''; // SMTP password
	$mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 465;                          // TCP port to connect to
	$mail->Subject = 'MOFS Registration Success';
	$mail->setFrom('no-reply@gcoej.ac.in', 'ADMIN MOFS');
	$mail->addAddress('rishabh.s.thakur.1996@gmail.com');
	$mail->isHTML(true);  
	// $name = 'Rishabh';
	// $file = file_get_contents('html_mail.php');
	// $mail->Body = eval("?\>$file"); Remove the backslash placed  before > in eval parameters
	$mail->Body = " <strong>Hello mail</strong>";
	$mail->AltBody = "Your link is: ";
	if(!$mail->send()) {
		echo 'Message could not be sent.';
		
	} 
	else
	{
		echo 'Mailed Successfull';
	}

?>