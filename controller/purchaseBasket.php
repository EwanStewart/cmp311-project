<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

		include_once("../model/api-store.php");
        session_start();
		$message = purchaseBasket();		
		echo $message;
    }else{
		//Error
	}
?>