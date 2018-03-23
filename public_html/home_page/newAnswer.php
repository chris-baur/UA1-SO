<?php
	
	include_once('..\..\private\models\Answer.php');
	include_once('..\..\private\controllers\answer_controller.php');

	if(isset($_POST['answerContent'])){
		if(validateString('answerContent') && validateId('accountId') && validateId('questionId')){
			$answerObject = new Answer();
			$answerObject->setAccountId($_POST['accountId']);
			$answerObject->setQuestionId($_POST['questionId']);
			$answerObject->setContent($_POST['answerContent']);
			$answerObject->setDate(date("Y-m-d H:i:s"));
			$answerObject->setBest(0);

			addAnswer($answerObject);
		}
	}

	header("Location: questionThreadPage.php?questionid=".$_POST['questionId']);

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

		if(!(empty($_POST[$id])) && isset($_POST[$id]) && is_numeric($_POST[$id]) && $_POST[$id] >= 0){
    		$log->lwrite('valid id here');
			return true;
		}
		else
			return false;
	}
?>