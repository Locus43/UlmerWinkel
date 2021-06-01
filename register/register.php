<?php
require 'include/validateEmail.php';
//require 'include/db.php';
require 'include/mailDeamon.php';
require 'include/generateId.php';

$id = "null";
$email = $_GET['email'];

$valid = validateEmail::validate($email);

if($valid == "true"){
    $id = (new generateId)->generateId();
    $query = "INSERT INTO newsletter (id, email) values('" . $id . "', '" . $email . "')";
    $result = db::getInstance()->dbquery($query);
    //echo $result;
    if($result == true){
        mailDeamon::sendMail($email);
        echo "Bestätigungsemail wurde verschickt. Bitte bestätigen Sie Ihre Emailadresse.";
    }else{
        echo "Ein technischer Fehler ist aufgetreten. Bitte versuchen Sie es erneut. Sollte dieser Fehler erneut auftreten, schreiben Sie bitte eine Email an: <a href='mailto:jan@wehrheim.eu'>jan@wehrheim.eu</a>";
    }
}else{
    echo "Die Emailadresse ist nicht gültig. Bitte überprüfen Sie Ihre Eingabe.";
}
?>