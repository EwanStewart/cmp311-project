<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //  start session
        session_start();

		if ($_SESSION["uID"]){
            //  get posted data
			$enteredReferralCode = $_POST['enteredReferralCode'];

            //  get user id
			$userID = $_SESSION['uID'];

            //	establish connection to database
			include_once("../controller/connection.php");
			$conn = getDatabaseConnection();

            //  get user from referral code
            $stmt = $conn->prepare("SELECT * FROM `cmp311user` WHERE `referralCode` = ?");
            $stmt->bind_param("s", $enteredReferralCode);
            $stmt->execute();
            $result = $stmt->get_result();

            $rows = array();
            while($buffer = mysqli_fetch_assoc($result)){
                $rows[] = $buffer;
            }

            //  check if code is valid
            if ($rows == NULL){
                //  error
                echo "No matching referral code found";
            }else if ($rows[0]["id"] == $userID){
                //  error
                echo "Cannot refer yourself, nice try";
            }else if ($rows[0]["referrals"] <= 10){
                //  success

                //  check if code has been used by user before

                //  get recorded referrals of both IDs
                $stmt2 = $conn->prepare("SELECT * FROM `referrals` WHERE `referrer` = ? AND `referred` = ?");
                $stmt2->bind_param("ii", $rows[0]["id"], $userID);
                $stmt2->execute();
                $result2 = $stmt2->get_result();
    
                $rows2 = array();
                while($buffer2 = mysqli_fetch_assoc($result2)){
                    $rows2[] = $buffer2;
                }

                if ($rows2 == NULL){
                    //  add record and continue
                    $stmt2 = $conn->prepare("INSERT INTO `referrals` (`referrer`, `referred`) VALUES (?, ?)");
                    $stmt2->bind_param("ii", $rows[0]["id"], $userID);
                    $stmt2->execute();
                    $result2 = $stmt2->get_result();
                }else{
                    //  error
                    echo "Referral code has already been used";
                    return;
                }

                //  increase referral count by 1 and add credit
                $newReferralCount = $rows[0]["referrals"] + 1;
                $newCreditCount = $rows[0]["credit"] + 100;

                $stmt = $conn->prepare("UPDATE `cmp311user` SET `referrals` = ?, `credit` = ? WHERE `id` = ?");
                $stmt->bind_param("iii", $newReferralCount, $newCreditCount, $rows[0]["id"]);
                $stmt->execute();
                $result = $stmt->get_result();

                echo "Success, you have been referred!";
            }else{
                //  Referral counted but user has reached maximum reward

                //  check if code has been used by user before

                //  get recorded referrals of both IDs
                $stmt2 = $conn->prepare("SELECT * FROM `referrals` WHERE `referrer` = ? AND `referred` = ?");
                $stmt2->bind_param("ii", $rows[0]["id"], $userID);
                $stmt2->execute();
                $result2 = $stmt2->get_result();
    
                $rows2 = array();
                while($buffer2 = mysqli_fetch_assoc($result2)){
                    $rows2[] = $buffer2;
                }

                if ($rows2 == NULL){
                    //  add record and continue
                    $stmt2 = $conn->prepare("INSERT INTO `referrals` (`referrer`, `referred`) VALUES (?, ?)");
                    $stmt2->bind_param("ii", $rows[0]["id"], $userID);
                    $stmt2->execute();
                    $result2 = $stmt2->get_result();
                }else{
                    //  error
                    echo "Referral code has already been used";
                    return;
                }

                //  increase referral count by 1
                $newReferralCount = $rows[0]["referrals"] + 1;

                $stmt = $conn->prepare("UPDATE `cmp311user` SET `referrals` = ? WHERE `id` = ?");
                $stmt->bind_param("ii", $newReferralCount, $rows[0]["id"]);
                $stmt->execute();
                $result = $stmt->get_result();


                echo "Referral counted but user has reached maximum reward.";
            }

		}
		
    }else{
		//Error
	}
?>