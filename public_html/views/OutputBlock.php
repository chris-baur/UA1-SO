<?php

include_once(dirname(__FILE__).'../../../private/util/logging.php');
include_once(dirname(__FILE__).'../../../private/util/sets.php');
include_once(dirname(__FILE__).'../../../private/models/Question.php');
include_once(dirname(__FILE__).'../../../private/models/Answer.php');
include_once(dirname(__FILE__).'../../../private/models/Account.php');
include_once(dirname(__FILE__).'../../../private/controllers/FavouriteController.php');


class OutputBlock{
	private static $servername;
	private static $username;
	private static $password;
	private static $dbname;
	private static $log;

	function __construct(){
	    $config = parse_ini_file(dirname(__FILE__).'/../../config.ini');
	    
	    self::$servername = $config['servername'];
	    self::$username = $config['username'];
	    self::$password = $config['password'];
	    self::$dbname = $config['dbname'];

	    self::$log = new Logging();
	}

	/**
	* Outputs the question/answer
	*
	* @param $account		Account object
	*/

	static function outputBlock($outputType, $model, $voteClass, $filePath, $username, $returnLocation, $questionId = null, $commentCounter = null, $commentThread = null, $questionUserId = null){
		// Output if type is a question or answer
		if ($outputType == "answers" || $outputType == "questions"){

			

		    // --------------------------- LEFT SIDE ---------------------------
		    // output profile picture
	        echo "
            <div class='col-md-2 '>";

            if(!file_exists($filePath)) {
            	$filePath = "..\img\avatar2.png";                      
            };
            echo "<div class='col-md-10'><img class='circle_img' src=".$filePath."></div>";

            // Output the like and dislike buttons
            echo"
	        <div class='details vote_btns ".$voteClass." '>
  	        <form action= '.\Like.php?ref=".$outputType."&ref_id=".$model->getId()."&vote=1&page=".$returnLocation."' method='POST'>
  	        <button type='submit' class='vote_btn vote_like' ";
  	        	if(!isset($_SESSION['userid'])){
  	         		echo "disabled";
  	            }
  	        echo "><i class='fa fa-thumbs-up'> ". $model->getUpvotes() . "</i></button>
  	        </form>
  	        <form action='.\Like.php?ref=".$outputType."&ref_id=".$model->getId()."&vote=-1&page=".$returnLocation."' method='POST'>
  	        <button type='submit' class='vote_btn vote_dislike' ";
  	        	if(!isset($_SESSION['userid'])){
  	            	echo "disabled";
  	            }
  	        echo "><i class='fa fa-thumbs-down'> ". $model->getDownvotes() . "</i></button>
  	        </form>";
            
            //  ------------------------------------ Favourite Button --------------------------------------
            if(isset($_SESSION['userid'])){
            	$fc = new FavouriteController();
                $favouriteFound = false;
                

                if($outputType == "questions"){
                	$favouriteArray = $fc::getFavouriteQuestions($_SESSION['userid']);
                  if(isset($favouriteArray)){
                    foreach($favouriteArray as $fav){
                        if ($fav->getId() == $model->getId())
                          $favouriteFound = true;
                    }
                  }
                }
                else if($outputType == "answers"){
                	$favouriteArray = $fc::getFavouriteAnswers($_SESSION['userid'], $questionId);
                  if(isset($favouriteArray)){
                    $favouriteFound = true;
                  }
                }
                
                echo "<form method='post' action = 'newFavourite.php?returnLocation=".$returnLocation."'>
                  <input type = 'hidden' name = 'idType' value = questionId>
                  <input type ='hidden' name = 'id' value = ".$model->getId()." >
                  <input type ='hidden' name = 'accountId' value = ".$_SESSION['userid']." >";


                if($outputType=="questions"){
                  echo"<input type ='hidden' name = 'outputType' value = 'questions'>";
                  if($favouriteFound == 'true'){
                    echo "<input type ='hidden' name = 'found' value = true>";
                    echo"<button type='submit' class='favouriteButton fa fa-star isFavourited custom-fa' aria-hidden='true'></button>";
                  }
                  else
                    echo "<input type ='hidden' name = 'found' value = false>
                      <button type='submit' class='favouriteButton fa fa-star isNotFavourited' aria-hidden='true'></button>";
                }
                else if($outputType=="answers" && $_SESSION['userid']==$questionUserId){
                  echo"<input type ='hidden' name = 'outputType' value = 'answers'>
                    <input type = 'hidden' name = 'questionId' value = ".$model->getQuestionId().">";
                  if($favouriteFound == 'true'){
                    if($model->getId()==$favouriteArray[0]->getId()){
                      echo "<input type ='hidden' name = 'found' value = true>";
                      echo"<button type='submit' class='favouriteButton fa fa-star isFavourited custom-fa' aria-hidden='true'></button>";
                    }
                    else{
                      echo "<input type ='hidden' name = 'found' value = true>
                        <input type ='hidden' name = 'isNotFavouriteAnswer' value = true>
                        <button type='submit' class='favouriteButton fa fa-star isNotFavourited' aria-hidden='true'></button>";
                    }
                  }
                  else
                    echo "<input type ='hidden' name = 'found' value = false>
                    <button type='submit' class='favouriteButton fa fa-star isNotFavourited' aria-hidden='true'></button>";
                }
                echo "</form>";

            }

            // ------------------------- RIGHT SIDE ------------------------------

  	        echo "
  	        </div></div>
  	        <div class='col-md-10 question'>
  	        <div>
  	        <a href='questionThreadPage.php?questionId=".$model->getId()."'>";

            if($outputType == "questions")
              echo "<h3><strong>" . $model->getHeader() . "</strong></h3></a>";
            else
              echo "</a>";

  	        echo "</div>
  	        <p>" . $model->getContent() . "
  	        </p>
  	        <span class = questionByDetail>Asked By: " .$username. "<br>
  	        Posted on: " . $model->getDate();

            if($outputType == "answers"){
            echo"
            <a class='btn btn-link commentButton' data-toggle='collapse' href='#commentThread".$commentCounter."' role='button' aria-expanded='false' aria-controls='commentThread".$commentCounter."'>
              ".sizeof($commentThread)."
              Comments
              </a>";
            }



              echo "
            </span>
	        </div>";
		}

		// Output if type is a comment

	}



}

?>