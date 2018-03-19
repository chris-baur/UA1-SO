
<?php
	// connection details
	$config = parse_ini_file('../../config.ini');
	$username = $config['username'];
    $password = $config['password'];
    $dbname = $config['dbname'];
    $servername = $config['servername'];
	include('header.php');
	include_once('..\..\private\controllers\question_controller.php');
	include_once("..\..\private\models\Question.php");
	echo "<link rel='stylesheet' type='text/css' href='../css/homepage.css'>";

	// gets the questionid from the page before enterring this page and prints out the question, answers, and comments
	if (isset($_GET['questionid'])){
		$row = getQuestionsById($_GET['questionid']);

	// print out question block 
	$con = mysqli_connect($servername, $username, $password, $dbname) or die("Connection Failed");
	$questid= $_GET['questionid'];
	$result = mysqli_query($con,"SELECT accounts.username, questions.id FROM questions AS questions INNER JOIN accounts ON accounts.id=questions.account_id WHERE questions.id LIKE $questid");
	$acc = mysqli_fetch_array($result,MYSQLI_ASSOC);
	
	// Output of the details of the question requested
	echo "
		<br>
		<div class= 'questionBlock'>

			<!-- left column of question block -->
	        <div class= 'details'>
				Upvotes: ".$row[0]->get_upvotes().
				  "Downvotes: ".$row[0]->get_downvotes()."
			</div>

			<!-- right column of question block -->
	        <div class='question'>
	            <h3><strong>".$row[0]->get_header()."</strong></h3>
	            <p>".$row[0]->get_content()."</p>
	            <span class ='questionByDetail'>
		            Asked By: ".$acc["username"]."<br>
				  	Posted On: ".$row[0]->get_date()."<br>
	            </span>
	        </div>
    	</div><br>";

	}

	else{
		echo "Question not found";
	}






	include('footer.php');
?>