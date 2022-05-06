    <?php
	session_start();
	require_once '../controller/connection.php';
	$conn = getDatabaseConnection();
	$error = '';
		
	if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordConf'])) {
		$email = $_POST['email'];
		$password = $_POST['password'];
		$passwordConf = $_POST['passwordConf'];
		$salt = 'abc%rtyfhey9setoup;hfqw3CHEGUILAHUOELIWRQRFJHUKL;&^*£^$%(';

		if (!preg_match("#[0-9]+#", $password))
		{
			$error = "Your Password Must Contain At Least 1 Number!";
		}
		elseif (!preg_match("#[A-Z]+#", $password))
		{
			$error = "Your Password Must Contain At Least 1 Capital Letter!";
		}
		
		if ($password != $passwordConf) {
			$error = 'Passwords do not match';
		}

		$_SESSION['signup_error'] = $error;

	} else  {
		$_SESSION['signup_error'] = 'Please fill in all fields';
	}
		


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
	

	
	
	if ($_SESSION['signup_error'] != '') {
		header("Location:../view/register.php"); //return to home
	} else {
		$sql = "SELECT `id` FROM cmp311user WHERE `email` = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$result = $stmt->get_result();
		while($r = mysqli_fetch_assoc($result)) {
			$_SESSION['uID'] = $r["id"];
		}
		$_SESSION['email'] = $email;
		$_SESSION['admin'] = 0;
		header("Location:../view/index.php"); //return to home
	}

	

?>