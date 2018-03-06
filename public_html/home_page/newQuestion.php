<?php include("header.php");
	  include("../../private/controllers/question_controller.php");

	  ?>
 <script src="http://mbenford.github.io/ngTagsInput/js/ng-tags-input.min.js"></script>
 <script src="../js/newQuestion.js"></script>
 <link rel="stylesheet" href="http://mbenford.github.io/ngTagsInput/css/ng-tags-input.min.css" />
 <link rel="stylesheet" type="text/css" href="../css/questions_page.css">

    <?php
    $username = 'ua1';
    $password = 'Ua1password0)';
    $servername = 'ua1_so';

    // connection to database
    $con = mysqli_connect('localhost', $username, $password, $servername) or die("Connection Failed");

    $result = mysqli_query($con,"SELECT id FROM accounts");
    $row = mysqli_fetch_array($result,MYSQLI_NUM);

    if(isset($_GET['action'])=='submitQuestion') {
    		submitQuestion();
		}
   
    ?>    
<!--Body-->
<form method="post" action="?action=submitQuestion">
	<div class="container" ng-app="newQuestion" ng-controller="questionController">
		<div class="form-control space">
			<span class="col-lg-2">Tilte  </span>
			<input class="col-lg-10" type="text" placeholder="Title of your question" name="header" 
			ng-model="question_title">		
		</div>
		<div class="form-control space">
			<textarea class="form-control" rows="10" name="content"
			ng-model="content"></textarea>
		</div>
		<div class="form-control space">
			<label>Tags : </label>
			<tags-input ng-model="tags"></tags-input>
		</div>
		<div class="space">
			<button ng-disabled="allowSubmit()" type="submit" class="btn btn-primary btn-md"> Ask it! </button>
		</div>

	</div>
</form>
<?php 
	function submitQuestion(){
		if(isset($_POST['header']) and isset($_POST['content'])){
			$question_title= $_POST['header'];
			$content=$_POST['content'];
		}
		$row=$GLOBALS['row'];		
		$id= $row[0];
		
		$account_id=$row[0]; //here shoul go the current account ID 
		$tags=['java'];
		$upvotes='0';
		$downvotes='0';
		$date=date("l jS \of F Y h:i:s A");

		//@TODO
		//must validate/sanitize data provided by the user
		//missing tags element, getting account id from session.

		$newQuestion=new Question($id,$account_id,$question_title,$content,$date,$upvotes,$downvotes,$tags);


		$response=addQuestion($newQuestion);
		//header("Location: myquestions.php");
   		//exit;
	}
?>
<?php
//footer
include("footer.php");
?>