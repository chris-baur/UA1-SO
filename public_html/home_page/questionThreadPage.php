
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
	require "../../private/models/Vote.php";
	echo "<link rel='stylesheet' type='text/css' href='../css/homepage.css'>
		<link rel='stylesheet' type='text/css' href='../css/questionThread.css'>";

	// gets the questionid from the page before enterring this page and prints out the question, answers, and comments
	if (isset($_GET['questionid'])){

		$questId= $_GET['questionid'];
		$votesQ=[];
		$votesA=[];

		$qtc = new QuestionThreadController();
		$questionThread = $qtc::getQuestionThread($questId);
		$row = $questionThread->getQuestion(); 

		// Imports the upvotes and downvotes of the user
		try{
            $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
          echo "Connection failed: " . $e->getMessage();
        }

      	if(isset($_SESSION['userid'])){

            $req = $pdo -> prepare("SELECT * FROM votes WHERE ref=? AND user_id=?");
            $req->execute (['questions',$_SESSION['userid']]);
            while($vote=$req->fetch()){
              array_push($votesQ, $vote);
        	}
        	$req->execute (['answers',$_SESSION['userid']]);
            while($vote=$req->fetch()){
              array_push($votesA, $vote);
        	}
        }
		
		echo "<div class = 'container'>";
		// Output of the details of the question requested

		$vote=getVote($votesQ,$row->getId());

	    if($questId==$vote['ref_id'])
	    	$vote_class=Vote::getClass($vote);
	    else
	    	$vote_class=Vote::getClass(false);

		echo "
		<br>
		<div class= 'questionBlock'>
		<div class='col-md-2 '>";
		$file_path=$questionThread->getQuestionFileName();
        if(!file_exists($file_path)) {
           	$file_path = "..\img\avatar2.png";                      
        };

        
            echo "<div class='col-md-10'><img class='circle_img' src=".$file_path."></div>


			<! ---------------------------- Left column of the Question Block ------------------------ -->
	            <div class='details vote_btns ".$vote_class." '>
  	            <form action= '..\..\private\models\Like.php?ref=questions&ref_id=".$row->getId()."&vote=1&page=questionThreadPage.php?questionid=".$row->getId()."'' method='POST'>
  	              <button type='submit' class='vote_btn vote_like' ";
  	              if(!isset($_SESSION['userid'])){
  	              	echo "disabled";
  	              }
  	            echo "><i class='fa fa-thumbs-up'> ". $row->getUpvotes() . "</i></button>
  	            </form>
  	            <form action='..\..\private\models\Like.php?ref=questions&ref_id=".$row->getId()."&vote=-1&page=questionThreadPage.php?questionid=".$row->getId()."' method='POST'>
  	              <button type='submit' class='vote_btn vote_dislike' ";
  	              if(!isset($_SESSION['userid'])){
  	              	echo "disabled";
  	              }
  	            echo "><i class='fa fa-thumbs-down'> ". $row->getDownvotes() . "</i></button>
  	              </form>
  	            </div>
  	            </div>

			<!------------------------------ right column of question block ------------------------------>
		    <div class='col-md-10 question'>
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
		$counter=0;
		if($answerRow != null){
			foreach ($answerRow as $info){
				echo "<div class = 'block'>";
				$answerInfo = $info->getAnswer();
				$voteA=getVote($votesA,$answerInfo->getId());				

				if($answerInfo->getId()==$voteA['ref_id'])
	    			$vote_class=Vote::getClass($voteA);
	    		else
	    			$vote_class=Vote::getClass(false);
				// Output of the details of the answers requested
				// get the array of comments
				$commentRow = $questionThread->getCommentThreadArray();
				
				echo "
				<br>
				<div class= 'answerBlock'>
				<div class='col-md-2 '>";
				$file_path=$info->getAnswerFileName();
		                if(!file_exists($file_path)) {
		                	$file_path = "..\img\avatar2.png";                      
		        };
		        echo "<div class='col-md-10'><img class='circle_img' src=".$file_path."></div>

				<! ---------------------------- Left column of the Answer Block ------------------------ -->
	            <div class='details vote_btns ".$vote_class." '>
  	            <form action= '..\..\private\models\Like.php?ref=answers&ref_id=".$answerInfo->getId()."&vote=1&page=questionThreadPage.php?questionid=".$row->getId()."'' method='POST'>
  	              <button type='submit' class='vote_btn vote_like' ";
  	              if(!isset($_SESSION['userid'])){
  	              	echo "disabled";
  	              }
  	            echo "><i class='fa fa-thumbs-up'> ". $answerInfo->getUpvotes() . "</i></button>
  	            </form>
  	            <form action='..\..\private\models\Like.php?ref=answers&ref_id=".$answerInfo->getId()."&vote=-1&page=questionThreadPage.php?questionid=".$row->getId()."' method='POST'>
  	              <button type='submit' class='vote_btn vote_dislike' ";
  	              if(!isset($_SESSION['userid'])){
  	              	echo "disabled";
  	              }
  	            echo "><i class='fa fa-thumbs-down'> ". $answerInfo->getDownvotes() . "</i></button>
  	              </form>
  	            </div></div>";

  	            echo "<!-- --------------------- right column of answer block ------------------------------- -->
			        <div class='question col-md-10'>
			            ".$answerInfo->getContent()."<br>
			            <span class ='questionByDetail'>
				            Answered By: ".$info->getAnswerName()."<br>
						  	Posted On: ".$answerInfo->getDate()."
						  	<a class='btn btn-link commentButton' data-toggle='collapse' href='#allComments".$counter."' role='button' aria-expanded='false' aria-controls='allComments".$counter."'>
						  	".sizeof($commentRow)."
							Comments
							</a>
			            </span>
			        </div>
			        </div>
		    	";

		    	// Output of the details of the comments requested
		    	echo "<div class='collapse' id='allComments".$counter."'>";
		    	
		    	if ($commentRow != null){
			    	foreach ($commentRow as $commentArrayInfo){
			    		$commentInfo = $commentArrayInfo->getComment();
			    		echo "
						
						<div class= 'commentBlock'>
					        <div class='comment'>
					            <p>".$commentInfo->getContent()."</p>
					            <span class ='questionByDetail'>
						            Commented By: ".$commentArrayInfo->getCommentName()."<br>
								  	Posted On: ".$commentInfo->getDate()."<br>
					            </span>
					        </div>
				    	</div>";
			    	}
			    }
		    	echo "</div></div><br>";
		    	$counter++;

			}
			// put input code here
		}
		
		// put input answer code here
	}
	else
		echo "Question not found";
	echo "</div>"; // div that closes the container class div



	//Verifie if the current question has a vote, if yes it returns it if not false
	function getVote($votes,$info_id){
	    foreach ($votes as $vote) {
	        if($vote['ref_id']==$info_id){
	        return $vote;
	    	}
		}
	    return false;
	}

	include('footer.php');
?>