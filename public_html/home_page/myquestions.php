<?php 
  
  include('header.php');
  include('../../private/controllers/account_controller.php');
  include('../../private/controllers/question_controller.php');


  echo "<link rel='stylesheet' type='text/css' href='../css/questions_page.css'>";
  
  //$_SESSION['username']= null;//'john117';// Here should go the userName of the person. If you have another userName replace here.
  //$_SESSION['userid'] = null;//1; 
  if( !isset($_SESSION['username']) || !isset($_SESSION['userid'])){     
    echo "<div class='alert alert-warning margins'>
      <h2><strong>Warning!</h2></strong><h2>You are not logged in</h2><h2>Please login to ask a question and/or view your questions</h2>
      <h2>Thank you</h2>
      </div>";
  }
  else {
    echo "
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
    $account= getAccountByUsername($userName);
    $rows = getQuestionsByAccount($account);
    foreach ($rows as $info) {
      echo "
        <div class='form-group row questionBox'>
        <div class='col-md-2 userBox'>
          <button class='btn btn-like'><i class='fa fa-thumbs-o-up'></i></button>". $info->get_upvotes() . "
          <button class='btn btn-like'><i class='fa fa-thumbs-o-down'></i></button>". $info->get_downvotes() . "
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
    echo '</div>';
  }
  include("footer.php");
?>