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
		include('config.php');
		include('navbar.php');
	?>
	
	<script>	
		const query = window.location.search;
		const params = new URLSearchParams(query);
		const pop = params.get('pop');
		console.log(pop);
		
		if (pop == 1) {
			document.getElementById("reg").click();
		} else if (pop == 2) {
			document.getElementById("log").click();
		}
	</script>

	  
		<div class="container">
		  <h2>Hot Games</h2>  
		  <div id="myCarousel" class="carousel slide" data-ride="carousel">
		  
			<ol class="carousel-indicators">
			  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			  <li data-target="#myCarousel" data-slide-to="1"></li>
			  <li data-target="#myCarousel" data-slide-to="2"></li>
			</ol>

			<div class="carousel-inner">
			
			  <div class="item active">
			  	<b> The Witcher 3 - 1000 Credits - 99 Keys </b>
				<img class="img-fluid" style="height:50% width:100%; margin:auto;" src="../image/witcher3.png">
			  </div>

			  <div class="item">
			  	<b> Skyrim Special Edition - 1000 Credits - 99 Keys </b>
				<img class="img-fluid" style="height:50% width:100%; margin:auto;" src="../image/skyrim.png">
			  </div>
			
			  <div class="item">
			  	<b> Pokemon - 1000 Credits - 99 Keys </b>
				<img class="img-fluid" style="height:50% width:100%; margin:auto;" src="../image/pokeball.png">
			  </div>
			</div>

			<a class="left carousel-control" href="#myCarousel" data-slide="prev">
			  <span class="glyphicon glyphicon-chevron-left"></span>
			  <span class="sr-only">Previous</span>
			</a>
			
			<a class="right carousel-control" href="#myCarousel" data-slide="next">
			  <span class="glyphicon glyphicon-chevron-right"></span>
			  <span class="sr-only">Next</span>
			</a>
			
		  </div>
		  
		  <br/>


		  <div class="row border-bottom text-center" style="padding-right:20px; border: 1px solid #ccc;">
				<div class="col-sm-4">
					<div><img class="img-fluid" style="height: 100px; width: 100px" src="../image/pokeball.png"/></div> 
				</div>
				<div class="col-sm-8 text-left">
					<span class="font-weight-bold"> AAAAA AAAA </span>
					<br/>
					<span>1000 Credits</span>
					<br/>
					<a href="#" class="btn btn-lg btn-outline-success">Purchase</a>
				</div>
		  </div>
		  
		  <br/>
		  
		  <div class="row border-bottom text-center" style="padding-right:20px; border: 1px solid #ccc;">
				<div class="col-sm-4">
					<div><img class="img-fluid" style="height: 100px; width: 100px" src="../image/pokeball.png"/></div> 
				</div>
				<div class="col-sm-8 text-left">
					<span class="font-weight-bold"> AAAAA AAAA </span>
					<br/>
					<span>1000 Credits</span>
					<br/>
					<a href="#" class="btn btn-lg btn-outline-success">Purchase</a>
				</div>
		  </div>	
		  
		  <br/>
		  
		  <div class="row border-bottom text-center" style="padding-right:20px; border: 1px solid #ccc;">
				<div class="col-sm-4">
					<div><img class="img-fluid" style="height: 100px; width: 100px" src="../image/pokeball.png"/></div> 
				</div>
				<div class="col-sm-8 text-left">
					<span class="font-weight-bold"> AAAAA AAAA </span>
					<br/>
					<span>1000 Credits</span>
					<br/>
					<a href="#" class="btn btn-lg btn-outline-success">Purchase</a>
				</div>
		  </div>
		  
		</div>
		
   </body>
</html>
