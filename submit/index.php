<?php
require_once("../include/db.php");

$id = $_GET['id'] ?? '';

if($id != ""){
    $query = "update newsletter set is_confirmed = '1' where id = ?";
    $result = db::getInstance()->dbquery($query, [$id]);

    if($result == true){
        echo "Emailadresse wurde erfolgreich bestätigt. Vielen Dank für Ihre Registrierung.";
    }else{
        echo "Fehler. Die Emailadresse konnte nicht bestätigt werden.";
    }
}else{
    echo "Fehler. Die Emailadresse konnte nicht bestätigt werden: ID = NULL";
}