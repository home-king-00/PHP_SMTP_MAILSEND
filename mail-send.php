<?php
require './include/PHPMailer/src/PHPMailer.php';
require './include/PHPMailer/src/SMTP.php';
require './include/PHPMailer/src/Exception.php';

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
// require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.naver.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = '이메일 아이디';                     //SMTP username
    $mail->Password   = '이메일 비밀번호';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    $mail->CharSet    = "EUC-KR";
    $mail->Encoding   = "base64";

    //Recipients
    $mail->setFrom('보내는 사람 이메일', "=?UTF-8?B?".base64_encode("보내는 사람 이메일")."?="."\r\n");
    $mail->addAddress('받는 사람 이메일', "=?UTF-8?B?".base64_encode("받는 사람 이메일")."?="."\r\n");     //Add a recipient
    $mail->addReplyTo('참조', "=?UTF-8?B?".base64_encode("참조")."?="."\r\n");

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    
    $mail->Subject = '=?UTF-8?B?'.base64_encode( "메일 제목" ).'?=';
    $mail->Body    = "메일 내용";
        
    $mail->send();

    echo "메일 전송 완료";
} catch (Exception $e) {
    echo "메일 전송 실패";
}