<?php 
  include_once('..\..\private\util\logging.php');
  $config = parse_ini_file('..\..\..\UA1-SO\config.ini');
  require "../../private/controllers/Vote.php";

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $log->lwrite("POST METHOD. for homepage.php");
  }
  else if($_SERVER["REQUEST_METHOD"] == "GET"){
    include('header.php');
    include_once('..\..\private\controllers\QuestionController.php');
    include_once('..\..\private\models\Account.php');
    include_once('..\..\private\controllers\FavouriteController.php');
    include_once('..\..\private\views\OutputTemplateView.php');

    echo "<link rel='stylesheet' type='text/css' href='../css/homepage.css'>";

  	$votes=[];
    $servername = $config['servername'];
    $username = $config['username'];
    $password = $config['password'];
    $dbname = $config['dbname'];

    $con = mysqli_connect($servername, $username, $password, $dbname) or die("Connection Failed");

 		$result = mysqli_query($con,"SELECT questions.*, accounts.username,accounts.profile_picture_path FROM questions AS questions INNER JOIN accounts ON accounts.id=questions.account_id ORDER BY upvotes DESC, downvotes, date DESC");

    try{
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
      echo "Connection failed: " . $e->getMessage();
    }

  	if(isset($_SESSION['userid'])){
      $req = $pdo -> prepare("SELECT * FROM votes WHERE ref=? AND user_id=?");
      $req->execute (['questions',$_SESSION['userid']]);
      while($vote=$req->fetch())
        array_push($votes, $vote);
    }
  }
  
  echo "<main>";
  // output template controller
  $otv = new OutputTemplateView();
  $qc = new QuestionController();

  if(isset($_SESSION['userid'])){
  	echo "
      <br>
  		<form>
    		<div class='container'  ng-app='myApp' ng-controller='mainCtrl'>
      			<div class='form-control space'>
      				<button type='button' class=' btn-md newQuestionButton' onclick=" . '"location.href=' . "'newQuestion.php';" . '"'. "/>New Question</button>
      			</div>
      		</div>  
  		</form>";
  }

  // Outputting the items in the database
  echo "<br><div class='container'>"; 

	while($questionElement = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
	 	$vote=getVote($votes,$questionElement['id']);

    if($questionElement['id']==$vote['ref_id'])
      $voteClass=Vote::getClass($vote);
    else
      $voteClass=Vote::getClass(false);

    $question = $qc->getQuestionById($questionElement['id']);

    echo "
      <div class='form-group row questionBlock'>";
    $filePath=$questionElement['profile_picture_path']; 
    if(!file_exists($filePath))
      $filePath = "..\img\avatar2.png";
  
    $otv->outputTemplate("questions", $question, $voteClass, $filePath, $questionElement['username'], "homepage.php");
    echo "</div><br>";
  }

    //   // Output the like and dislike buttons
     //  echo "
     //    <div class='form-group row questionBlock'>
    //       <div class='col-md-2 '>";
    //         $file_path=$question['profile_picture_path']; 
    //         if(!file_exists($file_path)) {
    //         $file_path = "..\img\avatar2.png";                      
    //         };
    //     echo "<div class='col-md-10'><img class='circle_img' src=".$file_path."></div>";
    //     echo"
     //      <div class='details vote_btns ".$cvoteClass." '>
     //        <form action= '.\Like.php?ref=questions&ref_id=".$question['id']."&vote=1&page=homepage.php' method='POST'>
     //          <button type='submit' class='vote_btn vote_like' ";
     //          if(!isset($_SESSION['userid'])){
     //          	echo "disabled";
     //          }
     //        echo "><i class='fa fa-thumbs-up'> ". $question['upvotes'] . "</i></button>
     //        </form>
     //        <form action='.\Like.php?ref=questions&ref_id=".$question['id']."&vote=-1&page=homepage.php' method='POST'>
     //          <button type='submit' class='vote_btn vote_dislike' ";
     //          if(!isset($_SESSION['userid'])){
     //          	echo "disabled";
     //          }
     //        echo "><i class='fa fa-thumbs-down'> ". $question['downvotes'] . "</i></button>
     //          </form>";
    //         //  ------------------------------------ Favourite Button --------------------------------------
    //         if(isset($_SESSION['userid'])){
    //         $fc = new FavouriteController();
    //           $favouriteQuestionFound = false;
    //           $favouriteQuestionArray = $fc::getFavouriteQuestions($_SESSION['userid']);
    //           if (isset($favouriteQuestionArray)){
    //             foreach($favouriteQuestionArray as $favouriteQuestion){
    //               if ($favouriteQuestion->getId() == $question['id']){
    //                 $favouriteQuestionFound = true;
    //               }
    //             }
    //           }

    //           if($favouriteQuestionFound == true){
    //             echo "
    //               <form method='post' action = 'newFavourite.php?returnLocation=homepage.php'>
    //                 <input type ='hidden' name = 'questionId' value = ".$question['id']." >
    //                 <input type ='hidden' name = 'accountId' value = ".$_SESSION['userid']." >
    //                 <input type ='hidden' name = 'foundQuestion' value = true>

    //                 <button type='submit' class='favouriteButton fa fa-star isFavourited custom-fa' aria-hidden='true'></button>
    //               </form>";
    //           }

    //           else{
    //             echo "
    //               <form method='post' action = 'newFavourite.php?returnLocation=homepage.php'>
    //                 <input type ='hidden' name = 'questionId' value = ".$question['id']." >
    //                 <input type ='hidden' name = 'accountId' value = ".$_SESSION['userid']." >
    //                 <input type ='hidden' name = 'foundQuestion' value = false>

    //                 <button type='submit' class='favouriteButton fa fa-star isNotFavourited' aria-hidden='true'></button>
    //               </form>";
    //           }

    //         }

     //        echo "</div></div>
     //        <div class='col-md-10 question'>
     //          <div>
     //          <a href='questionThreadPage.php?questionId=".$question['id']."'>
     //            <h3><strong>" . $question['header'] . "</strong></h3></a>
     //          </div>
     //          <p>" . $question['content'] . "
     //          </p>
     //          <span class = questionByDetail>Asked By: " .$question['username']. "<br>
     //          Posted on: " . $question['date'] . "</span>
     //      </div>
     //    </div><br>";
  		// }
  echo '</div></main>';
  //Verifie if the current question has a vote, if yes it returns it if not false
  function getVote($votes,$question_id){
      foreach ($votes as $vote) {
        if($vote['ref_id']==$question_id){
          return $vote;
        }
      }
      return false;
    }
  include("footer.php");
  
?>