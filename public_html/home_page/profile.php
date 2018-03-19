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

			<div class = "title"> Account Settings

				<div class = "columns">

					<div class = "column1">

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
						<p id = "demo"> 

						<input type=submit id = "button" onclick = "shiet()" value="Change profile picture" style = "font-size: 18px"/>
						
						</p>

						<script>
							function shiet() {
								document.getElementById("button").outerHTML = "";
								document.getElementById("demo").innerHTML = '<form enctype="multipart/form-data" action="uploadImage.php" method="POST" style = "padding-bottom: 2%"><input type="hidden"/><input name="userfile" type="file" style = "font-size: 18px; width: 50%"/><input type=submit name = "modify" value="Modify" onclick = "noshiet()" style = "font-size: 18px"/></form>';
							}

							function noshiet() {
								document.getElementById("demo").outterHTML = "";
								document.getElementById("button").innerHTML = '<input type=submit id = "button" onclick = "shiet()" value="Change profile picture" style = "font-size: 18px"/>';
								
							}
						</script>

						<!--<p> First Name <input type = "text" onfocus = "this.value=''" value = "Enter your First name" >  
						</p>
						<p> Last Name <input type = "text" onfocus = "this.value=''" value = "Enter your last name" >  
						</p>
						<input type="submit" value="Submit Changes">-->
					</div>

					<div class = "column2">
						blabla
					</div>

				</div>
		</div>

		</body>
	</html>

<?php include("footer.php");?>


	
