<?php
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //  start session
        session_start();

		if ($_SESSION["uID"]){
            //  get posted data
			$forename = $_POST['forename'];
            $surname = $_POST['surname'];
            $bio = $_POST['bio'];

            //  get user id
			$userID = $_SESSION['uID'];

            //	establish connection to database
			include_once("../controller/connection.php");
			$conn = getDatabaseConnection();

			//  update details
            $stmt = $conn->prepare("UPDATE `cmp311user` SET `forename` = ?, `surname` = ?, `bio` = ? WHERE `id` = ?");
            $stmt->bind_param("sssi", $forename, $surname, $bio, $userID);
            $stmt->execute();
            $result = $stmt->get_result();


            //  return result
            echo $result;
		}
		
    }else{
		//Error
	}
?>