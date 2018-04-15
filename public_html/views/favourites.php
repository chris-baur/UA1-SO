<?php
 	include('header.php');
 	include_once('../../private/controllers/FavouriteController.php');
 	include_once('../../private/controllers/Vote.php');
 	include_once('../../private/controllers/AccountController.php');
 	include_once('OutputBlock.php');

 	echo "
 	<link rel='stylesheet' type = 'text/css' href='../css/favorite.css'>
 	<link rel='stylesheet' type = 'text/css' href='../css/homepage.css'>
 	";

 	// controllers
	$fc = new FavouriteController();
	$ac = new AccountController();
	$ob = new OutputBlock();

  	// outputs all the favourited questions
	$votesQ=[];
	$votesA=[];

	// Get and print favourite questions
	$favouriteQuestionArray = $fc::getFavouriteQuestions($_SESSION['userid']);
	if(isset($favouriteQuestionArray)){
		echo "
			<div class= 'container'>
			<br>
			<h3>Favourite Questions</h3>";
		// Output all of current user's favorite questions
		foreach($favouriteQuestionArray as $favouriteQuestion){
			$vote=getVote($votesQ,$favouriteQuestion->getId());
			$account = $ac::getAccountById($favouriteQuestion->getAccountId());

	    if($favouriteQuestion->getId()==$vote['ref_id'])
	    	$voteClass=Vote::getClass($vote);
	    else
	    	$voteClass=Vote::getClass(false);

		echo "<br><div class= 'questionBlock'>";
		$filePath=$account->getProfilePicturePath();
        if(!file_exists($filePath))
           	$filePath = "..\img\avatar2.png";

        $returnLocation="favourites.php";
        $ob->outputBlock("questions", $favouriteQuestion, $voteClass, $filePath, $account->getUsername(), $returnLocation);
        echo "</div><br>";
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