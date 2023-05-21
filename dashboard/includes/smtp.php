<?php
 
// Import PHPMailer classes into the global namespace 
require("../vendor/phpmailer/src/PHPMailer.php");
require("../vendor/phpmailer/src/SMTP.php");

use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 

$mail = new PHPMailer; 
$mail->isSMTP();                      // Set mailer to use SMTP  
//$mail->Host     = "ssl://smtp.gmail.com"; // Specify main and backup SMTP servers 
//$mail->Host = gethostbyname('smtp.gmail.com');
$mail->SMTPSecure   = 'tls'; 
$mail->Host         = "smtp.gmail.com";
$mail->SMTPAuth     = true;               // Enable SMTP authentication 
$mail->Username     = 'waqarsabirmughal@gmail.com';   // SMTP username 
$mail->Password     = 'rida.naz9';   // SMTP password 
$mail->SMTPSecure   = 'tls';            // Enable TLS encryption, `ssl` also accepted 
$mail->Port = 587;                    // TCP port to connect to  


// $mail->SMTPSecure   = 'tls'; 
// $mail->Host         = "mail.waqarsabir.com";
// $mail->SMTPAuth     = false;               // Enable SMTP authentication 
// $mail->Username     = 'info@waqarsabir.com';   // SMTP username 
// $mail->Password     = 'rida.naz9';   // SMTP password 
// $mail->SMTPSecure   = 'tls';            // Enable TLS encryption, `ssl` also accepted 
// $mail->Port = 587;                    // TCP port to connect to  


// Sender info 
$mail->setFrom('info@waqarsabir.com', 'Waqar Sabir'); 
$mail->addReplyTo('info@waqarsabir.com', 'Saaaab'); 
 
// Add a recipient 
//$mail->addAddress('waqarsabirmughal@gmail.com'); 
//$mail->addCC('cc@example.com'); 
//$mail->addBCC('bcc@example.com'); 
// Set email format to HTML 
//$mail->isHTML(true); 
 
// Mail subject 
//$mail->Subject = 'Email from Localhost by CodexWorld'; 
 
// Mail body content 
//$bodyContent = '<h1>How to Send Email from Localhost using PHP by CodexWorld</h1>'; 
//$bodyContent .= '<p>This HTML email is sent from the localhost server using PHP by <b>CodexWorld</b></p>'; 
//$mail->Body    = $bodyContent; 
// Send email 
// if(!$mail->send()) { 
//     echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
// } else { 
//     echo 'Message has been sent.'; 
// } 
 
?>