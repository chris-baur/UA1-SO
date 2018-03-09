<?php
 	include('header.php');
 	include('../../private/controllers/account_controller.php');
 	include('../../private/controllers/favourite_controller.php');

 	echo "<link rel='stylesheet' type = 'text/css' href='../css/favorite.css'>";

 	$_SESSION['username'] = 'john117';
 	$_SESSION['userid'] = '1';

 	// outputs a warning message when user is not logged into an account
 	if( !isset($_SESSION['username']) || !isset($_SESSION['userid'])){     
    	echo "<div class='alert alert-warning margins'>
      		<h2><strong>Warning!</h2></strong><h2>You are not logged in</h2><h2>Please login to ask a question and/or view your questions</h2>
      		<h2>Thank you</h2>
      </div>";
  	}
  	else{
  		echo "<div class='container'>";  
    	$userName = $_SESSION['username'];
    	$account= getAccountByUsername($userName);
    	$rows = getFavouriteQuestions($account->get_id());
    	$hasFavorite = false;


    	if($rows == NULL){
    		echo "
 				<div class='alert alert-warning margins'>
      				<h2>You have not favorited any questions or answers</h2>
      			</div>";
    	}
    	else{
	    	foreach ($rows as $info) {
	    		$questionAccount = getAccountById($info->get_accountid());
	      		echo "
	        	<div class='form-group row questionBox'>
	        		<div class='col-md-2 userBox'>
	        			<label class ='username'>".$questionAccount->get_username()."</label><br>
		          		<button class='btn btn-like'><i class='fa fa-thumbs-o-up'></i></button>". $info->get_upvotes() . "
		          		<button class='btn btn-like'><i class='fa fa-thumbs-o-down'></i></button>". $info->get_downvotes() . "
	        		</div>
		        	<span class = 'questionBody'>
		        		<div class='col-md-10 '>
		          			<div>
		          				<h3><strong>" . $info->get_header() . "</strong></h3>
		        			</div>
		          			<p>" . $info->get_content() . "</p>
		          			<span class = 'time'>Posted on: " . $info->get_date() . "</span>
		        		</div>
		        	</span>
	      		</div><br>";
	    	}
	    	echo '</div>';
	    	$hasFavorite = true;
    	}

    	$rows = getFavouriteAnswers($account->get_id());
    	if($hasFavorite == false){
    		echo "
 				<div class='alert alert-warning margins'>
      				<h2>You have not favorited any questions or answers</h2>
      			</div>";
    	}
    	else{
	    	foreach ($rows as $info) {
	    		$questionAccount = getAccountById($info->get_accountid());
	      		echo "
	        	<div class='form-group row questionBox'>
	        		<div class='col-md-2 userBox'>
	        			<label class ='username'>".$questionAccount->get_username()."</label><br>
	          			<button class='btn btn-like'><i class='fa fa-thumbs-o-up'></i></button>". $info->get_upvotes() . "
	          			<button class='btn btn-like'><i class='fa fa-thumbs-o-down'></i></button>". $info->get_downvotes() . "
	        		</div>
	        	<span class = 'questionBody'>
	        		<div class='col-md-10 '>
	          			<div>
	          				<h3><strong>" . $info->get_header() . "</strong></h3>
	        			</div>
	          			<p>" . $info->get_content() . "</p>
	          			<span class = 'time'>Posted on: " . $info->get_date() . "</span>
	        		</div>
	        	</span>
	      		</div><br>";
	    	}
	    	echo '</div><br>';
    	}
  	}



 	include('footer.php');
?>