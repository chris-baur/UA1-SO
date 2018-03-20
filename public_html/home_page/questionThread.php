
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
	echo "<link rel='stylesheet' type='text/css' href='../css/homepage.css'>
		<link rel='stylesheet' type='text/css' href='../css/questionThread.css'>";

	// gets the questionid from the page before enterring this page and prints out the question, answers, and comments
	if (isset($_GET['questionid'])){
		$row = getQuestionsById($_GET['questionid']);

		// print out question block 
		$con = mysqli_connect($servername, $username, $password, $dbname) or die("Connection Failed");
		$questid= $_GET['questionid'];
		$result = mysqli_query($con,"SELECT accounts.username, questions.id FROM questions AS questions INNER JOIN accounts ON accounts.id=questions.account_id WHERE questions.id LIKE $questid");
		$acc = mysqli_fetch_array($result,MYSQLI_ASSOC);
		
		echo "<div class = 'container'>";
		// Output of the details of the question requested
		echo "
		<br>
		<div class= 'questionBlock'>
			<!-- ------------------------------------- Replace with upvotes and downvotes --------------------------- -->
			<!-- left column of question block -->
		    <div class= 'details'>
				Upvotes: ".$row[0]->getUpvotes().
				"Downvotes: ".$row[0]->getDownvotes()."
			</div>

			<!-- right column of question block -->
		    <div class='question'>
		        <h3><strong>".$row[0]->getHeader()."</strong></h3>
		        <p>".$row[0]->getContent()."</p>
		        <span class ='questionByDetail'>
			        Asked By: ".$acc["username"]."<br>
				  	Posted On: ".$row[0]->getDate()."<br>
		        </span>
		    </div>
	    </div><br>";

		// Output all answers corresponding to question
	    
		$answerRow = getAnswersByQuestionId($questid);
		foreach ($answerRow as $info){
			// Output of the details of the answers requested
			echo "
			<br>
			<div class= 'answerBlock'>

				<!-- ------------------------------------- Replace with upvotes and downvotes --------------------------- -->
				<!-- left column of question block -->
		        <div class= 'details'>
					Upvotes: ".$info->getUpvotes().
					  "Downvotes: ".$info->getDownvotes()."
				</div>

				<!-- right column of question block -->
		        <div class='question'>
		            <p>".$info->getContent()."</p>
		            <span class ='questionByDetail'>
			            Answered By: <br>
					  	Posted On: ".$info->getDate()."<br>
		            </span>
		        </div>
	    	</div><br>";

	    	// Output of the details of the comments requested
	    	$commentRow = getCommentsByAnswerQuestionId($info->getId(), $questid);
	    	foreach ($commentRow as $commentInfo){
	    		echo "
			<br>
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
			            Commented By: <br>
					  	Posted On: ".$commentInfo->getDate()."<br>
		            </span>
		        </div>
	    	</div><br>";
	    	}

		}

		echo "</div>";

	}

	else{
		echo "Question not found";
	}






	include('footer.php');
?>