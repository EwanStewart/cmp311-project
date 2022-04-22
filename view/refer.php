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

    });
</script>
<?php
    $referralCode = getReferralCode();
?>
<div class="container" style="margin-top: 150px; !important">
    <div class="row justify-content-center" style="margin-top: 150px;">

        <?php
            echo $referralCode;
        ?>

    </div>
</div>
<?php
    include('footer.php');
?>