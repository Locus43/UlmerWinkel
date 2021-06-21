<?php
require_once("../include/db.php");

$id = $_GET['id'];

if($id != ""){
    $query = "delete from newsletter where id = '" . $id . "'";
    $result = db::getInstance()->dbquery($query);

    if($result == true){
        echo "Sie haben sich erfolgreich vom Newsletter abgemeldet.";
    }else{
        echo "Fehler. Die Emailadresse wurde entweder nicht gefunden, oder konnte nicht aus unserer Datenbank gelöscht werden. Bitte versuchen SIe es erneut.";
    }
}else{
    echo "Fehler. Die Emailadresse konnte nicht bestätigt werden: ID = NULL";
}