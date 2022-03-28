<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        session_start();

		if ($_SESSION["uID"]){
			$gameID = $_POST['gameID'];
			$userID = $_SESSION['uID'];

			include_once("../controller/connection.php");
			$conn = getDatabaseConnection();

			$sql = "SELECT * FROM gameKeys WHERE appID = ".$gameID." ORDER BY dateAdded ASC LIMIT 1";
			$result = mysqli_query($conn, $sql);
			while($r = mysqli_fetch_assoc($result)) {
				$rows[] = $r;
			}
			$keyID = $rows[0]["id"];

			$sql = "SELECT * FROM basket WHERE (basket.userID = $userID && basket.keyID = $keyID";
			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) != 0){
				echo "This key is already in your basket";
			}else{
				$sql = "INSERT INTO basket (userID, keyID) VALUES ($userID, $keyID)";
				$result = mysqli_query($conn, $sql);
				echo "Item added to basket";
			}
		}else{
			echo "You must be logged in to add items to your basket.";
		}
		
    }else{
		//Error
	}
?>