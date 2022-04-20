<?php

//update_last_activity.php

include('chat_db.php');

session_start();

$query = "
UPDATE login_details 
SET last_activity = now() 
WHERE user_id = '".$_SESSION["uID"]."'
";

$statement = $connect->prepare($query);

$statement->execute();

?>