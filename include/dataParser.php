<?php
//file to get data from json and parse it into right mail format
//ToDo: write to log file if operation wether was successful or not

require_once("db.php");
include_once("mailDeamon.php");

class dataParser{
    public static function getEvents(){
        //prepare data for newsletter
        $config = parse_ini_file('config.ini.php');
        $jsonPath = $config['jsonPath'];
        $jsonFile =  file_get_contents("$jsonPath");
        $mainData = json_decode($jsonFile, true);

        //initialize some vars
        $oldMonth = "";

        //combine topics and data
        for ($i=0; $i<=10; $i++){
            switch ($i){
                case 0:
                    $data = $mainData[$i];
                    $newsletterText = '';
                    $topic = "gottesdienste";

                    if($data == null){
                        break;
                    }
                    if(!array_key_exists('_event_STATUS', $data)){
                        foreach ($data as $data){
                            $month = $data['START_MONAT'];
                            $time  = $data['START_UHRZEIT'];
                            $date = $data['DATUM'];
                            $title = $data['_event_TITLE'];
                            $performers = $data['_person_NAME'];
                            $description = $data['_event_LONG_DESCRIPTION'];
                            $location = $data['_place_NAME'];
                            $locationCity = $data['_place_CITY'];
                            $email = $data['_user_EMAIL'];

                            $newsletterText .= "<table><tbody>";
                            if($month != $oldMonth){
                                $newsletterText .= "<tr><td><p style='text-align: center;'><strong>" . $month . "</strong></p></td></tr>";
                            }$newsletterText .= "<tr><td><strong>";
                            if ($time == "00.00"){
                                $newsletterText .= $date . " Ganztägig ";
                            }if ($time != "00.00"){
                                $newsletterText .= $date;
                            }$newsletterText .= "</strong> | " . $title;
                            if(is_array($performers) != true){
                                $newsletterText .= " (" . $performers . ")";
                            }if(is_array($description) != true){
                                $newsletterText .= " | " . $description;
                            }$newsletterText .= " | " . $location . " (" . $locationCity . ") | <a href=mailto:" . $email . ">" . $email . "</a></td></tr>";
                            $oldMonth = $month;
                        }
                    }else{
                        $month = $data['START_MONAT'];
                        $time  = $data['START_UHRZEIT'];
                        $date = $data['DATUM'];
                        $title = $data['_event_TITLE'];
                        $performers = $data['_person_NAME'];
                        $description = $data['_event_LONG_DESCRIPTION'];
                        $location = $data['_place_NAME'];
                        $locationCity = $data['_place_CITY'];
                        $email = $data['_user_EMAIL'];

                        $newsletterText .= "<table><tbody>";
                        if($month != $oldMonth){
                            $newsletterText .= "<tr><td><p style='text-align: center;'><strong>" . $month . "</strong></p></td></tr>";
                        }$newsletterText .= "<tr><td><strong>";
                        if ($time == "00.00"){
                            $newsletterText .= $date . " Ganztägig ";
                        }if ($time != "00.00"){
                            $newsletterText .= $date;
                        }$newsletterText .= "</strong> | " . $title;
                        if(is_array($performers) != true){
                            $newsletterText .= " (" . $performers . ")";
                        }if(is_array($description) != true){
                            $newsletterText .= " | " . $description;
                        }$newsletterText .= " | " . $location . " (" . $locationCity . ") | <a href=mailto:" . $email . ">" . $email . "</a></td></tr>";
                        $oldMonth = $month;
                    }

                    $newsletterText .= "</tbody></table>";
                    dataParser::mailPreparation($topic, $newsletterText);
                    break;
                case 1:
                    $data = $mainData[$i];
                    $newsletterText = '';
                    $topic = "gruppen";

                    if($data == null){
                        break;
                    }
                    if(!array_key_exists('_event_STATUS', $data)){
                        foreach ($data as $data){
                            $month = $data['START_MONAT'];
                            $time  = $data['START_UHRZEIT'];
                            $date = $data['DATUM'];
                            $title = $data['_event_TITLE'];
                            $performers = $data['_person_NAME'];
                            $description = $data['_event_LONG_DESCRIPTION'];
                            $location = $data['_place_NAME'];
                            $locationCity = $data['_place_CITY'];
                            $email = $data['_user_EMAIL'];

                            $newsletterText .= "<table><tbody>";
                            if($month != $oldMonth){
                                $newsletterText .= "<tr><td><p style='text-align: center;'><strong>" . $month . "</strong></p></td></tr>";
                            }$newsletterText .= "<tr><td><strong>";
                            if ($time == "00.00"){
                                $newsletterText .= $date . " Ganztägig ";
                            }if ($time != "00.00"){
                                $newsletterText .= $date;
                            }$newsletterText .= "</strong> | " . $title;
                            if(is_array($performers) != true){
                                $newsletterText .= " (" . $performers . ")";
                            }if(is_array($description) != true){
                                $newsletterText .= " | " . $description;
                            }$newsletterText .= " | " . $location . " (" . $locationCity . ") | <a href=mailto:" . $email . ">" . $email . "</a></td></tr>";
                            $oldMonth = $month;
                        }
                    }else{
                        $month = $data['START_MONAT'];
                        $time  = $data['START_UHRZEIT'];
                        $date = $data['DATUM'];
                        $title = $data['_event_TITLE'];
                        $performers = $data['_person_NAME'];
                        $description = $data['_event_LONG_DESCRIPTION'];
                        $location = $data['_place_NAME'];
                        $locationCity = $data['_place_CITY'];
                        $email = $data['_user_EMAIL'];

                        $newsletterText .= "<table><tbody>";
                        if($month != $oldMonth){
                            $newsletterText .= "<tr><td><p style='text-align: center;'><strong>" . $month . "</strong></p></td></tr>";
                        }$newsletterText .= "<tr><td><strong>";
                        if ($time == "00.00"){
                            $newsletterText .= $date . " Ganztägig ";
                        }if ($time != "00.00"){
                            $newsletterText .= $date;
                        }$newsletterText .= "</strong> | " . $title;
                        if(is_array($performers) != true){
                            $newsletterText .= " (" . $performers . ")";
                        }if(is_array($description) != true){
                            $newsletterText .= " | " . $description;
                        }$newsletterText .= " | " . $location . " (" . $locationCity . ") | <a href=mailto:" . $email . ">" . $email . "</a></td></tr>";
                        $oldMonth = $month;
                    }
                    $newsletterText .= "</tbody></table>";
                    dataParser::mailPreparation($topic, $newsletterText);
                    break;
                case 2:
                    $data = $mainData[$i];
                    $newsletterText = '';
                    $topic = "fortbildungen";

                    if($data == null){
                        break;
                    }
                    if(!array_key_exists('_event_STATUS', $data)){
                        foreach ($data as $data){
                            $month = $data['START_MONAT'];
                            $time  = $data['START_UHRZEIT'];
                            $date = $data['DATUM'];
                            $title = $data['_event_TITLE'];
                            $performers = $data['_person_NAME'];
                            $description = $data['_event_LONG_DESCRIPTION'];
                            $location = $data['_place_NAME'];
                            $locationCity = $data['_place_CITY'];
                            $email = $data['_user_EMAIL'];

                            $newsletterText .= "<table><tbody>";
                            if($month != $oldMonth){
                                $newsletterText .= "<tr><td><p style='text-align: center;'><strong>" . $month . "</strong></p></td></tr>";
                            }$newsletterText .= "<tr><td><strong>";
                            if ($time == "00.00"){
                                $newsletterText .= $date . " Ganztägig ";
                            }if ($time != "00.00"){
                                $newsletterText .= $date;
                            }$newsletterText .= "</strong> | " . $title;
                            if(is_array($performers) != true){
                                $newsletterText .= " (" . $performers . ")";
                            }if(is_array($description) != true){
                                $newsletterText .= " | " . $description;
                            }$newsletterText .= " | " . $location . " (" . $locationCity . ") | <a href=mailto:" . $email . ">" . $email . "</a></td></tr>";
                            $oldMonth = $month;
                        }
                    }else{
                        $month = $data['START_MONAT'];
                        $time  = $data['START_UHRZEIT'];
                        $date = $data['DATUM'];
                        $title = $data['_event_TITLE'];
                        $performers = $data['_person_NAME'];
                        $description = $data['_event_LONG_DESCRIPTION'];
                        $location = $data['_place_NAME'];
                        $locationCity = $data['_place_CITY'];
                        $email = $data['_user_EMAIL'];

                        $newsletterText .= "<table><tbody>";
                        if($month != $oldMonth){
                            $newsletterText .= "<tr><td><p style='text-align: center;'><strong>" . $month . "</strong></p></td></tr>";
                        }$newsletterText .= "<tr><td><strong>";
                        if ($time == "00.00"){
                            $newsletterText .= $date . " Ganztägig ";
                        }if ($time != "00.00"){
                            $newsletterText .= $date;
                        }$newsletterText .= "</strong> | " . $title;
                        if(is_array($performers) != true){
                            $newsletterText .= " (" . $performers . ")";
                        }if(is_array($description) != true){
                            $newsletterText .= " | " . $description;
                        }$newsletterText .= " | " . $location . " (" . $locationCity . ") | <a href=mailto:" . $email . ">" . $email . "</a></td></tr>";
                        $oldMonth = $month;
                    }
                    $newsletterText .= "</tbody></table>";
                    dataParser::mailPreparation($topic, $newsletterText);
                    break;
                case 3:
                    $data = $mainData[$i];
                    $newsletterText = '';
                    $topic = "konzerte";

                    if($data == null){
                        break;
                    }
                    if(!array_key_exists('_event_STATUS', $data)){
                        foreach ($data as $data){
                            $month = $data['START_MONAT'];
                            $time  = $data['START_UHRZEIT'];
                            $date = $data['DATUM'];
                            $title = $data['_event_TITLE'];
                            $performers = $data['_person_NAME'];
                            $description = $data['_event_LONG_DESCRIPTION'];
                            $location = $data['_place_NAME'];
                            $locationCity = $data['_place_CITY'];
                            $email = $data['_user_EMAIL'];

                            $newsletterText .= "<table><tbody>";
                            if($month != $oldMonth){
                                $newsletterText .= "<tr><td><p style='text-align: center;'><strong>" . $month . "</strong></p></td></tr>";
                            }$newsletterText .= "<tr><td><strong>";
                            if ($time == "00.00"){
                                $newsletterText .= $date . " Ganztägig ";
                            }if ($time != "00.00"){
                                $newsletterText .= $date;
                            }$newsletterText .= "</strong> | " . $title;
                            if(is_array($performers) != true){
                                $newsletterText .= " (" . $performers . ")";
                            }if(is_array($description) != true){
                                $newsletterText .= " | " . $description;
                            }$newsletterText .= " | " . $location . " (" . $locationCity . ") | <a href=mailto:" . $email . ">" . $email . "</a></td></tr>";
                            $oldMonth = $month;
                        }
                    }else{
                        $month = $data['START_MONAT'];
                        $time  = $data['START_UHRZEIT'];
                        $date = $data['DATUM'];
                        $title = $data['_event_TITLE'];
                        $performers = $data['_person_NAME'];
                        $description = $data['_event_LONG_DESCRIPTION'];
                        $location = $data['_place_NAME'];
                        $locationCity = $data['_place_CITY'];
                        $email = $data['_user_EMAIL'];

                        $newsletterText .= "<table><tbody>";
                        if($month != $oldMonth){
                            $newsletterText .= "<tr><td><p style='text-align: center;'><strong>" . $month . "</strong></p></td></tr>";
                        }$newsletterText .= "<tr><td><strong>";
                        if ($time == "00.00"){
                            $newsletterText .= $date . " Ganztägig ";
                        }if ($time != "00.00"){
                            $newsletterText .= $date;
                        }$newsletterText .= "</strong> | " . $title;
                        if(is_array($performers) != true){
                            $newsletterText .= " (" . $performers . ")";
                        }if(is_array($description) != true){
                            $newsletterText .= " | " . $description;
                        }$newsletterText .= " | " . $location . " (" . $locationCity . ") | <a href=mailto:" . $email . ">" . $email . "</a></td></tr>";
                        $oldMonth = $month;
                    }

                    $newsletterText .= "</tbody></table>";
                    dataParser::mailPreparation($topic, $newsletterText);
                    break;
                case 4:
                    $data = $mainData[$i];
                    $newsletterText = '';
                    $topic = "freizeiten";

                    if($data == null){
                        break;
                    }
                    if(!array_key_exists('_event_STATUS', $data)){
                        foreach ($data as $data){
                            $month = $data['START_MONAT'];
                            $time  = $data['START_UHRZEIT'];
                            $date = $data['DATUM'];
                            $title = $data['_event_TITLE'];
                            $performers = $data['_person_NAME'];
                            $description = $data['_event_LONG_DESCRIPTION'];
                            $location = $data['_place_NAME'];
                            $locationCity = $data['_place_CITY'];
                            $email = $data['_user_EMAIL'];

                            $newsletterText .= "<table><tbody>";
                            if($month != $oldMonth){
                                $newsletterText .= "<tr><td><p style='text-align: center;'><strong>" . $month . "</strong></p></td></tr>";
                            }$newsletterText .= "<tr><td><strong>";
                            if ($time == "00.00"){
                                $newsletterText .= $date . " Ganztägig ";
                            }if ($time != "00.00"){
                                $newsletterText .= $date;
                            }$newsletterText .= "</strong> | " . $title;
                            if(is_array($performers) != true){
                                $newsletterText .= " (" . $performers . ")";
                            }if(is_array($description) != true){
                                $newsletterText .= " | " . $description;
                            }$newsletterText .= " | " . $location . " (" . $locationCity . ") | <a href=mailto:" . $email . ">" . $email . "</a></td></tr>";
                            $oldMonth = $month;
                        }
                    }else{
                        $month = $data['START_MONAT'];
                        $time  = $data['START_UHRZEIT'];
                        $date = $data['DATUM'];
                        $title = $data['_event_TITLE'];
                        $performers = $data['_person_NAME'];
                        $description = $data['_event_LONG_DESCRIPTION'];
                        $location = $data['_place_NAME'];
                        $locationCity = $data['_place_CITY'];
                        $email = $data['_user_EMAIL'];

                        $newsletterText .= "<table><tbody>";
                        if($month != $oldMonth){
                            $newsletterText .= "<tr><td><p style='text-align: center;'><strong>" . $month . "</strong></p></td></tr>";
                        }$newsletterText .= "<tr><td><strong>";
                        if ($time == "00.00"){
                            $newsletterText .= $date . " Ganztägig ";
                        }if ($time != "00.00"){
                            $newsletterText .= $date;
                        }$newsletterText .= "</strong> | " . $title;
                        if(is_array($performers) != true){
                            $newsletterText .= " (" . $performers . ")";
                        }if(is_array($description) != true){
                            $newsletterText .= " | " . $description;
                        }$newsletterText .= " | " . $location . " (" . $locationCity . ") | <a href=mailto:" . $email . ">" . $email . "</a></td></tr>";
                        $oldMonth = $month;
                    }

                    $newsletterText .= "</tbody></table>";
                    dataParser::mailPreparation($topic, $newsletterText);
                    break;
                case 5:
                    $data = $mainData[$i];
                    $newsletterText = '';
                    $topic = "ausstellungen";

                    if($data == null){
                        break;
                    }
                    if(!array_key_exists('_event_STATUS', $data)){
                        foreach ($data as $data){
                            $month = $data['START_MONAT'];
                            $time  = $data['START_UHRZEIT'];
                            $date = $data['DATUM'];
                            $title = $data['_event_TITLE'];
                            $performers = $data['_person_NAME'];
                            $description = $data['_event_LONG_DESCRIPTION'];
                            $location = $data['_place_NAME'];
                            $locationCity = $data['_place_CITY'];
                            $email = $data['_user_EMAIL'];

                            $newsletterText .= "<table><tbody>";
                            if($month != $oldMonth){
                                $newsletterText .= "<tr><td><p style='text-align: center;'><strong>" . $month . "</strong></p></td></tr>";
                            }$newsletterText .= "<tr><td><strong>";
                            if ($time == "00.00"){
                                $newsletterText .= $date . " Ganztägig ";
                            }if ($time != "00.00"){
                                $newsletterText .= $date;
                            }$newsletterText .= "</strong> | " . $title;
                            if(is_array($performers) != true){
                                $newsletterText .= " (" . $performers . ")";
                            }if(is_array($description) != true){
                                $newsletterText .= " | " . $description;
                            }$newsletterText .= " | " . $location . " (" . $locationCity . ") | <a href=mailto:" . $email . ">" . $email . "</a></td></tr>";
                            $oldMonth = $month;
                        }
                    }else{
                        $month = $data['START_MONAT'];
                        $time  = $data['START_UHRZEIT'];
                        $date = $data['DATUM'];
                        $title = $data['_event_TITLE'];
                        $performers = $data['_person_NAME'];
                        $description = $data['_event_LONG_DESCRIPTION'];
                        $location = $data['_place_NAME'];
                        $locationCity = $data['_place_CITY'];
                        $email = $data['_user_EMAIL'];

                        $newsletterText .= "<table><tbody>";
                        if($month != $oldMonth){
                            $newsletterText .= "<tr><td><p style='text-align: center;'><strong>" . $month . "</strong></p></td></tr>";
                        }$newsletterText .= "<tr><td><strong>";
                        if ($time == "00.00"){
                            $newsletterText .= $date . " Ganztägig ";
                        }if ($time != "00.00"){
                            $newsletterText .= $date;
                        }$newsletterText .= "</strong> | " . $title;
                        if(is_array($performers) != true){
                            $newsletterText .= " (" . $performers . ")";
                        }if(is_array($description) != true){
                            $newsletterText .= " | " . $description;
                        }$newsletterText .= " | " . $location . " (" . $locationCity . ") | <a href=mailto:" . $email . ">" . $email . "</a></td></tr>";
                        $oldMonth = $month;
                    }
                    $newsletterText .= "</tbody></table>";
                    dataParser::mailPreparation($topic, $newsletterText);
                    break;
                case 6:
                    $data = $mainData[$i];
                    $newsletterText = '';
                    $topic = "feste";

                    if($data == null){
                        break;
                    }
                    if(!array_key_exists('_event_STATUS', $data)){
                        foreach ($data as $data){
                            $month = $data['START_MONAT'];
                            $time  = $data['START_UHRZEIT'];
                            $date = $data['DATUM'];
                            $title = $data['_event_TITLE'];
                            $performers = $data['_person_NAME'];
                            $description = $data['_event_LONG_DESCRIPTION'];
                            $location = $data['_place_NAME'];
                            $locationCity = $data['_place_CITY'];
                            $email = $data['_user_EMAIL'];

                            $newsletterText .= "<table><tbody>";
                            if($month != $oldMonth){
                                $newsletterText .= "<tr><td><p style='text-align: center;'><strong>" . $month . "</strong></p></td></tr>";
                            }$newsletterText .= "<tr><td><strong>";
                            if ($time == "00.00"){
                                $newsletterText .= $date . " Ganztägig ";
                            }if ($time != "00.00"){
                                $newsletterText .= $date;
                            }$newsletterText .= "</strong> | " . $title;
                            if(is_array($performers) != true){
                                $newsletterText .= " (" . $performers . ")";
                            }if(is_array($description) != true){
                                $newsletterText .= " | " . $description;
                            }$newsletterText .= " | " . $location . " (" . $locationCity . ") | <a href=mailto:" . $email . ">" . $email . "</a></td></tr>";
                            $oldMonth = $month;
                        }
                    }else{
                        $month = $data['START_MONAT'];
                        $time  = $data['START_UHRZEIT'];
                        $date = $data['DATUM'];
                        $title = $data['_event_TITLE'];
                        $performers = $data['_person_NAME'];
                        $description = $data['_event_LONG_DESCRIPTION'];
                        $location = $data['_place_NAME'];
                        $locationCity = $data['_place_CITY'];
                        $email = $data['_user_EMAIL'];

                        $newsletterText .= "<table><tbody>";
                        if($month != $oldMonth){
                            $newsletterText .= "<tr><td><p style='text-align: center;'><strong>" . $month . "</strong></p></td></tr>";
                        }$newsletterText .= "<tr><td><strong>";
                        if ($time == "00.00"){
                            $newsletterText .= $date . " Ganztägig ";
                        }if ($time != "00.00"){
                            $newsletterText .= $date;
                        }$newsletterText .= "</strong> | " . $title;
                        if(is_array($performers) != true){
                            $newsletterText .= " (" . $performers . ")";
                        }if(is_array($description) != true){
                            $newsletterText .= " | " . $description;
                        }$newsletterText .= " | " . $location . " (" . $locationCity . ") | <a href=mailto:" . $email . ">" . $email . "</a></td></tr>";
                        $oldMonth = $month;
                    }
                    $newsletterText .= "</tbody></table>";
                    dataParser::mailPreparation($topic, $newsletterText);
                    break;
                case 7:
                    $data = $mainData[$i];
                    $newsletterText = '';
                    $topic = "sport";

                    if($data == null){
                        break;
                    }
                    if(!array_key_exists('_event_STATUS', $data)){
                        foreach ($data as $data){
                            $month = $data['START_MONAT'];
                            $time  = $data['START_UHRZEIT'];
                            $date = $data['DATUM'];
                            $title = $data['_event_TITLE'];
                            $performers = $data['_person_NAME'];
                            $description = $data['_event_LONG_DESCRIPTION'];
                            $location = $data['_place_NAME'];
                            $locationCity = $data['_place_CITY'];
                            $email = $data['_user_EMAIL'];

                            $newsletterText .= "<table><tbody>";
                            if($month != $oldMonth){
                                $newsletterText .= "<tr><td><p style='text-align: center;'><strong>" . $month . "</strong></p></td></tr>";
                            }$newsletterText .= "<tr><td><strong>";
                            if ($time == "00.00"){
                                $newsletterText .= $date . " Ganztägig ";
                            }if ($time != "00.00"){
                                $newsletterText .= $date;
                            }$newsletterText .= "</strong> | " . $title;
                            if(is_array($performers) != true){
                                $newsletterText .= " (" . $performers . ")";
                            }if(is_array($description) != true){
                                $newsletterText .= " | " . $description;
                            }$newsletterText .= " | " . $location . " (" . $locationCity . ") | <a href=mailto:" . $email . ">" . $email . "</a></td></tr>";
                            $oldMonth = $month;
                        }
                    }else{
                        $month = $data['START_MONAT'];
                        $time  = $data['START_UHRZEIT'];
                        $date = $data['DATUM'];
                        $title = $data['_event_TITLE'];
                        $performers = $data['_person_NAME'];
                        $description = $data['_event_LONG_DESCRIPTION'];
                        $location = $data['_place_NAME'];
                        $locationCity = $data['_place_CITY'];
                        $email = $data['_user_EMAIL'];

                        $newsletterText .= "<table><tbody>";
                        if($month != $oldMonth){
                            $newsletterText .= "<tr><td><p style='text-align: center;'><strong>" . $month . "</strong></p></td></tr>";
                        }$newsletterText .= "<tr><td><strong>";
                        if ($time == "00.00"){
                            $newsletterText .= $date . " Ganztägig ";
                        }if ($time != "00.00"){
                            $newsletterText .= $date;
                        }$newsletterText .= "</strong> | " . $title;
                        if(is_array($performers) != true){
                            $newsletterText .= " (" . $performers . ")";
                        }if(is_array($description) != true){
                            $newsletterText .= " | " . $description;
                        }$newsletterText .= " | " . $location . " (" . $locationCity . ") | <a href=mailto:" . $email . ">" . $email . "</a></td></tr>";
                        $oldMonth = $month;
                    }
                    $newsletterText .= "</tbody></table>";
                    dataParser::mailPreparation($topic, $newsletterText);
                    break;
                case 8:
                    $data = $mainData[$i];
                    $newsletterText = '';
                    $topic = "sonstiges";

                    if($data == null){
                        break;
                    }
                    if(!array_key_exists('_event_STATUS', $data)){
                        foreach ($data as $data){
                            $month = $data['START_MONAT'];
                            $time  = $data['START_UHRZEIT'];
                            $date = $data['DATUM'];
                            $title = $data['_event_TITLE'];
                            $performers = $data['_person_NAME'];
                            $description = $data['_event_LONG_DESCRIPTION'];
                            $location = $data['_place_NAME'];
                            $locationCity = $data['_place_CITY'];
                            $email = $data['_user_EMAIL'];

                            $newsletterText .= "<table><tbody>";
                            if($month != $oldMonth){
                                $newsletterText .= "<tr><td><p style='text-align: center;'><strong>" . $month . "</strong></p></td></tr>";
                            }$newsletterText .= "<tr><td><strong>";
                            if ($time == "00.00"){
                                $newsletterText .= $date . " Ganztägig ";
                            }if ($time != "00.00"){
                                $newsletterText .= $date;
                            }$newsletterText .= "</strong> | " . $title;
                            if(is_array($performers) != true){
                                $newsletterText .= " (" . $performers . ")";
                            }if(is_array($description) != true){
                                $newsletterText .= " | " . $description;
                            }$newsletterText .= " | " . $location . " (" . $locationCity . ") | <a href=mailto:" . $email . ">" . $email . "</a></td></tr>";
                            $oldMonth = $month;
                        }
                    }else{
                        $month = $data['START_MONAT'];
                        $time  = $data['START_UHRZEIT'];
                        $date = $data['DATUM'];
                        $title = $data['_event_TITLE'];
                        $performers = $data['_person_NAME'];
                        $description = $data['_event_LONG_DESCRIPTION'];
                        $location = $data['_place_NAME'];
                        $locationCity = $data['_place_CITY'];
                        $email = $data['_user_EMAIL'];

                        $newsletterText .= "<table><tbody>";
                        if($month != $oldMonth){
                            $newsletterText .= "<tr><td><p style='text-align: center;'><strong>" . $month . "</strong></p></td></tr>";
                        }$newsletterText .= "<tr><td><strong>";
                        if ($time == "00.00"){
                            $newsletterText .= $date . " Ganztägig ";
                        }if ($time != "00.00"){
                            $newsletterText .= $date;
                        }$newsletterText .= "</strong> | " . $title;
                        if(is_array($performers) != true){
                            $newsletterText .= " (" . $performers . ")";
                        }if(is_array($description) != true){
                            $newsletterText .= " | " . $description;
                        }$newsletterText .= " | " . $location . " (" . $locationCity . ") | <a href=mailto:" . $email . ">" . $email . "</a></td></tr>";
                        $oldMonth = $month;
                    }
                    $newsletterText .= "</tbody></table>";
                    dataParser::mailPreparation($topic, $newsletterText);
                    break;
                case 9:
                    $data = $mainData[$i];
                    $newsletterText = '';
                    $topic = "meditation";

                    if($data == null){
                        break;
                    }
                    if(!array_key_exists('_event_STATUS', $data)){
                        foreach ($data as $data){
                            $month = $data['START_MONAT'];
                            $time  = $data['START_UHRZEIT'];
                            $date = $data['DATUM'];
                            $title = $data['_event_TITLE'];
                            $performers = $data['_person_NAME'];
                            $description = $data['_event_LONG_DESCRIPTION'];
                            $location = $data['_place_NAME'];
                            $locationCity = $data['_place_CITY'];
                            $email = $data['_user_EMAIL'];

                            $newsletterText .= "<table><tbody>";
                            if($month != $oldMonth){
                                $newsletterText .= "<tr><td><p style='text-align: center;'><strong>" . $month . "</strong></p></td></tr>";
                            }$newsletterText .= "<tr><td><strong>";
                            if ($time == "00.00"){
                                $newsletterText .= $date . " Ganztägig ";
                            }if ($time != "00.00"){
                                $newsletterText .= $date;
                            }$newsletterText .= "</strong> | " . $title;
                            if(is_array($performers) != true){
                                $newsletterText .= " (" . $performers . ")";
                            }if(is_array($description) != true){
                                $newsletterText .= " | " . $description;
                            }$newsletterText .= " | " . $location . " (" . $locationCity . ") | <a href=mailto:" . $email . ">" . $email . "</a></td></tr>";
                            $oldMonth = $month;
                        }
                    }else{
                        $month = $data['START_MONAT'];
                        $time  = $data['START_UHRZEIT'];
                        $date = $data['DATUM'];
                        $title = $data['_event_TITLE'];
                        $performers = $data['_person_NAME'];
                        $description = $data['_event_LONG_DESCRIPTION'];
                        $location = $data['_place_NAME'];
                        $locationCity = $data['_place_CITY'];
                        $email = $data['_user_EMAIL'];

                        $newsletterText .= "<table><tbody>";
                        if($month != $oldMonth){
                            $newsletterText .= "<tr><td><p style='text-align: center;'><strong>" . $month . "</strong></p></td></tr>";
                        }$newsletterText .= "<tr><td><strong>";
                        if ($time == "00.00"){
                            $newsletterText .= $date . " Ganztägig ";
                        }if ($time != "00.00"){
                            $newsletterText .= $date;
                        }$newsletterText .= "</strong> | " . $title;
                        if(is_array($performers) != true){
                            $newsletterText .= " (" . $performers . ")";
                        }if(is_array($description) != true){
                            $newsletterText .= " | " . $description;
                        }$newsletterText .= " | " . $location . " (" . $locationCity . ") | <a href=mailto:" . $email . ">" . $email . "</a></td></tr>";
                        $oldMonth = $month;
                    }
                    $newsletterText .= "</tbody></table>";
                    dataParser::mailPreparation($topic, $newsletterText);
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

        $users = dataParser::getUser($topic);
        $subject = str_replace("{{TOPIC}}", "$topic", $subject);
        $newsletterText = str_replace("{{BODY}}", "$newsletter", $textMask);

        foreach ($users as $user){
            $uid = mailDeamon::getId($user); //get uid for 'newsletter-unsubscribe-link'
            $newsletterText = str_replace("{{UNSUBSCRIBE_LINK}}", "$baseUrl/unsubscribe/index.php?id=$uid", "$newsletterText");

            mailDeamon::sendNewsletter($user, $newsletterText, $subject);
        }
    }
}