<?php

include("../controller/connection.php");
$conn = getDatabaseConnection();
$sUserID = $_GET['uid'];
$fUserID = $_GET['rid'];

$sql = "DELETE FROM friends WHERE status=0 AND fUserID='".$fUserID."' AND sUserID='".$sUserID."'";
$result = mysqli_query($conn, $sql);
mysqli_close($conn);
header("Location: ../view/friends.php");

?>