<!DOCTYPE html> 
<html lang="en">

   <head>
	   <meta charset="utf-8">
	   <meta name="viewport" content="width=device-width, initial-scale=1">
	   
	   <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
	   <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	   
	   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	   
	   <link rel="stylesheet" href="style.css?v=1.0" />
   </head>
   
   <body>
   
	<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	require_once('config.php');
	include('navbar.html');
	?>

	  
      <div class="container-fluid">
         <div class="container">
            <div class="row justify-content-center">
				<?php 
					if(isset($_GET['code'])) {
						$token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
						if (isset($token["error"]) != "invalid_grant") {
							$oAuth = new Google_Service_Oauth2($gClient);
							$userData = $oAuth->userinfo_v2_me->get();
							echo $userData["email"];
							echo '<br>';
							echo $userData["givenName"]. " " .$userData["familyName"];
						} else {
							echo 'failed login';
						}
					}
				
				?>
            </div>
         </div>
      </div>
   </body>
</html>
