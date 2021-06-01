<?php
include 'sql.php';

class mailDeamon{
    private $betreff = "Ulmer-Winkel - Newsletter | Bitte bestätigen Sie Ihre Email-Adresse";
    private $from = "From: Ulmer-Winkel Newsletter <newsletter@evangelische-kirche-elchingen.de>\r\n
                     Reply-To: antwort@domain.de\r\n
                     Content-Type: text/html\r\n";

    public function sendMail($email){
        $empfaenger = $email;
        $betreff = mailDeamon::$betreff;
        $from = mailDeamon::$from;
        $id = getID($email);
        $text = "Hallo, <br>Vielen Dank für Ihre Registrierung für unseren Newsletter. Um Ihre Email-Adresse zu bestätigen, klicken Sie bitte <a href='evangelische-kirche-elchingen.de/confirm/index.php?id=". $id ."'>hier</a>.<br>Sollten Sie diesen Newsletter nicht bestellt haben, löschen oder ignorieren Sie bitte diese Email.'";
        mail($empfaenger, $betreff, $text, $from);
    }
    private function getID($email){
        $query = "select id from newsletter where email = '" . $email . "'";
        $result = sql::getInstance()->dbquery($query);
        return $result;
    }
}