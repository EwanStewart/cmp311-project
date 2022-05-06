<?php include('header.php');
    session_start();
    ?>
<div class="container mdc-top-app-bar--prominent-fixed-adjust">
    
    <div class="row">

        <div class="col-lg-5 justify-content-center" style="margin-left: auto; margin-right: auto;">
            <center>
                <?php
                    //	establish connection to database
                    include_once("../controller/connection.php");
                    $conn = getDatabaseConnection();

                    //  get users by referrals
                    $stmt = $conn->prepare("SELECT * FROM `cmp311user` WHERE `referrals` > 0 ORDER BY `referrals` DESC");
                    $stmt->execute();
                    $result = $stmt->get_result();

                    $rows = array();
                    while($buffer = mysqli_fetch_assoc($result)){
                        $rows[] = $buffer;
                    }

                    echo '<h2 style="margin-bottom: 45px;">Referral leaderboard</h2>';

                    $counter = 1;
                    //  create card for each user
                    foreach($rows as $row){
                        echo '<div class="card" style="display: flex; justify-content: center; padding-bottom: 16px; margin-bottom: 25px;">';

                        switch($row["profilePictureID"]){
                            case 0:
                                echo'<img class="card-img" width="64" height="64" style="max-height: 64px; max-width: 64px; margin-left: auto; margin-right: auto; margin-top: 15px;" src="../image/blank.png" />';
                                break;
                    
                            case 1:
                                echo'<img class="card-img" width="64" height="64" style="max-height: 64px; max-width: 64px; margin-left: auto; margin-right: auto; margin-top: 15px;" src="../image/witcher3.png" />';
                                break;
                    
                            case 2:
                                echo'<img class="card-img" width="64" height="64" style="max-height: 64px; max-width: 64px; margin-left: auto; margin-right: auto; margin-top: 15px;" src="../image/gta5trevor.png" />';
                                break;
                    
                            case 3:
                                echo'<img class="card-img" width="64" height="64" style="max-height: 64px; max-width: 64px; margin-left: auto; margin-right: auto; margin-top: 15px;" src="../image/owgenji.png" />';
                                break;
        
                            case 4:
                                echo'<img class="card-img" width="64" height="64" style="max-height: 64px; max-width: 64px; margin-left: auto; margin-right: auto; margin-top: 15px;" src="../image/mario.png" />';
                                break;
        
                            case 5:
                                echo'<img class="card-img" width="64" height="64" style="max-height: 64px; max-width: 64px; margin-left: auto; margin-right: auto; margin-top: 15px;" src="../image/pokeball.png" />';
                                break;
        
                            case 6:
                                echo'<img class="card-img" width="64" height="64" style="max-height: 64px; max-width: 64px; margin-left: auto; margin-right: auto; margin-top: 15px;" src="../image/falloutboy.png" />';
                                break;
        
                            case 7:
                                echo'<img class="card-img" width="64" height="64" style="max-height: 64px; max-width: 64px; margin-left: auto; margin-right: auto; margin-top: 15px;" src="../image/skyrim.png" />';
                                break;
        
                            case 8:
                                echo'<img class="card-img" width="64" height="64" style="max-height: 64px; max-width: 64px; margin-left: auto; margin-right: auto; margin-top: 15px;" src="../image/zombie.png" />';
                                break;
        
                            default:
                                echo'<img class="card-img" width="64" height="64" style="max-height: 64px; max-width: 64px; margin-left: auto; margin-right: auto; margin-top: 15px;" src="../image/blank.png" />';
                                break;
                        }

                        echo '<div class="card-body" style="padding-top: 0px; padding-bottom: 0px;">';

                        echo '<h2 class="card-title" style="margin-bottom: 20px;">#' . $counter . '</h2>';

                        echo '<h2 class="card-title" style="margin-bottom: 20px;">' . $row["forename"] . '</h2>';

                        echo '<h2 class="card-title" style="margin-bottom: 20px;">' . $row["referrals"] . ' referrals!</h2>';

                        echo '</div>';

                        echo '</div>';

                        
                        $counter++;
                    }


                ?>



                
            </center>
        </div>

        
                
    </div>



</div>
<?php include('footer.php');
