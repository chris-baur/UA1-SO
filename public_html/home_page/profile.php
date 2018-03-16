<?php include("header.php"); ?>

<!DOCTYPE html>
	<html>
		<head>
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" type="text/css" href="../css/profile.css">
		</head>
		<body>
			
			<?php 
				$status = session_status();
				if($status == PHP_SESSION_NONE){
					//There is no active session
					session_start();
				} 
			?>

			<div class = "title">Account Settings </div>
			<div class = "options">
				<p> Username <input type = "text" onfocus = "this.value=''" value = "<?php echo $_SESSION['username']; ?>" >
				</p>
				<p> First Name <input type = "text" onfocus = "this.value=''" value = "Enter your First name" >  
				</p>
				<p> Last Name <input type = "text" onfocus = "this.value=''" value = "Enter your last name" >  
				</p>
			</div>

		</body>
	</html>

<?php include("footer.php");?>


	
