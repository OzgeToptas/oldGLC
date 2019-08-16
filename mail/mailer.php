<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';

define('GUSER', 'admin@getlondonservices.co.uk'); // Kullanıcı Adı
define('GPWD', 'Gold1905.'); // Parola

function smtpmailer($to, $from, $from_name, $subject, $body) { 
	$mail = new PHPMailer(true);
	$mail->IsSMTP(); 
    $mail->CharSet = 'UTF-8';
	$mail->SMTPDebug = 2;  
	$mail->SMTPAuth = true;  
	$mail->SMTPSecure = "tls"; 
	$mail->Host = 'mail.getlondonservices.co.uk';
	$mail->Port = 587; 
	$mail->IsHTML(true);
    $mail->SMTPKeepAlive = true;
	$mail->Username = GUSER;  
	$mail->Password = GPWD; 
	$mail->SetFrom($from, $from_name);
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->AddAddress($to);
	$mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    
	if(!$mail->Send()) {
		return false;
	} else {
	   return true;
	}
}
