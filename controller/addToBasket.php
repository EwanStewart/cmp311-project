<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        session_start();

        $gameID = $_POST['gameID'];
        $userid = $_SESSION['uID'];
		//include_once("../model/api-store.php");
        include_once("../controller/connection.php");

        $sql = "SELECT * FROM gameKeys WHERE appID ORDER BY dateAdded DESC LIMIT 1";
		$result = mysqli_query($conn, $sql);
        while($r = mysqli_fetch_assoc($result)) {
    		$rows[] = $r;
		}
        $keyid = $rows[0]["id"];

		$sql = "SELECT * FROM basket WHERE (basket.userID = $userid && basket.keyID = $keyid";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) != 0){ // Same key cannot be added multiple times
			// give error message
		}else{
			$sql = "INSERT INTO basket (userID, keyID) VALUES $userid, $keyid";
			$result = mysqli_query($conn, $sql);
		}		
    }
?>