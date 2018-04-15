<?php

	$status = session_status();
	if($status == PHP_SESSION_NONE){
		//There is no active session
		session_start();
	}

	include_once("../../private/util/logging.php");
	$log = new Logging();
	$invalidArray;
	//$id = $_SESSION['userid'];
	$log->lwrite("In new question.php. top of the file");

	if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['userid'])){
		$log->lwrite("POST METHOD. for newQuestion.php");
		
		include("../../private/controllers/account_controller.php");
		include("../../private/controllers/question_controller.php");

		submitQuestion();

		
	}
	else if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_SESSION['userid'])){
		$log->lwrite("GET METHOD. for newQuestion.php");
		include("header.php");
		
		echo "<script src='http://mbenford.github.io/ngTagsInput/js/ng-tags-input.min.js'></script>
 			<script src='../js/newQuestion.js'></script>
 			<link rel='stylesheet' href='http://mbenford.github.io/ngTagsInput/css/ng-tags-input.min.css' />
		 	<link rel='stylesheet' type='text/css' href='../css/questions_page.css'>";
		 
		 echo "<!--Body-->
			<form method='post' action='?'>
				<div class='container' ng-app='newQuestion' ng-controller='QuestionController'>
					<div class='form-control space'>
						<span class='col-lg-2'>Tilte  </span>
						<input class='col-lg-10' type='text' placeholder='Title of your question' name='header' 
						ng-model='question_title' required>		
					</div>
					<div class='form-control space'>
						<textarea class='form-control' rows='10' name='content'
						ng-model='content' maxlength = '500' required></textarea>
					</div>
					
					<div class='space'>
						<button ng-disabled='allowSubmit()' type='submit' class='btn btn-primary btn-md'> Ask it! </button>
					</div>
				</div>
			</form>";

	$log->lwrite("echoed body of the form");

	//footer
	include("footer.php");

	}
	else{
		$log->lwrite('session userid not set');
	}

	function submitQuestion(){
		global $log;
		$id;
		$account_id;
		$question_title;
		$content;
		$log->lwrite("Inside submit question");
		
		if(validate('header') && validate('content')){
			$question_title = $_POST['header'];
			$content = $_POST['content'];
			$log->lwrite("header and content are set by POST");
			
			// if(isset($_SESSION['userid'])){

			// 	//$id= -1;//$_SESSION['userid'];
			// 	//$account_id=$_SESSION['userid']; //here shoul go the current account ID 
				$log->lwrite("session user id is set: " . $_SESSION['userid']);
				
			// }		
			
			$tags=array('java','default');
			$upvotes=0;
			$downvotes=0;
			$date=date("Y-m-d H:i:s");

			$newQuestion=new Question(-1,$_SESSION['userid'],$question_title,$content,$date,$upvotes,$downvotes,$tags);
			$log->lwrite("Question has been made");		

			$log->lwrite("about to use function in question controller to add the question");		
			$response=addQuestion($newQuestion);
			$log->lwrite("after adding the question to the database. Before redirecting to my questions");		
			header("Location: myquestions.php");
		}
		else{
			setcookie('invalidArray', json_encode($invalidArray), time()+20);
			header("Location: newQuestion.php");
		}
	}

	function validate($string){
		global $invalidArray;
		if(!(empty($_POST[$string])) && isset($_POST[$string]) && IS_STRING($_POST[$string]))
			return true;
		else{
			$invalidArray[$string] = 'invalid';
			return false;
		}
	}
?>