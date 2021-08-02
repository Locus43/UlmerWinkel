<?php

class dataFetcher{

    private $jsonMask;
    private $baseUrl;

    public static function fetchData(){
        $config = parse_ini_file('config.ini.php');
        $baseUrl = $config['url'];
        $jsonMask = $config['mask'];
        $eventData = array();
        $temp = array(); //array for data of an event; only temporary

        for($eventType = 0; $eventType < 11; $eventType++){
            $baseUrl = str_replace("$eventType", "{{eventType}}", $baseUrl);
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
                $temp[] = "'month' => '" . $monthbar . "'";
                $temp[] = "'time' => '" . $time . "'";
                $temp[] = "'date' => '" . $date . "'";
                $temp[] = "'title' => '" . $title. "'";
                $temp[] = "'performers' => '" . $performers . "'";
                $temp[] = "'description' => '" . $description . "'";
                $temp[] = "'location' => '" . $location . "'";
                $temp[] = "'locationCity' => '" . $locationCity . "'";
                $temp[] = "'email' => '" . $email . "'";

                $eventData[$eventType - 1] = "'" . $eventType . "' => " . "'" . $temp . "'";
            }
        }
        $eventData = json_encode($eventData);
        file_put_contents("/tmp/eventData.json", $eventData);
    }
}