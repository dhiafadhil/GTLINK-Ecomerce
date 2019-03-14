<?php
require 'PHPMailer/vendor/autoload.php';
include 'PHPMailer/src/PHPMailer.php';

use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer();


$mail->isSMTP();                            // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                     // Enable SMTP authentication
$mail->Username = 'noreply.gtlink@gmail.com';          // SMTP username
$mail->Password = 'M1r34cl3'; // SMTP password
$mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                          // TCP port to connect to 465 / 587

$mail->setFrom('noreply.gtlink@gmail.com', 'Admin');
$mail->addReplyTo('noreply.gtlink@gmail.com', 'Admin');
$mail->addAddress($email);   

$mail->isHTML(true);  // Set email format to HTML
$mail->addAttachment('../../pdf/'.$title.'.pdf');

$bodyContent = "Kode Booking GT-LINK - ".$title;
$bodyContent .= " Thank you for buying in GT-LINK";

$mail->Subject = "Kode Booking GT-LINK";
$mail->Body    = $bodyContent;



if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';

}
?>