<?php include("header.php"); ?>

<!DOCTYPE html>
	<html>
		<head>
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" type="text/css" href="../css/profil.css">
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

			<?php
				if(isset($_SESSION['username'])) {
					if(isset($_SESSION['name'])) {
						$file_path = $_SESSION['name'];
					} else {
						$file_path = "..\img\avatar2.png";
					}
						
					echo "<img src=\"".$file_path."\" width = \"150\" height = \"150\">";

				}
			?>	
	

				<form enctype="multipart/form-data" action="uploadImage.php" method="POST" style = "padding: 1%">
    				<input type="hidden"/>
    				Send this file: <input name="userfile" type="file" />
    				<input type="submit" value="Send File"/>
				</form>

				<!--<p> First Name <input type = "text" onfocus = "this.value=''" value = "Enter your First name" >  
				</p>
				<p> Last Name <input type = "text" onfocus = "this.value=''" value = "Enter your last name" >  
				</p>
				<input type="submit" value="Submit Changes">-->
			</div>

		</body>
	</html>

<?php include("footer.php");?>


	
