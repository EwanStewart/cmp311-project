<?php
    include('header.php');

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
?>
<script>
    $(document).ready(function() {
        $('.mdc-top-app-bar').css("top", "0");

        $('#editProfilePicture').click(function() {
            $('#popup').show();
        });

        $('.img-fluid').click(function() {
            $('#popup').hide();
        });

        $('#edit').click(function() {
            $("input[name='forename']").removeAttr("readonly");
            $("input[name='surname']").removeAttr("readonly");
            $("input[name='email']").removeAttr("readonly");
            $("textarea[name='bio']").removeAttr("readonly");
            $("#edit").text("Save Changes");
        });
    });
</script>
<?php
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
<div class="container" style="margin-top: 150px; !important">
    <div class="row justify-content-center">
        <div id="popup" style="display:none;" class="row">
            <br>
            <div class="row">
                <div class="col-md-3 text-center">
                    <img class="img-fluid" src="../image/witcher3.png">
                </div>
                <div class="col-md-3 text-center">
                    <img class="img-fluid" src="../image/gta5trevor.png">
                </div>
                <div class="col-md-3 text-center">
                    <img class="img-fluid" src="../image/owgenji.png">
                </div>
                <div class="col-md-3 text-center">
                    <img class="img-fluid" src="../image/mario.png">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3 text-center">
                    <img class="img-fluid" src="../image/pokeball.png">
                </div>
                <div class="col-md-3 text-center">
                    <img class="img-fluid" src="../image/falloutboy.png">
                </div>
                <div class="col-md-3 text-center">
                    <img class="img-fluid" src="../image/skyrim.png">
                </div>
                <div class="col-md-3 text-center">
                    <img class="img-fluid" src="../image/zombie.png">
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
                <img class="rounded-circle" width="150px" src="../image/blank.png">
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
                        <input type="text" class="form-control" name="forename" value="<?php echo $fname;?>"
                               readonly>
                    </div>
                    <div class="col-md-6">
                        <label> Surname </label>
                        <input type="text" class="form-control" name="surname" value="<?php echo $sname;?>"
                               readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label> Email </label>
                        <input type="email" class="form-control" name="email" value="<?php echo $email;?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label> Bio </label>
                        <textarea class="form-control" name="bio" rows="3" readonly> </textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary" id="edit" type="button"> Edit Profile </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
        include('../model/api-store.php');

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