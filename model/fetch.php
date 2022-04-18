<?php
    include('../controller/connection.php');

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