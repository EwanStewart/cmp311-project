<h3 class="mdc-drawer__title"><?php echo $_SESSION['forename'] . " " . $_SESSION['surname'] ?></h3>
<h6 class="mdc-drawer__subtitle"><?php echo $_SESSION['email'] ?></h6>
<button class="mdc-button mdc-button--touch mdc-button--icon-leading" type="button" data-bs-toggle="collapse" data-bs-target="#account_collapsePanel" aria-expanded="false" aria-controls="account_collapsePanel">
    <span class="mdc-button__ripple"></span>
    <span class="mdc-button__label">Account</span>
    <i class="material-icons mdc-button__icon" aria-hidden="true">expand_more</i>
</button>

<div class="collapse" id="account_collapsePanel">
    <div class="">
        <div class="nav-bar-modal-accountContainer">
            <div class="vstack g-1">
                <?php
                    include_once('../model/getGames.php');
                    $credits = getCredits();
                    echo '<p>Total Credits: ' . $credits . '</p>';

                ?>
                <a href="../view/account.php">Account</a>
                <a href="../view/basket.php">Basket</a>
                <a href="../view/transactionhistory.php">Purchased Keys</a>
                <a href="../view/publishedkeys.php">Contributed Keys</a>
                <a href="../view/friends.php">Friends</a>
                <a href="../view/refer.php">Refer a friend</a>
                <a href="../model/logout.php">Sign Out</a>
                <?php
                    if ($_SESSION['admin']){
                        echo '<a href="#">Admin Panel</a>';
                    }
                ?>

            </div>
        </div>
    </div>
</div>