<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';
//require 'POP3.php';
require 'form_setting.php';

if(isset($_POST)){
	$name = $_POST['name'];
	$email = $_POST['email'];
	$message = $_POST['message'];
	
	$messages  = "<h3>New message from the site " .$fromName. "</h3> \r\n";
	$messages .= "<ul>";
	$messages .= "<li><strong>Name: </strong>" .$name."</li>";
	$messages .= "<li><strong>Email: </strong>" .$email."</li>";
	$messages .= "<li><strong>Message: </strong>" .$message."</li>";
	$messages .= "</ul> \r\n";

	$mail = new PHPMailer;

	//SMTP
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
	$mail->FromName = "notification.namshad@gmail.com";
	$mail->Password = 'namshad$5420';
	$mail->Port = 465;

	// $mail->From = $from;
	// $mail->FromName = $fromName;
	// $mail->addAddress($to, 'Admin');

	$mail->isHTML(true); 
	$mail->setFrom($email, $name);
	$mail->addAddress($to, 'Admin');

	$mail->CharSet = $charset;

	$mail->Subject = $subj;
	$mail->Body    = $messages;

	if(!$mail->send()) {
	    print json_encode(array('status'=>0));
	} else {
	    print json_encode(array('status'=>1));
	}

}
	
?>