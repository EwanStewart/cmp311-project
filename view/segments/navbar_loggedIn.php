<button onclick="showAccountBox()" name="btn_account" id="btn_account"
    class="top-app-bar-mainLink mdc-button mdc-button--icon-leading top-app-bar-button">
    <span class="mdc-button__ripple"></span>
    <span class="mdc-button__label"><?php echo $_SESSION["email"] ?></span>
    <i class="material-icons mdc-button__icon" aria-hidden="true">expand_more</i>
</button>
<div name="accountPopup" id="accountPopup" class="top-app-bar-accountPopup mdc-card">
    <div class="vstack g-1">
        <div class="hstack g-2">
            <?php
                include('../model/api-store.php');

                $profilePictureID = getProfilePictureID();

                switch($profilePictureID){
                    case 0:
                        echo'<img width="64" height="64" src="../image/blank.png" />';
                        break;
            
                    case 1:
                        echo'<img width="64" height="64" src="../image/witcher3.png" />';
                        break;
            
                    case 2:
                        echo'<img width="64" height="64" src="../image/gta5trevor.png" />';
                        break;
            
                    case 3:
                        echo'<img width="64" height="64" src="../image/owgenji.png" />';
                        break;

                    case 4:
                        echo'<img width="64" height="64" src="../image/mario.png" />';
                        break;

                    case 5:
                        echo'<img width="64" height="64" src="../image/pokeball.png" />';
                        break;

                    case 6:
                        echo'<img width="64" height="64" src="../image/falloutboy.png" />';
                        break;

                    case 7:
                        echo'<img width="64" height="64" src="../image/skyrim.png" />';
                        break;

                    case 8:
                        echo'<img width="64" height="64" src="../image/zombie.png" />';
                        break;

                    default:
                        echo'<img width="64" height="64" src="../image/blank.png" />';
                        break;
                }

            ?>
            <h6><?php echo $_SESSION["email"] ?></h6>
        </div>
        <a href="../view/account.php">Account</a>
        <a href="#">Games</a>
        <a href="../view/friends.php">Friends</a>
        <a href="../model/logout.php">Sign Out</a>
        <?php
        if ($_SESSION['admin']){
            echo '<a href="#">Admin Panel</a>';
        }
        ?>

    </div>
</div>
<script type="text/javascript" src="../view/scripts/app.js"></script>