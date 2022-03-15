<?php
    // NOT FINISHED
    // TO BE USED WITH SUBSCRIPTION
    session_start();

    include_once '../controller/connection.php';
    $conn = getDatabaseConnection();
    $id = $_SESSION['userID'];
    $cardNum = $_POST['cardNum'];
    
    // Checks if card number fits requirements.
    if (!preg_match('/^[0-9]{16}$/', $cardNum)) {

        // If not, returns to register page with error code 1, representing an invalid number.
        header('Location: ../view/details?error=1');
    
    }else {
        include("../model/api-store.php") ;

        $errorCounter = 0;
        $basket = getBasket();
        
        for ($i=0;$i<sizeof($basket);$i++)
        {
            $keyID = $basket[$i]["keyID"];

            //Transaction ID string is created by incrementing number of existing transactions by one
            //and filliing the rest with zeros to bring it to 8 characters
            $tID = numberOfTransactions();
            $transactionStr = (string)$tID;
            while (strlen($transactionStr) < 8){
                $transactionStr = "0" . $transactionStr;
            }

            // Set up the JSON first
            $data -> vendor = "2005670" ;  // student number
            $data -> transaction = $transactionStr ;  // string of length 8
            $data -> amount = $price ; // amount less than 100
            $data -> card = $cardNum ;  //  16 digit number 
            $request = json_encode($data) ;
            
            //Interacts with AberPay API
            $url = "https://driesh.abertay.ac.uk/~g510572/aberpay/" ;
            $ch = curl_init() ;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json', 
            'Content-Length: ' . strlen($request)) );  
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
            $response = curl_exec($ch);
            
            //If the API returns a successful transaction
            if (strstr($response, '{"status":1,')){

                // - GET RID OF THIS SECTION -

                //The transaction ID, user ID, game ID, and price paid are stored in the DB
                $sql = "INSERT INTO `keyTransactions`(`userID`, `keyID`, `cost`) VALUES ('".$id."', '".$keyID."', '".$price."')";
                $result = mysqli_query($conn, $sql);
                var_dump($result);

                //User's basket is set to empty
                $sql = "UPDATE ShopUser SET basket=Null WHERE id=?";
                $stmt= $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();

                //Success Message is shown to user
                //header('Location: ../view/basket?msg=1');
                
            }else{
                //Error message is shown to user
                //header('Location: ../view/details?error=2');
                break;
            }

        }

        
    }
?>