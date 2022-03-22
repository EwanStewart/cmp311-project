<?php include('config.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/app.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
    <script src="../dist/app.js"></script>
</head>

<body>
<!-- This is still under construction btw -->
    <nav class="mdc-top-app-bar mdc-top-app-bar--prominent">
        <section class="d-flex container-fluid flex-row">
            <div class="d-flex float-start">
                <div class="d-flex flex-row align-items-center justify-content-center">
                    <img class="brand_icon" src="../image/TPCG_logo_no_text.png" />
                    <H2 class="">TPCG</H2>
                </div>
                <div class="d-flex flex-row justify-content-center align-items-center margin-left-8">
                    <a class="top-app-bar-mainLink mdc-button top-app-bar-button" href="index.php">
                        <span class="mdc-button__ripple"></span>
                        <span class="mdc-button__label">Store</span>
                    </a>
                    <a class="top-app-bar-mainLink mdc-button top-app-bar-button" href="contribute.php">
                        <span class="mdc-button__ripple"></span>
                        <span class="mdc-button__label">Contribute</span>
                    </a>
                    <a class="top-app-bar-mainLink mdc-button top-app-bar-button" href="community.php">
                        <span class="mdc-button__ripple"></span>
                        <span class="mdc-button__label">Community</span>
                    </a>
                    <a class="top-app-bar-mainLink mdc-button top-app-bar-button" href="about.php">
                        <span class="mdc-button__ripple"></span>
                        <span class="mdc-button__label">About</span>
                    </a>
                </div>
            </div>
            <div class="d-flex float-end ms-auto">
                <div class="d-flex flex-row justify-content-center align-items-center">
                    <div class="d-flex flex-row justify-content-center align-items-center margin-left-8">
                        <div>
                            <button onclick="showLoginBox()" name="btn_login" id="btn_login" class="top-app-bar-mainLink mdc-button mdc-button--icon-leading top-app-bar-button">
                                <span class="mdc-button__ripple"></span>
                                <span class="mdc-button__label">Login</span>
                                <i class="material-icons mdc-button__icon" aria-hidden="true">expand_more</i>
                            </button>
                            <div name="loginPopup" id="loginPopup" class="top-app-bar-loginPopup mdc-card">
                                <div>
                                    <form action="../model/login.php" method="post">
                                        <div class="form-group">
                                            <label class="mdc-text-field mdc-text-field--outlined top-app-bar-searchField">
                                                <span class="mdc-notched-outline">
                                                    <span class="mdc-notched-outline__leading"></span>
                                                    <span class="mdc-notched-outline__notch">
                                                        <span class="mdc-floating-label" id="login_email">Email</span>
                                                    </span>
                                                    <span class="mdc-notched-outline__trailing"></span>
                                                    </span>
                                                <input placeholder="Email" name="email" required="required" type="email" class="mdc-text-field__input" aria-labelledby="login_email">
                                            </label>
                                            </div>
                                        <div class="form-group">
                                            <label class="mdc-text-field mdc-text-field--outlined top-app-bar-searchField">
                                                <span class="mdc-notched-outline">
                                                    <span class="mdc-notched-outline__leading"></span>
                                                    <span class="mdc-notched-outline__notch">
                                                        <span class="mdc-floating-label" id="login_password">Password</span>
                                                    </span>
                                                    <span class="mdc-notched-outline__trailing"></span>
                                                    </span>
                                                <input placeholder="Password" name="password" required="required" type="password" class="mdc-text-field__input" aria-labelledby="login_password">
                                            </label>
                                            </div>
                                        <button class="mdc-button mdc-button--unelevated" type="submit" name="submit">
                                            <span class="mdc-button__ripple"></span>
                                            <span class="mdc-button__label">Login</span>
                                        </button>
                                        <div class="form-group social-btn clearfix">
                                            <a href='<?php echo $login_url ?>' class="btn btn-outline-dark" role="button" style="text-transform:none">
                                                <img width="20px" style="margin-bottom:3px; margin-right:5px" alt="Google sign-in" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />
                                                Login with Google
                                                </a>
                                            </div>
                                        <?php
                                            if (isset($_SESSION['login_error'])){
                                                echo "<h4><b style=color:red;>".$_SESSION['login_error']."</b></h4>";$_SESSION['login_error'] = '';
                                            }
                                        ?>
                                        </form>
                                </div>
                            </div>
                        </div>
                        <a name="btn_register" id="btn_register" class="top-app-bar-mainLink mdc-button top-app-bar-button" href="#">
                            <span class="mdc-button__ripple"></span>
                            <span class="mdc-button__label">Register</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <section class="d-flex container-fluid top-app-bar-lowerSection">
            <div class="col-9">
                <div class="d-flex flex-row justify-content-center">
                    <div class="mdc-touch-target-wrapper">
                        <a class="mdc-button mdc-button--touch top-app-bar-button top-app-bar-secondaryLink-align">
                            <span class="mdc-button__ripple"></span>
                            <span class="mdc-button__touch"></span>
                            <span class="mdc-button__label">Home</span>
                        </a>
                    </div>
                    <div class="mdc-touch-target-wrapper">
                        <a class="mdc-button mdc-button--touch top-app-bar-button top-app-bar-secondaryLink-align">
                            <span class="mdc-button__ripple"></span>
                            <span class="mdc-button__touch"></span>
                            <span class="mdc-button__label">Categories</span>
                        </a>
                    </div>
                    <div class="mdc-touch-target-wrapper">
                        <a class="mdc-button mdc-button--touch top-app-bar-button top-app-bar-secondaryLink-align">
                            <span class="mdc-button__ripple"></span>
                            <span class="mdc-button__touch"></span>
                            <span class="mdc-button__label">Recently Added</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <label class="mdc-text-field mdc-text-field--outlined top-app-bar-searchField">
                    <span class="mdc-notched-outline">
                        <span class="mdc-notched-outline__leading"></span>
                        <span class="mdc-notched-outline__notch">
                            <span class="mdc-floating-label" id="my-label-id">Search</span>
                        </span>
                        <span class="mdc-notched-outline__trailing"></span>
                    </span>
                    <input type="search" class="mdc-text-field__input" aria-labelledby="my-label-id">
                </label>
            </div>
        </section>
    </nav>



