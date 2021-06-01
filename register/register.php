<?php
require 'include/validateEmail.php';
require 'include/sql.php';

$email = $_POST['email'];

$valid = validate($email);

if($valid == true){
    echo "Bestätigungsemail wurde verschickt. Bitte bestätigen Sie Ihre Emailadresse.";

}else{
    echo "Die Emailadresse ist nicht gültig. Bitte überprüfen Sie Ihre Eingabe.";
}
?>