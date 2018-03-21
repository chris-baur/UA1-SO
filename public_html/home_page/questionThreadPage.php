
<?php
	// connection details
	$config = parse_ini_file('../../config.ini');
	$username = $config['username'];
    $password = $config['password'];
    $dbname = $config['dbname'];
    $servername = $config['servername'];
	include('header.php');
	include_once('..\..\private\controllers\question_controller.php');
	include_once('..\..\private\controllers\answer_controller.php');
	include_once('..\..\private\controllers\comment_controller.php');
	include_once('..\..\private\models\Question.php');
	include_once('..\..\private\models\Answer.php');
	include_once('..\..\private\models\Comment.php');
	include_once('..\..\private\controllers\QuestionThreadController.php');
	echo "<link rel='stylesheet' type='text/css' href='../css/homepage.css'>
		<link rel='stylesheet' type='text/css' href='../css/questionThread.css'>";

	// gets the questionid from the page before enterring this page and prints out the question, answers, and comments
	if (isset($_GET['questionid'])){

		$questId= $_GET['questionid'];

		$qtc = new QuestionThreadController();
		$questionThread = $qtc::getQuestionThread($questId);
		$row = $questionThread->getQuestion(); 

		
		echo "<div class = 'container'>";
		// Output of the details of the question requested
		echo "
		<br>
		<div class= 'questionBlock'>
			<!-- ------------------------------------- Replace with upvotes and downvotes --------------------------- -->
			<!-- left column of question block -->
		    <div class= 'details'>
				Upvotes: ".$row->getUpvotes().
				"Downvotes: ".$row->getDownvotes()."
			</div>

			<!-- right column of question block -->
		    <div class='question'>
		        <h3><strong>".$row->getHeader()."</strong></h3>
		        <p>".$row->getContent()."</p>
		        <span class ='questionByDetail'>
			        Asked By: ".$questionThread->getQuestionName()."<br>
				  	Posted On: ".$row->getDate()."<br>
		        </span>
		    </div>
	    </div><br><hr>";

		// Output all answers corresponding to question
	    
		$answerRow = $questionThread->getAnswerThreadArray();
		if($answerRow != null){
			foreach ($answerRow as $info){
				// Output of the details of the answers requested
				$answerInfo = $info->getAnswer();
				echo "
				<br>
				<div class= 'answerBlock'>

					<!-- ------------------------------------- Replace with upvotes and downvotes --------------------------- -->
					<!-- left column of question block -->
			        <div class= 'details'>
						Upvotes: ".$answerInfo->getUpvotes().
						  "Downvotes: ".$answerInfo->getDownvotes()."
					</div>

					<!-- right column of question block -->
			        <div class='question'>
			            <p>".$answerInfo->getContent()."</p>
			            <span class ='questionByDetail'>
				            Answered By: ".$info->getAnswerName()."<br>
						  	Posted On: ".$answerInfo->getDate()."<br>
			            </span>
			        </div>
		    	</div>";

		    	// Output of the details of the comments requested
		    	$commentRow = $questionThread->getCommentThreadArray();
		    	if ($commentRow != null){
			    	foreach ($commentRow as $commentArrayInfo){
			    		$commentInfo = $commentArrayInfo->getComment();
			    		echo "
						
						<div class= 'commentBlock'>

							<!-- ------------------------------------- Replace with upvotes and downvotes --------------------------- -->
							<!-- left column of question block -->
					        <div class= 'details'>
								Upvotes: ".$commentInfo->getUpvotes().
								  "Downvotes: ".$commentInfo->getDownvotes()."
							</div>

							<!-- right column of question block -->
					        <div class='question'>
					            <p>".$commentInfo->getContent()."</p>
					            <span class ='questionByDetail'>
						            Commented By: ".$commentArrayInfo->getCommentName()."<br>
								  	Posted On: ".$commentInfo->getDate()."<br>
					            </span>
					        </div>
				    	</div>";
			    	}
			    }
		    	echo "<br>";
			}
		}
		
	}
	else
		echo "Question not found";
	echo "</div>"; // div that closes the container class div





	include('footer.php');
?>