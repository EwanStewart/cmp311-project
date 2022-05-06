<?php
    //$transactionId = $_GET['transactionId'];
    
?>
<!DOCTYPE html>
<head>
	<!-- The site uses Bootstrap v5 Framework-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
	</script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body>
	<?php
		include('header.php');
	?>
	<div>
	<div class="container mdc-top-app-bar--prominent-fixed-adjust">
				
        <!-- bootstrap form for transaction feedabck -->
        <div class="card container justify-content-center p-4">
            <h2 class="card-title text-center">Please provide us with your feedback</h2>
            <form action="../model/feedback.php" method="post">
                <div class="form-group">
                    <label for="feedback">Feedback</label>
                    <textarea class="form-control" id="feedback" name="feedback" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="rating">Rating</label>
                    <select class="form-control" id="rating" name="rating">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="recommend">Would you like a moderator to get in touch regarding your transaction?</label>
                    <select class="form-control" id="moderator" name="moderator">
                        <option>Yes</option>
                        <option>No</option>
                    </select>                  
                </div>
                <div class="form-group">
                    <label for="email">Contact email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                </div>
                <input type="hidden" name="user_id" value="<?php echo $_SESSION['uID']; ?>">
                <input type="hidden" name="key_id" value="<?php echo $_GET['key_id']; ?>">

                
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>



	</div>

</body>

</html>