<?php
 	include('header.php');
 	include('../../private/controllers/account_controller.php');
 	include('../../private/controllers/favourite_controller.php');

 	echo "<link rel='stylesheet' type = 'text/css' href='../css/favorite.css'>";

 	// outputs a warning message when user is not logged into an account

 	if( !isset($_SESSION['username']) || !isset($_SESSION['userid'])){     
    	echo "<main><div class='alert alert-warning margins'>
      		<h2><strong>Warning!</h2></strong><h2>You are not logged in</h2><h2>Please login to see your Favorites</h2>
      		<h2>Thank you</h2>
      </div></main>";
  	}
  	else{
  		echo "<main><div class='container'>";  
    	$userName = $_SESSION['username'];
    	$rows = getFavouriteById($account->getId());
    	$hasFavorite = false;

    	// If user has no favorites
    	if($rows == NULL){
    		echo "
 				<div class='alert alert-warning margins'>
      				<h2>You have not favorited any questions or answers</h2>
      			</div></main>";
    	}
    	// User has favorites
    	else{

	    	echo '</div></main>';
	    	$hasFavorite = true;
		}
  	}



 	include('footer.php');
?>