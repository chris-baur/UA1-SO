<?php include("header.php");
      include("../../private/controllers/account_controller.php");
	  include("../../private/controllers/question_controller.php");
	  ?>

 <script src="http://mbenford.github.io/ngTagsInput/js/ng-tags-input.min.js"></script>
 <script src="../js/newQuestion.js"></script>
 <link rel="stylesheet" href="http://mbenford.github.io/ngTagsInput/css/ng-tags-input.min.css" />
 <link rel="stylesheet" type="text/css" href="../css/questions_page.css">

<?php    
    if(isset($_GET['action'])=='submitQuestion') submitQuestion();
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
		if(isset($_SESSION['userid'])){
			$id= $_SESSION['userid'];
			$account_id=$_SESSION['userid']; //here shoul go the current account ID 
		}		
		
		$tags=array('java','default');
		$upvotes=0;
		$downvotes=0;
		$date=date("Y-m-d H:i:s");

		$newQuestion=new Question($id,$account_id,$question_title,$content,$date,$upvotes,$downvotes,$tags);


		$response=addQuestion($newQuestion);
		header("Location: myquestions.php");
   		exit;
	}
?>
<?php
//footer
include("footer.php");
?>