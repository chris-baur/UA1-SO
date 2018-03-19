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
				<br>
				<a id = "titleName"><?php echo $_SESSION['username']?>'s profile </a>
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
						<p id = "changePic"> </p>

						<script>
							function changePicture() {
								document.getElementById("ChangePass").innerHTML = "";
								document.getElementById("changePic").innerHTML = '<form enctype="multipart/form-data" action="uploadImage.php" method="POST" style = "padding-bottom: 2%"><input name="userfile" type="file" style = "font-size: 18px; width: 50%"/><input type=submit name = "modify" value="Modify" onclick = "noshiet()" style = "font-size: 18px"/></form><input type=submit value="Cancel" onclick = "cancelChange()" style = "font-size: 18px"/>';
							}

							function pictureChanged() {
								document.getElementById("changePic").outterHTML = "";
							}

							function changePassword() {
								document.getElementById("changePic").innerHTML = "";
								document.getElementById("ChangePass").innerHTML = 'Current Password <input type = "text" id = "ChangePass" placeholder = "Password"><br> New Password <input type = "text" id = "changePass" placeholder = "Password"/><br><input type = "submit" id = "subChange" value = "Submit"/><input type = "submit" id = "subCancel" onclick = "cancelPass()" value = "Cancel"/>';
							}

							function cancelPass() {
								document.getElementById("ChangePass").innerHTML = "";
							}

							function cancelChange() {
								document.getElementById("changePic").innerHTML = "";
							}

						</script>

					</div>

					<div class = "column2">	 
							<p id = "ChangePass"></p>
							<li id = "option1">								
								<input type="submit" id = "password" onclick = "changePassword()" value = "Change Password"/>
									
							</li>
							<li id = "option2">
								<input type=submit id = "button" onclick = "changePicture()" value="Change profile picture"/>
							</li>

					</div>

				</div>
		</div>

		</body>
	</html>

<?php include("footer.php");?>


	
