<?php
	// Connect to database
	include("../controller/connection.php");
	
	// function to return the details of the game in the user's basket
	function getBasket()
	{
		$conn = getDatabaseConnection();
		$id = $_SESSION['uID'];
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
			$cost = ceil($apidata[$appID]["data"]["price_overview"]["final"] / 100 ) * 100;
			$rows[$i]["cost"] = $cost; // Add cost field to array
		}

		return $rows;
	}

	function addToBasket($keyid)
	{
		$conn = getDatabaseConnection();
		$userid = $_SESSION['uID'];
		$sql = "SELECT * FROM basket WHERE (basket.userID = $userid && basket.keyID = $keyid";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) != 0){ // Same key cannot be added multiple times
			// give error message
		}else{
			$sql = "INSERT INTO basket (userID, keyID) VALUES $userid, $keyid";
			$result = mysqli_query($conn, $sql);
		}		
	}

	function numberOfTransactions()
	{
		$conn = getDatabaseConnection();
		$sql = "SELECT * FROM subTransactions";
		$result = mysqli_query($conn, $sql);
		$rowcount = mysqli_num_rows( $result );
		return $rowcount;
	}

	function getUserTransactions()
	{
		$conn = getDatabaseConnection();
		$id = $_SESSION['uID'];
		$sql = "SELECT id, userID,  FROM subTransactions WHERE userID = $id";
		$result = mysqli_query($conn, $sql);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;
	}

	function totalBasketCost()
	{
		$id = $_SESSION['uID'];
		$basket = getBasket($id);
		$totalCost = 0.0;
		
		for ($i=0;$i<sizeof($basket);$i++){
			$totalCost += $basket[$i]["cost"];
		}
		return $totalCost;
	}

	function purchaseBasket()
	{
		$conn = getDatabaseConnection();
		$id = $_SESSION['uID'];
		$totalCost = totalBasketCost($id);

		$sql = "SELECT credit FROM cmp311user WHERE id = $id";
		$result = mysqli_query($conn, $sql);
		$balance = $result[0]["credit"];

		$newTotal = $balance - $totalCost;
		
		if ($balance < $totalCost){
			// give error message
		}else{	
			$basket = getBasket($id);
			for ($i=0;$i<sizeof($basket);$i++){
				$keyid = $basket[$i]["keyID"];
				$cost = $basket[$i]["cost"];
				// Mark Keys as owned by user who purchased
				$sql = "UPDATE gameKeys SET purchasedBy = $id WHERE id = $keyid";
				$result = mysqli_query($conn, $sql);
				// Make note of transaction in log
				$sql = "INSERT INTO subTransactions (userID, keyID, cost) VALUES ($id, $keyid, $cost)";
			}
			$sql = "UPDATE cmp311user SET credit = $newTotal WHERE id = $id";
			$result = mysqli_query($conn, $sql);
		}
		
		$basket = getBasket($id);
		for ($i=0;$i<sizeof($basket);$i++){
			$keyid = $basket[$i]["keyID"];
			$sql = "DELETE FROM gameKeys WHERE keyID = $keyid";
		}
	}
?>