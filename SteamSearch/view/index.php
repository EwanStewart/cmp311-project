<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
	    <title>JSON to PHPMYADMIN</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    </head>
    <body>
        <div id="header" class="text-center bg-light text-muted p-2">
            <div class="card-overlay">
                <h1 class="card-title">Get Steam game list, save to Database</h1>
            </div>
        </div>

        <?php
		


            include_once('../model/api.php');
            $json_string = file_get_contents('http://api.steampowered.com/ISteamApps/GetAppList/v0002/?format=json');

            $games = json_decode($json_string);
            $games = $games->applist;
            $games = $games->apps;

            $appid = "";
            $name = "";

            for ($i=0;$i<sizeof($games);$i++){
                $appid = $games[$i]->appid;
				$name = preg_replace("/&#?[a-z0-9]+;/i","",$games[$i]->name); 
                echo "Writing ".$appid.", ".$name."<br>";
                writeToDB($appid, $name);
            }

            echo "Games listed: ".sizeof($games);
        ?>     
    </body>
</html>