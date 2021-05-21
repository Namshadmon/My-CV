<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';
//require 'POP3.php';
require 'form_setting.php';

if (isset($_POST)) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$message = $_POST['message'];

	$messages  = "<h3>New message from the site " . $fromName . "</h3> \r\n";
	$messages .= "<ul>";
	$messages .= "<li><strong>Name: </strong>" . $name . "</li>";
	$messages .= "<li><strong>Email: </strong>" . $email . "</li>";
	$messages .= "<li><strong>Message: </strong>" . $message . "</li>";
	$messages .= "</ul> \r\n";

	$mail = new PHPMailer;

	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true; // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 465; // or 587
	$mail->IsHTML(true);
	$mail->Username = "notification.namshad@gmail.com";
	$mail->Password = "";
	$mail->SetFrom("notification.namshad@gmail.com");
	//$mail->Subject = "Test";
	//$mail->Body = "hello";
	$mail->AddAddress("namshadnpt@gmail.com");

	$mail->CharSet = $charset;

	$mail->Subject = $subj;
	$mail->Body    = $messages;

	if (!$mail->send()) {
		print json_encode(array('status' => 0, 'msg' => "Error" . $mail->ErrorInfo));
	} else {
		print json_encode(array('status' => 1));
	}
}
