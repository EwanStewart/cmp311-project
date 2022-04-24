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

function getCredits() {
    //get the total amount of credits
    global $conn;
    $sqlSelect = "SELECT credit FROM cmp311user WHERE email = ?";
    $stmtSelect = $conn->prepare($sqlSelect);
    $stmtSelect->bind_param("s", $_SESSION["email"]);
    $stmtSelect->execute();
    $result = $stmtSelect->get_result();
    if ($result->num_rows > 0) { 
        while($row = $result->fetch_assoc()) { 					
            $rows[] = $row;
        }
    }
    return $rows[0]["credit"];

}

function getAvaliableGames() {
    global $conn;

    $sqlSelect = "SELECT * FROM gameKeys WHERE public = 1 and purchasedBy IS NULL";							
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

function getNewGames() {
    global $conn;

    $sqlSelect = "SELECT * FROM gameKeys WHERE public = 1 AND purchasedBy IS NULL ORDER BY dateAdded DESC LIMIT 3";							
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
    $genre = $param[5];
    $sqlSelect = "INSERT INTO cachedGameData (appid, title, s_desc, price, img, genres) VALUES (?,?,?,?,?,?)";							
    $stmtSelect = $conn->prepare($sqlSelect);
    $stmtSelect->bind_param("isssss", $appid, $title, $s_desc, $price, $img, $genre);
    $stmtSelect->execute();										
    $result = $stmtSelect->get_result();		

    
    return $result;
}

function checkGenreCached($param) {
    global $conn;

    $sqlSelect = "SELECT genres FROM cachedGameData WHERE appID = ?";							
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

function cache($game) {
    $cached = checkedGameCached($game["appID"]);
    if (!$cached) {
        $steamData = getSteamData($game["appID"]);
        $param = array();


        if ($steamData[$game["appID"]]["success"]) {
            $appid = $game["appID"];
            $title = getGameTitle($game["appID"])[0]["name"];
            $s_desc = strip_tags(min(100,$steamData[$game["appID"]]["data"]["short_description"]));
            $price = $steamData[$game["appID"]]["data"]["price_overview"]["final_formatted"];
            $img = $steamData[$game["appID"]]["data"]["header_image"];
            $genre = $steamData[$game["appID"]]["data"]["genres"][0]["description"];
        } else {
            $appid = $game["appID"];
            $title = getGameTitle($appid)[0]["name"];
            $s_desc = "No data avaliable from Steam";
            $price = "No data avaliable from Steam";
            $img = "https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/1024px-No_image_available.svg.png";
            $genre = "No data avaliable from Steam";

        }


        array_push($param, $appid, $title, $s_desc, $price, $img, $genre);
        insertGameDataToCache($param);
    }
}

?>