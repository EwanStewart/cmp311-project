<?php
    //session_start();
	include("../model/api-store.php");
	include_once("../model/getGames.php");

	// Message code is set to be used later
    // Zero means default message

    // $msgType = 0;
    // $code = $_GET['msg'];  
    // $msgType += $code;
?>
<!DOCTYPE html>
<head>
	<!-- The site uses Bootstrap v5 Framework-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
	</script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body>
	<?php
		include('header.php');
	?>

	<div>
	<div class="container mdc-top-app-bar--prominent-fixed-adjust">
				
			<?php
				
				$keys = getUserPubKeys();

				if (sizeof($keys) < 1){
                    echo '
                    <div class="card container justify-content-center p-4">
                        <h2 class="card-title text-center">You haven\'t submitted any keys yet.</h2>
                    </div>
                    ';				
				}else{
					echo '<div class="card container justify-content-center p-4 my-2">';
					for ($i=0;$i<sizeof($keys);$i++){

						$cached = checkedGameCached($keys[$i]["appID"])[0];

						echo '
							<div class="row my-2">
								<div class="col-3">
									<div><img class="shadow-sm w-75 rounded" src="'. $cached["img"] .'"/></div>
								</div>
								<div class="col-9">
									<div class="row">
										<div class="col-8">
											<h2 class="font-weight-bold">'. $cached["title"] .'</h2>
										</div>
										<div class="col-4 text-center">';
											if ($keys[$i]["public"] == 1){
												echo '<h4>Public <i class="bi bi-eye"></i></h3>';
											}else{
												echo '<h4>Private <i class="bi bi-eye-slash"></i></i></h3>';
											}
										echo '</div>
										<div class="col-8 pt-2">
											<h4>Key: '. $keys[$i]["gameKey"] .'</h6>
										</div>
										<div class="col-4 text-center">
											<h4>'. $cached["price"] .'<h4><h6>Credits</h6>
										</div>
									</div>
								</div>
							</div>
						';
					}
				}
			?>
		</div>
	</div>

</body>

</html>