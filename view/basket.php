<?php
    session_start();
	include("../model/api-store.php");
	include("../model/getGames.php");

	// Message code is set to be used later
    // Zero means default message
    $msgType = 0;
    $code = $_GET['msg'];  
    $msgType += $code;
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
    $(function() {

        $("[data-shopButton]").click(function() {
            $.ajax({
                type: "POST",
                url: "https://mayar.abertay.ac.uk/~cmp311g21c02/cmp311/controller/removeFromBasket.php",
                data: {
                    keyID: $(this).attr("data-keyID")
                },
                success: function(text) {
                    alert(text);
					window.location.reload()
                }
            });
        });

    });
    </script>

	<div class="container mdc-top-app-bar--prominent-fixed-adjust">

		<div class="card container justify-content-center p-4">
					
			<?php
				
				$basket = getBasket();


				if (sizeof($basket) < 1){
					switch ($msgType){
						case 0:
							echo '<h2 class="card-title text-center">Your basket is empty.</h2>';
							var_dump($basket);
							break;
						case 1:
							echo '<h2 class="card-title text-center">Purchase was successful!</h2>'; 
							break;
						default:
							echo '<h2 class="card-title text-center">Unknown error.</h2>';
					}				
				}else{
					for ($i=0;$i<sizeof($basket);$i++){

						$cached = checkedGameCached($basket[$i]["appid"])[0];
						$img = $cached["img"];

						echo '
						<div class="row">
							<div class="col-4">
								<div><img class="shadow-sm w-75 rounded" src="'. $img .'"/></div>
							</div>
							<div class="col-8">
								<div class="row">
									<div class="col-6">
										<h1 class="font-weight-bold">'. $basket[$i]["name"] .'</h1>
									</div>
									<div class="col-6">
										<input type="submit" name="submit" data-shopbutton="true" class="btn btn-outline-success" data-keyID="'.$basket[$i]["keyID"].'" value="Remove from Basket">
										</div>
									<div class="col-6">
										<h3>'. $basket[$i]["cost"] .' Credits</h3>
									</div>
									<!--<div class="col-6">
										<a href="details.php" class="btn btn-lg btn-outline-success">Purchase</a>
									</div>-->
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