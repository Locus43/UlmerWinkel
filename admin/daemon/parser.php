<?php
//file to get data from json and parse it into right mail format
//ToDo: implement functions to parse text and send mail

require_once("../../include/db.php");
parser::getEvents();
class parser{
    public function getEvents(){
        $jsonFile =  file_get_contents("../../include/tmp/tmp.json");
        $data = json_decode($jsonFile, true);
        parser::getUser("gruppen");


    }private function getUser($topic){
        $query = "select * from topics inner join newsletter on topics.uid = newsletter.id having " . $topic . " = '1'";
        $result = db::getInstance()->get_result($query);
        var_dump($result);
        echo $result["email"];
}
}