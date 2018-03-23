<?php

include_once(dirname(__FILE__).'/../util/logging.php');
include_once(dirname(__FILE__).'/../util/sets.php');
include_once(dirname(__FILE__).'/../models/Question.php');
include_once(dirname(__FILE__).'/../models/Answer.php');
include_once(dirname(__FILE__).'/../models/Account.php');
include_once(dirname(__FILE__).'/../models/Comment.php');

class CommentController{

    private static $servername;
    private static $username;
    private static $password;
    private static $dbname;
    private static $log;

    function __construct(){
        $config = parse_ini_file(dirname(__FILE__).'/../../config.ini');
        
        self::$servername = $config['servername'];
        self::$username = $config['username'];
        self::$password = $config['password'];
        self::$dbname = $config['dbname'];

        self::$log = new Logging();


    }
	/**
	* Adds a comment to the comment table in the Database
	*
	* @param $comment		comment object
	*/
	static function addComment($comment){
		$servername = self::$servername;
		$username = self::$username;
		$password = self::$password;
		$dbname = self::$dbname;
		$log = self::$log;
		$comment_id = 0;

		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            $stmt = $pdo -> prepare('INSERT INTO comments(account_id, question_id, answer_id, content, date) VALUES(:account_id, :question_id, :answer_id, :content, :date);');
				//@TODO complete function
			$accountId = $comment->getAccountId();
			$questionId = $comment->getQuestionId();
			$answerId = $comment->getAnswerId();
			$content = $comment->getContent();
			$date = $comment->getDate();
										
			$stmt -> bindParam(':account_id', $accountId);
			$stmt -> bindParam(':question_id', $questionId);
			$stmt -> bindParam(':answer_id', $answerId);			
			$stmt -> bindParam(':content', $content);
            $stmt -> bindParam(':date', $date);
			
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
	 * Returns comments with the specified id
	 *
	 * @param $id		Comments's id
	 */
	static function getCommentById($id){
		$servername = self::$servername;
		$username = self::$username;
		$password = self::$password;
		$dbname = self::$dbname;
		$log = self::$log;
        $comment = new Comment();
		
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

			$stmt = $pdo -> prepare("SELECT id, account_id, question_id, answer_id, content, date FROM comments WHERE id = :id;");	
			$stmt -> bindParam(':id',$id );
		
			$stmt -> execute();
			
			// while there is a comment with specified account id
			if($result = $stmt -> fetch()){
                $c = new comment();

				$c->setId($result[0]);
                $c->setAccountId($result[1]);
                $c->setQuestionId($result[2]);
                $c->setAnswerId($result[3]);
                $c->setContent($result[4]);
                $c->setDate($result[5]);

                $comment = $c;
			}
		}
		catch(PDOException $e){
			$log->lwrite($e -> getMessage());
		}
		finally{
			unset($pdo);
		}
		// returns the comment array
		return $comment;
    }

    /**
	 * Returns comments with the specified account
	 *
	 * @param $account		Comments's account
	 */
   	static function getCommentsByAccount($account){
		$servername = self::$servername;
		$username = self::$username;
		$password = self::$password;
		$dbname = self::$dbname;
		$log = self::$log;
        $commentsArray = [];
		
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

			$stmt = $pdo -> prepare("SELECT id, account_id, question_id, answer_id, content, date FROM comments WHERE account_id = :account_id;");
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
	static function getCommentsByContent($content){
		$servername = self::$servername;
		$username = self::$username;
		$password = self::$password;
		$dbname = self::$dbname;
		$log = self::$log;
		$commentArray = [];
		$content = "%$content%";

		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

			$stmt = $pdo -> prepare("SELECT id, account_id, question_id, answer_id, content, date FROM comments WHERE content LIKE :content;");						
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
	 * Returns comment with the specified answer_id and question_id
	 *
	 * @param $answerId, $questionId		Comment's answerId, questionId
	 */
	static function getCommentsByAnswerQuestionId($answerId, $questionId){
		$servername = self::$servername;
		$username = self::$username;
		$password = self::$password;
		$dbname = self::$dbname;
		$log = self::$log;
		$commentArray = [];
		$sql;
		$stmt;

		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			if(isset($answerId)){
				$sql = "SELECT id, account_id, question_id, answer_id, content, date FROM comments WHERE answer_id = :answerId AND question_id IS NULL;";
				$stmt = $pdo -> prepare($sql);
				$stmt -> bindParam(':answerId', $answerId);				
			}else{
				$sql = "SELECT id, account_id, question_id, answer_id, content, date FROM comments WHERE answer_id IS NULL AND question_id = :question_id;";
				$stmt = $pdo -> prepare($sql);					
				$stmt -> bindParam(':questionId', $questionId);
			}
			$stmt -> execute();
			
            // if there is comment with specified question and answer idid
            if($result = $stmt -> fetch()){
                $c = new Comment();

				$c->setId($result[0]);
                $c->setAccountId($result[1]);
                $c->setQuestionId($result[2]);
                $c->setAnswerId($result[3]);
                $c->setContent($result[4]);
                $c->setDate($result[5]);

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
	static function updateComment($comment){
		$servername = self::$servername;
		$username = self::$username;
		$password = self::$password;
		$dbname = self::$dbname;
		$log = self::$log;
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            $stmt = $pdo -> prepare('UPDATE comments set content = :content
				WHERE id = :id;');
				
			$content = $comment->getContent();
			$id = $comment->getId();			
			$stmt -> bindParam(':content', $content);
            $stmt -> bindParam(':id', $id);
			
			$stmt -> execute();
            $log->lwrite('Updated Comment succesfully. ID: '. $id);
		}
		catch(PDOException $e){
			$log->lwrite($e -> getMessage());
		}
		finally{
			unset($pdo);
		}
    }
}
    
?>