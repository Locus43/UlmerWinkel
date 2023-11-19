<?php
require_once("../include/db.php");
require_once("../include/validateEmail.php");

$id = $_GET['id'];
$confirm = $_GET['confirm'];

if($confirm === "true") {
    $valid = validateEmail::checkForId($id);

    if($id != "" && $valid){
        $query = "delete from newsletter where id = '" . $id . "'";
        $resultNewsletter = db::getInstance()->dbquery($query);
        $query = "delete from topics where uid = '" . $id . "'";
        $resultTopics = db::getInstance()->dbquery($query);
        $query = "INSERT INTO events (eventtype) values('unsubscribe')";
        $resultStatics = db::getInstance()->dbquery($query);
    
        if($resultNewsletter && $resultTopics && $resultStatics){
            echo "Sie haben sich erfolgreich vom Newsletter abgemeldet.";
        }else{
            echo "Fehler. Die Emailadresse wurde entweder nicht gefunden, konnte nicht aus unserer Datenbank gelöscht oder konnte statistisch nicht erfasst werden. Bitte versuchen Sie es erneut.";
        }
    }else{
        echo "Fehler. Die Emailadresse konnte nicht gelöscht werden: ID = NON_EXISTENT";
    }
    exit(0);
}
?>
<html>
    <head>
        <title>Newsletter Abmeldung</title>
    </head>
    <body>
        <h1>Newsletter Abmeldung</h1>
        <p>Bitte best&auml;tigen Sie Ihre Abmeldung vom Ulmer-Winkel-Newsletter:</p>
        <form method="get">
			<input type="hidden" name="confirm" value="true">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" value="Abmelden">
        </form>
    </body>
</html>

