<?php



include('../model/getGames.php');
$data = getAvaliableGames();
$diffGenres = array();

for ($i=0;$i<count($data);$i++){
	$title = getGameTitle($data[$i]["appID"]);
	$info = getSteamData($data[$i]["appID"]);
	
	$genre = $info[$data[$i]["appID"]]["data"]["genres"][0]["description"];
	
	array_push($diffGenres,$genre);
		
	
	

	
	echo $title[0]["name"] . "<br/>";
	for ($i=0;$i<count($diffGenres);$i++) {
		for ($j=0;$j<1;$j++) {
			echo $diffGenres[$i] . "<br/>";
		}
	}
	echo "<br/>";
	
}

	$it = array_merge($diffGenres);
	$l = array_values(array_filter(array_unique($it)));
	
	echo 'Different types of genres: ' . "<br/>";
	for ($i=0;$i<count($l);$i++) {
		if ($l[$i]) {
			echo $l[$i] . "<br/>";
		}
	}
	

?>