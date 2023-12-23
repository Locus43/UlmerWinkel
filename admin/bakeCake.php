<?php
require_once("../include/db.php");
require_once("../include/mailDeamon.php");

$emailOption = $_GET['emailOption'];
$text = $_GET['mailText'];
$subject = $_GET['subject'];

if($emailOption == "all"){
    $query = "select email from newsletter where is_confirmed='1'";
    $result = db::getInstance()->get_result($query);

    for($i = 0; $i <= count($result); $i++){
        $email = $result[$i][0];
        mailDeamon::sendManualNewsletter($email, $text, $subject);
    }
    echo "<script>history.go(-1)</script>";
}elseif ($emailOption != "all"){
    mailDeamon::sendManualNewsletter($emailOption, $text, $subject);
    echo "<script>history.go(-1)</script>";
}