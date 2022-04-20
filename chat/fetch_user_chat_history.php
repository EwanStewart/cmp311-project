<?php

//fetch_user_chat_history.php

include('chat_db.php');

session_start();

echo fetch_user_chat_history($_SESSION['uID'], $_POST['to_user_id'], $connect);


?>