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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
                    $price = (ceil($steamData[$game["appID"]]["data"]["price_overview"]["final"] / 100 )) * 100;
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
            array_push($a, $cached);
        }

        ?>


        <h3>
            <strong> New Listings </strong>
        </h3>

        <div class="row">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>   
                <div class="carousel-inner">
                    <div class="item active">
                        <?php echo "<a href='listing.php?appid=".$a[0][0]['appid']."'> <img class='img-fluid' style='width:100%;' src=".$a[0][0]['img']."></a>";?>
                    </div>
                    <div class="item">
                    <?php echo "<a href='listing.php?appid=".$a[1][0]['appid']."'> <img class='img-fluid' style='width:100%;' src=".$a[1][0]['img']."></a>";?>
                    </div>
                    <div class="item">
                    <?php echo "<a href='listing.php?appid=".$a[2][0]['appid']."'> <img class='img-fluid' style='width:100%;' src=".$a[2][0]['img']."></a>";?>
                    </div>
                </div>
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
            for ($i=0;$i<count($data);$i++){
                $cached = checkedGameCached($data[$i]["appID"]);
                if (!$cached) {
                    $steamData = getSteamData($data[$i]["appID"]);
                    $param = array();


                    if ($steamData[$data[$i]["appID"]]["success"]) {
                        $appid = $data[$i]["appID"];
                        $title = getGameTitle($data[$i]["appID"])[0]["name"];
                        $s_desc = strip_tags(min(100,$steamData[$data[$i]["appID"]]["data"]["short_description"]));
                        //$price = $steamData[$data[$i]["appID"]]["data"]["price_overview"]["final_formatted"];
                        $price = (ceil($steamData[$game["appID"]]["data"]["price_overview"]["final"] / 100 )) * 100;
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
                    <div class="card">
                        <div class="card-wrapper">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-3">
                                    <!--<div class="image-wrapper">
                                        <img src="'.$img.'" class="img-fluid" title="">
                                    </div>-->
                                    <div class="text-center">
                                        <img class="shadow-sm w-75 rounded" src="'. $img .'"/>
                                    </div>
                                </div>
                                <div class="col-12 col-md-9">
                                    <div class="card-box">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="top-line">
                                                    <h4 class="card-title"><strong>'.$title.'</strong></h4>
                                                    <p class="cost">
                                                        '.$price.' Credits
                                                    </p>
                                                    <p> 															
                                                        <input type="submit" name="submit" data-shopbutton="true" data-gameid="'.$gameid.'" value="Add to Basket">
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
            }
        ?>
        <br><br>
    </div>
</div>
<?php include('footer.php'); ?>