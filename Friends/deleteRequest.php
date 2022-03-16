<?php

include("../controller/connection.php");
$conn = getDatabaseConnection();
$sUserID = $_GET['sid'];
$fUserID = $_GET['uid'];

$sql = "DELETE FROM friends WHERE status=1 AND fUserID='".$fUserID."' AND sUserID='".$sUserID."'";
$result = mysqli_query($conn, $sql);
header("Location: ../view/friends.php");
mysqli_close($conn);


?>