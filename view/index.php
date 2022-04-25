<?php
    require_once('header.php');
    require_once('../model/getGames.php');

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $data = getAvaliableGames();
    $carouselData = getNewGames();
    
?>

<div>
    <?php
        if(isset($_GET['feedback'])){
            if($_GET['feedback'] == 'success'){
                ?><script>alert("Thank you for your feedback, a moderator will be in touch if required!"); </script><?php
            }
        }
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

    <script>
    const query = window.location.search;
    const params = new URLSearchParams(query);
    const pop = params.get('pop');
    console.log(pop);

    if (pop == 1) {
        document.getElementById("reg").click();
    } else if (pop == 2) {
        document.getElementById("log").click();
    } else if (pop == 3) {
        alert("Please log in to contribute");
    }
    </script>
    <div class="container mdc-top-app-bar--prominent-fixed-adjust">

        <?PHP
        $a = array();

        foreach ($carouselData as $game) {
            $cached = checkedGameCached($game["appID"]);
            
            if (!$cached) {
                $steamData = getSteamData($game["appID"]);
                $param = array();

                if ($steamData[$game["appID"]]["success"]) {
                    $appid = $game["appID"];
                    $title = getGameTitle($game["appID"])[0]["name"];
                    $s_desc = strip_tags(min(100,$steamData[$game["appID"]]["data"]["short_description"]));
                    //$price = $steamData[$game["appID"]]["data"]["price_overview"]["final_formatted"];
                    if (isset($steamData[$game["appID"]]["data"]["price_overview"])) {
                        $price = (ceil($steamData[$game["appID"]]["data"]["price_overview"]["final"] / 100 )) * 100;
                    } else {
                        $price = "0";
                    }
                    $img = $steamData[$game["appID"]]["data"]["header_image"];
                    $genre = $steamData[$game["appID"]]["data"]["genres"][0]["description"];
                } else {
                    $appid = $game["appID"];
                    $title = getGameTitle($appid)[0]["name"];
                    $s_desc = "No data avaliable from Steam";
                    $price = "No data avaliable from Steam";
                    $img = "https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/1024px-No_image_available.svg.png";
                    $genre = "No data avaliable from Steam";
                }
                $param = array($appid, $title, $s_desc, $price, $img, $genre);
                $result = insertGameDataToCache($param);
            }
            $cached = checkedGameCached($game["appID"]);
            array_push($a, $cached);
        }

        ?>


        <h3>
            <strong> New Listings </strong>
        </h3>
        <div class="row">
            <div id="topGamesCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#topGamesCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#topGamesCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#topGamesCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <?php echo "<a href='listing.php?appid=".$a[0][0]['appid']."'> <img class='d-block w-100' src=".$a[0][0]['img']."></a>";?>
                    </div>
                    <div class="carousel-item">
                        <?php echo "<a href='listing.php?appid=".$a[1][0]['appid']."'> <img class='d-block w-100' src=".$a[1][0]['img']."></a>";?>
                    </div>
                    <div class="carousel-item">
                        <?php echo "<a href='listing.php?appid=".$a[2][0]['appid']."'> <img class='d-block w-100' src=".$a[2][0]['img']."></a>";?>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#topGamesCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#topGamesCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <br />
        <br />
        <div class="title">
            <h3>
                <strong> Hot Games </strong>
                </br></br>
            </h3>
        </div>

        <?php
            $duplicates = array();
            for ($i=0;$i<count($data);$i++){
                $cached = checkedGameCached($data[$i]["appID"]);
                if (in_array($data[$i]["appID"], $duplicates)) {
                    continue;
                } else {
                    array_push($duplicates, $data[$i]["appID"]);
                    if (!$cached) {
                        $steamData = getSteamData($data[$i]["appID"]);
                        $param = array();
    
    
                        if ($steamData[$data[$i]["appID"]]["success"]) {
                            $appid = $data[$i]["appID"];
                            $title = getGameTitle($data[$i]["appID"])[0]["name"];
                            $s_desc = strip_tags(min(100,$steamData[$data[$i]["appID"]]["data"]["short_description"]));
                            //$price = $steamData[$data[$i]["appID"]]["data"]["price_overview"]["final_formatted"];
                            if (isset($steamData[$data[$i]["appID"]]["data"]["price_overview"]["final"])) {
                                $price = (ceil($steamData[$data[$i]["appID"]]["data"]["price_overview"]["final"] / 100 )) * 100;
                            } else {
                                $price = "0";
                            }                        
                            $img = $steamData[$data[$i]["appID"]]["data"]["header_image"];
                            $genre = $steamData[$data[$i]["appID"]]["data"]["genres"][0]["description"];
                        } else {
                            $appid = $data[$i]["appID"];
                            $title = getGameTitle($appid)[0]["name"];
                            $s_desc = "No data avaliable from Steam";
                            $price = "No data avaliable from Steam";
                            $img = "https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/1024px-No_image_available.svg.png";
                            $genre = "No data avaliable from Steam";
    
                        }
    
    
                        array_push($param, $appid, $title, $s_desc, $price, $img, $genre);
                        insertGameDataToCache($param);
                    }
    
                    $cached = checkedGameCached($data[$i]["appID"])[0];
    
                    $gameid = $data[$i]["appID"];
                    $title = $cached["title"];
                    $img = $cached["img"];
                    $price = $cached["price"];
                    $desc = $cached["s_desc"];

                    echo '
                        <div class="mdc-card margin-all-8">
                            <div class="container">
                                <div class="row margin-all-2 align-items-center">
                                    <div class="col-12 col-md-3">
                                        <div class="margin-all-2">
                                            <img class="w-100 rounded" src="'. $img .'"/>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <div class="margin-all-2">
                                            <div>
                                                <h5 class="mdc-typography--headline5">'.$title.'</h5>
                                                <h6 class="mdc-typography--headline6">'.$price.' Credits</h6>
                                                <div class="mdc-touch-target-wrapper">
                                                    <button class="mdc-button mdc-button--outlined mdc-button--touch" type="submit" name="submit" data-shopbutton="true" data-gameid="'.$gameid.'" value="Add to Basket">
                                                        <span class="mdc-button__ripple"></span>
                                                        <span class="mdc-button__touch"></span>
                                                        <span class="mdc-button__label">Add to Basket</span>
                                                    </button>
                                                </div>
                                                <p class="mdc-typography">
                                                    '. $desc .'
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                }
            }
        ?>
        <br><br>
    </div>
</div>
<?php include('footer.php'); ?>