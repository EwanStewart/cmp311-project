<?php
	function getDatabaseConnection() {
		$servername = "lochnagar.abertay.ac.uk";
		$username = "sqlcmp311g21c02";
		$password = "6XYSo4gbvVFy";
		$dbname = "sqlcmp311g21c02";
		$conn = mysqli_connect($servername, $username, $password, $dbname) ;
		return $conn ;
	}
?>