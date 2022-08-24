<?php
include "PHPMailer/src/PHPMailer.php";
include "PHPMailer/src/Exception.php";
include "PHPMailer/src/OAuth.php";
include "PHPMailer/src/POP3.php";
include "PHPMailer/src/SMTP.php";
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->SMTPDebug = 0;
    $mail->ChartSet = 'UTF-8';
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'nghiemmanhcuong98@gmail.com';
    $mail->Password = 'caisjgruzdxragql';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    //Recipients
    $mail->setFrom('nghiemmanhcuong98@gmail.com', 'ADMIN');
    $mail->addAddress("$email", "");


    //Content
    $mail->isHTML(true);
    $mail->Subject = "Chào bạn";
    $mail->Body    = $content;

    $mail->send();
} catch (Exception $e) {
    $error = 'Gửi mail thất bại vui lòng gửi lại';
}
