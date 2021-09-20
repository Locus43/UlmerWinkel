<?php
//file to get data from json and parse it into right mail format
//ToDo: implement functions to parse text and send mail; write to log file if operation wether was successful or not

require_once("../../include/db.php");
require_once("../../include/mailDeamon.php");

parser::getEvents();

class parser{
    public function getEvents(){
        //prepare data for newsletter
        $jsonFile =  file_get_contents("../../include/tmp/tmp.json");
        $data = json_decode($jsonFile, true);

        //get all users for certain topic
        //$users = parser::getUser("gottesdienste");

        //combine topics and data
        for ($i=1; $i<= 10; $i++){
            switch ($i){
                case 1:
                    $newsletterText = '';
                    $topic = "gottesdienste";

                    $data = $data[1];
                    foreach ($data as $data){
                        $month = $data['month'];
                        $time  = $data['time'];
                        $date = $data['date'];
                        $title = $data['title'];
                        $performers = $data['performers'];
                        $description = $data['description'];
                        $location = $data['location'];
                        $locationCity = $data['locationCity'];
                        $email = $data['email'];

                        if($month == ""){
                            $month = "";
                        }if($time == ""){
                            $time = "";
                        }if($date == ""){
                            $date = "";
                        }if($title == ""){
                            $title = "";
                        }if($performers == ""){
                            $performers = "";
                        }if($description == ""){
                            $description = "";
                        }if($location == ""){
                            $location = "";
                        }if($locationCity == ""){
                            $locationCity = "";
                        }if($email == ""){
                            $email = "";
                        }

                        if($month != ""){
                            $newsletterText .= "<tr><td><p style='text-align: center;'><strong>" . $month . "</strong></p></td></tr>";
                        }$newsletterText .= "<tr><td><strong>";
                        if ($time == "00.00"){
                            $newsletterText .= $date . " Ganztägig ";
                        }if ($time != "00.00"){
                            $newsletterText .= $date;
                        }$newsletterText .= "</strong> | " . $title;
                        if($performers != ""){
                            $newsletterText .= " (" . $performers . ")";
                        }if($description != ""){
                            $newsletterText .= " | " . $description;
                        }$newsletterText .= " | " . $location . " (" . $locationCity . ") | <a href=mailto:" . $email . ">" . $email . "</a></td></tr>";
                    }
                    echo $newsletterText;
                    parser::mailPreparation($topic, $newsletterText);
                case 2:
                    $topic = "gruppen";
                case 3:
                    $topic = "fortbildungen";
                case 4:
                    $topic = "konzerte";
                case 5:
                    $topic = "freizeiten";
                case 6:
                    $topic = "ausstellungen";
                case 7:
                    $topic = "feste";
                case 8:
                    $topic = "sport";
                case 9:
                    $topic = "sonstiges";
                case 10:
                    $topic = "meditation";
            }
        }


    }private function getUser($topic){
        $users = array();
        $query = "select " . $topic . ", email as email from topics inner join newsletter on topics.uid = newsletter.id having " . $topic . " = '1'";
        $result = db::getInstance()->get_result($query);
        foreach ($result as $result){
            $email = $result[1];
            array_push($users, $email);
        }
        return $users;
    }private function mailPreparation($topic, $newsletter){
        $users = parser::getUser($topic);

        foreach ($users as $user){
            echo "<br><br>";
            echo $user;
            mailDeamon::sendNewsletter($user, $newsletter, "Ulmerwinkel Newsletter | " . $topic);
        }
    }
}