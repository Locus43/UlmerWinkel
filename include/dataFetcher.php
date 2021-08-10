<?php
$eventData = [];
$temp = []; //array for data of an event; only temporary



dataFetcher::fetchData();

class dataFetcher{

    public static function fetchData(){
        $config = parse_ini_file('config.ini.php');
        $baseUrl = $config['url'];
        global $eventData;
        global $temp;

        for($idx = 1; $idx <= 11; $idx++){
            echo $idx;
            $eventType = $idx;
            $baseUrl = str_replace("{{eventType}}", $eventType, $baseUrl);

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

                echo "<br><br>";
                var_dump($temp);
                echo "<br><br>";

                $monthbar = "'month' => '" . $monthbar . "'";
                echo $monthbar;
                $time = "'time' => '" . $time . "'";
                $date = "'date' => '" . $date . "'";
                $title = "'title' => '" . $title . "'";
                $performers = "'performers' => '" . $performers . "'";
                $description = "'description' => '" . $description . "'";
                $location = "'location' => '" . $location . "'";
                $locationCity = "'locationCity' => '" . $locationCity . "'";
                $email = "'email' => '" . $email . "'";

                $temp[] = $monthbar;
                $temp[] = $time;
                $temp[] = $date;
                $temp[] = $title;
                $temp[] = $performers;
                $temp[] = $description;
                $temp[] = $location;
                $temp[] = $locationCity;
                $temp[] = $email;

                echo "<br><br>";
                var_dump($temp);

                /*array_push($temp, $monthbar);
                array_push($temp, $time);
                array_push($temp, $date);
                array_push($temp, $title);
                array_push($temp, $performers);
                array_push($temp, $description);
                array_push($temp, $location);
                array_push($temp, $locationCity);
                array_push($temp, $email);*/

                $temp = json_encode($temp);
                $tmp = "'" . $eventType . "' => " . "'" . $temp . "'";
                array_push($eventData, $tmp);
                echo "<br><br>";
                var_dump($eventData);
            }
        }
        //var_dump($eventData);
        $eventData = json_encode($eventData);
        file_put_contents("/tmp/eventData.json", $eventData);
    }
}