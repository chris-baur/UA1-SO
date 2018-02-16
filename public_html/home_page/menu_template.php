<?php

$index="myButtons";
$about="myButtons";
$favorites="myButtons";
$myquestions="myButtons";

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
<a class="<?php echo $myquestions;?>"href="myquestions.php">My Questions</a>
</div>
<div class="col-lg-2 <?php echo $favorites;?>">
<a class="<?php echo $favorites;?>"href="favorites.php">Favorites</a>
</div>
<div class="col-lg-2 <?php echo $about;?>">
<a class="<?php echo $about;?>"href="aboutBody.php">About</a>
</div>
<div class="col-lg-4">
<button class="btn loginButton" onclick="location.href='../login_register/loginregister.html';"/>Login / Sign Up</button>
</div>
      