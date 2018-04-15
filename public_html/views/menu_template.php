<!DOCTYPE HTML>
<html>
	<head>
		<title>Ask It! About</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
    	<link rel="stylesheet" type="text/css" href="../css/header1.css">
    </head>

 	<body>

		<?php

		$status = session_status();
		if($status == PHP_SESSION_NONE){
			//There is no active session
			session_start();
		}
		//include_once '..\login_register\validateLogin.php';

		$index="myButtons";
		$about="myButtons";
		$favorites="myButtons";
		$myquestions="myButtons";
		$logout="myButtons";

		$menuLinkid= basename($_SERVER['PHP_SELF'],".php");
		if($menuLinkid=="homepage"){
			$index='myActiveButton';
		}else if($menuLinkid=="about"){
			$about='myActiveButton';
		}else if($menuLinkid=="favorites"){
			$favorites='myActiveButton';
		}else if($menuLinkid=="myquestions"){
			$myquestions='myActiveButton';
		}
		?>

		<div class="col-lg-4 <?php echo $index;?>">
			<a class="<?php echo $index;?>"href="homepage.php">Home</a>
		</div>

		<div class="col-lg-4 <?php echo $about;?>">
			<a class="<?php echo $about;?>"href="about.php">About</a>
		</div>

		<div class="head_login">
			<?php

			if(isset($_SESSION['username'])) {
				?>

				<div class="dropdown">
	  				<button class="dropbtn"> <?php echo "Hi, " .$_SESSION['username']. " !"; ?> </button>
	  				<div class="dropdown-content">
	    				<a href="profile.php">My Profile</a>
	    				<a href="myquestions.php">My Questions</a>
	    				<a href="favourites.php">Favorites</a>
	    				<a href="logout.php">Logout</a>
	  				</div>
				</div>

				<?php
			} else {
				?>
				<button class="btn loginButton" onclick="location.href='../login_register/loginregister.php';"/>Login / Sign Up</button>
				<?php
			}
		?>	
		</div>

	</body>
	</html>

      