<?php 
require_once('../google-api/vendor/autoload.php');
$gClient = new Google_Client();
$gClient ->setClientId("545896985220-a257ua7j6655eingdmg2palht955ha89.apps.googleusercontent.com");
$gClient ->setClientSecret("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");
$gClient->setApplicationName("TPCG Login");
$gClient->setRedirectUri("https://mayar.abertay.ac.uk/~1900598/google-test/controller/google_rec.php");
$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");

$login_url = $gClient->createAuthUrl();
?>