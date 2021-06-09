<?php
require_once("db.php");

class mailDeamon{


    public function sendRegisterMail($email){
        $mailMask = json_decode(file_get_contents("include/mail.json"), true);
        $subject = $mailMask["submit"]["subject"];
        $receiver = $email;
        $id = mailDeamon::getID($email);
        $text = $mailMask["submit"]["text1"];
        $text .= $id;
        $text .= $mailMask["submit"]["text2"];
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
    private function getID($email){
        $query = "select id from newsletter where email = '" . $email . "'";
        $result = db::getInstance()->get_result($query);
        $result = $result['id'];
        return $result;
    }
    public function sendNewsletter($email, $text, $subject){
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