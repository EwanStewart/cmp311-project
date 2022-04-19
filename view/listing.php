
<?php
    include('header.php');
    include('../model/getGames.php');
    $appid = $_GET['appid'];
    require_once('../model/getGames.php');
    $data = checkedGameCached($appid);
    $game = $data[0];
    $title = $game['title'];
    $img = $game['img'];
    $price = $game['price'];
    $desc = $game['s_desc'];
	echo "<br/><br/><br/><br/>";
?>

<script>
    $(function() {

        $("[data-shopButton]").click(function() {
            $.ajax({
                type: "POST",
                url: "https://mayar.abertay.ac.uk/~cmp311g21c02/cmp311/controller/addToBasket.php",
                data: {
                    gameID: $(this).attr("data-gameID")
                },
                success: function(text) {
                    alert(text); // Function DOES reach here
                }
            });
        });

    });
    </script>

<div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


   <body>
   <div class="container mdc-top-app-bar--dense-fixed-adjustt">
    <?php
        echo '</br></br>
        <div class="card">
            <div class="card-wrapper">
                <div class="row align-items-center">
                    <div class="col-12 col-md-3">
                        <!--<div class="image-wrapper">
                            <img src="'.$img.'" class="img-fluid" title="">
                        </div>-->
                        <div class="text-center">
                            <img src=' . $img . ' width=100% height=100%>
                        </div>
                    </div>
                    <div class="col-12 col-md-9">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-12">
                                    <div class="top-line">
                                        <h4 class="card-title"><strong>'.$title.'</strong></h4>
                                        <p class="cost">
                                            '.$price.'
                                        </p>
                                        <p> 															
                                            <input type="submit" name="submit" data-shopbutton="true" data-gameid="'.$appid.'" value="Add to Basket">
                                        </p>
                                    </div>
                                </div>
                                </div>
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
    ?>
		</div>
    </body>
   

	  
		



</div>
<?php include('footer.php'); ?>


