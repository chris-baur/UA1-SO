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
    	$account= getAccountByUsername($userName);
    	$rows = getFavouriteQuestions($account->getId());
    	$hasFavorite = false;


    	if($rows == NULL){
    		echo "
 				<div class='alert alert-warning margins'>
      				<h2>You have not favorited any questions or answers</h2>
      			</div></main>";
    	}
    	else{
	    	foreach ($rows as $info) {
	    		$questionAccount = getAccountById($info->getAccountId());
	      		echo "
	        	<div class='form-group row questionBox'>
	        		<div class='col-md-2 userBox'>
	        			<label class ='username'>".$questionAccount->getUsername()."</label><br>
		          		<button class='btn btn-like'><i class='fa fa-thumbs-o-up'></i></button>". $info->getUpvotes() . "
		          		<button class='btn btn-like'><i class='fa fa-thumbs-o-down'></i></button>". $info->getDownvotes() . "
	        		</div>
		        	<span class = 'questionBody'>
		        		<div class='col-md-10 '>
		          			<div>
		          				<h3><strong>" . $info->getHeader() . "</strong></h3>
		        			</div>
		          			<p>" . $info->getContent() . "</p>
		          			<span class = 'time'>Posted on: " . $info->getDate() . "</span>
		        		</div>
		        	</span>
	      		</div><br>";
	    	}
	    	echo '</div></main>';
	    	$hasFavorite = true;
		}

    	// $rows = getFavouriteAnswers($account->getId());
    	// if($hasFavorite == false){
    	// }
    	// else{
	    // 	foreach ($rows as $info) {
	    // 		$questionAccount = getAccountById($info->getAccountId());
	    //   		echo "
	    //     	<div class='form-group row questionBox'>
	    //     		<div class='col-md-2 userBox'>
	    //     			<label class ='username'>".$questionAccount->getUsername()."</label><br>
	    //       			<button class='btn btn-like'><i class='fa fa-thumbs-o-up'></i></button>". $info->getUpvotes() . "
	    //       			<button class='btn btn-like'><i class='fa fa-thumbs-o-down'></i></button>". $info->getDownvotes() . "
	    //     		</div>
	    //     	<span class = 'questionBody'>
	    //     		<div class='col-md-10 '>
	    //       			<div>
	    //       				<h3><strong>" . $info->getHeader() . "</strong></h3>
	    //     			</div>
	    //       			<p>" . $info->getContent() . "</p>
	    //       			<span class = 'time'>Posted on: " . $info->getDate() . "</span>
	    //     		</div>
	    //     	</span>
	    //   		</div><br>";
	    // 	}
	    // 	echo '</div><br>';
    	// }
  	}



 	include('footer.php');
?>