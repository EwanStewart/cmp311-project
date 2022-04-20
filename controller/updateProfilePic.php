<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //  start session
        session_start();

		if ($_SESSION["uID"]){
            //  get profile picture id and user id
			$profilePictureID = $_POST['profilePictureID'];
			$userID = $_SESSION['uID'];

            //	establish connection to database
			include_once("../controller/connection.php");
			$conn = getDatabaseConnection();

			//  update profile picture id
            $sql = "UPDATE `cmp311user` SET `profilePictureID` = $profilePictureID WHERE `id` = $userID";
			$result = mysqli_query($conn, $sql);
		}
		
    }else{
		//Error
	}
?>