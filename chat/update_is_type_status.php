<?php

//update_is_type_status.php

include('chat_db.php');

session_start();

$query = "
UPDATE login_details 
SET is_type = '".$_POST["is_type"]."' 
WHERE user_id = '".$_SESSION["uID"]."'
";

$statement = $connect->prepare($query);

$statement->execute();

?>