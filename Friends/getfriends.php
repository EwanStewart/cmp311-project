<?php
session_start();
include("../controller/connection.php");
$conn = getDatabaseConnection();

function getFriends($id, $email){
    $email = $_SESSION['email'];
    global $conn;
    //SQL STATEMENT TO RETRIEVE FRIENDS
    $sqlSelect = "SELECT friends.sUserID, friends.fUserID, friends.status , login_details.last_activity, cmp311user.forename, cmp311user.email FROM friends
    LEFT JOIN cmp311user ON friends.sUserID = cmp311user.id OR friends.fUserID = cmp311user.id
    LEFT JOIN login_details ON login_details.user_id = friends.sUserID
    WHERE (status=2) AND (fUserID='".$id."' OR sUserID='".$id."') AND NOT email='".$email."'";
    $result = mysqli_query($conn, $sqlSelect);
    $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
    $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
    $rows = array();
    while ($r = mysqli_fetch_assoc($result)) {
    if($current_timestamp < $r['last_activity'])
    {
        $r['last_activity'] = 'Online';
    }
    else{
    }
        $rows[] = $r;
    }
    
    return json_encode($rows);
  
    mysqli_close($conn);
}

function getRequests($id){
    global $conn;
    //SQL STATEMENT TO RETRIEVE RECIEVED REQUESTS
            $sql = "SELECT friends.fUserID, friends.status, cmp311user.forename, cmp311user.email FROM friends
            LEFT JOIN cmp311user ON friends.fUserID = cmp311user.id WHERE status=1 AND sUserID='".$id."'";
        $res = mysqli_query($conn, $sql);
        $rows = array();
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
        $rows = array();
        while ($r = mysqli_fetch_assoc($result)) {
            $rows[] = $r;
        }
        $results = json_encode($rows);
        return $results;
        mysqli_close($conn);
}


?>