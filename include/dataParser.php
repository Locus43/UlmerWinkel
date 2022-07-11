<?php
//file to get data from json and parse it into right mail format
//ToDo: write to log file if operation wether was successful or not
//ToDo: Fix error where topics freizeiten and konzerte are empty in the mail --> doublecheck if check doesnt fail

require_once("db.php");
include_once("mailDeamon.php");
include_once("translateMonth.php");

class dataParser{
    public function getEvents(){
        //prepare data for newsletter
        $config = parse_ini_file('config.ini.php');
        $jsonPath = __DIR__ . $config['jsonPath'];
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
                    $topic = "Gottesdienste";
                    $state = dataParser::parser($data, $topic, $i);
                    if($state == "0"){
                        break;
                    }
                    break;
                case 1:
                    $data = $mainData[$i];
                    $topic = "Gruppen";
                    dataParser::parser($data, $topic, $i);

                    if($state == "0"){
                        break;
                    }
                    break;
                case 2:
                    $data = $mainData[$i];
                    $topic = "Fortbildungen";

                    dataParser::parser($data, $topic, $i);

                    if($state == "0"){
                        break;
                    }
                    break;
                case 3:
                    $data = $mainData[$i];
                    $topic = "Konzerte";
                    dataParser::parser($data, $topic, $i);

                    if($state == "0"){
                        break;
                    }
                    break;
                case 4:
                    $data = $mainData[$i];
                    $topic = "Freizeiten";
                    dataParser::parser($data, $topic, $i);

                    if($state == "0"){
                        break;
                    }
                    break;
                case 5:
                    $data = $mainData[$i];
                    $topic = "Ausstellungen";
                    dataParser::parser($data, $topic, $i);

                    if($state == "0"){
                        break;
                    }
                    break;
                case 6:
                    $data = $mainData[$i];
                    $topic = "Feste";
                    dataParser::parser($data, $topic, $i);

                    if($state == "0"){
                        break;
                    }
                    break;
                case 7:
                    $data = $mainData[$i];
                    $topic = "Sport";
                    dataParser::parser($data, $topic, $i);

                    if($state == "0"){
                        break;
                    }
                    break;
                case 8:
                    $data = $mainData[$i];
                    $topic = "Sonstiges";
                    dataParser::parser($data, $topic, $i);

                    if($state == "0"){
                        break;
                    }
                    break;
                case 9:
                    $data = $mainData[$i];
                    $topic = "Meditation";
                    dataParser::parser($data, $topic, $i);

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
    }private function mailPreparation($topic, $newsletter, $month){
        if(!$newsletter == ""){
            $config = parse_ini_file("../../include/mail.ini.php"); //config for mail mask
            $subject = $config['newsletterSubject'];
            $textMask = $config['newsletterText'];

            $config = parse_ini_file("../../include/config.ini.php"); //config for baseUrl
            $baseUrl = $config["base_url"];

            $users = dataParser::getUser($topic);
            $subject = str_replace("{{TOPIC}}", "$topic", $subject);
            $newsletterText = str_replace("{{MONTH}}", "$month", $textMask);
            $newsletterText = str_replace("{{BODY}}", "$newsletter", $newsletterText);

            foreach ($users as $user){
                $uid = mailDeamon::getId($user); //get uid for 'newsletter-unsubscribe-link'
                $newsletterTextUser = str_replace("{{UNSUBSCRIBE_LINK}}", "$baseUrl/unsubscribe/index.php?id=$uid", "$newsletterText");

                mailDeamon::sendNewsletter($user, $newsletterTextUser, $subject);
            }
        }
    }private function parser($data, $topic, $topicInt){
        $newsletterText = "";
        $currentMonth = date('m');
        $translatedMonth = translateMonth::translate($currentMonth);

            if($data != null){
                if(!array_key_exists('_event_STATUS', $data)){
                    foreach ($data as $data) {
                        $month = $data['START_MONAT'];
                        $time = $data['START_UHRZEIT'];
                        $date = $data['DATUM'];
                        $title = $data['_event_TITLE'];
                        $performers = $data['_person_NAME'];
                        $description = $data['_event_LONG_DESCRIPTION'];
                        $location = $data['_place_NAME'];
                        $locationCity = $data['_place_CITY'];
                        $eventImage = $data['_event_IMAGE'];
                        $placeImage = $data['_place_IMAGE'];
                        if(empty($eventImage) || is_array($eventImage))
                        {
                            $eventImage = $placeImage;
                        }
                            if($month == $translatedMonth){
                                $newsletterText .= "<tr><td style='padding: 10px;'>";
                                if(!empty($eventImage) && !is_array($eventImage))
                                {
                                    $newsletterText .= "<img src=\"https:".$eventImage."\" width='120px'>";
                                }
                                $newsletterText .= "</td><td style='padding: 10px;'><strong>";
                                if ($time == "00.00") {
                                    $newsletterText .= $date . " Ganztägig ";
                                }
                                if ($time != "00.00") {
                                    $newsletterText .= $date;
                                }
                                $newsletterText .= "</strong> | " . $title . "<br>" . $location . " (" . $locationCity . ")";
                                if (!is_array($performers)) {
                                    $newsletterText .= " | <i>". $performers . "</i>";
                                }
                                if (!is_array($description)) {
                                    $newsletterText .= "<br><i>" . $description . "</i>";
                                }
                                $newsletterText .= "</td></tr>";
                            }else{
                                break;
                        }

                    }
                    $month = translateMonth::translate($currentMonth);
                    dataParser::mailPreparation($topic, $newsletterText, $month);
                }
            }
        else{
            return "0";
        }
    }
}