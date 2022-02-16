<?php 
  session_start();
  require_once '../controller/connection.php';
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
	
  $conn = getDatabaseConnection();

  $salt = 'abc%rtyfhey9setoup;hfqw3CHEGUILAHUOELIWRQRFJHUKL;&^*£^$%('; 

  if (isset($_POST['submit'])) {
	  
	$email = $_POST['email']; 											    //get username from form
	$password = $salt . $_POST['password']; 									//get password from form
	
	$sqlSelect = "SELECT * FROM cmp311user WHERE email=?";	//select to check if correct login
	$stmtSelect = $conn->prepare($sqlSelect);									//prepare select
	$stmtSelect->bind_param("s", $email);						//bind parameters to select statement
	$stmtSelect->execute(); 													//execute select statement
	$result = $stmtSelect->get_result();	
	
	if ($result->num_rows > 0) { 								//if there is comments
		while($row = $result->fetch_assoc()) { 					//output row
			if(password_verify($password, $row["password"])) {
				  $_SESSION['login_error'] = '';
				  $_SESSION['email'] = $email;
				  $_SESSION['forename'] = $row["forename"];
				  $_SESSION['surname'] = $row["surname"];
				  $_SESSION['admin'] = $row["admin"];
				  header("Location:../view/index.php");
			}
		}
	}
  }
  
  $_SESSION['login_error'] = 'Invalid Login';
  header("Location:../view/index.php?pop=2");
?>