<?php
    require_once('header.php');
    require_once('../model/api-store.php');

    if(!isset($_SESSION['uID'])) {
		?>
		<script>
            window.location.href = "../view/index.php?pop=3";
		</script>
		<?php
    }
    
    $sub = checkValidSubscription();
    if($sub == 0) {
        ?>
        <script>
            window.location.href = "../view/index.php?pop=4";
        </script>
        <?php
    }
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    //do something
    jQuery(document).ready(function(){
        $("#prevBtn").toggle();
        $("#contributeConfirmation").toggle();
    });

    function alertKeyFormat() {
        $("#prevBtn").click();
    }


    function tabs() {
        var x = document.querySelectorAll("[id='tab']");
        for(var i = 0; i < x.length; i++) {
            if (x[i].style.display === "none") {
                x[i].style.display = "block";
                $("#nextBtn").toggle();
                $("#prevBtn").toggle();
            } else {
                x[i].style.display = "none";
            }
        }
    }
    function updatetitles(str) {

        if (str.length == 0) {
            return;
        } else {
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function() {

                document.getElementById("titles").innerHTML = this.responseText;
                document.getElementById("titles").style.visibility = "visible";
            }
            xmlhttp.open("GET", "../model/fetch.php?q=" + str);
            xmlhttp.send();
        }
    }

</script>
<div class="container mdc-top-app-bar--prominent-fixed-adjust">
    <div class="row">
        <div class="col-md-12">
            <form action="../model/addGameKey.php" method="POST" class="contributeCard">
                <h1 style="text-align:center;">Contribute</h1>
                <div id="tab">
                    <h4>Game Information</h4>
                        <br/>
                        <h6>Search for your game</h6>
                        <p class="gameDrop">
                            <input type="text" oninput="updatetitles(this.value);"/>
                            <br/>
                            <br/>

                            <select id="titles" name="title" required>
                                <h6>Select from our choices</h6>
                                <?php
                                    $data = NULL;
                                    if ($data != NULL) {
                                        for ($i=0;$i < count($data); $i++) {
                                            echo '<option value="'. $data[$i]["name"] .'">'. $data[$i]["name"] .'</option>';
                                        }
                                    }

                                ?>
                            </select>
                        </p>

                        <h6>Game Key</h6>
                        <!-- pattern for five blocks of five characters seperated by a dash> -->
                        <p> <input type="text" name="key" pattern="[a-zA-Z0-9]{5}-[a-zA-Z0-9]{5}-[a-zA-Z0-9]{5}-[a-zA-Z0-9]{5}-[a-zA-Z0-9]{5}"  
                        placeholder="Steam Key" required/> </p>

                        <h6>Applicable Store</h6>

                        <p class="storeDrop">
                            <select name="store">
                                <option value="steam">Steam</option>
                            </select>
                        </p>
                </div>
                <div id="tab" style="display:none;">
                    <h4>Additional Information</h4>
                        <br/>
                        <h4>Notes</h4>
                        <p><textarea name="gameNotes"> </textarea></p>
                        <h4> Should the key be made public? </h4>
                        <p class="public">
                            <select name="public">
                                <option value="1">Make this key available to the public</option>
                                <option value="0">Add this key to my account only</option>
                            </select>
                        </p>

                        <h4 style="display:inline;"> By checking this tickbox you agree that this a <span style="color:green; font-weight:bold;"> valid </span> and <span style="color:green; font-weight:bold;"> legally </span> obtained game key. </h4>
                        <input type="checkbox" id="tick" onchange="document.getElementById('contributeSubmit').disabled = !this.checked;" name="tick1">
                        <br/>
                        <br/>
                        <input type="submit" onclick="return alertKeyFormat()" name="submit" id="contributeSubmit" value="Submit" disabled>
                        <br/>
                        <br/>
                </div>
                <div style="overflow:auto;">
                    <div style="float:right;">
                        <button type="button" id="prevBtn" onclick="tabs()"><i class="fa fa-angle-double-left"></i></button>
                        <button type="button" id="nextBtn" onclick="tabs()"><i class="fa fa-angle-double-right"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
    include('footer.php');
?>
