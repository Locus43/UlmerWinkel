<?php

dataFetcher::fetchData();

class dataFetcher{

    private $jsonMask;
    private $baseUrl;

    public static function fetchData(){
        $config = parse_ini_file('config.ini.php');
        $baseUrl = $config['url'];
        $eventData = array();
        $temp = array(); //array for data of an event; only temporary

        for($eventType = 1; $eventType < 11; $eventType++){
            $baseUrl = str_replace("{{eventType}}", $eventType, $baseUrl);
            //print "\r";
            //echo $eventType;

            echo $baseUrl; //debug
            echo "<br><br>";
            $curl =  curl_init();
            curl_setopt_array($curl, Array(
                CURLOPT_URL => $baseUrl,
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_ENCODING => 'UTF-8'
            ));
            $data = curl_exec($curl);
            curl_close($curl);
            $data = simplexml_load_string($data);


            foreach($data->Export->Veranstaltung as $data){
                $monthbar = $data->monthbar;
                $time = $data->START_UHRZEIT;
                $date = $data->DATUM;
                $title = $data->_event_TITLE;
                $performers = $data->_event_TEXTLINE_1;
                $description = $data->_event_SHORT_DESCRIPTION;
                $location = $data->_place_NAME;
                $locationCity = $data->_place_CITY;
                $email = $data->_user_EMAIL;


                if($monthbar == ""){
                    $monthbar = "";
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
                /*$temp[] = "'month' => '" . $monthbar . "'";
                $temp[] = "'time' => '" . $time . "'";
                $temp[] = "'date' => '" . $date . "'";
                $temp[] = "'title' => '" . $title. "'";
                $temp[] = "'performers' => '" . $performers . "'";
                $temp[] = "'description' => '" . $description . "'";
                $temp[] = "'location' => '" . $location . "'";
                $temp[] = "'locationCity' => '" . $locationCity . "'";
                $temp[] = "'email' => '" . $email . "'";
                $temp[] = "<br><br>";*/

                array_push($temp, "'month' => '" . $monthbar . "'");
                array_push($temp, "'time' => '" . $time . "'");
                array_push($temp, "'date' => '" . $date . "'");
                array_push($temp, "'title' => '" . $title . "'");
                array_push($temp, "'performers' => '" . $performers . "'");
                array_push($temp, "'description' => '" . $description . "'");
                array_push($temp, "'location' => '" . $location . "'");
                array_push($temp, "'locationCity' => '" . $locationCity . "'");
                array_push($temp, "'email' => '" . $email . "'");

                $temp = json_encode($temp);
                var_dump($temp);
                $tmp = "'" . $eventType . "' => " . "'" . $temp . "'";
                array_push($eventData, $tmp);
                echo "<br><br>";
                var_dump($tmp);
                echo $monthbar;
                echo "<br><br><br>";
                echo $eventType;
            }
            echo "<br><br><br>";
            echo $eventType;
        }
        $eventData = json_encode($eventData);
        file_put_contents("/tmp/eventData.json", $eventData);
    }
}