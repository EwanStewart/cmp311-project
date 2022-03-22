<div>
    <button onclick="showLoginBox()" name="btn_login" id="btn_login" class="top-app-bar-mainLink mdc-button mdc-button--icon-leading top-app-bar-button">
        <span class="mdc-button__ripple"></span>
        <span class="mdc-button__label">Login</span>
        <i class="material-icons mdc-button__icon" aria-hidden="true">expand_more</i>
    </button>
    <div name="loginPopup" id="loginPopup" class="top-app-bar-accountPopup mdc-card">
        <div>
            <form action="../model/login.php" method="post">
                <div class="form-group">
                    <label class="mdc-text-field mdc-text-field--outlined top-app-bar-searchField">
                                                <span class="mdc-notched-outline">
                                                    <span class="mdc-notched-outline__leading"></span>
                                                    <span class="mdc-notched-outline__notch">
                                                        <span class="mdc-floating-label" id="login_email">Email</span>
                                                    </span>
                                                    <span class="mdc-notched-outline__trailing"></span>
                                                    </span>
                        <input placeholder="Email" name="email" required="required" type="email" class="mdc-text-field__input" aria-labelledby="login_email">
                    </label>
                </div>
                <div class="form-group">
                    <label class="mdc-text-field mdc-text-field--outlined top-app-bar-searchField">
                                                <span class="mdc-notched-outline">
                                                    <span class="mdc-notched-outline__leading"></span>
                                                    <span class="mdc-notched-outline__notch">
                                                        <span class="mdc-floating-label" id="login_password">Password</span>
                                                    </span>
                                                    <span class="mdc-notched-outline__trailing"></span>
                                                    </span>
                        <input placeholder="Password" name="password" required="required" type="password" class="mdc-text-field__input" aria-labelledby="login_password">
                    </label>
                </div>
                <div class="form-group top-app-bar-accountPopup_buttonContainer">
                    <button class="mdc-button mdc-button--unelevated top-app-bar-accountPopup_loginButton" type="submit" name="submit">
                        <span class="mdc-button__ripple"></span>
                        <span class="mdc-button__label">Login</span>
                    </button>
                </div>
                <div class="form-group social-btn clearfix top-app-bar-accountPopup_buttonContainer">
                    <a href='<?php echo $login_url ?>' class="mdc-button mdc-button--outlined top-app-bar-accountPopup_GoogleLoginButton" role="button">
                        <span class="mdc-button__ripple"></span>
                        <img class="mdc-button--icon-leading" width="20px" style="margin-bottom:3px; margin-right:5px" alt="Google sign-in" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />
                        <span class="mdc-button__label">
                                                    Login with Google
                                                </span>
                    </a>
                </div>
                <?php
                if (isset($_SESSION['login_error'])){
                    echo "<h4><b style=color:red;>".$_SESSION['login_error']."</b></h4>";$_SESSION['login_error'] = '';
                }
                ?>
            </form>
        </div>
    </div>
</div>
<a name="btn_register" id="btn_register" class="top-app-bar-mainLink mdc-button top-app-bar-button" href="register.php">
    <span class="mdc-button__ripple"></span>
    <span class="mdc-button__label">Register</span>
</a>