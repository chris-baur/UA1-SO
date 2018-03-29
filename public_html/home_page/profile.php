<?php include("header.php"); ?>

<!DOCTYPE html>
	<html>
		<head>
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" type="text/css" href="../css/prof.css">
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
						<img src = "..\img\edit.png" id = "edit" onclick="modifyUsername()">
						<p id = "changePic"></p>
						<p id = "showBio" style = "font-size: 60%"> 
							<?php
								if (!("null" == $account->getBio())) {
									echo $account->getBio();
								};
							 ?>
						</p>
			
						<button type=button id = "profile" class = "btn btn-primary btn-block" onclick = "changePicture()"> Change profile picture </button>
						<button type=button id = "profile" class = "btn btn-primary btn-block" onclick = "changePassword()"> Modify password </button>
						<button type=button id = "profile" class = "btn btn-primary btn-block" onclick = "changeBio()"> Add or change your description </button>
						<button type=button id = "profile" class = "btn btn-primary btn-block" onclick = "changeInfo()"> Modify my general informations </button>
						
					</div>

					<div class = "column2">	
						
						<div id = "gen">Your General Informations</div>
						<p id = text> 
							<table>
								<tr>
									<th>First Name</th>
									<th><?php echo $account->getName() ?></th>
									
								</tr>
								<tr>
									<td>Last Name</td>
									<td><?php echo $account->getLastName() ?></td>
									
								</tr>
								<tr>
								    <td>Profession</td>
								    <td><?php echo $account->getProfession() ?></td>
								    
								</tr>
								<tr>
								    <td>Gender</td>
								    <td><?php echo $account->getGender() ?></td>
								    
						  		</tr>
							</table>
						</p>
						<p id = info> </p>
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
					document.getElementById("info").innerHTML = "";
					document.getElementById("changePic").innerHTML = '<form enctype="multipart/form-data" action="../home_page/profile/uploadImage.php" method="POST" style = "padding-bottom: 2%; padding-top: 2%"><input name="userfile" type="file" style = "font-size: 18px; width: 60%; margin-top:2%;"/><br><input type=submit name = "modify" class = "btn btn-gray btn-sm" id = "subChange" value="Submit" style = "font-size: 14px"/><input type=submit id = subCancel class = "btn btn-gray btn-sm" value="Cancel" onclick = "cancelChange()" style = "font-size: 14px; margin-top: 2%"/></form>';
				}

				function pictureChanged() {
					document.getElementById("changePic").outterHTML = "";
				}

				function changePassword() {
					document.getElementById("changeBio").innerHTML = "";
					document.getElementById("changePic").innerHTML = "";
					document.getElementById("info").innerHTML = "";
					document.getElementById("ChangePass").innerHTML = '<br><form action="profile/changePassword.php" method="POST"> Current Password <br> <input type = "password" class = "btn btn-gray btn-sm" name = "currentPass" placeholder = "Current Password" style = "width: 100%"><br>New Password <br><input type = "password" class = "btn btn-gray btn-sm" name = "newpassword1" placeholder = "New Password" style = "margin-top: 1%; width: 100%"/><br>Retype New Password <br><input type = "password" class = "btn btn-gray btn-sm" name = "newpassword2" id = "focus" placeholder = "New Password" style = "margin-top: 1%; width:100%"/><br><input type = "submit" class = "btn btn-gray btn-sm" id = "subChange" value = "Submit"/><input type = "submit" class = "btn btn-gray btn-sm" id = "subCancel" onclick = "cancelPass()" value = "Cancel" style = "margin-top: 2%"/></form>';
				}

				function changeBio() {
					document.getElementById("ChangePass").innerHTML = "";
					document.getElementById("changePic").innerHTML = "";
					document.getElementById("info").innerHTML = "";
					document.getElementById("changeBio").innerHTML = '<br>Describe Yourself<form action="profile/uploadBio.php" method="POST" style = "padding-bottom: 2%"><textarea rows = 5 cols = 50 class = "btn btn-gray btn-sm" name = bio placeholder = "Enter your description here" maxlength = 300 style = "font-size: 18px; height:50%; width: 80%"></textarea><br><input type=submit id = "subChange" class = "btn btn-gray btn-sm" value="Submit" style = "font-size: 18px"/><input type=submit id = "subCancel" class = "btn btn-gray btn-sm" value="Cancel" onclick = "cancelBio()" style = "font-size: 18px; margin-left: 2%; margin-top: 2%"/></form>';
				}

				function changeInfo() {
					document.getElementById("ChangePass").innerHTML = "";
					document.getElementById("changePic").innerHTML = "";
					document.getElementById("changeBio").innerHTML = "";
					document.getElementById("info").innerHTML = '<form action="#" method="POST" id = "info" style="margin-left: 2%"><label for="fname" style="margin-top: 2%">UserName</label><input type="text" id="uname" name="username" placeholder= "<?php echo $_SESSION['username'] ?>"><br><label for="fname" style="margin-top: 2%">First Name</label><input type="text" id="fname" name="firstname" placeholder="Your name.."><br><label for="lname" style="margin-top: 2%">Last Name</label><input type="text" id="lname" name="lastname" placeholder="Your last name.."><br><label for="lname" style="margin-top: 2%">Profession</label><input type="text" id="lname" name="lastname" placeholder="<?php echo $account->getProfession() ?>"><br><label for="lname" style="margin-top: 2%">Gender</label><input type="text" id="lname" name="lastname" placeholder="<?php echo $account->getGender() ?>"><br><br><input type="submit" value="Submit"><input type="submit" value="Cancel" onclick = "cancelInfo()" style = "background-color: red;"></form>';
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

				function cancelInfo() {
					document.getElementById("info").innerHTML = "";
				}

			</script>

		</body>
	</html>

<?php include("footer.php");?>


	
