<?php
	include_once('..\..\private\controllers\FavouriteController.php');
	include_once('..\..\private\controllers\AnswerController.php');
	include_once('..\..\private\models\Favourite.php');
	include_once('..\..\private\util\logging.php');

	$fc = new FavouriteController();
	$log = new logging();
	$ac = new AnswerController();

	$favouriteAnswer= null;
	if($_POST['found'] == 'true'){
		if($_POST['outputType'] == 'questions')
			$fc::deleteFavouriteQuestion($_POST['accountId'],$_POST['id']);
		else if($_POST['outputType'] == "answers"){
			if($_POST['isNotFavouriteAnswer'] == 'true')
				$favouriteAnswer = "&favouriteAnswer=true";
			else {
				$fc::deleteFavouriteAnswer($_POST['accountId'],$_POST['id']);
				$favouritedAnswer = $ac->getAnswerById($_POST['id']);
				$favouritedAnswer->setBest('0');
				$ac->updateAnswer($favouritedAnswer);
			}
		}
	}

	else{
		$newFavourite = new Favourite();
		$newFavourite->setAccountId($_POST['accountId']);

		if ($_POST['outputType'] == "answers"){
			$newFavourite->setAnswerId($_POST['id']);
			$newFavourite->setQuestionId($_POST['questionId']);
			$favouritedAnswer = $ac->getAnswerById($_POST['id']);
			$favouritedAnswer->setBest('1');
			$ac->updateAnswer($favouritedAnswer);
			$log->lwrite("new favourite answer, best: ".$favouritedAnswer->getBest()." Id: ".$_POST['id']);
		}
		else{
			$newFavourite->setQuestionId($_POST['id']);
			$log->lwrite("new favourite question");
		}
		$fc::addFavourite($newFavourite);
		
	}

	header("Location: ".$_GET[returnLocation]."".$favouriteAnswer);


?>