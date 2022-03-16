<?php

require_once("../controller/connection.php");
$conn = getDatabaseConnection();

function getGameTitle($param) {
    global $conn;
    $sqlSelect = "SELECT name FROM steam WHERE appID = ?";							
    $stmtSelect = $conn->prepare($sqlSelect);
    $stmtSelect->bind_param("i", $param);
    $stmtSelect->execute();										
    $result = $stmtSelect->get_result();
    if ($result->num_rows > 0) { 
        while($row = $result->fetch_assoc()) { 					
            $rows[] = $row;
        }
    } 
    return $rows;
}


function getAvaliableGames() {
    global $conn;

    $sqlSelect = "SELECT * FROM gameKeys WHERE public = 1";							
    $stmtSelect = $conn->prepare($sqlSelect);
    $stmtSelect->execute();										
    $result = $stmtSelect->get_result();		

    if ($result->num_rows > 0) { 
        while($row = $result->fetch_assoc()) { 					
            $rows[] = $row;
        }
    } 
    return $rows;
}

function getSteamData($param) {
    $json_string = file_get_contents('https://store.steampowered.com/api/appdetails?appids='.$param);
    $games = json_decode($json_string, true);
    return $games;
}


function checkedGameCached($param) {
    global $conn;

    $sqlSelect = "SELECT * FROM cachedGameData WHERE appID = ?";							
    $stmtSelect = $conn->prepare($sqlSelect);
    $stmtSelect->bind_param("i", $param);
    $stmtSelect->execute();										
    $result = $stmtSelect->get_result();		

    if ($result->num_rows > 0) { 
        while($row = $result->fetch_assoc()) { 					
            $rows[] = $row;
        }
        return $rows;
    } else {
        return false;
    }
}

function insertGameDataToCache($param) {
    global $conn;

    $appid = $param[0];
    $title = $param[1];
    $s_desc = $param[2];
    $price = $param[3];
    $img = $param[4];

    $sqlSelect = "INSERT INTO cachedGameData (appid, title, s_desc, price, img) VALUES (?,?,?,?,?)";							
    $stmtSelect = $conn->prepare($sqlSelect);
    $stmtSelect->bind_param("issss", $appid, $title, $s_desc, $price, $img);
    $stmtSelect->execute();										
    $result = $stmtSelect->get_result();		

    
    return $result;
}


?>