<?php

	
function fetchFromDB($str) { 
    include('../controller/connection.php');
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);


    $conn = getDatabaseConnection();
    
    $sql = "SELECT `name` FROM steam WHERE `name` LIKE ? ORDER BY `name` DESC LIMIT 10" ;
    $stmt = $conn->prepare($sql);

    $a =  $str.'%';
    $stmt->bind_param("s", $a);
    $stmt->execute();

    $result = $stmt->get_result();
    $rows = array();
    while($r = mysqli_fetch_assoc($result)) {
        $rows[] = $r;
    }
    mysqli_close($conn);

    return $rows;
}

?>