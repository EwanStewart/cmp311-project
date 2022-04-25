<?php

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    include('header.php');
    include_once('../model/api-store.php');

    session_start();
?>
<script>
    $(document).ready(function() {
        $('.mdc-top-app-bar').css("top", "0");

        $('#editProfilePicture').click(function() {
            $('#popup').show();
        });

        $('.profile-picture').click(function() {
            $('#popup').hide();
        });

        //  updates profile picture, janky but works
        $('#1').click(function() {
            $.ajax({
                type: "POST",
                url: "https://mayar.abertay.ac.uk/~cmp311g21c02/cmp311/controller/updateProfilePic.php",
                data: {
                    profilePictureID: 1
                },
                success: function(text) {
					window.location.reload()
                }
            });
        });

        $('#2').click(function() {
            $.ajax({
                type: "POST",
                url: "https://mayar.abertay.ac.uk/~cmp311g21c02/cmp311/controller/updateProfilePic.php",
                data: {
                    profilePictureID: 2
                },
                success: function(text) {
					window.location.reload()
                }
            });
        });

        $('#3').click(function() {
            $.ajax({
                type: "POST",
                url: "https://mayar.abertay.ac.uk/~cmp311g21c02/cmp311/controller/updateProfilePic.php",
                data: {
                    profilePictureID: 3
                },
                success: function(text) {
					window.location.reload()
                }
            });
        });

        $('#4').click(function() {
            $.ajax({
                type: "POST",
                url: "https://mayar.abertay.ac.uk/~cmp311g21c02/cmp311/controller/updateProfilePic.php",
                data: {
                    profilePictureID: 4
                },
                success: function(text) {
					window.location.reload()
                }
            });
        });

        $('#5').click(function() {
            $.ajax({
                type: "POST",
                url: "https://mayar.abertay.ac.uk/~cmp311g21c02/cmp311/controller/updateProfilePic.php",
                data: {
                    profilePictureID: 5
                },
                success: function(text) {
					window.location.reload()
                }
            });
        });

        $('#6').click(function() {
            $.ajax({
                type: "POST",
                url: "https://mayar.abertay.ac.uk/~cmp311g21c02/cmp311/controller/updateProfilePic.php",
                data: {
                    profilePictureID: 6
                },
                success: function(text) {
					window.location.reload()
                }
            });
        });

        $('#7').click(function() {
            $.ajax({
                type: "POST",
                url: "https://mayar.abertay.ac.uk/~cmp311g21c02/cmp311/controller/updateProfilePic.php",
                data: {
                    profilePictureID: 7
                },
                success: function(text) {
					window.location.reload()
                }
            });
        });

        $('#8').click(function() {
            $.ajax({
                type: "POST",
                url: "https://mayar.abertay.ac.uk/~cmp311g21c02/cmp311/controller/updateProfilePic.php",
                data: {
                    profilePictureID: 8
                },
                success: function(text) {
					window.location.reload()
                }
            });
        });

        //  hide save button initially;
        $('#save').hide();

        //  controls edit details button
        $('#edit').click(function() {
            //  remove read only
            $("textarea[name='forename']").removeAttr("readonly");
            $("textarea[name='surname']").removeAttr("readonly");
            $("textarea[name='bio']").removeAttr("readonly");

            //  hide edit button
            $('#edit').hide();

            //  show save button
            $('#save').show();
        });

        //  controls save changes button
        $('#save').click(function() {
            alert($("textarea[name='forename']").val());
            alert($("textarea[name='surname']").val());
            alert($("textarea[name='bio']").val());

            $.ajax({
                type: "POST",
                url: "https://mayar.abertay.ac.uk/~cmp311g21c02/cmp311/controller/updateAccountDetails.php",
                data: {
                    forename: $("textarea[name='forename']").val(),
                    surname: $("textarea[name='surname']").val(),
                    bio: $("textarea[name='bio']").val()
                },
                success: function(text) {
                    alert(text);
					window.location.reload()
                }
            });

        });
    });
</script>
<?php
    $fname = getForename();
    $sname = getSurname();
    $email = '';
    $country = '';
    $bio = getBio();


    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
    }
    if (isset($_SESSION['country'])) {
        $email = $_SESSION['country'];
    }
?>
<div class="container" style="margin-top: 150px; !important">
    <div class="row justify-content-center">
        <div id="popup" style="display:none;" class="row">
            <br>
            <div class="row">
                <div class="col-md-3 text-center">
                    <img class="img-fluid profile-picture" id="1" src="../image/witcher3.png">
                </div>
                <div class="col-md-3 text-center">
                    <img class="img-fluid profile-picture" id="2" src="../image/gta5trevor.png">
                </div>
                <div class="col-md-3 text-center">
                    <img class="img-fluid profile-picture" id="3" src="../image/owgenji.png">
                </div>
                <div class="col-md-3 text-center">
                    <img class="img-fluid profile-picture" id="4" src="../image/mario.png">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3 text-center">
                    <img class="img-fluid profile-picture" id="5" src="../image/pokeball.png">
                </div>
                <div class="col-md-3 text-center">
                    <img class="img-fluid profile-picture" id="6" src="../image/falloutboy.png">
                </div>
                <div class="col-md-3 text-center">
                    <img class="img-fluid profile-picture" id="7" src="../image/skyrim.png">
                </div>
                <div class="col-md-3 text-center">
                    <img class="img-fluid profile-picture" id="8" src="../image/zombie.png">
                </div>
            </div>
            <br>
        </div>
        <div class="col-md-3" id="profile" style="padding-right:20px; border-right: 1px solid #ccc;">
            <div class="row" id="editProfilePicture">
                <h4 class="text-center"> Profile Picture </h4>
                <i style="font-size:24px;" class="fa fa-align-right fa-pull-right fa-3x"> &#xf040; </i>
            </div>
            <div class="row text-center">

                <div class="rounded-circle img-thumbnail accountPage-image__container">
                    <?php

                        $profilePictureID = getProfilePictureID();

                        switch($profilePictureID){
                            case 0:
                                echo'<img class="accountPage-image__img center-in-parent" src="../image/blank.png">';
                                break;

                            case 1:
                                echo'<img class="accountPage-image__img center-in-parent" src="../image/witcher3.png">';
                                break;

                            case 2:
                                echo'<img class="accountPage-image__img center-in-parent" src="../image/gta5trevor.png">';
                                break;

                            case 3:
                                echo'<img class="accountPage-image__img center-in-parent" src="../image/owgenji.png">';
                                break;

                            case 4:
                                echo'<img class="accountPage-image__img center-in-parent" src="../image/mario.png">';
                                break;

                            case 5:
                                echo'<img class="accountPage-image__img center-in-parent" src="../image/pokeball.png">';
                                break;

                            case 6:
                                echo'<img class="accountPage-image__img center-in-parent" src="../image/falloutboy.png">';
                                break;

                            case 7:
                                echo'<img class="accountPage-image__img center-in-parent" src="../image/skyrim.png">';
                                break;

                            case 8:
                                echo'<img class="accountPage-image__img center-in-parent" src="../image/zombie.png">';
                                break;

                            default:
                                echo'<img class="accountPage-image__img center-in-parent" src="../image/blank.png">';
                                break;
                        }

                    ?>
                </div>


                
            </div>
        </div>
        <div class="col-md-5">
            <div>
                <div class="align-items-center">
                    <h4> Account Details </h4>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label> Forename </label>
                        <textarea class="form-control" name="forename" rows="1" readonly><?php echo $fname;?></textarea>
                    </div>
                    <div class="col-md-6">
                        <label> Surname </label>
                        <textarea class="form-control" name="surname" rows="1" readonly><?php echo $sname;?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label> Email </label>
                        <!--<input type="email" class="form-control" name="email" value="<?php echo $email;?>" readonly>-->
                        <textarea class="form-control" name="email" rows="1" readonly><?php echo $email;?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label> Bio </label>
                        <textarea class="form-control" name="bio" rows="3" readonly><?php echo $bio;?></textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary" id="edit" type="button"> Edit Profile </button>
                        <button class="btn btn-primary" id="save" type="button"> Save Changes </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
        

        $subscriptionCode = checkValidSubscription();

        if ($subscriptionCode == 0)
        {
            echo '
                <div class="row" style="margin-top: 25px; margin-bottom: 25px;">

                    <div class="col-md-6 justify-content-center">

                        <div class="card">
                            <img class="card-img-top" src="../image/yearly.jpg">

                            <div class="card-body" style="padding-top: 0px; padding-bottom: 0px;">
                                <center>
                                    <h3 class="card-title" style="margin-top: 10px;">Yearly</h3>
                                    <h3 class="card-title" style="margin-bottom: 10px;">£99</h3>
                                    

                                    <div class="plan-list">
                                        <ul class="list-group">
                                            <li class="list-group-item">Access for 365 days!
                                            </li>
                                                <li class="list-group-item">Saves over £100!
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="plan-button" style="margin-bottom: 10px; margin-top: 10px;">
                                        <a href="details.php?plan=1" class="btn btn-primary">Subscribe to get started</a>
                                    </div>
                                </center>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6 justify-content-center">

                        <div class="card">
                            <img class="card-img-top" src="../image/monthly.jpg">

                            <div class="card-body" style="padding-top: 0px; padding-bottom: 0px;">
                                <center>
                                    <h3 class="card-title" style="margin-top: 10px;">Monthly</h3>
                                    <h3 class="card-title" style="margin-bottom: 10px;">£19</h3>
                                    

                                    <div class="plan-list">
                                        <ul class="list-group">
                                            <li class="list-group-item">Access for 30 days!
                                            </li>
                                                <li class="list-group-item">No commitment!
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="plan-button" style="margin-bottom: 10px; margin-top: 10px;">
                                        <a href="details.php?plan=2" class="btn btn-primary">Subscribe to get started</a>
                                    </div>
                                </center>
                            </div>
                        </div>




                    </div>
                
                </div>';
                
        }else if ($subscriptionCode == 1){
            echo '
                <div class="row justify-content-center">
                    <h2>Monthly Subscription</h2>
                    <h3>You are currently subscribed. Thank you for your support!</h3>
                </div>
            ';
        }else if ($subscriptionCode == 2){
            echo '
            <div class="row justify-content-center">
                <h2>Yearly Subscription</h2>
                <h3>You are currently subscribed. Thank you for your support!</h3>
            </div>
        ';
        }

    ?>
    </div>
</div>
<?php
    include('footer.php');
?>