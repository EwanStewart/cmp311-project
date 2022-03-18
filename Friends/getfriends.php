<?php
session_start();
include("../controller/connection.php");
$conn = getDatabaseConnection();

function getFriends($id, $email){
    
    global $conn;
    //SQL STATEMENT TO RETRIEVE FRIENDS
    $sqlSelect = "SELECT friends.sUserID, friends.fUserID, friends.status , cmp311user.forename, cmp311user.email FROM friends
    LEFT JOIN cmp311user ON friends.sUserID = cmp311user.id OR friends.fUserID = cmp311user.id 
    WHERE (status=2) AND (fUserID='".$id."' OR sUserID='".$id."' AND NOT email='".$email."')";
   $result = mysqli_query($conn, $sqlSelect);
   while ($r = mysqli_fetch_assoc($result)) {
       $rows[] = $r;
   }
   $result = json_encode($rows);
   return $result;
   mysqli_close($conn);
}

function getRequests($id){
    global $conn;
    //SQL STATEMENT TO RETRIEVE RECIEVED REQUESTS
            $sql = "SELECT friends.fUserID, friends.status, cmp311user.forename, cmp311user.email FROM friends
            LEFT JOIN cmp311user ON friends.fUserID = cmp311user.id WHERE status=1 AND sUserID='".$id."'";
        $res = mysqli_query($conn, $sql);
        while ($rec = mysqli_fetch_assoc($res)) {
            $rows[] = $rec;
        }
        $results = json_encode($rows);
        return $results;

        mysqli_close($conn);
}

function getSent($id){
 //SQL STATEMENT TO RETRIEVE RECIEVED REQUESTS
 global $conn;
        $sql = "SELECT friends.sUserID, friends.status, cmp311user.forename, cmp311user.email FROM friends
         LEFT JOIN cmp311user ON friends.sUserID = cmp311user.id WHERE status=1 AND fUserID='".$id."'";
        $result = mysqli_query($conn, $sql);
        while ($r = mysqli_fetch_assoc($result)) {
            $rows[] = $r;
        }
        $results = json_encode($rows);
        return $results;
        mysqli_close($conn);
}


?>