<?php
	function getDatabaseConnection() {
		//  Database connections 
		$servername = "lochnagar.abertay.ac.uk";
		$username = "#";
		$password = "#";
		$dbname = "#";
		$conn = mysqli_connect($servername, $username, $password, $dbname) ;
		return $conn ;
	}
?>