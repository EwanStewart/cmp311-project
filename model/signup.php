<?php
	session_start();
	
	require_once '../controller/connection.php';
	$conn = getDatabaseConnection();
	$error = '';
		
	if (isset($_POST['submit']))
	{
		$email = $_POST['email']; //get username from form
		$pass = $_POST['password']; //get password from form
		
		$salt = 'abc%rtyfhey9setoup;hfqw3CHEGUILAHUOELIWRQRFJHUKL;&^*£^$%(';

		if (!preg_match("#[0-9]+#", $pass))
		{
			$error = "Your Password Must Contain At Least 1 Number!";
		}
		elseif (!preg_match("#[A-Z]+#", $pass))
		{
			$error = "Your Password Must Contain At Least 1 Capital Letter!";
		}


		$_SESSION['signup_error'] = $error;

		if ($_SESSION['signup_error'] == '')
		{
			$password = password_hash($salt . $_POST['password'], PASSWORD_DEFAULT); //get password from form
			
			$sqlSelect = "SELECT * FROM cmp311user WHERE email=?"; //select to check if username exists
			$sqlInsert = "INSERT INTO cmp311user (email, password) VALUES (?, ?)"; //insert to create account

			$stmtSelect = $conn->prepare($sqlSelect); //prepare select
			$stmtInsert = $conn->prepare($sqlInsert); //prepare insert
			
			$stmtSelect->bind_param("s", $email); //bind parameters to select statement
			$stmtSelect->execute(); //execute select statement
			
			$result = $stmtSelect->get_result();

			if ($result->num_rows > 0)
			{ 
				$_SESSION['signup_error'] = 'Username Taken';
			}
			else
			{
				$_SESSION['signup_error'] = '';
				$stmtInsert->bind_param("ss", $email, $password); //bind parameters to insert statement
				$stmtInsert->execute(); //execute insert statement	
			}
			
		}
	}
	
	if ($_SESSION['signup_error'] != '') {
		header("Location:../view/index.php?pop=1"); //return to home
	} else {
		header("Location:../view/index.php?pop=2"); //return to home
	}

	

?>