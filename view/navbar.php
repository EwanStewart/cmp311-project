<!DOCTYPE html>
<html lang="en">
   <head>
   <script>
      $(document).on("click", ".navbar-right .dropdown-menu", function(e){
      	e.stopPropagation();
      });
   </script>
   </head>
   <body>
      <nav class="navbar navbar-default navbar-expand-lg navbar-light">
         <div class="navbar-header">
            <a class="navbar-brand" href="#">TCPG</a>  		
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
                     <li><a href="#">Home</a></li>
                     <li><a href="#">Categories</a></li>
                     <li><a href="#">Recently Added</a></li>
                  </ul>
               </li>
               <li><a href="#">Contribute</a></li>
               <li><a href="#">Community</a></li>
               <li><a href="#">About</a></li>
            </ul>
            <?php
			echo '<ul class="nav navbar-nav navbar-right">';
						
			if (!isset($_SESSION['email'])) {
				echo '<li>';
					echo '<a data-toggle="dropdown" class="dropdown-toggle" href="#">Register</a>';
				echo '<ul class="dropdown-menu form-wrapper">';
					echo '<li>';
						echo '<form action="#" method="post">';
							echo '<div class="form-group">';
								echo '<input type="text" class="form-control" placeholder="Username" required="required">';
							echo '</div>';
							echo '<div class="form-group">';
								echo '<input type="password" class="form-control" placeholder="Password" required="required">';
							echo '</div>';
							echo '<input type="submit" class="btn btn-primary btn-block" value="Register">';
							echo '<div class="form-group social-btn clearfix">';
								echo '<a href='.$login_url.' class="btn btn-outline-dark" role="button" style="text-transform:none">';
								echo '<img width="20px" style="margin-bottom:3px; margin-right:5px" alt="Google sign-in" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />';
								echo 'Login with Google';
								echo '</a>';
							echo '</div>';
						echo '</form>';
					echo '</li>';
				echo '</ul>';
				echo '</li>';
				echo '<li>';
				
				echo '<a data-toggle="dropdown" class="dropdown-toggle" href="#">Login</a>';
				echo '<ul class="dropdown-menu form-wrapper">';
					echo '<li>';
						echo '<form action="#" method="post">';
							echo '<div class="form-group">';
								echo '<input type="text" class="form-control" placeholder="Username" required="required">';
							echo '</div>';
							echo '<div class="form-group">';
								echo '<input type="password" class="form-control" placeholder="Password" required="required">';
							echo '</div>';
							echo '<input type="submit" class="btn btn-primary btn-block" value="Login">';
							echo '<div class="form-group social-btn clearfix">';
								echo '<a href='.$login_url.' class="btn btn-outline-dark" role="button" style="text-transform:none">';
								echo '<img width="20px" style="margin-bottom:3px; margin-right:5px" alt="Google sign-in" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />';
								echo 'Login with Google';
								echo '</a>';
							echo '</div>';
						echo '</form>';
					echo '</li>';
				echo '</ul>';

			} else {
				echo 'logged in';
			}
			
				echo '</li>';
				echo '</ul>';
			?>
         </div>
      </nav>
   </body>
</html>

