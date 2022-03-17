<?php

include("../controller/connection.php");
$conn = getDatabaseConnection();
$sUserID = $_GET['fid'];
$fUserID = $_GET['uid'];
$altFuserID = $_GET['rid'];

$sql = "DELETE FROM friends WHERE status=2 AND (fUserID='".$fUserID."' AND sUserID='".$sUserID."')
OR (sUserID='".$fUserID."' AND fUserID='".$sUserID."') OR (sUserID='".$fUserID."' AND fUserID='".$altFuserID."') 
OR (sUserID='".$altFuserID."' AND fUserID='".$fUserID."') OR (sUserID='".$sUserID."' AND fUserID='".$altFuserID."')";
$result = mysqli_query($conn, $sql);
mysqli_close($conn);
header("Location: ../view/friends.php");

?>