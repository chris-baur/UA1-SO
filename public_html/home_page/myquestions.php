<?php 
  include_once('..\..\private\util\logging.php');

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
        echo "
          <div class='form-group row questionBox'>
            <div class='col-md-2 vote_btns'>
              <button class='vote_btn vote_like'><i class='fa fa-thumbs-up'> ". $info->get_upvotes() . "</i></button>
              <button class='vote_btn vote_dislike'><i class='fa fa-thumbs-down'> ". $info->get_downvotes() . "</i></button>
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
  include("footer.php");
  
?>