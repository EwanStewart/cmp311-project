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
		    <h3>
                <strong> Hot Games </strong>
            </h3>
			<div class="row">
				<div class="col-sm-10">
					<div id="myCarousel" class="carousel slide" data-ride="carousel">
					
					<ol class="carousel-indicators">
						<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
						<li data-target="#myCarousel" data-slide-to="1"></li>
						<li data-target="#myCarousel" data-slide-to="2"></li>
					</ol>

					<div class="carousel-inner">
					
						<div class="item active">
						<b> The Witcher 3 - 1000 Credits - 99 Keys </b>
						<img class="img-fluid" style="height:50%; width:100%; margin:auto;" src="../image/witcher3.png">
						</div>

						<div class="item">
						<b> Skyrim Special Edition - 1000 Credits - 99 Keys </b>
						<img class="img-fluid" style="height:50%; width:100%; margin:auto;" src="../image/skyrim.png">
						</div>
					
						<div class="item">
						<b> Pokemon - 1000 Credits - 99 Keys </b>
						<img class="img-fluid" style="height:50%; width:100%; margin:auto;" src="../image/pokeball.png">
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
					</div>
					<br/>
					
					<div class="col-sm-2 text-right">
						<h4>
							Community
						</h4>
							<br/>
							
							<form action="#">
							  <input type="text" placeholder="Search for a friend" name="search">
							  <br/>
							  <br/>
							  <button type="submit">Search</button>
							</form>
							
							<br/>
							<br/>
						<h4>
							Friend List
						</h4>
							<?php
								for ($i=0;$i<4;$i++){
									echo '
									<div class="row border-bottom text-right" style="padding-right:20px; border-bottom: 1px solid #ccc;">
										Friend
									</div>
									
									<br/>
								';
								}		
							?>
					</div>
				</div>
				
			<br/>
			<br/>
			<div class="title">
            <h3>
                <strong> Hot Games Continued </strong>
            </h3>
            
        </div>
		
		<?php
			for ($i=0;$i<4;$i++){
				echo '
					<div class="card">
						<div class="card-wrapper">
							<div class="row align-items-center">
								<div class="col-12 col-md-3">
									<div class="image-wrapper">
										<img src="../image/pokeball.png" class="img-fluid" title="">
									</div>
								</div>
								<div class="col-12 col-md">
									<div class="card-box">
										<div class="row">
											<div class="col-12">
												<div class="top-line">
													<h4 class="card-title"><strong>Pokemon</strong></h4>
													<p class="cost">
														99 Credits
													</p>
												</div>
											</div>
											<div class="col-12">
												<div class="bottom-line">
													<p>
														Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam volutpat rutrum nunc ac malesuada.
														In nunc massa, ultricies et efficitur nec, hendrerit nec urna. Aenean ut eleifend enim.
														Maecenas aliquet est ac ex posuere pulvinar. 
													</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				';
			}		
		?>
			
			</div>
			
			<br/>
			<br/>
			<!-- Once list of keys is created and populated, this section will pull from it -->
   </body>
</html>