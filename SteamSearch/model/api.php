<?php
    include('../model/connection.php');

    function writeToDB($appid, $name){ 
        global $conn;
        //$message = (string)$message;
		
		$sql = "insert into steam (appid, name) values (?, ?)" ;
		$stmt = mysqli_stmt_init($conn);
		$r1 = mysqli_stmt_prepare($stmt, $sql);
		$r2 = mysqli_stmt_bind_param($stmt, "is", $appid, $name);
		$result = mysqli_stmt_execute($stmt);
    }
?>