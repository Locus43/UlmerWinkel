<?php
//file is only there to execute cronjobs
require_once ("../../include/config.ini.php");
require_once ("../../include/dataFetcher.php");


$dataFetch = dataFetcher::fetchData();