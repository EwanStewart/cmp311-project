<?php
    session_start();
    include ("../Friends/getfriends.php");
    $userID = $_SESSION['uID'];
    include('header.php');
    $fname = '';
    $sname = '';
    $email = '';
    $country = '';

    if (isset($_SESSION['forename'])) {
        $fname = $_SESSION['forename'];
    }
    if (isset($_SESSION['surname'])) {
        $sname = $_SESSION['surname'];
    }
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
    }
    if (isset($_SESSION['country'])) {
        $email = $_SESSION['country'];
    }
?>
<div>
    <div class="col-12 col-md-6 align-center col-lg-6">
        <h3>Friends</h3>
        <input type="text" id="email" placeholder="Enter email" />
        <input type="button" id="getUser" value="Search" />
        <div class="user-content" style="display: none;">
            <p>Name: <span id="userName"></span></p>
            <p>Email: <span id="userEmail"></span></p>
            <p>Register Date: <span id="userCreated"></span></p>
            <button id="addBttn" class="btn btn-primary" style="display: none;">Add friend</button>
            <p id="status" style="display: none;"></p>
        </div>
        <div class="informative" style="display: none;">
            <p>Friend status: <span id="info"></span></p>
        </div>
        <div class="tab">
            <button class="tablinks" onclick="openTab(event, 'Friends')">Friends</button>
            <button class="tablinks" onclick="openTab(event, 'RequestsRecieved')">Requests Received</button>
            <button class="tablinks" onclick="openTab(event, 'RequestsSent')">Requests Sent</button>
        </div>
        <div id="Friends" class="tabcontent">
            <div class="friends-body">
                <div class="friends-list">
                    <?php
                        $email = $_SESSION['email'];
                        $itemtxt = getFriends($userID, $email) ;
                        $item = json_decode($itemtxt) ;
                        for($i = 0; $i < sizeof($item); $i++){
                            echo '<div class="col-sm-4" id="items">' ;
                            echo '<div class="card">' ;
                            echo '<div class="card-header">' ;
                            echo '<h1>'.$item[$i]->forename.'</h1>' ;
                            echo '</div>' ;
                            echo '<div class="card-body">' ;
                            echo '<p>'.$item[$i]->email.'</p>' ;
                            echo '</div>' ;
                            echo '<div class="card-footer">' ;
                            echo '<a href="../Friends/deleteFriend.php?fid='.$item[$i]->sUserID.'&uid='.$userID.'&rid='.$item[$i]->fUserID.'">Delete Friend</a>' ;
                            echo '</div>' ;
                            echo '</div>' ;
                            echo '</div>' ;
                        }
                    ?>
                </div>
            </div>
        </div>

        <div id="RequestsRecieved" class="tabcontent">
            <div class="friends-body">
                <div class="friends-list">
                    <?php

                        $itemReq = getRequests($userID);
                        $items = json_decode($itemReq);
                        for($y = 0; $y < sizeof($items); $y++){
                            echo '<div class="col-sm-4" id="items">' ;
                            echo '<div class="card">' ;
                            echo '<div class="card-header">' ;
                            echo '<h1>'.$items[$y]->forename.'</h1>' ;
                            echo '</div>' ;
                            echo '<div class="card-body">' ;
                            echo '<p>'.$items[$y]->email.'</p>' ;
                            echo '</div>' ;
                            echo '<div class="card-footer">' ;
                            echo '<a href="../Friends/addFriend.php?rid='.$items[$y]->fUserID.'&uid='.$userID.'">Add friend</a>' ;
                            echo '<a href="../Friends/deleteRecieved.php?rid='.$items[$y]->fUserID.'&uid='.$userID.'">Delete Request</a>' ;
                            echo '</div>' ;
                            echo '</div>' ;
                            echo '</div>' ;
                        }
                    ?>
                </div>
            </div>
        </div>
        <div id="RequestsSent" class="tabcontent">
            <div class="friends-body">
                <div class="friends-list">
                    <?php

                        $itm = getSent($userID);
                        $items = json_decode($itm);

                        for($x = 0; $x < sizeof($items); $x++){
                            echo '<div class="col-sm-4" id="items">' ;
                            echo '<div class="card">' ;
                            echo '<div class="card-header">' ;
                            echo '<h1>'.$items[$x]->forename.'</h1>' ;
                            echo '</div>' ;
                            echo '<div class="card-body">' ;
                            echo '<p>'.$items[$x]->email.'</p>' ;
                            echo '</div>' ;
                            echo '<div class="card-footer">' ;
                            echo '<a href="../Friends/deleteRequest.php?sid='.$items[$x]->sUserID.'&uid='.$userID.'">Delete Request</a>' ;
                            echo '</div>' ;
                            echo '</div>' ;
                            echo '</div>' ;
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
        $(document).ready(function() {
            $('#getUser').on('click', function() {
                var email = $('#email').val();
                $.ajax({
                    type: 'POST',
                    url: '../Friends/searchresults.php',
                    dataType: "json",
                    data: {
                        email: email
                    },
                    success: function(data) {
                        if (data.status == 'ok') {
                            $('#userName').text(data.result.forename);
                            $('#userEmail').text(data.result.email);
                            $('#userCreated').text(data.result.created);
                            $('.user-content').slideDown();
                            $('#addBttn').css("display", "block");
                        } else if (data.status == null) {
                            $('#addBttn').css("display", "block");
                            $('#status').css("display", "none");
                        } else if (data.status == 'requested') {
                            $('#info').text("Requested");
                            $('#info').css("display", "block");
                            $('.informative').slideDown();
                        } else if (data.status == 'friends') {
                            $('#info').text("Friends");
                            $('#info').css("display", "block");
                            $('.informative').slideDown();
                        } else {
                            $('.user-content').slideUp();
                            alert("User not found.");
                        }
                    }
                });
            });
        });

        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        $('#addBttn').on('click', function() {
            var email = $('#email').val();
            console.log(email);
            $.ajax({
                type: 'POST',
                url: '../Friends/sendrequest.php',
                dataType: "json",
                data: {
                    email: email
                },
                success: function(data) {
                    alert("User request sent");
                    $('#email').text('');
                    window.location.reload();
                }
            });
        });
    </script>
<?php
    include('footer.php');
?>