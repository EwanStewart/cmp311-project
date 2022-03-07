<!DOCTYPE html> 
<html lang="en">

   <head>
		<?php   
			session_start();
		?>
		<title> Contribute </title>
	   <meta charset="utf-8">
	   <meta name="viewport" content="width=device-width, initial-scale=1">
	   
	   <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
	   <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	   
	   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	   
	   <link rel="stylesheet" type="text/css" href="styles.css" >
	   
   </head>
   
   <script>
	//do something
	jQuery(document).ready(function(){
		$("#prevBtn").toggle();
		$("#contributeConfirmation").toggle();
	});



	function tabs() {

		
		var x = document.querySelectorAll("[id='tab']");

		for(var i = 0; i < x.length; i++) {
			if (x[i].style.display === "none") {
				x[i].style.display = "block";
				$("#nextBtn").toggle();
				$("#prevBtn").toggle();
			} else {
				x[i].style.display = "none";
			}
		}	


	} 



	function updatetitles(str) {

		if (str.length == 0) {
			return;
		} else {
			const xmlhttp = new XMLHttpRequest();
			xmlhttp.onload = function() {

			document.getElementById("titles").innerHTML = this.responseText;
			document.getElementById("titles").style.visibility = "visible"; 
		}
		xmlhttp.open("GET", "../model/fetch.php?q=" + str);
		xmlhttp.send();
		}
	}

   </script>


   <body>
   
	<?php	
		include('navbar.php');
	?>
	  
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<form action="../model/addGameKey.php" method="POST" class="contributeCard">
					<h1 style="text-align:center;">Contribute</h1>
				
					<div id="tab">
						<h4>Game Information</h6>
						<br/>
						<h6>Search for your game</h6>
						<p class="gameDrop">
							
							<?php
								ini_set('display_errors', 1);
								ini_set('display_startup_errors', 1);
								error_reporting(E_ALL);

							?>


							<input type="text" oninput="updatetitles(this.value);"/>
							<br/>
							<br/>

							<select id="titles" name="title">
								<h6>Select from our choices</h6>
								<?php
									$data = NULL;
									if ($data != NULL) {
										for ($i=0;$i < count($data); $i++) {
											echo '<option value="'. $data[$i]["name"] .'">'. $data[$i]["name"] .'</option>';
										}
									}

								?>
							</select>
						</p>						
						
						<h6>Game Key</h6>
						<p> <input name="key"></p>
						<h6>Applicable Store</h6>
						
						<p class="storeDrop">
							<select name="store">
								<option value="steam">Steam</option>
							</select>
						</p>
					</div>

					<div id="tab" style="display:none;">
						<h4>Additional Information</h6>
						<br/>

						<h4>Notes</h4>
						<p><textarea name="gameNotes"> </textarea></p>

						<h4> Should the key be made public? </h4>
						<p class="public">
							<select name="public">
								<option value="0">Add to my account only</option>
								<option value="1">Public</option>
							</select>
						</p>

						<h4 style="display:inline;"> By checking this tickbox you agree that this a valid and legally obtained game key. </h4>
						<input type="checkbox" id="tick" name="tick1">
						<br/>
						<br/>
						<input type="submit" name="submit" id="contributeSubmit" value="Submit">
						<br/>
						<br/>
					</div>

					<div style="overflow:auto;">
						<div style="float:right;">
						<button type="button" id="prevBtn" onclick="tabs()"><i class="fa fa-angle-double-left"></i></button>
						<button type="button" id="nextBtn" onclick="tabs()"><i class="fa fa-angle-double-right"></i></button>
						</div>
					</div>
				</form>



			</div>
    </div>
</div>
		
   </body>
   
</html>