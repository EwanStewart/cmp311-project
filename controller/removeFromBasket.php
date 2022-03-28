<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        session_start();

		if ($_SESSION["uID"]){
			$keyID = $_POST['keyID'];
			$userID = $_SESSION['uID'];

			include_once("../controller/connection.php");
			$conn = getDatabaseConnection();

			$sql = "DELETE FROM basket WHERE (basket.userID = $userID && basket.keyID = $keyID)";
			$result = mysqli_query($conn, $sql);
			echo "Item removed from basket";
		}
		
    }else{
		//Error
	}
?>