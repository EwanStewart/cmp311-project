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
   
	<script>
		$(document).ready(function () {
			$("form").submit(function (event) {
				$.ajax({
					type: "POST",
					url: "../model/filter.php",
					data: $("form").serializeArray(),
					}).done(function (data) {

						$('#filtered').html(data);
					});

				event.preventDefault();
			});
		})
	</script>

   <body>
   
	<?php	
		require_once('config.php');
		include('navbar.php');
		include('../model/getGames.php');
	?>

	  
		<div class="container-fluid mdc-top-app-bar--dense-fixed-adjustt">
			<?php
				$data = getAvaliableGames();
				$diffGenres = array();

				for ($i=0;$i<count($data);$i++){
					$title = getGameTitle($data[$i]["appID"]);
					$cached = checkGenreCached($data[$i]["appID"]);
					array_push($diffGenres, $cached[0]["genres"]);
				}

				echo "<br/>";

				$l = array_values(array_filter(array_unique($diffGenres)));
				$a = array_count_values($diffGenres);	

			?>
				 <div class="text-left">

				 		Filter Bar
						 <form method="POST">
							<?php
								for ($i=0;$i<count($l);$i++) {
									echo "<input type=checkbox name=".$l[$i]." /> " . "(". $a[$l[$i]] . ") " . $l[$i] . "<br/>";
								}
								echo "<br/>";
								echo "<input type=submit value='Search' name='submit'/>";
							?>
						 </form>

				</div>

				<div id ="filtered" class="text-center">
						

				</div>
				


			
		</div>

   </body>
</html>


