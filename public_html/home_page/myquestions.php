<?php include("header.php");?>

<link rel="stylesheet" type="text/css" href="../css/questions_page.css">

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
    $username = 'ua1';
    $password = 'Ua1password0)';
    $servername = 'ua1_so';

    // connection to database
    $con = mysqli_connect('localhost', $username, $password, $servername) or die("Connection Failed");

    $result = mysqli_query($con,"SELECT * FROM questions");
    $account_id="1";// Here should go the userName of the person or his AccountId.
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
    	if($row["account_id"]==$account_id){

    ?>    
    <div class="form-group row questionBox">
      <div class="col-md-2 userBox">
        <img class="userPhoto" src="../img/avatar2.png" alt="" width="80" height="80" />
        <span class="col-md-3">
        <label ><?php echo $row["account_id"]?></label>
        </span>
        <button class="btn btn-like"><i class="fa fa-thumbs-o-up"></i></button><?php echo $row["upvotes"]?>
        <button class="btn btn-like"><i class="fa fa-thumbs-o-down"></i></button><?php echo $row["downvotes"]?>
      </div>
      <div class="col-md-10 ">
        <div class="row">
        <h3><?php echo $row["header"]?> </h3>
        <button class="btn"><i class="fa fa-star-o" aria-hidden="true"></i></button>
   	 	</div>
        <p><?php echo $row["content"]?></p>
      </div>
    </div> 
<?php }}?>
</div>

<?php include("footer.php");?>