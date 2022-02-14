<!DOCTYPE html> 
<html lang="en">

   <head>
   
		<?php   
			session_start();
		?>
		
	   <meta charset="utf-8">
	   <meta name="viewport" content="width=device-width, initial-scale=1">
	   
	   <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
	   
	   <link rel="stylesheet" type="text/css" href="styles.css" >
	   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	   
	   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	   
	   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

   </head>
   
   <body>

  	<script>
		$(document).ready(function(){	
		
			$('#editProfilePicture').click(function(){
				$('#popup').show();
			});	
			
			$('.img-fluid').click(function(){
				$('#popup').hide();
			});	
			
			$('#edit').click(function(){
					$("input[name='forename']").removeAttr( "readonly" ); 
					$("input[name='surname']").removeAttr( "readonly" ); 
					$("input[name='email']").removeAttr( "readonly" ); 
					$("#edit").text("Save Changes");
			});	
		});
	</script>
	
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
	
	<style>
		.img-fluid {
			width: 100px; 
			height: 100px;
			object-fit: cover;
		}
		
		.popup {
		  background: #d1005c;
		  padding: 20px;
		  color: #fff;
		  min-height: 200px;
		  position: absolute;
		  bottom:100%;         
		  margin-top:-20px;    
		  left: -47px;
		  width: 300px;
		  z-index: 100;
		}
	</style>

	  
     <div class="container">
		 <div class="container-fluid" style="background-color: #d3d3d3;">
			<div class="row">	
			
				<div id="popup" style="display:none;"class="row">
					<br>
					<div class="row">
						<div class="col-md-3 text-center">
							<img class="img-fluid" src="../image/witcher3.png">
						</div>
						<div class="col-md-3 text-center">
							<img class="img-fluid" src="../image/gta5trevor.png">
						</div>
						<div class="col-md-3 text-center">
							<img class="img-fluid" src="../image/owgenji.png">
						</div>
						<div class="col-md-3 text-center">
							<img class="img-fluid" src="../image/mario.png">
						</div>
					</div>
					
					<br>

					<div class="row">
						<div class="col-md-3 text-center">
							<img class="img-fluid" src="../image/pokeball.png">
						</div>
						<div class="col-md-3 text-center">
							<img class="img-fluid" src="../image/falloutboy.png">
						</div>
						<div class="col-md-3 text-center">
							<img class="img-fluid" src="../image/skyrim.png">
						</div>
						<div class="col-md-3 text-center">
							<img class="img-fluid" src="../image/zombie.png">
						</div>
					</div>
					<br>
				</div>


				<div class="col-md-3" id="profile" style="padding-right:20px; border-right: 1px solid #ccc;">
				
						<div class="row" id="editProfilePicture">
							<h4 class="text-center"> Profile Picture </h4> <i style="font-size:24px;" class="fa fa-align-right fa-pull-right fa-3x"> &#xf040; </i> 
						</div>
						
						<div class="row text-center">
							<img class="rounded-circle" width="150px" src="../image/blank.png">
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
								<input type="text" class="form-control" name="forename" value="<?php echo $fname;?>" readonly>
							</div>
							<div class="col-md-6">
								<label> Surname </label>
								<input type="text" class="form-control" name="surname" value="<?php echo $sname;?>" readonly>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label> Email </label>
								<input type="email" class="form-control" name="email" value="<?php echo $email;?>" readonly>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label> Bio </label>
								<textarea class="form-control" name="bio" rows="3"></textarea>
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
</div>
   </body>
</html>
