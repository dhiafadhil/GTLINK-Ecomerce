<?php
require 'PHPMailer/vendor/autoload.php';
include 'PHPMailer/src/PHPMailer.php';

use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer();

$email = $_POST['email'];

$mail->isSMTP();                            // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                     // Enable SMTP authentication
$mail->Username = 'noreply.gtlink@gmail.com';          // SMTP username
$mail->Password = 'M1r34cl3'; // SMTP password
$mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                          // TCP port to connect to 465 / 587

$mail->setFrom('noreply.gtlink@gmail.com', 'Admin');
$mail->addReplyTo('noreply.gtlink@gmail.com', 'Admin');
// $mail->addAddress('tes7725@gmail.com');   // Add a recipient
$mail->addAddress($email);
// $mail->addCC('cc@example.com');
// $mail->addBCC('bcc@example.com');

$mail->isHTML(true);  // Set email format to HTML

// $bodyContent = $_POST['nama'];
// $bodyContent .= $_POST['pesan'];

// $mail->Subject = $_POST['subject'];

$date = date('d-m-Y');
$bodyContent = "Selamat bergabung sebagai member GT-LINK <br>";
$bodyContent .= "Selamat menghabiskan uang anda di GT-LINK jangan ragu jangan malu habiskan saja uang anda disini <br>
	Pembelian 10 item dapet umroh gratis , kapan lagi kan , ayo segera habiskan uang anda disini 
	<br>
	<br>
	Jakarta.$date.<br>
	<br>
	<br>
	Admin GT-LINK";

$mail->Subject = "Info Status Account GT-LINK";
$mail->Body    = $bodyContent;

if(!$mail->send()) {
	echo 'Message could not be sent.';
	echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
	echo 'Message has been sent';
}
?>