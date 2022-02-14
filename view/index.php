<!DOCTYPE html> 
<html lang="en">

   <head>
		<?php   
			session_start();
		?>
		
	   <meta charset="utf-8">
	   <meta name="viewport" content="width=device-width, initial-scale=1">
	   
	   <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
	   <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	   
	   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	   
	   <link rel="stylesheet" type="text/css" href="styles.css" >
	   
   </head>
   
   <body>
   
	<?php	
		include('config.php');
		include('navbar.php');
	?>
	
	<script>	
		const query = window.location.search;
		const params = new URLSearchParams(query);
		const pop = params.get('pop');
		console.log(pop);
		
		if (pop == 1) {
			document.getElementById("reg").click();
		} else if (pop == 2) {
			document.getElementById("log").click();
		}
	</script>

	  
      <div class="container-fluid">
         <div class="container">
            <div class="row justify-content-center">
			

				
            </div>
         </div>
      </div>
   </body>
</html>
