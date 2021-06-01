<?php
require 'include/validateEmail.php';
require 'include/sql.php';
require 'include/mailDeamon.php';
require 'include/generateId.php';

$id = "null";
$email = $_POST['email'];

$valid = validate($email);

if($valid == true){
    $id = generateId();
    $query = "insert into newsletter (id, email) values('" . $id . $email . "')";
    $result = sql::getInstance()->dbquery($query);
    if($result == true){
        mailDeamon::sendMail($email);
        echo "Bestätigungsemail wurde verschickt. Bitte bestätigen Sie Ihre Emailadresse.";
    }else{
        echo "Ein technischer Fehler ist aufgetreten. Bitte versuchen Sie es erneut. Sollte dieser Fehler erneut auftretene, schreiben Sie bitte eine Email an: <a href='mailto:jan@wehrheim.eu'>jan@wehrheim.eu</a>";
    }
}else{
    echo "Die Emailadresse ist nicht gültig. Bitte überprüfen Sie Ihre Eingabe.";
}
?>