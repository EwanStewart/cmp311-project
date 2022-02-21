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
	   
	   <link rel="stylesheet" type="text/css" href="styles.css" >
	   
   </head>
   
   <body>
   
	<?php	
		include('navbar.php');
	?>
	  
		<div class="container">
			<div class="row">
			<form>
				<div class="col-md-6">
					<label> Please enter the game title </label>
					<input type="text" class="form-control" name="title">
				</div>
				<div class="col-md-6">
					<label> Which game store is this key for? </label>
					<input type="text" class="form-control" name="store">
				</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<label> Game key: </label>
						<input type="text" class="form-control" name="key">
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<label> Notes </label>
						<textarea class="form-control" name="bio" rows="3" > </textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<label> I confirm that this a valid game key </label>
						<input type="checkbox" id="confirm" name="confirm">
					</div>
				</div>	
				<div class="row">
					<div class="col-md-12">
						<label> Should this key be public right away? </label>
						<input type="checkbox" id="public" name="public">
					</div>
				</div>					
				<br>
				<div class="row">
					<div class="col-md-12">
						<button class="btn btn-primary" type="button"> Add </button>
					</div>
				</div>
			</form>
		</div>
		
   </body>
   
</html>
