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
    include_once('OutputBlock.php');

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
  $ob = new OutputBlock();
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

    echo "<div class='form-group row questionBlock'>";
    $filePath=$questionElement['profile_picture_path']; 
    if(!file_exists($filePath))
      $filePath = "..\img\avatar2.png";
  
    $ob->outputBlock("questions", $question, $voteClass, $filePath, $questionElement['username'], "homepage.php");
    echo "</div><br>";
  }

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