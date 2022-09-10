<?php
require_once("../include/db.php");

$id = $_GET['id'];

if($id != ""){
    $query = "delete from newsletter where id = '" . $id . "'";
    $resultNewsletter = db::getInstance()->dbquery($query);
    $query = "delete from topics where uid = '" . $id . "'";
    $resultTopics = db::getInstance()->dbquery($query);

    if($resultNewsletter && $resultTopics == true){
        echo "Sie haben sich erfolgreich vom Newsletter abgemeldet.";
    }else{
        echo "Fehler. Die Emailadresse wurde entweder nicht gefunden, oder konnte nicht aus unserer Datenbank gelöscht werden. Bitte versuchen Sie es erneut.";
    }
}else{
    echo "Fehler. Die Emailadresse konnte nicht gelöscht werden: ID = NULL";
}