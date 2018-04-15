<?php 

  include_once('..\..\private\util\logging.php');
  $config = parse_ini_file('..\..\..\UA1-SO\config.ini');
  require "../../private/controllers/Vote.php";
   if($_SERVER["REQUEST_METHOD"] == "POST"){
    $log->lwrite("POST METHOD. for search.php");
  }
  else if($_SERVER["REQUEST_METHOD"] == "GET"){
    include('header.php');
    include_once('..\..\private\controllers\questionController.php');
    include_once('OutputBlock.php');
    include_once('..\..\private\models\Account.php');

    echo "<link rel='stylesheet' type='text/css' href='../css/homepage.css'>";

    // Controllers
    $ob = new OutputBlock();
    $qc = new QuestionController();

	if(isset($_GET['search'])){

		$search=$_GET['search'];
		$min_length = 3; // minimum length of the query
		if(strlen($search)<$min_length){
			echo "<main> <br> 
			<div class='container'>"
			. $search." is too short, the word has to have at least 3 characters
			</div>
			</main>";  
		}else { 
		$votes=[];
		$servername = $config['servername'];
	    $username = $config['username'];
	    $password = $config['password'];
	    $dbname = $config['dbname'];

	    $con = mysqli_connect($servername, $username, $password, $dbname) or die("Connection Failed");
	    $sql= "SELECT questions.*, accounts.username, accounts.name FROM questions INNER JOIN accounts ON accounts.id=questions.account_id WHERE (header LIKE '%".$search."%') OR (content LIKE '%".$search."%') OR (tags LIKE '%".$search."%')";
	    $result=mysqli_query($con,$sql) or die(mysql_error());
	    try{
            $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
          echo "Connection failed: " . $e->getMessage();
        }

        if(isset($_SESSION['userid'])){
            $req = $pdo -> prepare("SELECT * FROM votes WHERE ref=? AND user_id=?");
            $req->execute (['questions',$_SESSION['userid']]);
            while($vote=$req->fetch()){
              array_push($votes, $vote);
            }
        }
		
		echo "<main>";
		echo "<br><div class='container'>"; 

		if($result->num_rows ==0){
			echo "<main><div class='alert alert-info margins'>
        <h2><strong>Results</h2></strong>
        We couldn't find anything for " .$_GET['search'];        
        echo "</div></main>";

		}else {
			echo "<h4> ".$result->num_rows." results </h4>";

	    while($questionElement= mysqli_fetch_array($result,MYSQLI_ASSOC)){
	    	
	    	$vote=getVote($votes,$questionElement['id']);

	        if($questionElement['id']==$vote['ref_id']){
	          $voteClass=Vote::getClass($vote);
	        }else{
	          $voteClass=Vote::getClass(false);
	        }
	        echo "<div class='form-group row questionBlock'>";
            $filePath=$questionElement['name']; 
            	if(!file_exists($filePath))	
                	$filePath = "..\img\avatar2.png";   
            $question = $qc->getQuestionById($questionElement['id']);

            
            $ob->outputBlock("questions", $question, $voteClass, $filePath, $questionElement['username'], "search.php?search=".$_GET['search']);
            echo "</div><br>";
	    }
	 }

      echo '</div></main>';  
    }

	}else{
		echo "We couldn't find anything for ".$_GET['search'];
	}
}

	function getVote($votes,$questionElement_id){
      foreach ($votes as $vote) {
        if($vote['ref_id']==$questionElement_id){
          return $vote;
        }
      }
      return false;
    }
  include("footer.php");
?>	