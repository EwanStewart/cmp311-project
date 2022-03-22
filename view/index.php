<?php
    include('header.php');
    session_start();
    
?>
<div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
    }
    </script>
    <div class="container mdc-top-app-bar--prominent-fixed-adjust">
        <h3>
            <strong> Hot Games </strong>
        </h3>
        <div class="row">
            <div class="col-sm-10">
                <h3>Put a carousel here when you can pls</h3>
            </div>
            <br />

            <div class="col-sm-2 text-right">
                <h4>
                    Community
                </h4>
                <br />

                <form action="#">
                    <input type="text" placeholder="Search for a friend" name="search">
                    <button class="mdc-button" type="submit">
                        <div class="mdc-button__ripple"></div>
                        <span class="mdc-button__label">Search</span>
                    </button>
                </form>

                <br />
                <br />
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

        <br />
        <br />
        <div class="title">
            <h3>
                <strong> Hot Games Continued </strong>
                </br></br>
            </h3>
        </div>

        <?php
            include('../model/getGames.php');
            $data = getAvaliableGames();
            

            for ($i=0;$i<count($data);$i++){
                $cached = checkedGameCached($data[$i]["appID"]);
                if (!$cached) {
                    $steamData = getSteamData($data[$i]["appID"]);
                    $param = array();


                    if ($steamData[$data[$i]["appID"]]["success"]) {
                        $appid = $data[$i]["appID"];
                        $title = getGameTitle($data[$i]["appID"])[0]["name"];
                        $s_desc = strip_tags(min(100,$steamData[$data[$i]["appID"]]["data"]["short_description"]));
                        $price = $steamData[$data[$i]["appID"]]["data"]["price_overview"]["final_formatted"];
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
                                    <div class="image-wrapper">
                                        <img src="'.$img.'" class="img-fluid" title="">
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
                                                        <input type="submit" name="submit" data-shopbutton="true" data-gameid="'.$gameid.'" value="DEBUG: '.$gameid.'">
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
</div>
<?php include('footer.php'); ?>