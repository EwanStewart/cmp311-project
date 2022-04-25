<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

    //session_start();
	include_once("../model/api-store.php");
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
				
				$history = getUserTransactions();

				if (sizeof($history) < 1){
                    echo '
                    <div class="card container justify-content-center p-4">
                        <h2 class="card-title text-center">You haven\'t purchased any items yet. Why not have a look around the store? .</h2>
                    </div>
                    ';				
				}else{
					echo '<div class="card container justify-content-center p-4 my-2">';
					for ($i=0;$i<sizeof($history);$i++){

						$cached = checkedGameCached($history[$i]["appid"])[0];
						$img = $cached["img"];
						echo '
							<div class="row my-2">
								<div class="col-4">
									<div><img class="shadow-sm w-75 rounded" src="'. $img .'"/></div>
								</div>
								<div class="col-8">
									<div class="row">
										<div class="col-8">
											<h2 class="font-weight-bold">'. $history[$i]["name"] .'</h2>
										</div>
										<div class="col-4 text-center">
											<h4>Price Paid: '. $history[$i]["cost"] .' Credits</h4>
											<br>						
											<a href="../view/feedback.php?key_id='.$history[$i]["keyID"].'">
												<button class="btn btn-secondary btn-sm">Leave Feedback/Report a problem?</button>
											</a>
										</div>
										<div class="col">
											<h4>Key: '. $history[$i]["gameKey"] .'</h4>
										</div>
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