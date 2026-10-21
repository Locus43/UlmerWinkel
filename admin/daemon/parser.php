<?php
//file is only there to execute cronjobs
if(php_sapi_name() !== 'cli'){
    http_response_code(403);
    exit;
}
require_once("../../include/dataParser.php");

dataParser::getEvents();