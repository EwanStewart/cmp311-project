<?php

include("../controller/connection.php");
$conn = getDatabaseConnection();
$sUserID = $_GET['fid'];
$fUserID = $_GET['uid'];

$sql = "DELETE FROM friends WHERE status=2 AND fUserID='".$fUserID."' AND sUserID='".$sUserID."'";
$result = mysqli_query($conn, $sql);
mysqli_close($conn);
header("Location: ../view/friends.php");

?>