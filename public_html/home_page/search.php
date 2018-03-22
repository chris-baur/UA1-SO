<?php 

  include_once('..\..\private\util\logging.php');
  $config = parse_ini_file('..\..\..\UA1-SO\config.ini');
  require "../../private/models/Vote.php";
   if($_SERVER["REQUEST_METHOD"] == "POST"){
    $log->lwrite("POST METHOD. for search.php");
  }
  else if($_SERVER["REQUEST_METHOD"] == "GET"){
    include('header.php');
    include_once('..\..\private\controllers\question_controller.php');
    include_once('..\..\private\models\Account.php');

    echo "<link rel='stylesheet' type='text/css' href='../css/homepage.css'>";

	if(isset($_GET['search'])){

		$search=$_GET['search'];
		$min_length = 3; // minimum length of the query
		if(strlen($search)<$min_length){
			echo "<main> <br> 
			<div class='container'>"
			. $search." is to short, the word has to have at least 3 characters.
			</div>
			</main>";  
		}else { 
		$votes=[];
		$servername = $config['servername'];
	    $username = $config['username'];
	    $password = $config['password'];
	    $dbname = $config['dbname'];

	    $con = mysqli_connect($servername, $username, $password, $dbname) or die("Connection Failed");
	    $sql= "SELECT questions.*, accounts.username, accounts.name FROM questions INNER JOIN accounts ON accounts.id=questions.account_id WHERE (header LIKE '%".$search."%') OR (content LIKE '%".$search."%')";
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

	    while($info= mysqli_fetch_array($result,MYSQLI_ASSOC)){
	    	
	    	$vote=getVote($votes,$info['id']);

	        if($info['id']==$vote['ref_id']){
	          $vote_class=Vote::getClass($vote);
	        }else{
	          $vote_class=Vote::getClass(false);
	        }
	        echo "
	          <div class='form-group row questionBlock'>
            <div class='col-md-2 '>";
              $file_path=$info['name']; 
                if(!file_exists($file_path)) {
                $file_path = "..\img\avatar2.png";                      
                }
                ;
            echo "
            	<div class='col-md-10'>
            		<img class='circle_img' src=".$file_path.">
            	</div>
	            <div class='details vote_btns ".$vote_class." '>
	            <form action='..\..\private\models\Like.php?ref=questions&ref_id=".$info['id']."&vote=1&page=search.php?search=".$search."' method='POST'>
	              <button type='submit' class='vote_btn vote_like' ";
	              if(!isset($_SESSION['userid'])){
	              	echo "disabled";
	              }
	            echo "><i class='fa fa-thumbs-up'> ". $info['upvotes'] . "</i></button>
	            </form>
	            <form action='..\..\private\models\Like.php?ref=questions&ref_id=".$info['id']."&vote=-1&page=search.php?search=".$search."' method='POST'>
	              <button type='submit' class='vote_btn vote_dislike' ";
	              if(!isset($_SESSION['userid'])){
	              	echo "disabled";
	              }
	            echo "><i class='fa fa-thumbs-down'> ". $info['downvotes'] . "</i></button>
	              </form>
	            </div>
	        </div>
	            <div class='col-md-10 question'>
	              <div>
	              <a href='questionThreadPage.php?questionid=".$info['id']."'>
	                <h3><strong>" . $info['header'] . "</strong></h3></a>
	              </div>
	              <p>" . $info['content'] . "
	              </p>
	              <span> Asked By: " .$info['username']. "</span><br>
	              <span class = 'time'>Posted on: " . $info['date'] . "</span>

	            </div>
	          </div><br>";
	    }
	 }

      echo '</div></main>';  
    }

	}else{
		echo "We couldn't find anything for ".$_GET['search'];
	}
}

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