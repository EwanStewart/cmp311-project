<?php

	

    include('../controller/connection.php');
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);


    $conn = getDatabaseConnection();
    
    $sql = "SELECT `name` FROM steam WHERE `name` LIKE ? ORDER BY `name` DESC" ;
    $stmt = $conn->prepare($sql);

    $a =  $_GET['q'].'%';
    $stmt->bind_param("s", $a);
    $stmt->execute();

    $result = $stmt->get_result();
    $rows = array();
    while($r = mysqli_fetch_assoc($result)) {
        echo '<option value="'. $r["name"] .'">'. $r["name"] .'</option>';
    }

    mysqli_close($conn);



?>