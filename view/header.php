<?php 

include('config.php');
session_start();

?>
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
        </section>
        <section class="d-flex container-fluid top-app-bar-lowerSection">
            <div class="col-9">
                <div class="d-flex flex-row justify-content-center">
                    <div class="mdc-touch-target-wrapper">
                        <a class="mdc-button mdc-button--touch top-app-bar-button top-app-bar-secondaryLink-align" href="index.php">
                            <span class="mdc-button__ripple"></span>
                            <span class="mdc-button__touch"></span>
                            <span class="mdc-button__label">Home</span>
                        </a>
                    </div>
                    <div class="mdc-touch-target-wrapper">
                        <a class="mdc-button mdc-button--touch top-app-bar-button top-app-bar-secondaryLink-align" href="search.php">
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