<!DOCTYPE html> 
<html lang="en">

   <head>
		<?php   
			session_start();
		?>
		
	   <meta charset="utf-8">
	   <meta name="viewport" content="width=device-width, initial-scale=1">
	   
	   <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
	   <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


       <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	   
	   <link rel="stylesheet" type="text/css" href="styles/styles.css" >
	   
   </head>
   
   <body>
   
	<?php	
		require_once('config.php');
		include('navbar.php');
		include('../model/getGames.php');
	?>

	  
		<div class="container mdc-top-app-bar--dense-fixed-adjustt">
			<?php
				$data = getAvaliableGames();
				$diffGenres = array();

				for ($i=0;$i<count($data);$i++){
					$title = getGameTitle($data[$i]["appID"]);
					$cached = checkGenreCached($data[$i]["appID"]);
					
					//echo $title[0]["name"] . "<br/>";
					//echo $cached[0]["genres"] . "<br/>";
					array_push($diffGenres, $cached[0]["genres"]);
				}

				echo "<br/>";

				//$it = array_merge($diffGenres);
				$l = array_values(array_filter(array_unique($diffGenres)));
					
				for ($i=0;$i<count($l);$i++) {
					echo $l[$i] . "<br/>";
				}
			?>
		</div>

   </body>
</html>


