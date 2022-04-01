<?php
    $onScreen = array();

    if(!empty($_POST)){
        foreach ($_POST as $key => $value) {
            echo $key  . "<br/><br/>";
            require_once("getGames.php");
            $data = getAvaliableGames();

            for ($i=0;$i<count($data);$i++){

                $appid = $data[$i]["appID"];
                $game = checkedGameCached($appid);
                



                if($game[0]['genres'] == $key || $key == 'No' && $game[0]['genres'] == 'No data avaliable from Steam') {
                    if(!in_array($game[0]['title'], $onScreen)) {
                        echo $game[0]['title'] . "<br/>";
                        array_push($onScreen, $game[0]['title']);
                    }
                }


            }


            echo "<br/>";
        }
    }


?>