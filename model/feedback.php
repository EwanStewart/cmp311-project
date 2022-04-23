<?php 
$feedback = $_POST['feedback'];
$rating = $_POST['rating'];
$moderator = $_POST['moderator'];
$email = $_POST['email'];
$user_id = $_POST['user_id'];
$transaction_id = $_POST['transaction_id'];

//insert into feedback table prepared statement
$sql = "INSERT INTO feedback (feedback, rating, moderator, email, user_id, transaction_id) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../publishedGameKeys.php?status=failure");
} else {
    mysqli_stmt_bind_param($stmt, "sissis", $feedback, $rating, $moderator, $email, $user_id, $transaction_id);
    mysqli_stmt_execute($stmt);
    header("Location: ../publishedGameKeys.php?status=success");
}

?>