<?php
dataFetcher::fetchData();

class dataFetcher{
   public static function fetchData(){
       $config = parse_ini_file('config.ini.php');
       $baseUrl = $config['url'];
       file_put_contents("tmp/eventData.json", "[");
       for($eventType = 1; $eventType <= 10; $eventType++){
           $url = str_replace("{{EVENTTYPE}}", "$eventType", $baseUrl);
           $curl = curl_init();
           curl_setopt_array($curl, Array(
               CURLOPT_URL => $url,
               CURLOPT_RETURNTRANSFER => TRUE,
               CURLOPT_ENCODING => 'UTF-8'
           ));
           $data = curl_exec($curl);
           curl_close($curl);
           $xml = simplexml_load_string($data,'SimpleXMLElement',LIBXML_NOCDATA);
           $json = json_encode($xml);
           $json = json_decode($json, TRUE);
           $json = json_encode($json['Export']['Veranstaltung']);
           file_put_contents("tmp/eventData.json", $json, FILE_APPEND);
           if($eventType < 10){
               file_put_contents("tmp/eventData.json", ",", FILE_APPEND);
           }
       }
       file_put_contents("tmp/eventData.json", "]", FILE_APPEND); 
   }
}