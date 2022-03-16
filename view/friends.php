<?php
session_start();
include ("../Friends/getfriends.php");
$userID = $_SESSION['uID'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styles/styles.css">
    <title>Friends</title>
</head>

<body>
    <!--Friend list-->
    <?php	
         include('navbar.php');
         
         $fname = '';
         $sname = '';
         $email = '';
         $country = '';
         
         if (isset($_SESSION['forename'])) { 
         	$fname = $_SESSION['forename'];
         }
         if (isset($_SESSION['surname'])) { 
         	$sname = $_SESSION['surname'];
         }		
         if (isset($_SESSION['email'])) { 
         	$email = $_SESSION['email'];
         }
            if (isset($_SESSION['country'])) { 
         	$email = $_SESSION['country'];
         }
         ?>
    <div>
        <div class="col-12 col-md-6 align-center col-lg-6">
            <h3>Friends</h3>
            <input type="text" id="search" name="search" placeholder="Enter email" />
            <input type="submit" class="btn btn-primary" value="Search" />
            <div class="tab">
                <button class="tablinks" onclick="openTab(event, 'Friends')">Friends</button>
                <button class="tablinks" onclick="openTab(event, 'RequestsRecieved')">Requests Received</button>
                <button class="tablinks" onclick="openTab(event, 'RequestsSent')">Requests Sent</button>
            </div>
            <div id="Friends" class="tabcontent">
                <div class="friends-body">
                    <div class="friends-list">
                        <?php 
                        
                        $itemtxt = getFriends($userID) ;
                        $item = json_decode($itemtxt) ;
                            for($i = 0; $i < sizeof($item); $i++){
                                echo '<div class="col-sm-4" id="items">' ;
                                echo '<div class="card">' ;
                                echo '<div class="card-header">' ;
                                echo '<h1>'.$item[$i]->forename.'</h1>' ;
                                echo '</div>' ;
                                echo '<div class="card-body">' ;
                                echo '<p>'.$item[$i]->email.'</p>' ; 
                                echo '</div>' ;
                                echo '<div class="card-footer">' ;
                                echo '<a href="../Friends/deleteFriend.php?fid='.$item[$i]->sUserID.'&uid='.$userID.'">Delete Friend</a>' ;
                                echo '</div>' ;
                                echo '</div>' ;
                                echo '</div>' ;
                            }
                        ?>
                    </div>
                </div>
            </div>

            <div id="RequestsRecieved" class="tabcontent">
                <div class="friends-body">
                    <div class="friends-list">
                        <?php 

                        $itemReq = getRequests($userID);
                        $items = json_decode($itemReq);
                            for($y = 0; $y < sizeof($items); $y++){
                                echo '<div class="col-sm-4" id="items">' ;
                                echo '<div class="card">' ;
                                echo '<div class="card-header">' ;
                                echo '<h1>'.$items[$y]->forename.'</h1>' ;
                                echo '</div>' ;
                                echo '<div class="card-body">' ;
                                echo '<p>'.$items[$y]->email.'</p>' ; 
                                echo '</div>' ;
                                echo '<div class="card-footer">' ;
                                echo '<a href="">Add friend</a>' ;
                                echo '<a href="../Friends/deleteRecieved.php?rid='.$items[$y]->fUserID.'&uid='.$userID.'">Delete Request</a>' ;
                                echo '</div>' ;
                                echo '</div>' ;
                                echo '</div>' ;
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div id="RequestsSent" class="tabcontent">
                <div class="friends-body">
                    <div class="friends-list">
                        <?php 

                        $itm = getSent($userID);
                        $items = json_decode($itm);
                        
                            for($x = 0; $x < sizeof($items); $x++){
                                echo '<div class="col-sm-4" id="items">' ;
                                echo '<div class="card">' ;
                                echo '<div class="card-header">' ;
                                echo '<h1>'.$items[$x]->forename.'</h1>' ;
                                echo '</div>' ;
                                echo '<div class="card-body">' ;
                                echo '<p>'.$items[$x]->email.'</p>' ; 
                                echo '</div>' ;
                                echo '<div class="card-footer">' ;
                                echo '<a href="../Friends/deleteRequest.php?sid='.$items[$x]->sUserID.'&uid='.$userID.'">Delete Request</a>' ;
                                echo '</div>' ;
                                echo '</div>' ;
                                echo '</div>' ;
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    }
    </script>
</body>

</html>