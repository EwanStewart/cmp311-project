<?php
include('../model/getGames.php');
$data = getAvaliableGames();
$diffGenres = array();

for ($i=0;$i<count($data);$i++){
	$title = getGameTitle($data[$i]["appID"]);
	$cached = checkGenreCached($data[$i]["appID"]);
	
	echo $title[0]["name"] . "<br/>";
	echo $cached[0]["genres"] . "<br/>";
	array_push($diffGenres, $cached[0]["genres"]);
}

	echo "<br/>";

	//$it = array_merge($diffGenres);
	$l = array_values(array_filter(array_unique($diffGenres)));
	
	echo 'Different types of genres: ' . "<br/>";
	for ($i=0;$i<count($l);$i++) {
		if ($l[$i]) {
			echo $l[$i] . "<br/>";
		}
	}
	
?>