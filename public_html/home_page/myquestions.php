<?php 
  include_once('..\..\private\util\logging.php');
  $config = parse_ini_file('..\..\..\UA1-SO\config.ini');
  require "../../private/models/Vote.php";

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $log->lwrite("POST METHOD. for newQuestion.php");
    
  }
  else if($_SERVER["REQUEST_METHOD"] == "GET"){
    include('header.php');
    include_once('..\..\private\controllers\question_controller.php');
    include_once('..\..\private\models\Account.php');

    echo "<link rel='stylesheet' type='text/css' href='../css/questions_page.css'>";
  
    if( !isset($_SESSION['username']) || !isset($_SESSION['userid'])){
      $log->lwrite("User is not logged in. @myquestions.php");     
      echo "<main><div class='alert alert-warning margins'>
        <h2><strong>Warning!</h2></strong><h2>You are not logged in</h2><h2>Please login to ask a question and/or view your questions</h2>
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
            $req->execute (['questions',$_SESSION['userid']]);
            while($vote=$req->fetch()){
              array_push($votes, $vote);
            }
         }catch(PDOException $e){
          echo "Connection failed: " . $e->getMessage();
        }
      }
      echo "<main>
      <form>
        <div class='container'  ng-app='myApp' ng-controller='mainCtrl'>
          <div class='form-control space'>
          <button type='button' class='btn btn-primary btn-md' onclick=" . '"location.href=' . "'newQuestion.php';" . '"'. "/>New Question</button>
          </div>
        </div>  
      </form>";
      //<!--Outputting the items in the database-->
      echo "<div class='container'>"; 

      $userName = $_SESSION['username'];
      $id = $_SESSION['userid'];
      $log->lwrite("ID retrieved from session: $id");
      $account = new Account();
      $account->set_id($id);
      $log->lwrite('ID in account object: ' . $account->get_id());
      $rows = getQuestionsByAccount($account);
      $log->lwrite('Number of rows retrieved: ' . sizeof($rows));
      foreach ($rows as $info) {
        $vote=getVote($votes,$info->get_id());
        if($info->get_id()==$vote['ref_id']){
          $vote_class=Vote::getClass($vote);
        }else{
          $vote_class=Vote::getClass(false);
        }
        echo "
          <div class='form-group row questionBox'>
            <div class='col-md-2 vote_btns ".$vote_class." '>
            <form action='..\..\private\models\Like.php?ref=questions&ref_id=".$info->get_id()."&vote=1&page=myquestions.php' method='POST'>
              <button type='submit' class='vote_btn vote_like'><i class='fa fa-thumbs-up'> ". $info->get_upvotes() . "</i></button>
            </form>
            <form action='..\..\private\models\Like.php?ref=questions&ref_id=".$info->get_id()."&vote=-1&page=myquestions.php' method='POST'>
              <button type='submit' class='vote_btn vote_dislike'><i class='fa fa-thumbs-down'> ". $info->get_downvotes() . "</i></button>
              </form>
            </div>
            <span class = 'questionBody'>
            <div class='col-md-10 '>
              <div>
                <h3><strong>" . $info->get_header() . "</strong></h3>
              </div>
              <p>" . $info->get_content() . "
              </p>
              <span class = 'time'>Posted on: " . $info->get_date() . "</span>
            </div>
            </span>
          </div><br>";
      }
      echo '</div></main>';
    }
    
  }
  //Verifie if the current question has a vote, if yes it returns it if not false
  function getVote($votes,$info_id){
      foreach ($votes as $vote) {
        if($vote['ref_id']==$info_id){
          return $vote;
        }
      }
      return false;
    }
  include("footer.php");
  
?>