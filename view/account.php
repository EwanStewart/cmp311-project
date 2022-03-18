<?php
    include('header.php');
    session_start();
?>
<script>
    $(document).ready(function() {

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
<div class="container">
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
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 align-center col-lg-6">
            <div class="plan">
                <div class="plan-header">
                    <h3 class="plan-title">
                        <strong>Yearly</strong>
                        </h3>
                        <div class="plan-price">
                            <h4 class="price"><strong>£100</strong></p>
                            </h4>
                        </div>
                </div>
                <div class="plan-body">
                    <div class="plan-list">
                        <ul class="list-group">
                            <li class="list-group-item">Benefit 1
                            </li>
                            <li class="list-group-item">Benefit 2
                            </li>
                        </ul>
                    </div>
                    <div class="plan-button">
                        <a href="#" class="btn btn-primary">Subscribe to get started</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 align-center col-lg-6">
            <div class="plan">
                <div class="plan-header">
                    <h3 class="plan-title">
                        <strong>Monthly</strong>
                        </h3>
                        <div class="plan-price">
                            <h4 class="price"><strong>£20</strong></p>
                            </h4>
                        </div>
                </div>
                <div class="plan-body">
                    <div class="plan-list">
                        <ul class="list-group">
                            <li class="list-group-item">Benefit 1
                            </li>
                            <li class="list-group-item">Benefit 2
                            </li>
                        </ul>
                    </div>
                    <div class="text-center">
                        <a href="#" class="btn btn-primary">Subscribe to get started</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    include('footer.php');
?>