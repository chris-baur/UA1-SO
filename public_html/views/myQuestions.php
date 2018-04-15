<?php 
  include_once('..\..\private\util\logging.php');
  $config = parse_ini_file('..\..\..\UA1-SO\config.ini');
  require "../../private/controllers/Vote.php";
  $log = new Logging();

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $log->lwrite("POST METHOD. for newQuestion.php");
    
  }
  else if($_SERVER["REQUEST_METHOD"] == "GET"){
    include('header.php');
    include_once('..\..\private\controllers\QuestionController.php');
    include_once('..\..\private\models\Account.php');
    include_once('..\..\private\controllers\AccountController.php');
    include_once('OutputBlock.php');

    echo "<link rel='stylesheet' type='text/css' href='../css/homepage.css'>";

    // controller declaration
    $qc = new QuestionController();
    $ac = new AccountController();
    $ob = new OutputBlock();

  
    if( !isset($_SESSION['username']) || !isset($_SESSION['userid'])){
      $log->lwrite("User is not logged in. @myquestionArray.php");     
      echo "<main><div class='alert alert-warning margins'>
        <h2><strong>Warning!</h2></strong><h2>You are not logged in</h2><h2>Please login to ask a question and/or view your questionArray</h2>
        <h2>Thank you</h2>
        </div></main>";
    }
    else {

      $votes=[];
      if(isset($_SESSION['userid'])){
        $servername = $config['servername'];
        $username = $config['username'];
        $password = $config['password'];
        $dbname = $config['dbname'];

        try{
            $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $req = $pdo -> prepare("SELECT * FROM votes WHERE ref=? AND user_id=?");
            $req->execute (['questionArray',$_SESSION['userid']]);
            while($vote=$req->fetch()){
              array_push($votes, $vote);
            }
         }catch(PDOException $e){
          echo "Connection failed: " . $e->getMessage();
        }
      }
      echo "<main>
      <form>
      <br>
        <div class='container'  ng-app='myApp' ng-controller='mainCtrl'>
          <div class='form-control space'>
          <button type='button' class='btn-primary btn-md newQuestionButton' onclick=" . '"location.href=' . "'newQuestion.php';" . '"'. "/>New Question</button>
          </div>
        </div>  
      </form>";
      //<!--Outputting the items in the database-->
      echo "<br>
            <div class='container'>";

      $log->lwrite("ID retrieved from session: ".$_SESSION['userid']);
      $account = new Account();
      $account = $ac->getAccountById($_SESSION['userid']);
      $questionArray = $qc->getQuestionsByAccount($account);

      foreach ($questionArray as $question) {
        $vote=getVote($votes,$question->getId());
        if($question->getId()==$vote['ref_id']){
          $voteClass=Vote::getClass($vote);
        }else{
          $voteClass=Vote::getClass(false);
        }

        echo "
          <div class='form-group row questionBlock'>";      
        if(!file_exists($account->getProfilePicturePath()))
          $filePath = "..\img\avatar2.png";                      
        else
          $filePath = $picPath;

        $returnLocation = "myQuestions.php";
        $ob->outputBlock("questions", $question, $voteClass, $filePath, $_SESSION['username'], $returnLocation);
        echo "</div><br>";
      }
      echo '</div></main>';
    }
    
  }
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