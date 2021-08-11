<?php

//php脚本永不过期
set_time_limit(0);

//php发送邮件，可以phpmailer
//队列key

$key = 'sendmaillist';

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require __DIR__.'/vendor/autoload.php';


//读一下队列是否有记录
$bool = $redis->exists($key);

if ($bool) return;

while (true) {
    //列表中有数据
    if ($redis->lLen($key) > 0) {
        $toMail = $redis->rPop($key);
        sendmail($toMail);
    }



    sleep(2);
}


function sendmail(string $toMail)
{
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        // $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
        $mail->Host       = 'smtp.qq.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        // $mail->Username   = 'user@example.com';                     //SMTP username
        // $mail->Password   = 'secret';                               //SMTP password
        $mail->Username   = '337262953@qq.com';                     //SMTP username
        $mail->Password   = 'sfnwuehuwe';                               //SMTP password
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        // $mail->setFrom('from@example.com', 'Mailer');
        $mail->setFrom('337262953@qq.com', 'linfei');
        $mail->addAddress($toMail, 'Joe User');     //Add a recipient
        // $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
        // $mail->addAddress('ellen@example.com');               //Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent \n';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}



