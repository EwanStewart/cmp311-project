<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	session_start();

	$id = $_SESSION['uID'];

	include_once("../controller/connection.php");
	$conn = getDatabaseConnection();

	include_once("../model/api-store.php");
	$totalCost = totalBasketCost();

	$sql = "SELECT credit FROM cmp311user WHERE id = $id LIMIT 1";
	$result = mysqli_query($conn, $sql);
	while($r = mysqli_fetch_assoc($result)) {
		$row = $r;
	}

	$balance = $row["credit"];

	$newTotal = $balance - $totalCost;
	
	if ($balance < $totalCost){
		echo "You do not have enough Credits for this purchase.";
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
			$result = mysqli_query($conn, $sql);
		}
		// Empty basket
		$sql = "DELETE FROM basket WHERE userID = $id";
		$result = mysqli_query($conn, $sql);
		// Take credits from user
		$sql = "UPDATE cmp311user SET credit = $newTotal WHERE id = $id";
		$result = mysqli_query($conn, $sql);

		echo "Keys purchased successfully.";
	}
?>