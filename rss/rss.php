<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

    include("../model/api-store.php");

    

    $response = rss();
    echo $response;




?>