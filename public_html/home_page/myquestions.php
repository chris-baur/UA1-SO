<?php include("header.php");
      include("../../private/controllers/account_controller.php");
      include("../../private/controllers/question_controller.php");

      ?>

<link rel="stylesheet" type="text/css" href="../css/questions_page.css">
<?php
  $_SESSION['username']="Rodrigo";// Here should go the userName of the person. If you have another userName replace here.
  $_SESSION['userid'] =1; 
  if( !isset($_SESSION['username']) || !isset($_SESSION['userid'])){  
?>    
    <div class="alert alert-warning margins">
      <strong>Warning!</strong><?php echo " You are not connected to a session. Please use the log in to continue."; ?>
    </div>
<?php
  } else {
?>

<form>
<div class="container"  ng-app="myApp" ng-controller="mainCtrl">
  <div class="form-control space">
    <button type="button" class="btn btn-primary btn-md" onclick="location.href='newQuestion.php';"/>New Question</button>
  </div>
</div>  
</form>
 <!--Outputting the items in the database-->
    <div class="container">
    <?php    
    $userName=$_SESSION['username'];
    $account=getAccountByUsername($userName);
    $rows =getQuestionsByAccount($account);
    foreach ($rows as $info) {
    ?>
    <div class="form-group row questionBox">
      <div class="col-md-2 userBox">
        <img class="userPhoto" src="../img/avatar2.png" alt="" width="80" height="80" />
        <span class="col-md-3">
        <label ><?php echo $account->get_username()?></label>
        </span>
        <button class="btn btn-like"><i class="fa fa-thumbs-o-up"></i></button><?php echo $info->get_upvotes()?>
        <button class="btn btn-like"><i class="fa fa-thumbs-o-down"></i></button><?php echo $info->get_downvotes()?>
      </div>
      <div class="col-md-10 ">
        <div class="row">
        <h3><?php echo $info->get_header()?> </h3>
      </div>
        <p><?php echo $info->get_content()?>
        </p>
        <span class = "time"><?php echo "Posted on: ".$info->get_date()?></span>
      </div>
    </div> 
  <?php }?>
  </div>
<?php }?>
<?php include("footer.php");?>