<!DOCTYPE html> 
<html lang="en">

   <head>
		<?php   
			session_start();
			$_SESSION['userID'] = NULL;
			//NEED TO MOVE THIS SOMEWHERE
			require ("../controller/connection.php");
			$conn = getDatabaseConnection();
			$sql = "SELECT `id` FROM cmp311user WHERE `email` = ?";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("s", $_SESSION['email']);
			$stmt->execute();

			$result = $stmt->get_result();

			while($r = mysqli_fetch_assoc($result)) {
				$_SESSION['userID'] = $r["id"];
			}


			/////

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
		include('config.php');
		include('navbar-material.php');
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

	  
		<div class="container mdc-top-app-bar--dense-prominent-fixed-adjust">
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
							  <button class="mdc-button" type="submit">
                                  <div class="mdc-button__ripple"></div>
                                  <span class="mdc-button__label">Search</span>
                              </button>
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
							</br></br>
				</h3>
			</div>
		
			<?php
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				include('../model/getGames.php');
				$data = getAvaliableGames();


				for ($i=0;$i<count($data);$i++){
					$title = getGameTitle($data[$i]["appID"]);
					$info = getSteamData($data[$i]["appID"]);

					$img = $info[$data[$i]["appID"]]["data"]["header_image"];
					$price = $info[$data[$i]["appID"]]["data"]["price_overview"]["final_formatted"];

					$desc = strip_tags(min(100,$info[$data[$i]["appID"]]["data"]["short_description"]));
					echo '
						<div class="card">
							<div class="card-wrapper">
								<div class="row align-items-center">
									<div class="col-12 col-md-3">
										<div class="image-wrapper">
											<img src="'.$img.'" class="img-fluid" title="">
										</div>
									</div>
									<div class="col-12 col-md-9">
										<div class="card-box">
											<div class="row">
												<div class="col-12">
													<div class="top-line">
														<h4 class="card-title"><strong>'.$title[0]["name"].'</strong></h4>
														<p class="cost">
															'.$price.'
														</p>
														<p> 															
															<input type="submit" name="submit" value="Add to Basket">
														</p>
													</div>
												</div>
												</div>
												<br/><br/>
												<div class="row align-items-center">
													<div class="col-12">
														<div class="bottom-line">
															<p>'. $desc .'
															</p>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
							</div>
						</div>
						</br></br>
					';
				}		
			?>
			
		<br><br>

		</div>

   </body>
</html>