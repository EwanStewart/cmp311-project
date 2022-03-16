<?php
session_start();
include("../controller/connection.php");
$conn = getDatabaseConnection();
$uid = $_SESSION['uID'];

$search = $_POST['email'];
$sql = "SELECT * FROM cmp311user WHERE email LIKE '$search%' LIMIT 5";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)){
	if($row['id'] == $uid)
    {
        return 0;
    }
    else{
        echo json_encode($row);
}
?>