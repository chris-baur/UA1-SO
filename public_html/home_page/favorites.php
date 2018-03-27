<?php
 	include('header.php');
 	include_once('../../private/controllers/account_controller.php');
 	include_once('../../private/controllers/FavouriteController.php');
 	include_once('../../private/controllers/Vote.php');
 	include_once('../../private/controllers/AccountController.php');


 	echo "
 	<link rel='stylesheet' type = 'text/css' href='../css/favorite.css'>
 	<link rel='stylesheet' type = 'text/css' href='../css/homepage.css'>
 	";

 	// outputs a warning message when user is not logged into an account

 	if( !isset($_SESSION['username']) || !isset($_SESSION['userid'])){     
    	echo "<main><div class='alert alert-warning margins'>
      		<h2><strong>Warning!</h2></strong><h2>You are not logged in</h2><h2>Please login to see your Favorites</h2>
      		<h2>Thank you</h2>
      </div></main>";
  	}
  	else{
  		$votesQ=[];
  		$votesA=[];

  		$fc = new FavouriteController();
  		$ac = new AccountController();


  		// Get and print favourite questions
  		$favouriteQuestionArray = $fc::getFavouriteQuestions($_SESSION['userid']);
  		if(isset($favouriteQuestionArray)){
	  		echo "
	  			<div class= 'container'>
	  			<br>
	  			<h3>Favourite Questions</h3>";
	  		foreach($favouriteQuestionArray as $favouriteQuestion){
	  			$vote=getVote($votesQ,$favouriteQuestion->getId());
	  			$account = $ac::getAccountById($favouriteQuestion->getAccountId());

			    if($favouriteQuestion->getId()==$vote['ref_id'])
			    	$vote_class=Vote::getClass($vote);
			    else
			    	$vote_class=Vote::getClass(false);

				echo "
				<br>
				<div class= 'questionBlock'>
				<div class='col-md-2 '>";
				$file_path=$account->getProfilePicturePath();
		        if(!file_exists($file_path)) {
		           	$file_path = "..\img\avatar2.png";                      
		        };

		        
		            echo "<div class='col-md-10'><img class='circle_img' src=".$file_path."></div>


					<! ---------------------------- Left column of the Question Block ------------------------ -->
			            <div class='details vote_btns ".$vote_class." '>
		  	            <form action= '.\Like.php?ref=questions&ref_id=".$favouriteQuestion->getId()."&vote=1&page=questionThreadPage.php?questionid=".$favouriteQuestion->getId()."'' method='POST'>
		  	              <button type='submit' class='vote_btn vote_like' ";
		  	              if(!isset($_SESSION['userid'])){
		  	              	echo "disabled";
		  	              }
		  	            echo "><i class='fa fa-thumbs-up'> ". $favouriteQuestion->getUpvotes() . "</i></button>
		  	            </form>
		  	            <form action='.\Like.php?ref=questions&ref_id=".$favouriteQuestion->getId()."&vote=-1&page=questionThreadPage.php?questionid=".$favouriteQuestion->getId()."' method='POST'>
		  	              <button type='submit' class='vote_btn vote_dislike' ";
		  	              if(!isset($_SESSION['userid'])){
		  	              	echo "disabled";
		  	              }
		  	            echo "><i class='fa fa-thumbs-down'> ". $favouriteQuestion->getDownvotes() . "</i></button>
		  	              </form>";



		  	            // 	------------------------------------ Favourite Button --------------------------------------
			    
			    

					    if(isset($_SESSION['userid'])){
							$fc = new FavouriteController();
					    	$favouriteQuestionFound = false;
					    	$favouriteQuestionArray = $fc::getFavouriteQuestions($_SESSION['userid']);
					    	if (isset($favouriteQuestionArray)){
						    	foreach($favouriteQuestionArray as $favouriteQuestion){
						    		if ($favouriteQuestion->getId() == $favouriteQuestion->getId()){
						    			$favouriteQuestionFound = true;
						    		}
						    	}
					    	}

					    	if($favouriteQuestionFound == true){
					    		echo "
					    			<form method='post' action = 'newFavouritePage.php'>
								  		<input type ='hidden' name = 'questionId' value = ".$favouriteQuestion->getId()." >
								  		<input type ='hidden' name = 'accountId' value = ".$_SESSION['userid']." >
								  		<input type ='hidden' name = 'foundQuestion' value = true>

								  		<button type='submit' class='favouriteButton fa fa-star isFavourited custom-fa' aria-hidden='true'></button>
								  	</form>";
					    	}

					    	else{
					    		echo "
					    			<form method='post' action = 'newFavouritePage.php'>
								  		<input type ='hidden' name = 'questionId' value = ".$favouriteQuestion->getId()." >
								  		<input type ='hidden' name = 'accountId' value = ".$_SESSION['userid']." >
								  		<input type ='hidden' name = 'foundQuestion' value = false>

								  		<button type='submit' class='favouriteButton fa fa-star isNotFavourited' aria-hidden='true'></button>
								  	</form>";
					    	}

					    }







		  	            echo "</div></div>

					<!------------------------------ right column of question block ------------------------------>
				    <div class='col-md-10 question'>
				    	<a href='questionThreadPage.php?questionid=".$favouriteQuestion->getId()."'>
				        <h3><strong>".$favouriteQuestion->getHeader()."</strong></h3>
				        </a>
				        <p>".$favouriteQuestion->getContent()."</p>
				        <span class ='questionByDetail'>
					        Asked By: ".$account->getUsername()."<br>
						  	Posted On: ".$favouriteQuestion->getDate()."<br>
				        </span>
				    </div>
			    </div>";


	  		}
	  		echo "</div>";
  		}
  		else{
  			echo "
	  			<main>
	  			<div class='alert alert-warning margins'>
	      			<h2>You dont have any questions favourited</h2>
	     		</div></main>";
  		}








  	}
  	function getVote($votes,$info_id){
      foreach ($votes as $vote) {
        if($vote['ref_id']==$info_id){
          return $vote;
        }
      }
      return false;
    }



 	include('footer.php');
?>