<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/vendor/phpmailer/src/Exception.php';
require_once __DIR__ . '/vendor/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/vendor/phpmailer/src/SMTP.php';


$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->Username = 'eventflow786@gmail.com'; // YOUR gmail email
    $mail->Password = 'dayl vfvl hhxt fpku'; // YOUR gmail password

    // Sender and recipient settings
    $mail->setFrom('eventflow786@gmail.com', 'EVENT FLOW');
    $mail->addAddress('huzaifa.50922@iqra.edu.pk', 'Receiver Name');
    // $mail->addAddress('osamafayyaz51@gmail.com', 'Osama');

    //$mail->addReplyTo('example@gmail.com', 'Sender Name'); // to set the reply to

    // Setting the email content
    $mail->IsHTML(true);
    $mail->Subject = "Failed in PF LAB";
    $mail->Body = 'Jnab You are Fail . <b>Gmail</b> We are so sorry.';
    $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';

    $mail->send();
    echo "Email message sent.";
} catch (Exception $e) {
    echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
}
?>
