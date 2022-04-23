<?php
    include('header.php');
	echo "<br/><br/><br/><br/>";
?>

<div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
		include_once('../model/getGames.php');
	?>

	  
		<div class="container mdc-top-app-bar--dense-fixed-adjustt">
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
				<div class="row">
					<div class="col-sm-2">

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

					<div id ="filtered" class="col-sm-10">
							

					</div>
				</div>
				


			
		</div>
    



</div>
<?php include('footer.php'); ?>