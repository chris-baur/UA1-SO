<!DOCTYPE HTML>
<html>
	<head>
		<title>Ask It! About</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
    	<link rel="stylesheet" type="text/css" href="../css/header.css">
    </head>

    <style>
    	.dropbtn {
		    background-color: #DEB887;
		    color: black;
		    padding: 16px;
		    font-size: 17px;
		    font-weight: bold;
		    font-family: arial;
		    text-transform: uppercase;
		    border: none;
		}

		.dropdown {
		    position: relative;
		    display: inline-block;
		}

		.dropdown-content {
		    display: none;
		    position: absolute;
		    background-color: #f1f1f1;
		    min-width: 160px;
		    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
		    z-index: 1;
		}

		.dropdown-content a {
		    color: black;
		    padding: 12px 16px;
		    text-decoration: none;
		    display: block;
		}

		.dropdown-content a:hover {background-color: #ddd}

		.dropdown:hover .dropdown-content {
		    display: block;
		}

		.dropdown:hover .dropbtn {
		    background-color: #D2B48C;
		}
	</style>

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
		<div class="col-lg-2 <?php echo $index;?>">
			<a class="<?php echo $index;?>"href="homepage.php">Home</a>
		</div>

		<div class="col-lg-2 <?php echo $myquestions;?>">
			<a class="<?php echo $myquestions;?>"href="myquestions.php">Questions</a>
		</div>

		<div class="col-lg-2 <?php echo $favorites;?>">
			<a class="<?php echo $favorites;?>"href="favorites.php">Favorites</a>
		</div>

		<div class="col-lg-2 <?php echo $about;?>">
			<a class="<?php echo $about;?>"href="about.php">About</a>
		</div>

		<div class="col-lg-4">
			<?php

			if(isset($_SESSION['username'])) {
				//echo "Hi, " .$_SESSION['username']. "!";
				?>

				<div class="dropdown">
	  				<button class="dropbtn"> <?php echo "Hi, " .$_SESSION['username']. " !"; ?> </button>
	  				<div class="dropdown-content">
	    				<a href="profile.php">My Profile</a>
	    				<a href="#">Settings</a>
	    				<a href="logout.php">Logout</a>
	  				</div>
				</div>


				<!--<div class="col-lg-2 <?php echo $logout;?>">
					<a class="<?php echo $logout;?>"href="logout.php">Logout</a>
				</div>-->
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

      