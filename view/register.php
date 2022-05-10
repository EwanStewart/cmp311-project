<?php
 include('header.php');

?>

<div class="container mdc-top-app-bar--prominent-fixed-adjust d-flex justify-content-center">
    <div class="align-content-center">
        <h4 class="mdc-typography--headline4">Create your Account</h4>
        <div class="vstack gap-2">
            <form class="vstack gap-2" action="../model/signup.php" method="post">
                <label class="mdc-text-field mdc-text-field--filled">
                    <span class="mdc-text-field__ripple"></span>
                    <span class="mdc-floating-label" id="email_label">Email</span>
                    <input class="mdc-text-field__input" type="email" name="email" required="required" id="email" aria-labelledby="email_label">
                    <span class="mdc-line-ripple"></span>
                </label>
                <br/>
                <label class="mdc-text-field mdc-text-field--filled">
                    <span class="mdc-text-field__ripple"></span>
                    <span class="mdc-floating-label" id="password_label">Password</span>
                    <input class="mdc-text-field__input" type="password" name="password" required="required" id="password" aria-labelledby="password_label">
                    <span class="mdc-line-ripple"></span>
                </label>
                <label class="mdc-text-field mdc-text-field--filled">
                    <span class="mdc-text-field__ripple"></span>
                    <span class="mdc-floating-label" id="passwordConf_label">Confirm Password</span>
                    <input class="mdc-text-field__input" type="password" name="passwordConf" required="required" id="passwordConf" aria-labelledby="passwordConf_label">
                    <span class="mdc-line-ripple"></span>
                </label>                    
                <p style="font-weight:bold;"> Password must contain a capital letter, a number and must be greater than 8 characters!</p>
                <br/>
                <div class="center-in-parent">
                    <button type="reset" class="mdc-button mdc-button--icon-trailing">
                        <span class="mdc-button__ripple"></span>
                        <span class="mdc-button__label">Clear</span>
                        <span class="mdc-button--icon-trailing material-icons">
                    clear
                </span>
                    </button>
                    <button type="submit" class="mdc-button mdc-button--raised mdc-button--icon-trailing">
                        <span class="mdc-button__ripple"></span>
                        <span class="mdc-button__label">Submit</span>
                        <span class="mdc-button--icon-trailing material-icons">
                    navigate_next
                </span>
                    </button>
                </div>
            </form>
            <div class="vstack gap-2">
                <div class="center-in-parent">
                    <br/> <p>For convenience, why don't you sign in with Google instead?</p>
                </div>
                <a href='<?php echo $login_url ?>' class="mdc-button mdc-button--outlined" role="button">
                    <span class="mdc-button__ripple"></span>
                    <img class="mdc-button--icon-leading" width="20px" style="margin-bottom:3px; margin-right:5px" alt="Google sign-in" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />
                    <span class="mdc-button__label">
                        Register with Google
                    </span>
                </a>
                <?php
                if (isset($_SESSION['signup_error'])){
                    echo "<h4><b style=color:red;>".$_SESSION['signup_error']."</b></h4>";$_SESSION['signup_error'] = '';
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php');
