<?php
include("../controller/connection.php");
$conn = getDatabaseConnection();
$sUserID = $_GET['rid'];
$fUserID = $_GET['uid'];

$sql = "UPDATE friends SET status=2 WHERE (fUserID='".$fUserID."' AND sUserID='".$sUserID."') 
OR (sUserID='".$fUserID."' AND fUserID='".$sUserID."')";
mysqli_query($conn ,$sql);
mysqli_close($conn);
header("Location: ../view/friends.php");


?>