<?php
include 'db.php';

class mailDeamon{


    public function sendMail($email){
        $betreff = "Ulmer-Winkel - Newsletter | Bitte bestätigen Sie Ihre Email-Adresse";
        $header = array(
            'From' => 'newsletter@evangelische-kirche-elchingen.de',
            'Reply-To' => 'newsletter@evangelische-kirche-elchingen.de',
            'X-Mailer' => 'PHP/' . phpversion(),
            'Content-type' => 'text/html; charset=utf-8'
        );
        $empfaenger = $email;
        $id = mailDeamon::getID($email);
        //Richtige Domain
        //$text = "Hallo, <br>Vielen Dank für Ihre Registrierung für unseren Newsletter. Um Ihre Email-Adresse zu bestätigen, klicken Sie bitte <a href='evangelische-kirche-elchingen.de/confirm/index.php?id=". $id ."'>hier</a>.<br>Sollten Sie diesen Newsletter nicht bestellt haben, löschen oder ignorieren Sie bitte diese Email.";
        //Testdomain
        $text = "Hallo, <br>Vielen Dank für Ihre Registrierung für unseren Newsletter. Um Ihre Email-Adresse zu bestätigen, klicken Sie bitte <a href='5b5c3771c1629.prepaiddomain.de/test/ulmer-winkel/newsletter/submit/index.php?id=". $id ."'>hier</a>.<br>Sollten Sie diesen Newsletter nicht bestellt haben, löschen oder ignorieren Sie bitte diese Email.";
        mail($empfaenger, $betreff, $text, $header);
    }
    private function getID($email){
        $query = "select id from newsletter where email = '" . $email . "'";
        $result = db::getInstance()->get_result($query);
        $result = $result['id'];
        return $result;
    }
}