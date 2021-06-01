<?php
include "../register/include/sql.php";

$id = $_GET['id'];

$query = "update newsletter set is_confirmed = '1' where id = '" . $id . "'";
$result = sql::getInstance()->dbquery($query);

if($result == true){
    echo "Emailadresse wurde erfolgreich bestätigt. Vielen Dank für Ihre Registrierung.";
}else{
    echo "Fehler. Die Emailadresse konnte nicht bestätigt werden.";
}