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
<nav id="nav">
          <ul>
            <li>
              <a class="<?php echo $index;?>"href="homepage.php">Home</a>
            </li>
            <li>
              <a class="<?php echo $myquestions;?>"href="myquestions.php">My Questions</a>
            </li>
            <li>
              <a class="<?php echo $favorites;?>"href="favorites.php">Favorites</a>
            </li>
            <li>
              <a class="<?php echo $about;?>"href="about.php">About</a>
            </li>
            <li>
              <a><button onclick="location.href='loginregister.html';"/>Login / Sign Up</button></a>
            </li>
          </ul>
        </nav>
      </div>