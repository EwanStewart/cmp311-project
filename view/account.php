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
	   
	   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


	   <link rel="stylesheet" href="style.css?v=1.0" />
   </head>
   
   <body>

  
	<?php	
		include('navbar.php');
		
		$fname = '';
		$sname = '';
		$email = '';
		$country = '';

		if (isset($_SESSION['forename'])) { 
			$fname = $_SESSION['forename'];
		}
		if (isset($_SESSION['surname'])) { 
			$sname = $_SESSION['surname'];
		}		
		if (isset($_SESSION['email'])) { 
			$email = $_SESSION['email'];
		}
	    if (isset($_SESSION['country'])) { 
			$email = $_SESSION['country'];
		}
	?>
	
	<script>
		$(document).ready(function(){		
			$('#edit').click(function(){
					$("input[name='forename']").removeAttr( "readonly" ); 
					$("input[name='surname']").removeAttr( "readonly" ); 
					$("input[name='email']").removeAttr( "readonly" ); 
					$("#edit").text("Save Changes");
			});	
		});
	</script>

	  
     <div class="container rounded bg-white mt-5 mb-5">
		<div class="row">	
		
			<div class="col-md-3">
				<div>
					<img class="rounded-circle" width="150px" src="http://clipart-library.com/images/Bigrp5ebT.png">
					<button class="btn btn-primary" type="button"> Change Avatar </button>
				</div>
			</div>
			
			<div class="col-md-5">
				<div>
					<div class="align-items-center">
						<h4> Account Details </h4>
					</div>
					<div class="row">
						<div class="col-md-6">
							<label> Forename </label>
							<input type="text" class="form-control" name="forename" value=<?php echo $fname;?> readonly>
						</div>
						<div class="col-md-6">
							<label> Surname </label>
							<input type="text" class="form-control" name="surname" value=<?php echo $sname;?> readonly>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<label> Email </label>
							<input type="email" class="form-control" name="email" value=<?php echo $email;?> readonly>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-12">
							<button class="btn btn-primary" id="edit" type="button"> Edit Profile </button>
						</div>
					</div>
				</div>
			</div>
						
		</div>
	</div>
	</div>
	</div>

   </body>
</html>
