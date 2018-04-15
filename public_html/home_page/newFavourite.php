<?php
	include_once('..\..\private\controllers\FavouriteController.php');
	include_once('..\..\private\models\Favourite.php');
	include_once('..\..\private\util\logging.php');

	$fc = new FavouriteController();
	$log = new logging();

	$favouriteAnswer= null;
	if($_POST['found'] == 'true'){
		if($_POST['outputType'] == 'questions')
			$fc::deleteFavouriteQuestion($_POST['accountId'],$_POST['id']);
		else if($_POST['outputType'] == "answers"){
			if($_POST['isNotFavouriteAnswer'] == 'true')
				$favouriteAnswer = "&favouriteAnswer=true";
			else 
				$fc::deleteFavouriteAnswer($_POST['accountId'],$_POST['id']);
		}
	}

	else{
		$newFavourite = new Favourite();
		$newFavourite->setAccountId($_POST['accountId']);

		if ($_POST['outputType'] == "answers"){
			$newFavourite->setAnswerId($_POST['id']);
			$newFavourite->setQuestionId($_POST['questionId']);
			$log->lwrite("new favourite answer");
		}
		else{
			$newFavourite->setQuestionId($_POST['id']);
			$log->lwrite("new favourite question");
		}
		$fc::addFavourite($newFavourite);
		
	}

	header("Location: ".$_GET[returnLocation]."".$favouriteAnswer);


?>