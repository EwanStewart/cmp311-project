<?php
session_start();
include("../controller/connection.php");

function getFriends($id){
    $conn = getDatabaseConnection();

    //SQL STATEMENT TO RETRIEVE FRIENDS
    $sqlSelect = "SELECT friends.sUserID, friends.status , cmp311user.forename, cmp311user.email FROM friends
    LEFT JOIN cmp311user ON friends.sUserID = cmp311user.id WHERE status=2 AND fUserID='".$id."'";
   $result = mysqli_query($conn, $sqlSelect);
   while ($r = mysqli_fetch_assoc($result)) {
       $rows[] = $r;
   }
   $result = json_encode($rows);
   return $result;
   mysqli_close($conn);
}

function getRequests($id){
    $conn = getDatabaseConnection();
    //SQL STATEMENT TO RETRIEVE RECIEVED REQUESTS
            $sql = "SELECT friends.fUserID, friends.status, cmp311user.forename, cmp311user.email FROM friends
            LEFT JOIN cmp311user ON friends.fUserID = cmp311user.id WHERE status=0 AND sUserID='".$id."'";
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
 $conn = getDatabaseConnection();
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

function sendRequest($firstUser, $secondUser){
    $conn = getDatabaseConnection();

        $sql = "INSERT INTO friends (fUserID, sUserID, status) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        $r1 = mysqli_stmt_prepare($stmt, $sqlInsert);
        $r2 = mysqli_stmt_bind_param($stmt, "ssi", $firstUser, $secondUser, 0);
        $result = mysqli_stmt_execute($stmt);
        mysqli_close($stmt);
        return $result;
}

function getUsers($email){
    $conn = getDatabaseConnection();

    $sql = "SELECT forename, surname, created FROM cmp311user WHERE email LIKE '$email%'";
    $result = mysqli_query($conn, $sql);
    while ($r = mysqli_fetch_assoc($result)) {
        $rows[] = $r;
    }
    $results = json_encode($rows);
    return $results;
    mysqli_close($conn);

}

         
         

?>