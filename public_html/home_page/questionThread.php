<style>
<?php include '..\..\public_html\css\homepage.css'?>
</style>


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


	// gets the questionid from the page before enterring this page and prints out the question, answers, and comments
	if (isset($_GET['questionid'])){
		$row = getQuestionsById($_GET['questionid']);
?>

<!-- print out question block -->
<br>
	<div class= "questionBlock">
        <div class= "details">
            <!-- Output of the details of the comment and commenter -->

            <?php // connection to database
			    $con = mysqli_connect($servername, $username, $password, $dbname) or die("Connection Failed");
			    $questid= $_GET['questionid'];
			    $result = mysqli_query($con,"SELECT accounts.username, questions.id FROM questions AS questions INNER JOIN accounts ON accounts.id=questions.account_id WHERE questions.id LIKE $questid");
			    $acc = mysqli_fetch_array($result,MYSQLI_ASSOC);
			?>

            <?php echo "Asked By: ".$acc["username"]?><br>
            <?php echo "Posted on: ".$row[0]->get_date()?><br>
            <?php echo "Upvotes: ".$row[0]->get_upvotes()?>
            <?php echo "Downvotes: ".$row[0]->get_downvotes()?>

        </div>
        <div class="question">
            <h5><strong><?php echo $row[0]->get_header()?></strong></h5>
            <?php echo $row[0]->get_content()?><br>
        </div>
    </div>  
     
    <br>





<?php
	}

	else{
		echo "Question not found";
	}






	include('footer.php');
?>