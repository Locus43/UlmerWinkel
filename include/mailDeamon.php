<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once("db.php");
require_once("phpmailer/src/Exception.php");
require_once("phpmailer/src/OAuth.php");
require_once("phpmailer/src/PHPMailer.php");
require_once("phpmailer/src/POP3.php");
require_once("phpmailer/src/SMTP.php");

class mailDeamon{


    public function sendRegisterMail($email){
        $mailMask = parse_ini_file("mail.ini.php");
        $config = parse_ini_file('config.ini.php');
        $base_url = $config['base_url'];
        $subject = $mailMask["submitSubject"];
        $recipient = $email;
        $id = mailDeamon::getID($email);
        $textMask = $mailMask["submitText"];
        $text = str_replace("{{BASE_URL}}", "$base_url", $textMask);
        $text = str_replace("{{SUBMIT_ID}}", "$id", $text);
        $sender = $config['smtp_sender'];

        //smtp config
        $debug = $config['smtp_debug'];
        $host = $config['smtp_host'];
        $smtp_auth = $config['smtp_auth'];
        $password = $config['smtp_password'];
        $securityOptions = $config['smtp_security'];
        $port = $config['port'];

        $mail = new PHPMailer(true);

        try{
            //server connection
            $mail->SMTPDebug = $debug;
            $mail->isSMTP();
            $mail->Host = $host;
            $mail->SMTPAuth = $smtp_auth;
            $mail->Username = $sender;
            $mail->Password = $password;
            $mail->SMTPSecure = $securityOptions;
            $mail->Port = $port;
            $mail->CharSet = 'UTF-8';

            //recipients
            $mail->setFrom($sender, $sender);
            $mail->addAddress($recipient);

            //Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $text;

            //final step
            $mail->send();
            //apache_note('Info', 'Mail has been sent successfully');
            syslog(LOG_INFO, "Mail has bee sent successfully");
        }catch(Exception $e){
            //apache_note('Mail_Error', 'Mail couldn\'t be sent. Mailer error: {$mail->ErrorInfo}');
            syslog(LOG_ERROR, "Mail couldn\'t be sent. Mailer error: {$mail->ErrorInfo}");
        }
    }
    public function getID($email){
        $query = "select id from newsletter where email = '" . $email . "'";
        $result = db::getInstance()->get_result($query);
        return $result[0][0];
    }
    public function sendNewsletter($email, $text, $subject){
        $recipient = $email;
        $mailConfig = parse_ini_file('config.ini.php');
        $sender = $mailConfig['smtp_sender'];

        $debug = $mailConfig['smtp_debug'];
        $host = $mailConfig['smtp_host'];
        $smtp_auth = $mailConfig['smtp_auth'];
        $password = $mailConfig['smtp_password'];
        $securityOptions = $mailConfig['smtp_security'];
        $port = $mailConfig['port'];

        $mail = new PHPMailer(true);

        try{
            //server connection
            $mail->SMTPDebug = $debug;
            $mail->isSMTP();
            $mail->Host = $host;
            $mail->SMTPAuth = $smtp_auth;
            $mail->Username = $sender;
            $mail->Password = $password;
            $mail->SMTPSecure = $securityOptions;
            $mail->Port = $port;
            $mail->CharSet = 'UTF-8';

            //recipients
            $mail->setFrom($sender, $sender);
            $mail->addAddress($recipient);

            //Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $text;

            //final step
            $mail->send();
            syslog(LOG_INFO, "Mail has bee sent successfully");
        }catch(Exception $e){
            syslog(LOG_ERROR, "Mail couldn\'t be sent. Mailer error: {$mail->ErrorInfo}");
        }
    }
}