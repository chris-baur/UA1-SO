<?php
	include_once('..\..\private\controllers\FavouriteController.php');
	include_once('..\..\private\models\Favourite.php');

	$fc = new FavouriteController();
	

	if($_POST['foundQuestion'] == 'true'){
		$fc::deleteFavouriteQuestion($_POST['accountId'],$_POST['questionId']);

	}

	else{
		$newFavourite = new Favourite();
		$newFavourite->setAccountId($_POST['accountId']);
		$newFavourite->setQuestionId($_POST['questionId']);
		$fc::addFavourite($newFavourite);
		
	}

	header("Location: ".$_GET[returnLocation]."");


?>