<?php 
$feedback = $_POST['feedback'];
$rating = $_POST['rating'];
$moderator = $_POST['moderator'];
$email = $_POST['email'];
$user_id = $_POST['user_id'];
$key_id = $_POST['key_id'];

//insert into feedback table prepared statement

require_once("../controller/connection.php");
$conn = getDatabaseConnection();

$sql = "INSERT INTO feedback (feedback_desc, rating, contactMod, sendingUserID, key_id, email) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sisiis", $feedback, $rating, $moderator, $user_id, $key_id, $email);
//if sql execution is successful, redirect to index.php
if($stmt->execute()){
    header("Location: ../view/index.php?feedback=success");
} else {
    header("Location: ../view/index.php?feedback=failure");
}


?>