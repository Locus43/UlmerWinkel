<?php
require_once("db.php");

class mailDeamon{


    public static function sendRegisterMail($email){
        $mailMask = parse_ini_file("mail.ini.php");
        $config = parse_ini_file('config.ini.php');
        $base_url = $config['base_url'];
        $subject = $mailMask["submitSubject"];
        $receiver = $email;
        $id = mailDeamon::getID($email);
        $textMask = $mailMask["submitText"];
        $text = str_replace("{{BASE_URL}}", "$base_url", $textMask);
        $text = str_replace("{{SUBMIT_ID}}", "$id", $text);
        $sender = $config['sender'];

        $header = array(
            'From' => $sender,
            'Reply-To' => $sender,
            'X-Mailer' => 'PHP/' . phpversion(),
            'Content-type' => 'text/html; charset=utf-8'
        );
        mail($receiver, $subject, $text, $header);
    }
    public static function getID($email){
        $query = "select id from newsletter where email = '" . $email . "'";
        $result = db::getInstance()->get_result($query);
        return $result[0][0];
    }
    public static function sendNewsletter($email, $text, $subject){
        $receiver = $email;
        $mailConfig = parse_ini_file('config.ini.php');
        $sender = $mailConfig['sender'];
        $header = array(
            'From' => $sender,
            'Reply-To' => $sender,
            'X-Mailer' => 'PHP/' . phpversion(),
            'Content-type' => 'text/html; charset=utf-8'
        );

        mail($receiver, $subject, $text, $header);
    }
}