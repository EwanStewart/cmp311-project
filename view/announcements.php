<?php
    include('header.php');
    include("../model/api-store.php");

    session_start();
    ?>
<script>
    $(document).ready(function() {
        $('.card-img-top').css("max-height", "250px");
        $('.card-img-top').css("max-width", "250px");

        $('.card').css("margin-top", "25px");
        
        $('.card-img-top').css("margin-left", "auto");
        $('.card-img-top').css("margin-right", "auto");

        $('.card-img-top').css("margin-top", "25px");
    });
</script>

<div class="container mdc-top-app-bar--prominent-fixed-adjust">
    
    <div class="row">

        <?php

            //  load RSS feed
            $xml = new DOMDocument();
            //  keenan local address
            //$xml->load("https://mayar.abertay.ac.uk/~1903531/cmp311-project/rss/rss.php");
            //  group hosted address
            $xml->load("https://mayar.abertay.ac.uk/~cmp311g21c02/cmp311/rss/rss.php");

            //  load XSL document
            $xsl = new DOMDocument();
            $xsl->load("../rss/rss.xsl");

            //  transform RSS
            $proc = new XSLTProcessor();
            $proc->importStyleSheet($xsl);
            $result = $proc->transformtoXML($xml);

            //  echo transformed RSS
            echo $result;

        ?>
                
    </div>

</div>

<?php include('footer.php'); ?>