<?php
    include('header.php');
    //include('../model/api-store.php');

    //session_start();

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
?>
<script>
    $(document).ready(function() {
        $('.mdc-top-app-bar').css("top", "0");

        //  copies referral code to clipboard
        $('#copy').click(function() {
            var referralCode = $('.referralCode').text();
            navigator.clipboard.writeText(referralCode);
        });

        //  controls submit referral code button
        $('#submit').click(function() {
            $.ajax({
                type: "POST",
                url: "https://mayar.abertay.ac.uk/~cmp311g21c02/cmp311/controller/submitReferralCode.php",
                data: {
                    enteredReferralCode: $("textarea[name='enteredReferralCode']").val()
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
    $referralCode = getReferralCode();

    //	establish connection to database
    include_once("../controller/connection.php");
    $conn = getDatabaseConnection();

    //  get user id
    $userID = $_SESSION['uID'];

    //  get current referrals
    $stmt = $conn->prepare("SELECT `referrals` FROM `cmp311user` WHERE `id` = ?");
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    $rows = array();
    while($buffer = mysqli_fetch_assoc($result)){
        $rows[] = $buffer;
    }

    $currentReferrals = $rows[0]["referrals"];

?>
<div class="container" style="margin-top: 150px; !important">
    <div class="row justify-content-center" style="margin-top: 150px;">

        <center>

            <div class="card" style="display: flex; justify-content: center; padding-bottom: 16px; margin-bottom: 25px;">


                <div class="card-body" style="padding-top: 0px; padding-bottom: 0px;">
                        
                    <h3 class="card-title" style="margin-bottom: 20px;">Your unique referral code</h3>

                        
                        
                    <p class="card-text referralCode" style="margin-bottom: 20px;"><?php echo $referralCode; ?></p>

                    <button class="btn btn-secondary" id="copy" type="button" style="margin-bottom: 20px;"> Copy code </button>

                    <p class="card-text" style="margin-bottom: 20px;">Recieve 100 credits each for your first 10 referrals!</p>

                    <?php
                        echo '<p class="card-text referralCounter">You have referred ' . $currentReferrals . ' people!</p>';
                    ?>

                </div>
                    
            </div>

            <div class="card" style="display: flex; justify-content: center; padding-bottom: 16px;">


                <div class="card-body" style="padding-top: 0px; padding-bottom: 0px;">
                        
                    <h3 class="card-title" style="margin-bottom: 20px;">Have a referral code?</h3>

                        
                        
                    <textarea class="form-control" name="enteredReferralCode" rows="1" style="max-width: 400px; margin-bottom: 15px;"></textarea>

                    <button class="btn btn-primary" id="submit" type="button"> Submit referral code </button>

                </div>
                    
            </div>

        

    </div>
</div>
<?php
    include('footer.php');
?>