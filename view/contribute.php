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

	function confirmation() {
		var x = document.querySelectorAll("[id='tab']");
		for(var i = 0; i < x.length; i++) {
			x[i].style.display = "none";
		}
		$("#prevBtn").toggle();
		$("#contributeConfirmation").toggle();
	}

	function updatetitles(str) {

		if (str.length == 0) {
			document.getElementById("txtHint").innerHTML = "";
			return;
		} else {
			const xmlhttp = new XMLHttpRequest();
			xmlhttp.onload = function() {
			var a=document.getElementById("titles").options.length;
			var b=document.getElementById("titles").options[0].value;

			document.getElementById("titles").innerHTML = this.responseText;


		}
		xmlhttp.open("GET", "../model/a.php?q=" + str);
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

				<form class="contributeCard">
					<h1 style="text-align:center;">Contribute</h1>
				
					<div id="tab">
						<h4>Game Information</h6>
						<br/>
						<h6>Game Title</h6>
						<p class="gameDrop">
							
							<?php
								ini_set('display_errors', 1);
								ini_set('display_startup_errors', 1);
								error_reporting(E_ALL);

								require('../model/fetchGameTitles.php');

								function fetch($str) {
									return fetchFromDB($str);
								}

							?>

							<div id="txtHint">
								
							</div>

							<input type="text" id="t" oninput="updatetitles(this.value);" list="titles" />
							<datalist id="titles">
								<?php
									$data = fetch('Call');
									for ($i=0;$i < count($data); $i++) {
										echo '<option value="'. $data[$i]["name"] .'">'. $data[$i]["name"] .'</option>';
									}
								?>
							</datalist>
						</p>						
						
						<h6>Game Key</h6>
						<p> <input placeholder="Example: (XXXXX-XXXXX-XXXXX-XXXXX-XXXXX)" name="key"></p>
						<h6>Applicable Store</h6>
						
						<p class="storeDrop">
							<select name="steam">
								<option value="steam">Steam</option>
							</select>
						</p>
					</div>

					<div id="tab" style="display:none;">
						<h4>Additional Information</h6>
						<br/>

						<h6>Notes</h6>
						<p><textarea name="gameNotes"> </textarea></p>

						<h6> Should the key be made public? </h6>
						<p class="public">
							<select name="Public">
								<option value="steam">Add to my account only</option>
								<option value="steam">Public</option>
							</select>
						</p>

						<h6> By checking this tickbox you agree that this a valid and legally obtained game key. </h6>
						<p> <input type="checkbox" id="tick" name="tick1"></p>
						
						<button type="button" onClick="confirmation()" id="contributeSubmit" href="#" > Submit </button>
					</div>

					<div style="overflow:auto;">
						<div style="float:right;">
						<button type="button" id="prevBtn" onclick="tabs()"><i class="fa fa-angle-double-left"></i></button>
						<button type="button" id="nextBtn" onclick="tabs()"><i class="fa fa-angle-double-right"></i></button>
						</div>
					</div>

					<div id="contributeConfirmation">
						<h3>Confirmation</h3>
						<br/>
						<p>Contribution Reference: </p>
						<p>Title: </p>
						<p>Store: </p>
						<p>Notes: </p>
						<p>Listed Price:</p>

						<a href="contribute.php"> <input style="font-size:20px;" type="button" value="Contribute another" />  </a>
						<br/>
						<br/>
						<a href="index.php"> <input style="font-size:20px;" type="button" value="Return to homepage" />  </a>

					</div>

				</form>



			</div>
    </div>
</div>
		
   </body>
   
</html>