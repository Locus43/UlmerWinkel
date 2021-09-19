<?php

//ToDo: Fix problem with json formatting -> file is not usable

$eventData = array(); //final array for events

dataFetcher::fetchData();

class dataFetcher{

    public static function fetchData(){
        $config = parse_ini_file('config.ini.php');
        $eventType = 0;

        for($idx = 1; $idx <= 10; $idx++){
            $baseUrl = $config['url'];
            $eventType = $eventType + 1;
            echo $eventType;
            $baseUrl = str_replace("{{EVENTTYPE}}", "$idx", $baseUrl);

            echo $baseUrl; //debug
            echo "<br><br>"; //debug
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
                $temp = array(); //array for data of an event; only temporary

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

                $monthbar = 'month => '. $monthbar;
                $time = 'time '.'=> ' . $time;
                $date = 'date => ' . $date;
                $title = "title => " . $title;
                $performers = "performers => " . $performers;
                $description = "description => " . $description;
                $location = "location => " . $location;
                $locationCity = "locationCity => " . $locationCity;
                $email = "email => " . $email;

                $temp[] = $monthbar;
                $temp[] = $time;
                $temp[] = $date;
                $temp[] = $title;
                $temp[] = $performers;
                $temp[] = $description;
                $temp[] = $location;
                $temp[] = $locationCity;
                $temp[] = $email;

                $temp = json_encode($temp, JSON_FORCE_OBJECT, JSON_UNESCAPED_SLASHES);
                $tmp = $eventType . " => " . $temp;
                $eventData[] = $tmp;
            }
        }
        var_dump($eventData);
        $eventData = json_encode($eventData, JSON_FORCE_OBJECT, JSON_UNESCAPED_SLASHES);
        $eventDataFile = fopen("test.json", "w") or die ("Unable to write file");
        fwrite($eventDataFile, $eventData);
        fclose($eventDataFile);
        //file_put_contents("/tmp/eventData.json", $eventData);
    }
}