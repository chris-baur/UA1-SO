<?php

include_once(dirname(__FILE__).'/../util/logging.php');
include_once(dirname(__FILE__).'/../util/sets.php');
include_once(dirname(__FILE__).'/../models/Question.php');
include_once(dirname(__FILE__).'/../models/Answer.php');
include_once(dirname(__FILE__).'/../models/Account.php');

class AnswerController{

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
	* Adds a answer to the answer table in the Database
	*
	* @param $answer		answer object
	*/
	static function addAnswer($answer){
		$servername = self::$servername;
		$username = self::$username;
		$password = self::$password;
		$dbname = self::$dbname;
		$log = self::$log;
		$log->lwrite("servername: $servername, username: $username, password: $password, dbname: $dbname");		
		$answer_id = -9;
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            $stmt = $pdo -> prepare('INSERT INTO answers(account_id, question_id, content, date, upvotes, downvotes, best) VALUES(:account_id, :question_id, :content, :date, :upvotes, :downvotes, :best);');
				//@TODO complete function
				
			$accountId = $answer->getAccountId();
			$questionId = $answer->getQuestionId();
			$content = $answer->getContent();
			$date = $answer->getDate();
			$up = $answer->getUpvotes();
			$down = $answer->getDownvotes();
			$best = $answer->getBest();

			$log->lwrite("$accountId , $questionId, $content, $date, $up, $down, $best");
										
			$stmt -> bindParam(':account_id', $accountId);
			$stmt -> bindParam(':question_id', $questionId);
			$stmt -> bindParam(':content', $content);
            $stmt -> bindParam(':date', $date);
            $stmt -> bindParam(':upvotes', $up);
            $stmt -> bindParam(':downvotes', $down);
            $stmt -> bindParam(':best', $best);
			
            $log->lwrite("adding answer to question ID: $questionId, with accountId: $accountId");			
			$stmt -> execute();
            $answer_id = $pdo -> lastInsertId();
            $log->lwrite('added answer succesfully. ID: '.$answer_id);
		}
		catch(PDOException $e){
			$log->lwrite($e -> getMessage());
		}
		finally{
			unset($pdo);
		}
		return $answer_id;
    }

    /**
	 * Returns answers with the specified account
	 *
	 * @param $account		Answer's account
	 */
	static function getAnswersByAccount($account){
		$servername = self::$servername;
		$username = self::$username;
		$password = self::$password;
		$dbname = self::$dbname;
		$log = self::$log;
        $answerArray = [];
		
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

			$stmt = $pdo -> prepare("SELECT id, account_id, question_id, content, date, upvotes, downvotes, best FROM answers WHERE account_id = :account_id;");
			$accountID=$account->getId();						
			$stmt -> bindParam(':account_id',$accountID );
		
			$stmt -> execute();
			
			// while there is an answer with specified account id
			while($result = $stmt -> fetch()){
                $a = new Answer();

				$a->setId($result[0]);
                $a->setAccountId($result[1]);
                $a->setQuestionId($result[2]);
                $a->setContent($result[3]);
                $a->setDate($result[4]);
                $a->setUpvotes($result[5]);
                $a->setDownvotes($result[6]);
                $a->setBest($result[7]);

                $answerArray[] = $a;
			}
		}
		catch(PDOException $e){
			$log->lwrite($e -> getMessage());
		}
		finally{
			unset($pdo);
		}
		// returns the answer array
		return $answerArray;
    }
    
    /**
	 * Returns answers with the specified content
	 *
	 * @param $content		Answer's content
	 */
	static function getAnswersByContent($content){
		$servername = self::$servername;
		$username = self::$username;
		$password = self::$password;
		$dbname = self::$dbname;
		$log = self::$log;
		$answerArray = [];
		$content = "%$content%";
		
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

			$stmt = $pdo -> prepare("SELECT id, account_id, question_id, content, date, upvotes, downvotes, best FROM answers WHERE content LIKE :content;");						
			$stmt -> bindParam(':content', $content);
		
			$stmt -> execute();
			
            // while there is an answer with specified content
            while($result = $stmt -> fetch()){
                $a = new Answer();

				$a->setId($result[0]);
                $a->setAccountId($result[1]);
                $a->setQuestionId($result[2]);
                $a->setContent($result[3]);
                $a->setDate($result[4]);
                $a->setUpvotes($result[5]);
                $a->setDownvotes($result[6]);
                $a->setBest($result[7]);

                $answerArray[] = $a;
			}
		}
		catch(PDOException $e){
			$log->lwrite($e -> getMessage());
		}
		finally{
			unset($pdo);
		}
		// returns the answers array
		return $answerArray;
	}

	/**
	 * Returns answers with the specified question_id
	 *
	 * @param $content		Answer's question_id
	 */
	static function getAnswersByQuestionId($questionId){
		$servername = self::$servername;
		$username = self::$username;
		$password = self::$password;
		$dbname = self::$dbname;
		$log = self::$log;
        $answerArray = [];
		
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

			$stmt = $pdo -> prepare("SELECT id, account_id, question_id, content, date, upvotes, downvotes, best FROM answers WHERE question_id = :questionId;");						
			$stmt -> bindParam(':questionId', $questionId);
		
			$stmt -> execute();
			
            // while there is an answer with specified content
            while($result = $stmt -> fetch()){
                $a = new Answer();

				$a->setId($result[0]);
                $a->setAccountId($result[1]);
                $a->setQuestionId($result[2]);
                $a->setContent($result[3]);
                $a->setDate($result[4]);
                $a->setUpvotes($result[5]);
                $a->setDownvotes($result[6]);
                $a->setBest($result[7]);

                $answerArray[] = $a;
			}
		}
		catch(PDOException $e){
			$log->lwrite($e -> getMessage());
		}
		finally{
			unset($pdo);
		}
		// returns the answers array
		return $answerArray;
	}
    

	/**
	* Updates an answer in the answer table of the Database
	*
	* @param $answer		answer object
	*/
	static function updateAnswer($answer){
		$servername = self::$servername;
		$username = self::$username;
		$password = self::$password;
		$dbname = self::$dbname;
		$log = self::$log;
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            $stmt = $pdo -> prepare('UPDATE answers set content = :content, upvotes = :upvotes, downvotes = :downvotes, best = :best
				WHERE id = :id;');
				
			$content = $answer->getContent();
			$date = $answer->getDate();
			$up = $answer->getUpvotes();
			$down = $answer->getDownvotes();
			$best = $answer->getBest();
			$id = $answer->getId();
										
			$stmt -> bindParam(':content', $content);
            $stmt -> bindParam(':upvotes', $up);
            $stmt -> bindParam(':downvotes', $down);
            $stmt -> bindParam(':best', $best);
            $stmt -> bindParam(':id', $id);
			
			$stmt -> execute();
            $log->lwrite('Updated Answer succesfully. ID: '. $id);
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