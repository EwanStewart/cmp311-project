<?php
    error_reporting(0);
    session_start();
    include ("../Friends/getfriends.php");
    $userID = $_SESSION['uID'];
    include('header.php');
    include('../chat/chat_db.php');
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
    $conn = getDatabaseConnection();
    $selectSql = "SELECT * FROM login_details WHERE user_id='".$userID."'";
    $result = mysqli_query($conn, $selectSql);
    if (mysqli_num_rows($result) != 0){
        echo "User already registered";
    }else{
        $chatInsert = "INSERT INTO login_details (user_id) VALUES ('".$userID."')";
        mysqli_query($conn ,$chatInsert);
        mysqli_close($conn);
    }
    
?>

<body>
    <div class="container mdc-top-app-bar--prominent-fixed-adjust">
    </div>
    <div class="friends_container">
        <h3>Friends</h3>
        <input type="text" id="email" placeholder="Enter email" />
        <input type="button" id="getUser" value="Search" />
        <div class="user-content" style="display: none;">
            <p>Name: <span id="userName"></span></p>
            <p>Email: <span id="userEmail"></span></p>
            <p>Register Date: <span id="userCreated"></span></p>

            <p id="status" style="display: none;"></p>
        </div>
        <button id="addBttn" class="btn btn-primary" style="display: none;">Add friend</button>
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
                        echo '<div class="col-12" id="items">' ;
                        echo '<div class="row align-items-center">' ;
                        if(sizeof($item) != 0)
                        {
                            for($i = 0; $i < sizeof($item); $i++){
                                echo '<div class="col-sm-4" id="items">' ;
                                echo '<div class="card">' ;
                                echo '<div class="card-header">' ;
                                echo '<h1>'.$item[$i]->forename.'</h1>' ;
                                echo '</div>' ;
                                echo '<div class="card-body">' ;
                                echo '<p>'.$item[$i]->email.'</p>' ;
                                echo '</div>' ;
                                if($item[$i]->last_activity == "Online")
                                {
                                    echo '<span style="color:green;">'.$item[$i]->last_activity.'</span>';
                                }
                                else
                                {
                                    echo '<span style="color:crimson;">Last active: '.$item[$i]->last_activity.'</span>';
                                }
                                echo '<div class="card-footer">' ;
                                echo '<button type="button" class="btn btn-info btn-xs"><a href="../Friends/deleteFriend.php?fid='.$item[$i]->sUserID.'&uid='.$userID.'&rid='.$item[$i]->fUserID.'">Delete Friend</a></button>' ;
                                $touser = 0;
                                if($item[$i]->fUserID == $_SESSION['uID'])
                                {
                                    $touser = $item[$i]->sUserID;
                                }else if($item[$i]->sUserID == $_SESSION['uID'])
                                {
                                    $touser = $item[$i]->fUserID;
                                }
                                echo '<button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$touser.'" data-tousername="'.$item[$i]->forename.'">Start Chat</button>';
                                echo '</div>' ;
                                echo '</div>' ;
                                echo '</div>' ;
                            }
                        }else{
                            echo '<p>Currently no friends in the list.</p>';
                        }
                        echo '</div>' ;
                        echo '</div>' ;
                    ?>
                </div>
            </div>
        </div>

        <div id="RequestsRecieved" class="tabcontent">
            <div class="friends-body">
                <div class="friends-list">
                    <?php
                            echo '<div class="col-12" id="items">' ;
                            echo '<div class="row align-items-center">' ;
                        $itemReq = getRequests($userID);
                        $items = json_decode($itemReq);
                        if(sizeof($items) != 0)
                        {
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
                                echo '<button class="btn btn-info btn-xs"><a href="../Friends/addFriend.php?rid='.$items[$y]->fUserID.'&uid='.$userID.'">Add friend</a></button>';
                                echo '<button class="btn btn-info btn-xs"><a href="../Friends/deleteRecieved.php?rid='.$items[$y]->fUserID.'&uid='.$userID.'">Delete Request</a></button>' ;
                                echo '</div>' ;
                                echo '</div>' ;
                                echo '</div>' ;
                            }
                        }else{
                            echo '<p>Currently no requests recieved.</p>';
                        }
                        
                        echo '</div>' ;
                        echo '</div>' ;
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
                        echo '<div class="col-12" id="items">' ;
                        echo '<div class="row align-items-center">' ;
                        if(sizeof($items) != 0){
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
                                echo '<button class="btn btn-info btn-xs"><a href="../Friends/deleteRequest.php?sid='.$items[$x]->sUserID.'&uid='.$userID.'">Delete Request</a></button>' ;
                                echo '</div>' ;
                                echo '</div>' ;
                                echo '</div>' ;
                            }
                        }else{
                            echo '<p>Currently no requests sent.</p>';
                        }
                        
                        echo '</div>' ;
                        echo '</div>' ;
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- GROUP CHAT BUTTON -->
    <div class="group-button">
        <input type="hidden" id="is_active_group_chat_window" value="no" />
        <button type="button" name="group_chat" id="group_chat" class="btn btn-warning btn-xs">Group
            Chat</button>
    </div>

    <style>
    .group-button {
        text-align: center;
        justify-content: center;
        align-items: center;
    }

    .tab {
        text-align: center;
        justify-content: center;
        align-items: center;
    }

    .chat_message_area {
        position: relative;
        width: 100%;
        height: auto;
        background-color: #FFF;
        border: 1px solid #CCC;
        border-radius: 3px;
    }

    #group_chat_message {
        width: 100%;
        height: auto;
        min-height: 80px;
        overflow: auto;
        padding: 6px 24px 6px 12px;
    }

    .image_upload {
        position: absolute;
        top: 3px;
        right: 3px;
    }

    .image_upload>form>input {
        display: none;
    }

    .image_upload img {
        width: 24px;
        cursor: pointer;
    }

    #user_details {
        width: 50%;
        height: auto;
        min-height: 80px;
    }

    a {
        text-decoration: none;
    }

    .friends_container {
        text-align: center;
        justify-content: center;
        align-items: center;
    }

    #addBttn {
        display: inline;
    }
    </style>
    <div id="group_chat_dialog" title="Group Chat Window">
        <div id="group_chat_history"
            style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;">

        </div>
        <div class="form-group">
            <!--<textarea name="group_chat_message" id="group_chat_message" class="form-control"></textarea>!-->
            <div class="chat_message_area">
                <div id="group_chat_message" contenteditable class="form-control">

                </div>
                <div class="image_upload">
                    <form id="uploadImage" method="post" action="../chat/upload.php">
                        <label for="uploadFile"><img src="../chat/upload.png" /></label>
                        <input type="file" name="uploadFile" id="uploadFile" accept=".jpg, .png" />
                    </form>
                </div>
            </div>
        </div>
        <div class="form-group" align="right">
            <button type="button" name="send_group_chat" id="send_group_chat" class="btn btn-info">Send</button>
        </div>
    </div>

    <div id="user_model_details">
    </div>

    <body>

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
                            $('#addBttn').css("display", "inline");
                        } else if (data.status == null) {
                            $('#addBttn').css("display", "inline");
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
                            $('#addBttn').css("display", "none");
                            alert("User not found.");
                        }
                    }
                });
            });


            setInterval(function() {
                update_last_activity();
                update_chat_history_data();
                fetch_group_chat_history();
            }, 1000);

            function update_last_activity() {
                $.ajax({
                    url: "../chat/update_last_activity.php",
                    success: function() {

                    }
                })
            }

            function make_chat_dialog_box(to_user_id, to_user_name) {
                var modal_content = '<div id="user_dialog_' + to_user_id +
                    '" class="user_dialog" title="You have chat with ' + to_user_name + '">';
                modal_content +=
                    '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="' +
                    to_user_id + '" id="chat_history_' + to_user_id + '">';
                modal_content += fetch_user_chat_history(to_user_id);
                modal_content += '</div>';
                modal_content += '<div class="form-group">';
                modal_content += '<textarea name="chat_message_' + to_user_id + '" id="chat_message_' +
                    to_user_id + '" class="form-control chat_message"></textarea>';
                modal_content += '</div><div class="form-group" align="right">';
                modal_content += '<button type="button" name="send_chat" id="' + to_user_id +
                    '" class="btn btn-info send_chat">Send</button></div></div>';
                $('#user_model_details').html(modal_content);
            }

            $(document).on('click', '.start_chat', function() {
                var to_user_id = $(this).data('touserid');
                var to_user_name = $(this).data('tousername');
                make_chat_dialog_box(to_user_id, to_user_name);
                $("#user_dialog_" + to_user_id).dialog({
                    autoOpen: false,
                    width: 400
                });
                $('#user_dialog_' + to_user_id).dialog('open');
            });

            $(document).on('click', '.send_chat', function() {
                var to_user_id = $(this).attr('id');
                var chat_message = $.trim($('#chat_message_' + to_user_id).val());
                if (chat_message != '') {
                    $.ajax({
                        url: "../chat/insert_chat.php",
                        method: "POST",
                        data: {
                            to_user_id: to_user_id,
                            chat_message: chat_message
                        },
                        success: function(data) {
                            $('#chat_message_' + to_user_id).val('');
                            $('#chat_history_' + to_user_id).html(data);
                        }
                    })
                } else {
                    alert('Type something');
                }
            });

            function fetch_user_chat_history(to_user_id) {
                $.ajax({
                    url: "../chat/fetch_user_chat_history.php",
                    method: "POST",
                    data: {
                        to_user_id: to_user_id
                    },
                    success: function(data) {
                        $('#chat_history_' + to_user_id).html(data);
                    }
                })
            }

            function update_chat_history_data() {
                $('.chat_history').each(function() {
                    var to_user_id = $(this).data('touserid');
                    fetch_user_chat_history(to_user_id);
                });
            }

            $(document).on('click', '.ui-button-icon', function() {
                $('.user_dialog').dialog('destroy').remove();
                $('#is_active_group_chat_window').val('no');
            });

            $(document).on('focus', '.chat_message', function() {
                var is_type = 'yes';
                $.ajax({
                    url: "../chat/update_is_type_status.php",
                    method: "POST",
                    data: {
                        is_type: is_type
                    },
                    success: function() {

                    }
                })
            });

            $(document).on('blur', '.chat_message', function() {
                var is_type = 'no';
                $.ajax({
                    url: "../chat/update_is_type_status.php",
                    method: "POST",
                    data: {
                        is_type: is_type
                    },
                    success: function() {

                    }
                })
            });

            $('#group_chat_dialog').dialog({
                autoOpen: false,
                width: 400
            });

            $('#group_chat').click(function() {
                $('#group_chat_dialog').dialog('open');
                $('#is_active_group_chat_window').val('yes');
                fetch_group_chat_history();
            });

            $('#send_group_chat').click(function() {
                var chat_message = $.trim($('#group_chat_message').html());
                var action = 'insert_data';
                if (chat_message != '') {
                    $.ajax({
                        url: "../chat/group_chat.php",
                        method: "POST",
                        data: {
                            chat_message: chat_message,
                            action: action
                        },
                        success: function(data) {
                            $('#group_chat_message').html('');
                            $('#group_chat_history').html(data);
                        }
                    })
                } else {
                    alert('Type something');
                }
            });

            function fetch_group_chat_history() {
                var group_chat_dialog_active = $('#is_active_group_chat_window').val();
                var action = "fetch_data";
                if (group_chat_dialog_active == 'yes') {
                    $.ajax({
                        url: "../chat/group_chat.php",
                        method: "POST",
                        data: {
                            action: action
                        },
                        success: function(data) {
                            $('#group_chat_history').html(data);
                        }
                    })
                }
            }

            $('#uploadFile').on('change', function() {
                $('#uploadImage').ajaxSubmit({
                    target: "#group_chat_message",
                    resetForm: true
                });
            });

            $(document).on('click', '.remove_chat', function() {
                var chat_message_id = $(this).attr('id');
                if (confirm("Are you sure you want to remove this chat?")) {
                    $.ajax({
                        url: "../chat/remove_chat.php",
                        method: "POST",
                        data: {
                            chat_message_id: chat_message_id
                        },
                        success: function(data) {
                            update_chat_history_data();
                        }
                    })
                }
            });

            $('#addBttn').on('click', function() {
                var email = $('#email').val();
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
        </script>
        <?php
include('footer.php');
?>