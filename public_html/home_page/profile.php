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

				$config = parse_ini_file('../../config.ini');
				$username = $config['username'];
				$password = $config['password'];
				$dbname = $config['dbname'];
				$servername = $config['servername'];

				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$uploaddir = '../img/accounts/';
				$newfilename = $_SESSION['username'];
				$uploadfile =  $uploaddir. $newfilename. '.png';
				$_SESSION['name'] = $uploadfile;

				$stmt = $conn->prepare("UPDATE `accounts` SET `name` = '$uploadfile' WHERE `accounts`.`username` = '$newfilename'");
				$stmt->bindParam(':name', $uploadfile);
				$stmt->execute(); 
			?>

			<div class = "title"> Account Settings
				<br>
				<a id = "titleName"><?php echo $_SESSION['username']?>'s profile </a>
				<div class = "columns">

					<div class = "column1">

					<?php $file_path = $_SESSION['name'];
						if(!file_exists($file_path)) {
							$file_path = "..\img\avatar2.png";											
						}
						echo "<img src=\"".$file_path."\" width = \"150\" height = \"150\">";								
					?>
						<p id = "changePic"> </p>

					</div>

					<div class = "column2">	 
							<p id = "ChangePass"></p>
							<li>		
								<input type="submit" id = "password" onclick = "changePassword()" value = "Change Password"/>	
							</li>
							<li>
								<input type=submit id = "profile" onclick = "changePicture()" value="Change profile picture"/>
							</li>
							<li>
								<input type=submit id = "bio" onclick = "changeBio()" value="Change your bio"/>
							</li>
					</div>



				</div>					

				<div id = "changeBio"> </div>
				
		</div>

		<script>
			
			function changePicture() {
				document.getElementById("ChangePass").innerHTML = "";
				document.getElementById("changeBio").innerHTML = "";
				document.getElementById("changePic").innerHTML = '<form enctype="multipart/form-data" action="uploadImage.php" method="POST" style = "padding-bottom: 2%"><input name="userfile" type="file" style = "font-size: 18px; width: 50%"/><input type=submit name = "modify" value="Modify" onclick = "noshiet()" style = "font-size: 18px"/></form><input type=submit value="Cancel" onclick = "cancelChange()" style = "font-size: 18px"/>';
			}

			function pictureChanged() {
				document.getElementById("changePic").outterHTML = "";
			}

			function changePassword() {
				document.getElementById("changeBio").innerHTML = "";
				document.getElementById("changePic").innerHTML = "";
				document.getElementById("ChangePass").innerHTML = '<form action="changePassword.php" method="POST">Current Password <input type = "text" id = "ChangePass" placeholder = "Password"><br> New Password <input type = "text" id = "changePass" placeholder = "Password"/><br><input type = "submit" id = "subChange" value = "Submit"/><input type = "submit" id = "subCancel" onclick = "cancelPass()" value = "Cancel"/></form>';
			}

			function changeBio() {
				document.getElementById("ChangePass").innerHTML = "";
				document.getElementById("changePic").innerHTML = "";
				document.getElementById("changeBio").innerHTML = '<br>Describe Yourself<form action="uploadBio.php" method="POST" style = "padding-bottom: 2%"><textarea rows = 5 cols = 50 placeholder = "Enter your description here" maxlength = 500 style = "font-size: 18px; height:50%"></textarea><br><input type=submit value="Submit" style = "font-size: 18px"/><input type=submit value="Cancel" onclick = "cancelBio()" style = "font-size: 18px; margin-left: 2%"/></form>';
			}

			function cancelPass() {
				document.getElementById("ChangePass").innerHTML = "";
			}

			function cancelChange() {
				document.getElementById("changePic").innerHTML = "";
			}

			function cancelBio() {
				document.getElementById("changeBio").innerHTML = "";
			}

		</script>

		</body>
	</html>

<?php include("footer.php");?>


	
