<?php
require_once("../include/db.php");
require_once("../include/mailDeamon.php");
require_once("../include/csrf.php");
require_once("../include/session.php");

session::start();
if(!isset($_SESSION['userid'])){
    header("Location: login/index.php");
    exit;
}
if($_SERVER['REQUEST_METHOD'] !== 'POST' || !csrf::check($_POST['csrf_token'] ?? '')){
    http_response_code(403);
    exit("Ungültige Anfrage. Bitte das Formular neu laden und erneut absenden.");
}

$emailOption = $_POST['emailOption'] ?? '';
$text = $_POST['mailText'] ?? '';
$subject = $_POST['subject'] ?? '';

if($emailOption == "all"){
    $query = "select email from newsletter where is_confirmed='1'";
    $result = db::getInstance()->get_result($query);

    for($i = 0; $i < count($result); $i++){
        $email = $result[$i][0];
        mailDeamon::sendNewsletter($email, $text, $subject);
    }
    echo "<script>history.go(-1)</script>";
}elseif ($emailOption != "all"){
    mailDeamon::sendNewsletter($emailOption, $text, $subject);
    echo "<script>history.go(-1)</script>";
}