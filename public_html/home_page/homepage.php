<?php 
  include_once('..\..\private\util\logging.php');
  $config = parse_ini_file('..\..\..\UA1-SO\config.ini');
  require "../../private/models/Vote.php";

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $log->lwrite("POST METHOD. for homepage.php");
  }
  else if($_SERVER["REQUEST_METHOD"] == "GET"){
    include('header.php');
    include_once('..\..\private\controllers\question_controller.php');
    include_once('..\..\private\models\Account.php');

    echo "<link rel='stylesheet' type='text/css' href='../css/homepage.css'>";

      	$votes=[];
        $servername = $config['servername'];
        $username = $config['username'];
        $password = $config['password'];
        $dbname = $config['dbname'];

        $con = mysqli_connect($servername, $username, $password, $dbname) or die("Connection Failed");

   		$result = mysqli_query($con,"SELECT questions.*, accounts.username,accounts.name FROM questions AS questions INNER JOIN accounts ON accounts.id=questions.account_id ORDER BY date DESC, upvotes DESC, downvotes");

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
      if(isset($_SESSION['userid'])){
      	echo "
          <br>
      		<form>
        		<div class='container'  ng-app='myApp' ng-controller='mainCtrl'>
          			<div class='form-control space'>
          				<button type='button' class='btn btn-primary btn-md' onclick=" . '"location.href=' . "'newQuestion.php';" . '"'. "/>New Question</button>
          			</div>
          		</div>  
      		</form>";
      	}

      // Outputting the items in the database
      echo "<br><div class='container'>"; 

 		 while($info = mysqli_fetch_array($result,MYSQLI_ASSOC)) {        
 		 	$vote=getVote($votes,$info['id']);

	        if($info['id']==$vote['ref_id']){
	          $vote_class=Vote::getClass($vote);
	        }else{
	          $vote_class=Vote::getClass(false);
	        }

          // Output the like and dislike buttons
	        echo "
	          <div class='form-group row questionBlock'>
              <div class='col-md-2 '>";
                $file_path=$info['name']; 
                if(!file_exists($file_path)) {
                $file_path = "..\img\avatar2.png";                      
                };
            echo "<div class='col-md-10'><img class='circle_img' src=".$file_path."></div>";
            echo"
	            <div class='details vote_btns ".$vote_class." '>
  	            <form action= '..\..\private\models\Like.php?ref=questions&ref_id=".$info['id']."&vote=1&page=homepage.php' method='POST'>
  	              <button type='submit' class='vote_btn vote_like' ";
  	              if(!isset($_SESSION['userid'])){
  	              	echo "disabled";
  	              }
  	            echo "><i class='fa fa-thumbs-up'> ". $info['upvotes'] . "</i></button>
  	            </form>
  	            <form action='..\..\private\models\Like.php?ref=questions&ref_id=".$info['id']."&vote=-1&page=homepage.php' method='POST'>
  	              <button type='submit' class='vote_btn vote_dislike' ";
  	              if(!isset($_SESSION['userid'])){
  	              	echo "disabled";
  	              }
  	            echo "><i class='fa fa-thumbs-down'> ". $info['downvotes'] . "</i></button>
  	              </form>
                  </div>
  	            </div>
  	            <div class=' question'>
  	              <div>
  	              <a href='questionThread.php?questionid=".$info['id']."'>
  	                <h3><strong>" . $info['header'] . "</strong></h3></a>
  	              </div>
  	              <p>" . $info['content'] . "
  	              </p>
  	              <span class = questionByDetail>Asked By: " .$info['username']. "<br>
  	              Posted on: " . $info['date'] . "</span>
	            </div>
	          </div><br>";
      		}
      echo '</div></main>';    
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