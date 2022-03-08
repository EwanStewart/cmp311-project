<?php
	// Connect to database
	include("../controller/connection.php");
	
	// function to return the details of the game in the user's basket
	function getBasket($id)
	{
		$conn = getDatabaseConnection();
		// Get IDs of user, key, and app, as well as the store used, game name, and the key itself
		$sql = "SELECT basket.userID, basket.keyID, gameKeys.store, gameKeys.gameKey, steam.name, steam.appid FROM ((basket INNER JOIN gameKeys ON gameKeys.id = basket.keyID) INNER JOIN steam ON steam.appid = gameKeys.appID) WHERE basket.userID = $id";
		$result = mysqli_query($conn, $sql);
		while($r = mysqli_fetch_assoc($result)) {
    		$rows[] = $r;
		}

		for ($i=0;$i<sizeof($rows);$i++){
			$appID = $rows[$i]["appid"];
			$url = "https://store.steampowered.com/api/appdetails?appids=" . $appID; // Get info for current game
			$apidata = json_decode(file_get_contents($url), true);
			$cost = (float)($apidata[$appID]["data"]["price_overview"]["final"]/100); // Convert from pence to pounds (Aberpay uses pounds)
			$rows[$i]["cost"] = $cost; // Add cost field to array
		}

		return $rows;
	}
?>