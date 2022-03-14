<?php

//require("../controller/connection.php");
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

?>