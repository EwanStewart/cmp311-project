<!DOCTYPE html>
<html lang="en">

<head>
</head>

<body>
    <nav class="navbar navbar-default navbar-expand-lg navbar-light">
        <div class="navbar-header">
            <image src="../image/TPCG_logo" style="height:100px; width:100px;" class="image-fluid navbar-left" />
            <a class="navbar-brand" href="../view/index.php">Home</a>
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="navbar-toggler-icon"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">Store <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Categories</a></li>
                        <li><a href="#">Recently Added</a></li>
                    </ul>
                </li>
                <li><a href="contribute.php">Contribute</a></li>
                <li><a href="community.php">Community</a></li>
                <li><a href="about.php">About</a></li>
            </ul>
            <?php
               echo '<ul class="nav navbar-nav navbar-right">';
               			
               if (!isset($_SESSION['email'])) {
               	echo '<li>';
               		echo '<a data-toggle="dropdown" class="dropdown-toggle" id="reg">Register</a>';
               	echo '<ul class="dropdown-menu form-wrapper">';
               		echo '<li>';
               			echo '<form action="../model/signup.php" method="post">';
               				echo '<div class="form-group">';
               					echo '<input type="email" name="email" class="form-control" placeholder="email">';
               				echo '</div>';
               				echo '<div class="form-group">';
               					echo '<input type="password" name="password" class="form-control" placeholder="password">';
               				echo '</div>';
               				echo '<input type="submit" name="submit" class="btn btn-primary btn-block" value="Register">';
               				echo '<div class="form-group social-btn clearfix">';
               					echo '<a href='.$login_url.' class="btn btn-outline-dark" role="button" style="text-transform:none">';
               					echo '<img width="20px" style="margin-bottom:3px; margin-right:5px" alt="Google sign-in" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />';
               					echo 'Register with Google';
               					echo '</a>';
               				echo '</div>';
               				if (isset($_SESSION['signup_error'])){
               					echo "<h4><b style=color:red;>".$_SESSION['signup_error']."</b></h4>";$_SESSION['signup_error'] = '';
               				}
               			echo '</form>';
               		echo '</li>';
               	echo '</ul>';
               	echo '</li>';
               	echo '<li>';
               	
               	echo '<a data-toggle="dropdown" class="dropdown-toggle" id="log">Login</a>';
               	echo '<ul class="dropdown-menu form-wrapper">';
               		echo '<li>';
               			echo '<form action="../model/login.php" method="post">';
               				echo '<div class="form-group">';
               					echo '<input type="email" class="form-control" name="email" placeholder="email" required="required">';
               				echo '</div>';
               				echo '<div class="form-group">';
               					echo '<input type="password" class="form-control" name="password" placeholder="password" required="required">';
               				echo '</div>';
               				echo '<input type="submit" name="submit" class="btn btn-primary btn-block" value="Login">';
               				echo '<div class="form-group social-btn clearfix">';
               					echo '<a href='.$login_url.' class="btn btn-outline-dark" role="button" style="text-transform:none">';
               					echo '<img width="20px" style="margin-bottom:3px; margin-right:5px" alt="Google sign-in" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />';
               					echo 'Login with Google';
               					echo '</a>';
               				echo '</div>';
               				if (isset($_SESSION['login_error'])){
               					echo "<h4><b style=color:red;>".$_SESSION['login_error']."</b></h4>";$_SESSION['login_error'] = '';
               				}
               			echo '</form>';
               		echo '</li>';
               	echo '</ul>';
               
               } else {				
               	echo '<ul class="nav navbar-nav">';
               		echo '<li class="dropdown">';
               		echo '<a data-toggle="dropdown" class="dropdown-toggle" href="#">'. $_SESSION['email']. '<b class="caret"></b></a>';
               		echo '<ul class="dropdown-menu">';
               		echo '<li><a href="#">Account Balance: £9,999</a></li>';
               		echo '<li><a href="account.php">Account Settings</a></li>';
					echo '<li><a href="#">Key Inventory</a></li>';
               		echo '<li><a href="friends.php">Friends</a></li>';
               		
               		if ($_SESSION['admin']){
               			echo '<li><a href="#">Admin Panel</a></li>';
               		}
               		
               		echo '<li><a href="../model/logout.php">Logout</a></li>';
               	echo '</ul>';
               }
               
               	echo '</li>';
               	echo '</ul>';
               ?>
        </div>
    </nav>
</body>

</html>