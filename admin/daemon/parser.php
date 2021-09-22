<?php
//file to get data from json and parse it into right mail format
//ToDo: write to log file if operation wether was successful or not

require_once("../../include/db.php");
include_once("../../include/mailDeamon.php");

parser::getEvents();

class parser{
    public static function getEvents(){
        //prepare data for newsletter
        $jsonFile =  file_get_contents("../../include/tmp/tmp.json");
        $mainData = json_decode($jsonFile, true);
        
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

                        $newsletterText .= "<table><tbody>";
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
                        }$newsletterText .= " | " . $location . " (" . $locationCity . ") | <a href=mailto:" . $email . ">" . $email . "</a></td>";
                    }
                    $newsletterText .= "</tbody></table>";
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

                        $newsletterText .= "<tbody>";
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
                        }$newsletterText .= " | " . $location . " (" . $locationCity . ") | <a href=mailto:" . $email . ">" . $email . "</a></td></tr></tbody>";
                    }
                    $newsletterText .= "</tbody></table>";
                    parser::mailPreparation($topic, $newsletterText);
                    break;
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

                        $newsletterText .= "<tbody>";
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
                        }$newsletterText .= " | " . $location . " (" . $locationCity . ") | <a href=mailto:" . $email . ">" . $email . "</a></td></tr></tbody>";
                    }
                    $newsletterText .= "</tbody></table>";
                    parser::mailPreparation($topic, $newsletterText);
                    break;
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

                        $newsletterText .= "<tbody>";
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
                        }$newsletterText .= " | " . $location . " (" . $locationCity . ") | <a href=mailto:" . $email . ">" . $email . "</a></td></tr></tbody>";
                    }
                    $newsletterText .= "</tbody></table>";
                    parser::mailPreparation($topic, $newsletterText);
                    break;
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

                        $newsletterText .= "<tbody>";
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
                        }$newsletterText .= " | " . $location . " (" . $locationCity . ") | <a href=mailto:" . $email . ">" . $email . "</a></td></tr></tbody>";
                    }
                    $newsletterText .= "</tbody></table>";
                    parser::mailPreparation($topic, $newsletterText);
                    break;
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

                        $newsletterText .= "<tbody>";
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
                        }$newsletterText .= " | " . $location . " (" . $locationCity . ") | <a href=mailto:" . $email . ">" . $email . "</a></td></tr></tbody>";
                    }
                    $newsletterText .= "</tbody></table>";
                    parser::mailPreparation($topic, $newsletterText);
                    break;
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

                        $newsletterText .= "<tbody>";
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
                        }$newsletterText .= " | " . $location . " (" . $locationCity . ") | <a href=mailto:" . $email . ">" . $email . "</a></td></tr></tbody>";
                    }
                    $newsletterText .= "</tbody></table>";
                    parser::mailPreparation($topic, $newsletterText);
                    break;
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

                        $newsletterText .= "<tbody>";
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
                        }$newsletterText .= " | " . $location . " (" . $locationCity . ") | <a href=mailto:" . $email . ">" . $email . "</a></td></tr></tbody>";
                    }
                    $newsletterText .= "</tbody></table>";
                    parser::mailPreparation($topic, $newsletterText);
                    break;
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

                        $newsletterText .= "<tbody>";
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
                        }$newsletterText .= " | " . $location . " (" . $locationCity . ") | <a href=mailto:" . $email . ">" . $email . "</a></td></tr></tbody>";
                    }
                    $newsletterText .= "</tbody></table>";
                    parser::mailPreparation($topic, $newsletterText);
                    break;
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

                        $newsletterText .= "<tbody>";
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
                        }$newsletterText .= " | " . $location . " (" . $locationCity . ") | <a href=mailto:" . $email . ">" . $email . "</a></td></tr></tbody>";
                    }
                    $newsletterText .= "</tbody></table>";
                    parser::mailPreparation($topic, $newsletterText);
                    break;
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
        $config = parse_ini_file("../../include/mail.ini.php"); //config for mail mask
        $subject = $config['newsletterSubject'];
        $textMask = $config['newsletterText'];

        $config = parse_ini_file("../../include/config.ini.php"); //config for baseUrl
        $baseUrl = $config["base_url"];

        $users = parser::getUser($topic);
        $subject = str_replace("{{TOPIC}}", "$topic", $subject);
        $newsletterText = str_replace("{{BODY}}", "$newsletter", $textMask);

        foreach ($users as $user){
            $uid = mailDeamon::getId($user); //get uid for 'newsletter-unsubscribe-link'
            $newsletterText = str_replace("{{UNSUBSCRIBE_LINK}}", "$baseUrl/unsubscribe/index.php?id=$uid", "$newsletterText");

            mailDeamon::sendNewsletter($user, $newsletterText, $subject);
        }
    }
}