<?php
	session_start();
	require_once 'connection.php';
	require_once('../view/config.php');
	
	$conn = getDatabaseConnection();
	
	if(isset($_GET['code'])) {
		$token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
		if (isset($token["error"]) != "invalid_grant") {
			$oAuth = new Google_Service_Oauth2($gClient);
			$userData = $oAuth->userinfo_v2_me->get();
			$email    = $userData["email"];
			$forename = $userData["givenName"];
			$surname  = $userData["familyName"];
			$error = False;
		} else {
			$error = True;
		}
	}

    if (!$error)
    {
		$_SESSION['forename'] = $forename;
		$_SESSION['surname']  = $surname;
		$_SESSION['email']    = $email;
			
        $sqlSelect = "SELECT * FROM cmp311user WHERE email=?"; 
		$sqlInsert = "INSERT INTO cmp311user (forename, surname, email) VALUES (?, ?, ?)"; 

        $stmtSelect = $conn->prepare($sqlSelect); 
        $stmtInsert = $conn->prepare($sqlInsert); 
		
        $stmtSelect->bind_param("s", $email); 
        $stmtSelect->execute(); 
		
        $result = $stmtSelect->get_result();

		if ($result->num_rows > 0) { 								
			while($row = $result->fetch_assoc()) { 	
				$_SESSION['admin'] = $row["admin"];	
			}
		}
	
        if ($result->num_rows == 0)
        {		
            $stmtInsert->bind_param("sss", $forename, $surname, $email); 
            $stmtInsert->execute(); 		
        }
    }
	
	header("Location:../view/index.php");    
	
?>
