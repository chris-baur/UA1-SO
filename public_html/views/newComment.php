<?php


	include_once('..\..\private\models\Comment.php');
	include_once('..\..\private\controllers\comment_controller.php');
	include_once '..\..\private\util\logging.php';

    $log = new Logging();

	if(isset($_POST['commentContent'])){
		if(validateString('commentContent') && validateId('accountId') && validateId('questionId') && validateId('answerId')){
    	$log->lwrite('valid data');
			$commentObject = new Comment();
			$commentObject->setAccountId($_POST['accountId']);
			$commentObject->setQuestionId($_POST['questionId']);
			$commentObject->setContent($_POST['commentContent']);
			$commentObject->setAnswerId($_POST['answerId']);
			$commentObject->setDate(date("Y-m-d H:i:s"));

			addComment($commentObject);
    		$log->lwrite('added comment');

		}
	}

	header("Location: questionThreadPage.php?questionId=".$_POST['questionId']);



	function validateString($string){
		global $log;

	    if(!(empty($_POST[$string])) && isset($_POST[$string]) && IS_STRING($_POST[$string])){
    		$log->lwrite('valid string');
	        return true;
	    }
	    else
	        return false;
	}

	function validateId($id){
		global $log;
    		$log->lwrite('Checking ID: ' . $id);

		if(!(empty($_POST[$id])) && isset($_POST[$id]) && is_numeric($_POST[$id]) && ($_POST[$id]) >= 0){
    		$log->lwrite('valid id');
			return true;
		}
		else
			return false;
	}

?>

