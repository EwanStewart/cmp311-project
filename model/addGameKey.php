<?php
session_start();
require_once("../controller/connection.php");

$conn = getDatabaseConnection();

$title = $_POST['title'];
$key = $_POST['key'];
$notes = $_POST['gameNotes'];
$public = $_POST['public'];
$store = $_POST['store'];

$sql = "SELECT `appid` FROM steam WHERE `name` = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $title);
$stmt->execute();

$result = $stmt->get_result();

while($r = mysqli_fetch_assoc($result)) {
	$appid = $r["appid"];
}



if(isset($_POST['submit'])) {
	$sqlInsert = "INSERT INTO gameKeys (appID, gameKey, notes, public, store, userID) VALUES (?, ?, ?, ?, ?, ?)";	
	$stmtInsert = $conn->prepare($sqlInsert);	
	$stmtInsert->bind_param("issisi", $appid, $key, $notes, $public, $store, $_SESSION['uID']);						
	$stmtInsert->execute();
	$status = 'success';
} else {
	$status = 'failure';
}


header("Location: ../view/index.php?q=".$status);

?>