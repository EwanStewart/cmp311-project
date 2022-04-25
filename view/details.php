<!DOCTYPE html>
<html>

<head>
    <!-- The site uses Bootstrap v5 Framework-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    </header>

    <?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Error code is set to be used later
    // Zero means no issue/message
    $errorType = 0;
    $code = $_GET['error'];  
    $errorType += $code;
    $plan = $_GET['plan'];

    include('header.php');
?>
    <div class="container mdc-top-app-bar--prominent-fixed-adjust">
    </div>
    <div class="col-sm-12 mb-2">
        <div class="card">
            <div class="card-body">
                <a href="account.php" class="btn btn-outline-success">Cancel - Return to Account</a>
            </div><!-- card body -->
        </div><!-- card -->
    </div> <!-- column -->

    <div class="card container justify-content-center p-4">
        <?php
                    switch($errorType){
                        case 0:
                            echo "<h2>Please enter your details</h2>";
                            break;
                        case 1:
                            echo "<h2>Card Number does not match requirements. Please try again.</h2>";
                            break;
                        case 2:
                            echo "<h2>There was an error with the transaction. No money has been taken from your account. Please check your details and try again.</h2>";
                            break;
                        default:
                            echo "<h2>Unknown error.</h2>";
                            break;                 
                    }
                ?>
        <form method="POST" action="../controller/payValidation.php">
            <div class="form-group mb-2">
                <label for="cardNum">Card Number</label>
                <input type="text" class="form-control" name="cardNum" aria-describedby="cardHelp" required="required"
                    autocomplete="off">
                <small id="cardHelp" class="form-text text-muted">Must be exactly 16 digits.</small>
                <?php echo '<input type="hidden" id="plan" name="plan" value='.$plan.'>';?>
            </div>
            <button type="submit" class="btn btn-outline-success">Confirm Payment</button>
        </form>
    </div>

    </div><!-- container -->
    </body>

</html>