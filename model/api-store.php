<?php
	// Connect to database
	include_once("../controller/connection.php");

	ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
	
	// function to return the details of the game in the user's basket
	function getBasket()
	{
		$id = $_SESSION['uID'];
		$conn = getDatabaseConnection();
		// Get IDs of user, key, and app, as well as the store used, game name, and the key itself
		$sql = "SELECT basket.userID, basket.keyID, gameKeys.store, gameKeys.gameKey, steam.name, steam.appid FROM ((basket INNER JOIN gameKeys ON gameKeys.id = basket.keyID) INNER JOIN steam ON steam.appid = gameKeys.appID) WHERE basket.userID = " . $id;
		//$sql = "SELECT * FROM basket WHERE userID = " . $id;
		$result = mysqli_query($conn, $sql);
		while($r = mysqli_fetch_assoc($result)) {
    		$rows[] = $r;
		}

		for ($i=0;$i<sizeof($rows);$i++){
			$appID = $rows[$i]["appid"];
			$url = "https://store.steampowered.com/api/appdetails?appids=" . $appID; // Get info for current game
			$apidata = json_decode(file_get_contents($url), true);
			$cost = (ceil($apidata[$appID]["data"]["price_overview"]["final"] / 100 )) * 100;
			$rows[$i]["cost"] = $cost; // Add cost field to array
		}

		return $rows;
	}

	/*function addToBasket($keyid)
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
	}*/

	function numberOfTransactions()
	{
		//	possibly deprecated

		$conn = getDatabaseConnection();
		$sql = "SELECT * FROM subTransactions";
		$result = mysqli_query($conn, $sql);
		$rowcount = mysqli_num_rows( $result );
		return $rowcount;
	}

	/*function getUserTransactions()
	{
		$conn = getDatabaseConnection();
		$id = $_SESSION['uID'];
		$sql = "SELECT id, userID FROM subTransactions WHERE userID = $id";
		$result = mysqli_query($conn, $sql);
		while($r = mysqli_fetch_assoc($result)) {
    		$rows[] = $r;
		}
		return $rows;
	}*/

	function getUserTransactions()
	{
		$conn = getDatabaseConnection();
		$id = $_SESSION['uID'];
		$sql = "SELECT keyTransactions.userID, keyTransactions.keyID, keyTransactions.dateOfPurchase, keyTransactions.cost, gameKeys.store, gameKeys.gameKey, steam.name, steam.appid FROM ((keyTransactions INNER JOIN gameKeys ON gameKeys.id = keyTransactions.keyID) INNER JOIN steam ON steam.appid = gameKeys.appID) WHERE keyTransactions.userID = " . $id;
		$result = mysqli_query($conn, $sql);
		while($r = mysqli_fetch_assoc($result)) {
    		$rows[] = $r;
		}
		return $rows;
	}

	function totalBasketCost()
	{
		$basket = getBasket();
		$totalCost = 0;
		
		for ($i=0;$i<sizeof($basket);$i++){
			$totalCost += $basket[$i]["cost"];
		}
		return $totalCost;
	}

	function purchaseBasket()
	{
		$conn = getDatabaseConnection();
		$id = $_SESSION['uID'];
		$totalCost = totalBasketCost();

		$sql = "SELECT credit FROM cmp311user WHERE id = $id";
		$result = mysqli_query($conn, $sql);
		$balance = $result[0]["credit"];

		$newTotal = $balance - $totalCost;
		
		if ($balance < $totalCost){
			return "You do not have enough Credits for this purchase.";
		}else{	
			$basket = getBasket($id);
			for ($i=0;$i<sizeof($basket);$i++){
				$keyid = $basket[$i]["keyID"];
				$cost = $basket[$i]["cost"];
				// Mark Keys as owned by user who purchased
				$sql = "UPDATE gameKeys SET purchasedBy = $id WHERE id = $keyid";
				$result = mysqli_query($conn, $sql);
				// Make note of transaction in log
				$sql = "INSERT INTO keyTransactions (userID, keyID, cost) VALUES ($id, $keyid, $cost)";
			}
			// Empty basket
			$sql = "DELETE FROM basket WHERE userID = $id";
			$result = mysqli_query($conn, $sql);
			// Take credits from user
			$sql = "UPDATE cmp311user SET credit = $newTotal WHERE id = $id";
			$result = mysqli_query($conn, $sql);

			$msg = "Keys purchased successfully.";
			return $msg;
		}
	}

	function checkValidSubscription(){
		//	function to check for valid subscription
		//	returns:
		//	0 - invalid
		//	1 - valid - monthly
		//	2 - valid - yearly

		//	establish DB connection and get user ID from session
		$conn = getDatabaseConnection();
		$id = $_SESSION['uID'];

		//	get most recent monthly sub transaction
		$sql = "SELECT `dateOfPurchase` FROM `subTransactions` WHERE `userID` = $id AND `cost` = 99 ORDER BY `dateOfPurchase` DESC LIMIT 1";
		$yearlyResults = mysqli_fetch_assoc(mysqli_query($conn, $sql));

		//	get most recent yearly sub transaction
		$sql = "SELECT `dateOfPurchase` FROM `subTransactions` WHERE `userID` = $id AND `cost` = 19 ORDER BY `dateOfPurchase` DESC LIMIT 1";
		$monthlyResults = mysqli_fetch_assoc(mysqli_query($conn, $sql));

		//	close conn
		$conn->close();
		
		//	if most recent monthly sub transaction is still valid
		if ($monthlyResults != NULL){
			//	get last yearly sub date in correct format
			$dateOfPurchase = date("Y-m-d", strtotime($monthlyResults["dateOfPurchase"]));
			$lastSubDate = date_create_from_format('Y-m-d', $dateOfPurchase);

			//	get current date in correct format
			$currentDate = date_create_from_format('Y-m-d', date('Y-m-d'));

			//	get difference in days
			$diff = date_diff($lastSubDate, $currentDate);
			$days = $diff->format("%a");

			//	return success if last yearly sub date is still in date
			if($days <= 30){
				//	return monthly success code
				return 1;
			}
		}

		//	if most recent yearly sub transaction is still valid
		if ($yearlyResults != NULL){
			//	get last yearly sub date in correct format
			$dateOfPurchase = date("Y-m-d", strtotime($yearlyResults["dateOfPurchase"]));
			$lastSubDate = date_create_from_format('Y-m-d', $dateOfPurchase);

			//	get current date in correct format
			$currentDate = date_create_from_format('Y-m-d', date('Y-m-d'));

			//	get difference in days
			$diff = date_diff($lastSubDate, $currentDate);
			$days = $diff->format("%a");

			//	return success if last yearly sub date is still in date
			if($days <= 365){
				//	return yearly success code
				return 2;
			}
		}
		
		//	subscriptions do not exist or have expired, return fail code
		return 0;
	}

?>