<head>
	<link rel="stylesheet" href="css/thank-you-image.css">
</head>

<body>
<div class = "thank-you-page">Thank you for submitting your reservation request. I will reply as soon as possible.

Have a great day!
</div>
</body>
<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$name  = trim(filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING));
	$email = trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
	$message = trim(filter_input(INPUT_POST, "message", FILTER_SANITIZE_SPECIAL_CHARS));
	
	$email_body = "";
	$email_body .= "You have a massage therapy request from ".$name.":<br><br>";
	$email_body .= $message. "<br><br>";
	$email_body .= "You can reply to ".$name." at ".$email.".<br>";
	
	require_once('inc/phpmailer/class.phpmailer.php');
	$mail = new PHPMailer;
	if (! $mail->validateAddress($email)){
		echo "Invalid email address.";
	};
	//To Do: Send email
	
	$mail->setFrom($email, 'Mailer');
	$mail->addAddress('gideongrossman@gmail.com', $name);     // Add a recipient
	//$mail->addAddress('ellen@example.com');               // Name is optional
	// $mail->addCC('cc@example.com');
	// $mail->addBCC('bcc@example.com');

	// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(false);                                  // Set email format to HTML

	$mail->Subject = 'Here is the subject';
	$mail->Body    = $email_body;
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	if(!$mail->send()) {
	    echo 'Message could not be sent.';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
		exit;
	};
	
	exit;	};
?>	