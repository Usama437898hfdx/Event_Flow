<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

$mail = new PHPMailer();

$mail->isSMTP();
$mail->Host = 'smtp.yourprovider.com'; // Replace with your SMTP server
$mail->SMTPAuth = true;
$mail->Username = 'your_username';
$mail->Password = 'your_password';
$mail->SMTPSecure = 'tls'; // You may use 'ssl' or 'tls' depending on your server
$mail->Port = 587; // Use 465 for 'ssl', 587 for 'tls', and 25 for non-secure

$mail->setFrom('osamafayyaz53@gmail.com', 'Your Name');
$mail->addAddress('huza3455@gmail.com', 'Recipient Name');

$mail->Subject = 'Test Email';
$mail->Body = 'This is a test email sent from PHPMailer.';

if ($mail->send()) {
    echo 'Email sent successfully';
} else {
    echo 'Error sending email: ' . $mail->ErrorInfo;
}
?>
