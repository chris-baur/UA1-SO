<?php
include_once '..\..\private\util\logging.php';
include_once '..\..\private\util\sets.php';
include_once '..\..\private\models\Question.php';
include_once '..\..\private\models\Account.php';
include_once '..\..\private\models\Answer.php';
include_once '..\..\private\models\Comment.php';
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

            $stmt = $pdo -> prepare('INSERT INTO comments(account_id, content, date, upvotes, downvotes, tags) VALUES(:account_id, :content, :date, :upvotes, :downvotes, :tags);');
                //@TODO complete function
										
			$stmt -> bindParam(':account_id', $comment->getAccountId());
			$stmt -> bindParam(':content', $comment->getContent());
            $stmt -> bindParam(':date', $comment->getDate());
            $stmt -> bindParam(':upvotes', $comment->getUpvotes());
            $stmt -> bindParam(':downvotes', $comment->getDownvotes());
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
			$accountID=$account->getId();	
			$stmt -> bindParam(':account_id',$accountID );
		
			$stmt -> execute();
			
			// while there is a comment with specified account id
			while($result = $stmt -> fetch()){
                $c = new comment();

				$c->setId($result[0]);
                $c->setAccountId($result[1]);
                $c->setQuestionId($result[2]);
                $c->setAnswerId($result[3]);
                $c->setContent($result[4]);
                $c->setDate($result[5]);
                $c->setUpvotes($result[6]);
                $c->setDownvotes($result[7]);

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

				$c->setId($result[0]);
                $c->setAccountId($result[1]);
                $c->setQuestionId($result[2]);
                $c->setAnswerId($result[3]);
                $c->setContent($result[4]);
                $c->setDate($result[5]);
                $c->setUpvotes($result[6]);
                $c->setDownvotes($result[7]);

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

			$stmt = $pdo -> prepare("SELECT id, account_id, question_id, answer_id, content, date, upvotes, downvotes FROM comments WHERE answer_id LIKE :answerId AND question_id LIKE :questionId; ORDER BY date DESC");						
			$stmt -> bindParam(':answerId', $answerId);
			$stmt -> bindParam(':questionId', $questionId);
		
			$stmt -> execute();
			
            // while there is comment with specified content
            while($result = $stmt -> fetch()){
                $c = new Comment();

				$c->setId($result[0]);
                $c->setAccountId($result[1]);
                $c->setQuestionId($result[2]);
                $c->setAnswerId($result[3]);
                $c->setContent($result[4]);
                $c->setDate($result[5]);
                $c->setUpvotes($result[6]);
                $c->setDownvotes($result[7]);

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

            $stmt = $pdo -> prepare('UPDATE comments set content = :content, upvotes = :upvotes, downvotes = :downvotes, tags = :tags
                WHERE id = :id;');
										
			$stmt -> bindParam(':content', $comment->getContent());
            $stmt -> bindParam(':upvotes', $comment->getUpvotes());
            $stmt -> bindParam(':downvotes', $comment->getDownvotes());
            $stmt -> bindParam(':tags', $comment->get_tags());
            $stmt -> bindParam(':id', $comment->getId());
			
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