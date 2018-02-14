<?php include("header.php");
	  include("../../private/controllers/question_controller.php");
		if(isset($_GET['action'])=='submitQuestion') {
    		submitQuestion();
		}
	  ?>

 <script src="../js/newQuestion.js"></script>
 <link rel="stylesheet" type="text/css" href="../css/question_page.css">

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
			<label>Tags</label>
			<div></div>
		</div>
		<div class="space">
			<button ng-disabled="allowSubmit()" type="submit" class="btn btn-primary btn-md"> Ask it! </button>
		</div>

	</div>
</form>

<?php 
	function submitQuestion(){
		if(isset($_POST['header']) and isset($_POST['content'])){
			$question_title=$_POST['header'];
			$content=$_POST['content'];
		}
		$newQuestion=new Questions('0','123',$question_title,$content,date("l jS \of F Y h:i:s A"),'0','0');
		$response=addQuestion($newQuestion);
		print "$response"; // This is temporal, I want to see the response
		header("Location: myquestions.php");
   		exit;
	}
?>
<?php
//footer
include("footer.php");
?>