<?php 

include('config.php');
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/app.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="../dist/app.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body>
<aside class="mdc-drawer mdc-drawer--modal">
    <div class="mdc-drawer__header">

        <?php
            if(isset($_SESSION['email'])){
                include("segments/modal_loggedIn.php");
            }
        ?>
        <?php
            if(!isset($_SESSION['email'])){
                include("segments/modal_loggedOut.php");
            }
        ?>

    </div>
    <div class="mdc-drawer__content">
        <nav class="mdc-list">
            <a class="mdc-list-item mdc-list-item--activated" href="index.php" aria-current="page">
                <span class="mdc-list-item__ripple"></span>
                <i class="material-icons mdc-list-item__graphic" aria-hidden="true">store</i>
                <span class="mdc-list-item__text">Store</span>
            </a>
            <a class="mdc-list-item" href="contribute.php">
                <span class="mdc-list-item__ripple"></span>
                <i class="material-icons mdc-list-item__graphic" aria-hidden="true">publish</i>
                <span class="mdc-list-item__text">Contribute</span>
            </a>
            <a class="mdc-list-item" href="search.php">
                <span class="mdc-list-item__ripple"></span>
                <i class="material-icons mdc-list-item__graphic" aria-hidden="true">search</i>
                <span class="mdc-list-item__text">Search</span>
            </a>
            <a class="mdc-list-item" href="community.php">
                <span class="mdc-list-item__ripple"></span>
                <i class="material-icons mdc-list-item__graphic" aria-hidden="true">forum</i>
                <span class="mdc-list-item__text">Community</span>
            </a>
            <a class="mdc-list-item" href="about.php">
                <span class="mdc-list-item__ripple"></span>
                <i class="material-icons mdc-list-item__graphic" aria-hidden="true">info</i>
                <span class="mdc-list-item__text">About</span>
            </a>
            <a class="mdc-list-item" href="announcements.php">
                <span class="mdc-list-item__ripple"></span>
                <i class="material-icons mdc-list-item__graphic" aria-hidden="true">campaign</i>
                <span class="mdc-list-item__text">Announcements</span>
            </a>
        </nav>
    </div>
</aside>

<div class="mdc-drawer-scrim"></div>
<nav class="mdc-top-app-bar mdc-top-app-bar--prominent">
    <section class="d-flex container-fluid flex-row">
        <div class="d-flex float-start">
            <div class="d-flex flex-row align-items-center justify-content-center text-decoration-none">
                <div class="show-on-mobile">
                    <button class="mdc-button mdc-button--icon-leading" onclick="navDrawerActivate()">
                        <span class="mdc-button__ripple"></span>
                        <i class="material-icons mdc-button__icon" aria-hidden="true">menu</i>
                    </button>
                </div>
            </div>
            <a href="index.php" class="d-flex flex-row align-items-center justify-content-center text-decoration-none">
                <img class="brand_icon" src="../image/TPCG_logo_no_text.png" />
                <H2 class="h2 text-decoration-none text-black">TPCG</H2>
            </a>
                <div class="d-flex flex-row justify-content-center align-items-center margin-left-8">
                    <a class="hide-on-mobile top-app-bar-mainLink mdc-button top-app-bar-button" href="index.php">
                        <span class="mdc-button__ripple"></span>
                        <span class="mdc-button__label">Store</span>
                    </a>
                    <a class="hide-on-mobile top-app-bar-mainLink mdc-button top-app-bar-button" href="contribute.php">
                        <span class="mdc-button__ripple"></span>
                        <span class="mdc-button__label">Contribute</span>
                    </a>
                    <a class="hide-on-mobile top-app-bar-mainLink mdc-button top-app-bar-button" href="community.php">
                        <span class="mdc-button__ripple"></span>
                        <span class="mdc-button__label">Community</span>
                    </a>
                    <a class="hide-on-mobile top-app-bar-mainLink mdc-button top-app-bar-button" href="about.php">
                        <span class="mdc-button__ripple"></span>
                        <span class="mdc-button__label">About</span>
                    </a>
                    <a class="hide-on-mobile top-app-bar-mainLink mdc-button top-app-bar-button" href="announcements.php">
                        <span class="mdc-button__ripple"></span>
                        <span class="mdc-button__label">Announcements</span>
                    </a>
                </div>
        </div>
        <div class="d-flex float-end ms-auto">
            <div class="d-flex flex-row justify-content-center align-items-center">
                <div class="d-flex flex-row justify-content-center align-items-center margin-left-8">
                    <div class="hide-on-mobile">
                        <div>
                            <?php
                                if(isset($_SESSION['email'])){
                                    include('segments/navbar_loggedIn.php');
                                }
                            ?>
                        </div>
                        <?php
                            if(!isset($_SESSION['email'])){
                                include('segments/navbar_loggedOut.php');
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
        if(basename($_SERVER['PHP_SELF']) == "index.php" || basename($_SERVER['PHP_SELF']) == "search.php") {
            echo '
        <div class="hide-on-mobile">
        <section class="d-flex container-fluid top-app-bar-lowerSection">
            <div class="col-9">
                <div class="d-flex flex-row justify-content-center">
                    <div class="mdc-touch-target-wrapper">
                        <a class="mdc-button mdc-button--touch top-app-bar-button top-app-bar-secondaryLink-align"
                            href="search.php">
                            <span class="mdc-button__ripple"></span>
                            <span class="mdc-button__touch"></span>
                            <span class="mdc-button__label"> Categories </span>
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
            <div class="col-3" hidden="hidden">
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
        </div>';
        }
    ?>

</nav>
