<?php
session_start();
include("../controller/connection.php");
$from = $_SESSION['uID'];
$email = $_POST['email'];

$status = 1;

$conn = getDatabaseConnection();
$sqlselect = "SELECT id FROM cmp311user WHERE email='".$email."'";
$result = mysqli_query($conn, $sqlselect);
    if($row = mysqli_fetch_array($result)){
        $friendTo = $row['id'];
        $sqlInsert = "INSERT INTO friends (fUserID, sUserID, status) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        $r1 = mysqli_stmt_prepare($stmt, $sqlInsert);
        $r2 = mysqli_stmt_bind_param($stmt, "ssi", $from, $friendTo, $status);
        $results = mysqli_stmt_execute($stmt);
        mysqli_close($stmt);
    }
    
    

echo json_encode($results);

?>