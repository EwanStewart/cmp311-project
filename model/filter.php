<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $onScreen = array();
    
    if(!empty($_POST)){
        foreach ($_POST as $key => $value) {
            require_once("getGames.php");
            echo "<div class='row'>";
                if ($key != "email" && $key != "password"){
                    echo "<h3>" . $key . "</h3>";
                }
                $data = getAvaliableGames();
                echo "<div class='row' style='background-color:#D3D3D3;'>";
                    for ($i=0;$i<count($data);$i++){
                        $appid = $data[$i]["appID"];
                        $game = checkedGameCached($appid);
                        
                        if($game[0]['genres'] == $key || $key == 'No' && $game[0]['genres'] == 'No data avaliable from Steam') {
                            if(!in_array($game[0]['title'], $onScreen)) {
                                echo "<div class='col-md-4'>";
                                    echo "<a href='../view/listing.php?appid=".$appid."'>";

                                        echo "<div class='row'>";
                                            echo $game[0]['title'];
                                        echo "</div> </br>";

                                        echo "<div class='row'>";
                                            echo "<img src=" . $game[0]['img'] . " width=100% height=100%>";
                                        echo "</div>";

                                    echo "</a>";
                                echo "</div>";
                            }
                            array_push($onScreen, $game[0]['title']);
                        }


                    }


            echo " </div> </div>";
        }
    }
    echo "</br>";


?>