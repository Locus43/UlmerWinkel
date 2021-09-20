<?php
//file to get data from json and parse it into right mail format
//ToDo: implement functions to parse text and send mail; write to log file if operation wether was successful or not

require_once("../../include/db.php");
require_once("../../include/mailDeamon.php");

parser::getEvents();

class parser{
    public static function getEvents(){
        //prepare data for newsletter
        $jsonFile =  file_get_contents("../../include/tmp/tmp.json");
        $mainData = json_decode($jsonFile, true);

        //get all users for certain topic
        //$users = parser::getUser("gottesdienste");

        //combine topics and data
        for ($i=1; $i<= 10; $i++){
            switch ($i){
                case 1:
                    $data = $mainData[$i];
                    $newsletterText = '';
                    $topic = "gottesdienste";

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
                    $data = $mainData[$i];
                    $newsletterText = '';
                    $topic = "gruppen";

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
                case 3:
                    $data = $mainData[$i];
                    $newsletterText = '';
                    $topic = "fortbildungen";

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
                case 4:
                    $data = $mainData[$i];
                    $newsletterText = '';
                    $topic = "konzerte";

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
                case 5:
                    $data = $mainData[$i];
                    $newsletterText = '';
                    $topic = "freizeiten";

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
                case 6:
                    $data = $mainData[$i];
                    $newsletterText = '';
                    $topic = "ausstellungen";

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
                case 7:
                    $data = $mainData[$i];
                    $newsletterText = '';
                    $topic = "feste";

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
                case 8:
                    $data = $mainData[$i];
                    $newsletterText = '';
                    $topic = "sport";

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
                case 9:
                    $data = $mainData[$i];
                    $newsletterText = '';
                    $topic = "sonstiges";

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
                case 10:
                    $data = $mainData[$i];
                    $newsletterText = '';
                    $topic = "meditation";

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
            }
        }


    }private static function getUser($topic){
        $users = array();
        $query = "select " . $topic . ", email as email from topics inner join newsletter on topics.uid = newsletter.id having " . $topic . " = '1'";
        $result = db::getInstance()->get_result($query);
        if(is_array($result)){
            foreach ($result as $email){
                array_push($users, $email[1]);
            }
        }
        return $users;
    }private static function mailPreparation($topic, $newsletter){
        $users = parser::getUser($topic);

        foreach ($users as $user){
            echo "<br><br>";
            mailDeamon::sendNewsletter($user, $newsletter, "Ulmerwinkel Newsletter | " . $topic);
        }
    }
}