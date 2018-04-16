
<?php
	// connection details
	$config = parse_ini_file('../../config.ini');
	$username = $config['username'];
    $password = $config['password'];
    $dbname = $config['dbname'];
    $servername = $config['servername'];
	include('header.php');
	include_once('OutputBlock.php');
	include_once('..\..\private\models\Question.php');
	include_once('..\..\private\models\Answer.php');
	include_once('..\..\private\models\Comment.php');
	include_once('..\..\private\controllers\QuestionThreadController.php');
	include_once('..\..\private\controllers\FavouriteController.php');
	include_once('..\..\private\models\Favourite.php');
	require "../../private/controllers/Vote.php";
	echo "<link rel='stylesheet' type='text/css' href='../css/homepage.css'>
		<link rel='stylesheet' type='text/css' href='../css/questionThread.css'>";

	// output warning message if user
	if(isset($_GET['favouriteAnswer'])){
		echo"<div class='favourite-warning alert-warning'>
  		<h2>Please unfavourite old favourited answer first before favouriting a new one</h2>
		</div>";
	}

	// gets the questionId from the page before enterring this page and prints out the question, answers, and comments
	if (isset($_GET['questionId'])){

		$questId= $_GET['questionId'];
		$votesQ=[];
		$votesA=[];

		$qtc = new QuestionThreadController();
		$ob = new OutputBlock();
		$questionThread = $qtc::getQuestionThread($questId);
		$question = $questionThread->getQuestion(); 

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

		$vote=getVote($votesQ,$question->getId());

	    if($questId==$vote['ref_id'])
	    	$voteClass=Vote::getClass($vote);
	    else
	    	$voteClass=Vote::getClass(false);

        
		echo "
		<br>
		<h3>Question</h3>
		<div class= 'questionBlock'>";
		$filePath=$questionThread->getQuestionFileName();
        if(!file_exists($filePath)) {
           	$filePath = "..\img\avatar2.png";                      
        };

        $returnLocation = "questionThreadPage.php?questionId=".$_GET['questionId'];


        // ------------------------------ Outputting the requested question --------------------------
        $ob->outputBlock("questions", $question, $voteClass, $filePath, $questionThread->getQuestionName(), $returnLocation);
        
        echo "</div><hr>";

	    // Adding Answers
	    if(isset($_SESSION['username'])){
		    echo"
		    <button class='newAnswerButton' type='button' data-toggle='collapse' data-target='#newAnswer' aria-expanded='false' aria-controls='newAnswer'>
	    	Answer Question
	  		</button><hr>";

	  		// Contents inside the Add Answer Button
		  	echo"	
		  	<div class='collapse' id='newAnswer'>
		  	
		  	<form method='post' action = 'newAnswer.php'>
		  		<input class = 'answerForm' type='text' name = 'answerContent' required><br>
		  		<input type ='hidden' name = 'questionId' value = ".$question->getId()." >
		  		<input type ='hidden' name = 'accountId' value = ".$_SESSION['userid']." >

		  		<button type='submit' class='subButton'>Submit Answer</button>
		  	</form>

			</div>";
		}


		
		// Output all answers corresponding to question
	    
		$answerArrayElementThread = $questionThread->getAnswerThreadArray();
		$counter=0;
		if($answerArrayElementThread != null){
			$answerArrayCounter=0;
			foreach ($answerArrayElementThread as $answerArrayElement){
				echo "<div class = 'block'>";
				$answer = $answerArrayElement->getAnswer();
				$voteA=getVote($votesA,$answer->getId());				

				if($answer->getId()==$voteA['ref_id'])
	    			$voteClass=Vote::getClass($voteA);
	    		else
	    			$voteClass=Vote::getClass(false);
				// Output of the details of the answers requested
				
	    		$commentArray=[];
	    		$commentThread=$questionThread->getCommentThreadArray();
	    		// get the array of comments for current answer
	    		if(isset($commentThread)){
					for($id=0;$id<sizeof($commentThread);$id++){
						if(($commentThread[$id]->getComment()->getAnswerId())==$answer->getId()){
							$comment=$commentThread[$id];
							array_push($commentArray,$comment);
						}
					}
				}
				$filePath=$answerArrayElement->getAnswerFileName();
                if(!file_exists($filePath))
                	$filePath = "..\img\avatar2.png";


				if($answer->getBest() == '1'){
					echo "<br><h3>Asker's Favourite Answer</h3>";
			        echo "<div class= 'answerBlock answer-favourite'>";
			        $ob->outputBlock("answers", $answer, $voteClass, $filePath, $answerArrayElement->getAnswerName(), $returnLocation, $_GET['questionId'], $counter, $commentArray, $question->getAccountId());
		        	echo "</div>";
		    	}
		    	else{
		    		if($answerArrayCounter=='0')
		    			echo "<h3>Answers</h3>";
		    		echo "<div class= 'answerBlock'>";
		    		$ob->outputBlock("answers", $answer, $voteClass, $filePath, $answerArrayElement->getAnswerName(), $returnLocation, $_GET['questionId'], $counter, $commentArray, $question->getAccountId());
		        	echo "</div>";
		    		$answerArrayCounter++;
		    	}



		    	// Output of the details of the comments requested
		    	echo "<div class='collapse' id='commentThread".$counter."'>";
		    	
		    	if ($commentArray != null){
			    	$commentCounter=0;
			    	foreach ($commentArray as $commentArrayInfo){
			    		$commentInfo = $commentArrayInfo->getComment();
			    		$commentID="comment".$commentCounter;
			    		$buttonID="edit".$commentCounter;
			    		$paragraphID="paragraph".$commentCounter;
			    		$cancelID="cancel".$commentCounter;
			    		echo "
						
						<div class='commentBlock'>

							<!-- right column of comment block -->
					        <div class='comment'>
					            <div>
					            <textarea class='form-control editText' maxlength='250' style='display: none;' id='".$commentID."'>".$commentInfo->getContent()."</textarea>
					            <div id='".$paragraphID."'>".$commentInfo->getContent()."</div>
					            <button id='".$buttonID."' style='display: none;' type='button' class='btn subButton ' 
					            		onClick='updateComment(".$commentID.",".$buttonID.",".$cancelID.",".$paragraphID.",".$commentInfo->getId().")'> Submit edit </button>
					            <button id='".$cancelID."' style='display: none;' type='button' class='btn subButton ' 
					            		onClick='cancel(".$commentID.",".$buttonID.",".$cancelID.",".$paragraphID.")'>Cancel</button>		
					            
					            ";
					            if(isset($_SESSION['username'])){
					            	if($_SESSION['username']==$commentArrayInfo->getCommentName()){					            		
					            	echo "
						            <div class='utilities_btns'>								            
								            <button 
								            type='button' data-toggle='tooltip' title='Edit' 
								            		class='edit_btn' type='submit' name='Edit' value='Edit'
								            		onClick='editElement(".$commentID.",".$buttonID.",".$cancelID.",".$paragraphID.")'>
								            <i class='fa fa-pencil'></i>
								            </button>
								            <button type='button' data-toggle='tooltip' title='Delete' 
								            		class='delete_btn' type='submit' name='Delete' value='Delete'
								            		onClick='deleteElement(".$commentInfo->getId().")'>
								            	<i class='fa fa-trash'></i>
								            </button>
						            </div>
						            <script language='javascript'>
						            function deleteElement(elementId){
						            	if(confirm('Do you want to delete!')){
						            		window.location.href='delete.php?del_id='+elementId+'&page=questionThreadPage.php?questionId=".$question->getId()."';
						            		return true;
						            	}
						            }
						            
						            function editElement(elementId,buttonID,cancelID,paragraphID){						            	
						            	elementId.style.display='inline-block';
						            	cancelID.style.display='inline-block';
						            	buttonID.style.display='inline-block';
						            	paragraphID.style.display='none';
			            	
						            }

						            function cancel(elementId,buttonID,cancelID,paragraphID){						            	
						            	elementId.style.display='none';
						            	elementId.value=paragraphID.innerHTML;
						            	cancelID.style.display='none';
						            	buttonID.style.display='none';
						            	paragraphID.style.display='inline-block';
			            	
						            }

						            function updateComment(elementId,buttonID,cancelID,paragraphID,commentID){
						            	var newComment = elementId.value;   
									    paragraphID.innerHTML= newComment;									     
									    elementId.style.display='none';								    
									    buttonID.style.display='none';
									    cancelID.style.display='none';
									    paragraphID.style.display='inline-block';
									    var ajaxurl = 'edit.php',
								        data =  {'action': 'update','content':newComment,'commentId':commentID};
								        $.post(ajaxurl, data, function (response) {
								            alert('comment updated successfully');
								        });
						            }
						            </script>";
						        	}
						        }
						    	echo "</div>
					            
					            <span class ='questionByDetail'>
						            Commented By: ".$commentArrayInfo->getCommentName()."<br>
								  	Posted On: ".$commentInfo->getDate()."<br>
					            </span>
					        </div>
				    	</div>";
				    	$commentCounter++;
			    	}
			    	// new comment
			    	if(isset($_SESSION['username'])){
					    echo"
					    <span class= 'hasComment'>
					    <button class='newCommentButton' type='button' data-toggle='collapse' data-target='#newComment".$counter."' aria-expanded='false' aria-controls='newComment".$counter."'>
					    Add Comment
				  		</button>";


				  		// Contents inside the Add Answer Button
					  	echo"	
					  	<div class='collapse' id='newComment".$counter."'>
					  	
					  	<form method='post' action = 'newComment.php'>
					  		<input class = 'answerForm hasComment' type='text' name = 'commentContent' required><br>
					  		<input type='hidden' name='questionId' value = ".$question->getId()." >
					  		<input type='hidden' name='accountId' value = ".$_SESSION['userid']." >
					  		<input type='hidden' name='answerId' value = ".$answer->getId().">


					  		<button type='submit' class='subButton inside'>Submit Comment</button>
					  	</form>

						</div>
						</span>";
					}

			    }

			    // if there is no comment, the new question button will be here
			    else{
			    	if(isset($_SESSION['username'])){
					    echo"
					    <button class='newCommentButton' type='button' data-toggle='collapse' data-target='#newComment".$counter."' aria-expanded='false' aria-controls='newComment".$counter."'>
				    	Add Comment
				  		</button>";


				  		// Contents inside the Add Answer Button
					  	echo"	
					  	<div class='collapse' id='newComment".$counter."'>
					  	
					  	<form method='post' action = 'newComment.php'>
					  		<input class = 'answerForm' type='text' name = 'commentContent' required><br>
					  		<input type='hidden' name='questionId' value = ".$question->getId()." >
					  		<input type='hidden' name='accountId' value = ".$_SESSION['userid']." >
					  		<input type='hidden' name='answerId' value = ".$answer->getId().">


					  		<button ng-disabled='allowSubmit()' type='submit' class='subButton'>Submit Comment</button>
					  	</form>

						</div>";
					}

			    }
		    	echo "</div></div><br><br>";
		    	$counter++;
			}
		}
		
	}
	else
		echo "Question not found";
	echo "</div>"; // div that closes the container class div


	//Verifie if the current question has a vote, if yes it returns it if not false
	function getVote($votes,$answerArrayElement_id){
	    foreach ($votes as $vote) {
	        if($vote['ref_id']==$answerArrayElement_id){
	        return $vote;
	    	}
		}
	    return false;
	}

	include('footer.php');
?>