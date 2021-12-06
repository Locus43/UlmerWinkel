<?php
require_once('../include/validateEmail.php');
require_once('../include/db.php');
require_once('../include/mailDeamon.php');
require_once('../include/generateId.php');

$id = "null";
$email = $_GET['email'];
$topics = $_GET['topic'];
$valid = false;

$valid = validateEmail::validate($email);

if($valid == "true"){
    $id = (new generateId)->generateId();
    $query = "INSERT INTO newsletter (id, email) values('" . $id . "', '" . $email . "')";
    $result = db::getInstance()->dbquery($query);
    $query = "INSERT INTO topics (uid) values('" . $id . "')";
    $result = db::getInstance()->dbquery($query);
    if($result == true){
        //ToDo: fix sql statements
        foreach ($topics as $key){
            if($key == '1'){
                $query = "update topics set gottesdienste = '1' where uid like '" . $id . "'";
                $result = db::getInstance()->dbquery($query);
            }if($key == '2'){
                $query = "update topics set gruppen = '1' where uid like '" . $id . "'";
                $result = db::getInstance()->dbquery($query);
            }if($key == '3'){
                $query = "update topics set fortbildungen = '1' where uid like '" . $id . "'";
                $result = db::getInstance()->dbquery($query);
            }if($key == '4'){
                $query = "update topics set konzerte = '1' where uid like '" . $id . "'";
                $result = db::getInstance()->dbquery($query);
            }if($key == '5'){
                $query = "update topics set freizeiten = '1' where uid like '" . $id . "'";
                $result = db::getInstance()->dbquery($query);
            }if($key == '6'){
                $query = "update topics set ausstellungen = '1' where uid like '" . $id . "'";
                $result = db::getInstance()->dbquery($query);
            }if($key == '7'){
                $query = "update topics set feste = '1' where uid like '" . $id . "'";
                $result = db::getInstance()->dbquery($query);
            }if($key == '8'){
                $query = "update topics set sport = '1' where uid like '" . $id . "'";
                $result = db::getInstance()->dbquery($query);
            }if($key == '9'){
                $query = "update topics set sonstiges = '1' where uid like '" . $id . "'";
                $result = db::getInstance()->dbquery($query);
            }if($key == '10'){
                $query = "update topics set meditation = '1' where uid like '" . $id . "'";
                $result = db::getInstance()->dbquery($query);
            }
        }
        mailDeamon::sendRegisterMail($email);
        echo "Bestätigungsemail wurde verschickt. Bitte bestätigen Sie Ihre Emailadresse.";
    }else{
        echo "Ein technischer Fehler ist aufgetreten. Bitte versuchen Sie es erneut. Sollte dieser Fehler erneut auftreten, schreiben Sie bitte eine Email an: <a href='mailto:jan@wehrheim.eu'>jan(at)wehrheim.eu</a>";
    }
}else{
    echo "Die Emailadresse ist entweder nicht gültig oder sie wurde bereits für den Newsletter registriert. Bitte überprüfen Sie Ihre Eingabe. Sollten Sie die Emailadresse schon registriert haben, bestätigen Sie bitte diese Emailadresse. Sie haben dazu eine Email von uns bekommen.<br>
          Wenn die Email nicht in Ihrem Postfach ist, kontrollieren Sie bitte Ihren Spam-Ordner.";
}
?>