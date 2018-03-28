<?php include("header.php"); ?>

<!DOCTYPE html>
	<html>
		<head>
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" type="text/css" href="../css/profile.css">
		</head>
		<body>

			<?php 

				include_once '../../private/models/Account.php';
				include_once '../../private/controllers/AccountController.php';
			
				$status = session_status();
				if($status == PHP_SESSION_NONE){
					//There is no active session
					session_start();
				}		

				$controller = new AccountController();
				$account = $controller::getAccountByUsername($_SESSION['username']);

			?>

			<div class = "title"> Account Settings
				<br>
				<a id = "titleName"><?php echo $_SESSION['username']?>'s profile </a>
				<div class = "columns">

					<div class = "column1">

					<?php 
						$file_path = $account->getProfilePicturePath();
						if(!file_exists($file_path)) {
							$file_path = "..\img\avatar2.png";
						}
						echo "<img class='circle_img' src=\"".$file_path."\" width = \"150\" height = \"150\"><br>";
						echo $account->getUsername();	
					?>
						
						<p id = "changePic"></p>
						<p id = "showBio" style = "font-size: 60%"> 
							<?php
								if (!("null" == $account->getBio())) {
									echo $account->getBio();
								};
							 ?>
						</p>
					</div>

					<div class = "column2">	 
							
						<li>		
							<input type=submit id = "profile" onclick = "changePicture()" value="Change profile picture"/>
						</li>
						<li>
							<input type="submit" id = "password" onclick = "changePassword()" value = "Modify password"/>	
						</li>
						<li>
							<input type=submit id = "bio" onclick = "changeBio()" value="Add or change your description"/>
						</li>
					</div>

				</div>					

				<div id = "changeBio"> </div>
				<div id = "ChangePass">
				<?php 
					if(isset($_GET['errorMessage'])) {

    					if("The password has successfully been modified !" == $_GET['errorMessage']) {
    						echo "<br><p style='color:green;'>".$_GET['errorMessage']."</p>";
    					} else {
    						echo "<br><p style='color:red;'>".$_GET['errorMessage']."</p>";

    					}
					}
				?>
				</div>
				
			</div>

			<script>
				
				function changePicture() {
					document.getElementById("ChangePass").innerHTML = "";
					document.getElementById("changeBio").innerHTML = "";
					document.getElementById("changePic").innerHTML = '<form enctype="multipart/form-data" action="../home_page/profile/uploadImage.php" method="POST" style = "padding-bottom: 2%"><input name="userfile" type="file" style = "font-size: 18px; width: 50%"/><input type=submit name = "modify" value="Modify" onclick = "noshiet()" style = "font-size: 18px"/></form><input type=submit value="Cancel" onclick = "cancelChange()" style = "font-size: 18px"/>';
				}

				function pictureChanged() {
					document.getElementById("changePic").outterHTML = "";
				}

				function changePassword() {
					document.getElementById("changeBio").innerHTML = "";
					document.getElementById("changePic").innerHTML = "";
					document.getElementById("ChangePass").innerHTML = '<br><form action="profile/changePassword.php" method="POST"> Current Password <input type = "password" class = "btn btn-gray btn-sm" name = "currentPass" placeholder = "Password"><br>New Password <input type = "password" class = "btn btn-gray btn-sm" name = "newpassword1" placeholder = "Password" style = "margin-top: 1%"/><br>Retype New Password <input type = "password" class = "btn btn-gray btn-sm" name = "newpassword2" placeholder = "Password" style = "margin-top: 1%"/><br><input type = "submit" class = "btn btn-gray btn-sm" id = "subChange" value = "Submit"/><input type = "submit" class = "btn btn-gray btn-sm" id = "subCancel" onclick = "cancelPass()" value = "Cancel" style = "margin-top: 2%"/></form>';
				}

				function changeBio() {
					document.getElementById("ChangePass").innerHTML = "";
					document.getElementById("changePic").innerHTML = "";
					document.getElementById("changeBio").innerHTML = '<br>Describe Yourself<form action="profile/uploadBio.php" method="POST" style = "padding-bottom: 2%"><textarea rows = 5 cols = 50 class = "btn btn-gray btn-sm" name = bio placeholder = "Enter your description here" maxlength = 300 style = "font-size: 18px; height:50%"></textarea><br><input type=submit class = "btn btn-gray btn-sm" value="Submit" style = "font-size: 18px"/><input type=submit class = "btn btn-gray btn-sm" value="Cancel" onclick = "cancelBio()" style = "font-size: 18px; margin-left: 2%"/></form>';
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


	
