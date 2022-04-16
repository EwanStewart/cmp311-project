<?php 
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    include('header.php');
    include("../model/api-store.php");

    session_start();
    ?>
<div class="container mdc-top-app-bar--prominent-fixed-adjust">
    
    <div class="row">

        <?php

            $xml = new DOMDocument();
            $xml->load("https://mayar.abertay.ac.uk/~1903531/cmp311-project/rss/rss.php");
            //$xml->load("https://mayar.abertay.ac.uk/~1903531/cmp311-project/rss/rss.php");

            $xsl = new DOMDocument();
            $xsl->load("../rss/rss.xsl");

            $proc = new XSLTProcessor();
            $proc->importStyleSheet($xsl);
            $result = $proc->transformtoXML($xml);

            echo $result;

        ?>

        
                
    </div>



</div>
<?php include('footer.php');
