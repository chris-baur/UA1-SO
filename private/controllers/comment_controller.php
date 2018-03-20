<?php
include '..\..\private\util\logging.php';
include '..\..\private\util\sets.php';
include '..\..\private\models\Question.php';
include '..\..\private\models\Account.php';
include '..\..\private\models\Answer.php';
include '..\..\private\models\Comment.php';
$config = parse_ini_file('..\..\..\UA1-SO\config.ini');

$servername = $config['servername'];
$username = $config['username'];
$password = $config['password'];
$dbname = $config['dbname'];

$log = new Logging();

	/**
	* Adds a comment to the comment table in the Database
	*
	* @param $comment		comment object
	*/
	function addcomment($comment){
		global $servername, $username, $password, $dbname, $log;
		$comment_id = 0;

		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            $stmt = $pdo -> prepare('INSERT INTO comments(account_id, header, content, date, upvotes, downvotes, tags) VALUES(:account_id, :header, :content, :date, :upvotes, :downvotes, :tags);');
                //@TODO complete function
										
			$stmt -> bindParam(':account_id', $comment->get_accountId());
			$stmt -> bindParam(':header', $comment->get_header());
			$stmt -> bindParam(':content', $comment->get_content());
            $stmt -> bindParam(':date', $comment->get_date());
            $stmt -> bindParam(':upvotes', $comment->get_upvotes());
            $stmt -> bindParam(':downvotes', $comment->get_downvotes());
            $stmt -> bindParam(':tags', $comment->get_tags());
			
			$stmt -> execute();
            $comment_id = $pdo -> lastInsertId();
            $log->lwrite('added comment succesfully. ID: '.$comment_id);
		}
		catch(PDOException $e){
			$log->lwrite($e -> getMessage());
		}
		finally{
			unset($pdo);
		}
		return $comment_id;
    }

    /**
	 * Returns comments with the specified account
	 *
	 * @param $account		Comments's account
	 */
   	function getCommentsByAccount($account){
		global $servername, $username, $password, $dbname, $log;
        $commentsArray = [];
		
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

			$stmt = $pdo -> prepare("SELECT id, account_id, question_id, answer_id, content, date, upvotes, downvotes FROM comments WHERE account_id = :account_id;");
			$accountID=$account->get_id();	
			$stmt -> bindParam(':account_id',$accountID );
		
			$stmt -> execute();
			
			// while there is a comment with specified account id
			while($result = $stmt -> fetch()){
                $c = new comment();

				$c->set_id($result[0]);
                $c->set_accountId($result[1]);
                $c->set_questionId($result[2]);
                $c->set_answerId($result[3]);
                $c->set_content($result[4]);
                $c->set_date($result[5]);
                $c->set_upvotes($result[6]);
                $c->set_downvotes($result[7]);

                $commentArray[] = $c;
			}
		}
		catch(PDOException $e){
			$log->lwrite($e -> getMessage());
		}
		finally{
			unset($pdo);
		}
		// returns the comment array
		return $commentArray;
    }
    
	/**
	 * Returns comments with the specified content
	 *
	 * @param $content		Comment's content
	 */
	function getCommentsByContent($content){
		global $servername, $username, $password, $dbname, $log;
        $commentArray = [];

		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

			$stmt = $pdo -> prepare("SELECT id, account_id, question_id, answer_id, content, date, upvotes, downvotes FROM comments WHERE content LIKE '%:content%';");						
			$stmt -> bindParam(':content', $content);
		
			$stmt -> execute();
			
            // while there is comment with specified content
            while($result = $stmt -> fetch()){
                $c = new Comment();

				$c->set_id($result[0]);
                $c->set_accountId($result[1]);
                $c->set_questionId($result[2]);
                $c->set_answerId($result[3]);
                $c->set_content($result[4]);
                $c->set_date($result[5]);
                $c->set_upvotes($result[6]);
                $c->set_downvotes($result[7]);

                $commentArray[] = $c;
			}
		}
		catch(PDOException $e){
			$log->lwrite($e -> getMessage());
		}
		finally{
			unset($pdo);
		}
		// returns the comment array
		return $commentArray;
	}

	/**
	 * Returns comments with the specified answer_id and question_id
	 *
	 * @param $answerId, $questionId		Comment's answerId, questionId
	 */
	function getCommentsByAnswerQuestionId($answerId, $questionId){
		global $servername, $username, $password, $dbname, $log;
        $commentArray = [];

		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

			$stmt = $pdo -> prepare("SELECT id, account_id, question_id, answer_id, content, date, upvotes, downvotes FROM comments WHERE answer_id LIKE '%:answerId%' AND question_id LIKE '%:questionId%';");						
			$stmt -> bindParam(':answerId', $answerId);
			$stmt -> bindParam(':questionId', $questionId);
		
			$stmt -> execute();
			
            // while there is comment with specified content
            while($result = $stmt -> fetch()){
                $c = new Comment();

				$c->set_id($result[0]);
                $c->set_accountId($result[1]);
                $c->set_questionId($result[2]);
                $c->set_answerId($result[3]);
                $c->set_content($result[4]);
                $c->set_date($result[5]);
                $c->set_upvotes($result[6]);
                $c->set_downvotes($result[7]);

                $commentArray[] = $c;
			}
		}
		catch(PDOException $e){
			$log->lwrite($e -> getMessage());
		}
		finally{
			unset($pdo);
		}
		// returns the comment array
		return $commentArray;
	}

	/**
	* Updates a comment in the comment table of the Database
	*
	* @param $comment		comment object
	*/
	function updateComment($comment){
		global $servername, $username, $password, $dbname, $log;
		$comment_id = 0;
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            $stmt = $pdo -> prepare('UPDATE comments set header = :header, content = :content, upvotes = :upvotes, downvotes = :downvotes, tags = :tags
                WHERE id = :id;');
										
			$stmt -> bindParam(':header', $Comment->get_header());
			$stmt -> bindParam(':content', $Comment->get_content());
            $stmt -> bindParam(':upvotes', $Comment->get_upvotes());
            $stmt -> bindParam(':downvotes', $Comment->get_downvotes());
            $stmt -> bindParam(':tags', $Comment->get_tags());
            $stmt -> bindParam(':id', $Comment->get_id());
			
			$stmt -> execute();
            $log->lwrite('Updated Comment succesfully. ID: '.$comment_id);
		}
		catch(PDOException $e){
			$log->lwrite($e -> getMessage());
		}
		finally{
			unset($pdo);
		}
    }
    
?>