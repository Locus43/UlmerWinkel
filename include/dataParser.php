<?php
//file to get data from json and parse it into right mail format
//ToDo: write to log file if operation wether was successful or not

require_once("db.php");
include_once("mailDeamon.php");
include_once("translateMonth.php");

class dataParser{
    public function getEvents(){
        //prepare data for newsletter
        $config = parse_ini_file('config.ini.php');
        $jsonPath = $config['jsonPath'];
        $jsonFile =  file_get_contents("$jsonPath");
        $mainData = json_decode($jsonFile, true);

        //get current month
        $currentMonth = date('m');
        $translatedMonth = translateMonth::translate($currentMonth);

        //combine topics and data
        for ($i=0; $i<=10; $i++){
            switch ($i){
                case 0:
                    $data = $mainData[$i];
                    $topic = "gottesdienste";
                    $state = dataParser::parser($data, $topic);
                    if($state == "0"){
                        break;
                    }
                    break;
                case 1:
                    $data = $mainData[$i];
                    $topic = "gruppen";
                    dataParser::parser($data, $topic);
                    if($state == "0"){
                        break;
                    }
                    break;
                case 2:
                    $data = $mainData[$i];
                    $topic = "fortbildungen";
                    dataParser::parser($data, $topic);
                    if($state == "0"){
                        break;
                    }
                    break;
                case 3:
                    $data = $mainData[$i];
                    $topic = "konzerte";
                    dataParser::parser($data, $topic);
                    if($state == "0"){
                        break;
                    }
                    break;
                case 4:
                    $data = $mainData[$i];
                    $topic = "freizeiten";
                    dataParser::parser($data, $topic);
                    if($state == "0"){
                        break;
                    }
                    break;
                case 5:
                    $data = $mainData[$i];
                    $topic = "ausstellungen";
                    dataParser::parser($data, $topic);
                    if($state == "0"){
                        break;
                    }
                    break;
                case 6:
                    $data = $mainData[$i];
                    $topic = "feste";
                    dataParser::parser($data, $topic);
                    if($state == "0"){
                        break;
                    }
                    break;
                case 7:
                    $data = $mainData[$i];
                    $topic = "sport";
                    dataParser::parser($data, $topic);
                    if($state == "0"){
                        break;
                    }
                    break;
                case 8:
                    $data = $mainData[$i];
                    $topic = "sonstiges";
                    dataParser::parser($data, $topic);
                    if($state == "0"){
                        break;
                    }
                    break;
                case 9:
                    $data = $mainData[$i];
                    $topic = "meditation";
                    dataParser::parser($data, $topic);
                    if($state == "0"){
                        break;
                    }
                    break;
            }
        }


    }private function getUser($topic){
        $users = array();
        $query = "select " . $topic . ", email, is_confirmed as email from topics inner join newsletter on topics.uid = newsletter.id where " . $topic . " = '1' and newsletter.is_confirmed = '1'";
        $result = db::getInstance()->get_result($query);
        if(is_array($result)){
            foreach ($result as $email){
                array_push($users, $email[1]);
            }
        }
        return $users;
    }private function mailPreparation($topic, $newsletter){
        $config = parse_ini_file("../../include/mail.ini.php"); //config for mail mask
        $subject = $config['newsletterSubject'];
        $textMask = $config['newsletterText'];

        $config = parse_ini_file("../../include/config.ini.php"); //config for baseUrl
        $baseUrl = $config["base_url"];

        $users = dataParser::getUser($topic);
        $subject = str_replace("{{TOPIC}}", "$topic", $subject);
        $newsletterText = str_replace("{{BODY}}", "$newsletter", $textMask);

        foreach ($users as $user){
            $uid = mailDeamon::getId($user); //get uid for 'newsletter-unsubscribe-link'
            $newsletterTextUser = str_replace("{{UNSUBSCRIBE_LINK}}", "$baseUrl/unsubscribe/index.php?id=$uid", "$newsletterText");

            mailDeamon::sendNewsletter($user, $newsletterTextUser, $subject);
        }
    }private function parser($data, $topic){
        $newsletterText = "";
        $currentMonth = date('m');
        $translatedMonth = translateMonth::translate($currentMonth);

        if($data != null){
            if(!array_key_exists('_event_STATUS', $data)){
                $newsletterText .= "<table><tbody>";
                $newsletterText .= "<tr><td><p style='text-align: center;'><strong>{{MONTH}}</strong></p></td></tr>";
                foreach ($data as $data) {
                    $month = $data['START_MONAT'];
                    $time = $data['START_UHRZEIT'];
                    $date = $data['DATUM'];
                    $title = $data['_event_TITLE'];
                    $performers = $data['_person_NAME'];
                    $description = $data['_event_LONG_DESCRIPTION'];
                    $location = $data['_place_NAME'];
                    $locationCity = $data['_place_CITY'];
                    $email = $data['_user_EMAIL'];

                    if($month == $translatedMonth){
                        $newsletterText .= "<tr><td><strong>";
                        if ($time == "00.00") {
                            $newsletterText .= $date . " Ganztägig ";
                        }
                        if ($time != "00.00") {
                            $newsletterText .= $date;
                        }
                        $newsletterText .= "</strong> | " . $title;
                        if (is_array($performers) != true) {
                            $newsletterText .= " (" . $performers . ")";
                        }
                        if (is_array($description) != true) {
                            $newsletterText .= " | " . $description;
                        }
                        $newsletterText .= " | " . $location . " (" . $locationCity . ") | <a href=mailto:" . $email . ">" . $email . "</a></td></tr>";
                    }else{
                        break;
                    }
                }
                $newsletterText .= "</tbody></table>";
                $month = translateMonth::translate($currentMonth);
                $newsletterText = str_replace("{{MONTH}}", "$month", "$newsletterText");
                dataParser::mailPreparation($topic, $newsletterText);
            }
        }else{
            return "0";
        }
    }
}