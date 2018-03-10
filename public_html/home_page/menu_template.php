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
			echo "Hi, " .$_SESSION['username']. "!";
			?>
			<div class="col-lg-2 <?php echo $logout;?>">
				<a class="<?php echo $logout;?>"href="logout.php">Logout</a>
			</div>
			<?php
		} else {
			?>
			<button class="btn loginButton" onclick="location.href='../login_register/loginregister.php';"/>Login / Sign Up</button>
			<?php
		}
	?>	
</div>

      