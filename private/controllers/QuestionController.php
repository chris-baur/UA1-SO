<?php

include_once(dirname(__FILE__).'/../util/logging.php');
include_once(dirname(__FILE__).'/../util/sets.php');
include_once(dirname(__FILE__).'/../models/Question.php');
include_once(dirname(__FILE__).'/../models/Account.php');
// $config = parse_ini_file('../../../UA1-SO/config.ini');

class QuestionController{

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
	* Adds a question to the question table in the Database
	*
	* @param $question		Question object
	*/
	static function addQuestion($question){
		$servername = self::$servername;
		$username = self::$username;
		$password = self::$password;
		$dbname = self::$dbname;
		$log = self::$log;
		$question_id = -1;
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            $stmt = $pdo -> prepare('INSERT INTO questions(account_id, header, content, date, upvotes, downvotes, tags) VALUES(:account_id, :header, :content, :date, :upvotes, :downvotes, :tags);');
                //@TODO complete function
										
			$account_id = $question->getAccountId();
			$header = $question->getHeader();
			$content = $question->getContent();
			$date =	$question->getDate();
			$upvotes = $question->getUpvotes();
			$downvotes = $question->getDownvotes();
			$tags = implode(" ",$question->getTags());

			$stmt -> bindParam(':account_id', $account_id);
			$stmt -> bindParam(':header', $header );
			$stmt -> bindParam(':content', $content);
            $stmt -> bindParam(':date', $date);
            $stmt -> bindParam(':upvotes', $upvotes);
            $stmt -> bindParam(':downvotes', $downvotes);
            $stmt -> bindParam(':tags', $tags);
			
			$stmt -> execute();
            $question_id = $pdo -> lastInsertId();
            $log->lwrite('added question succesfully. ID: '.$question_id);
		}
		catch(PDOException $e){
			$log->lwrite($e -> getMessage());
		}
		finally{
			unset($pdo);
		}
		return $question_id;
	}
	
	/**
	 * Returns questions with the specified id
	 *
	 * @param $id		Question's id
	 */
	static function getQuestionById($id){
		$servername = self::$servername;
		$username = self::$username;
		$password = self::$password;
		$dbname = self::$dbname;
		$log = self::$log;
        $question = new Question();
		
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

			$stmt = $pdo -> prepare("SELECT id, account_id, header, content, date, upvotes, downvotes, tags FROM questions WHERE id = :id;");						
			$stmt -> bindParam(':id',$id );
		
			$stmt -> execute();
			
			// while there is a question with specified account id
			if($result = $stmt -> fetch()){
                $q = new Question();

				$q->setId($result[0]);
                $q->setAccountId($result[1]);
                $q->setHeader($result[2]);
                $q->setContent($result[3]);
                $q->setDate($result[4]);
                $q->setUpvotes($result[5]);
                $q->setDownvotes($result[6]);
                $q->setTags(explode(' ', $result[7]));

                $question = $q;
			}
		}
		catch(PDOException $e){
			$log->lwrite($e -> getMessage());
		}
		finally{
			unset($pdo);
		}
		// returns the question
		return $question;
    }

     /**
	 * Returns questions with the specified account
	 *
	 * @param $account		Question's account owner
	 */
	static function getQuestionsByAccount($account){
		$servername = self::$servername;
		$username = self::$username;
		$password = self::$password;
		$dbname = self::$dbname;
		$log = self::$log;
        $question = new Question();
        $questionArray = [];
		
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

			$stmt = $pdo -> prepare("SELECT id, account_id, header, content, date, upvotes, downvotes, tags FROM questions WHERE account_id = :account_id;");
			$accountID=$account->getId();						
			$stmt -> bindParam(':account_id',$accountID );
		
			$stmt -> execute();
			
			// while there is a question with specified account id
			while($result = $stmt -> fetch()){
                $q = new Question();

				$q->setId($result[0]);
                $q->setAccountId($result[1]);
                $q->setHeader($result[2]);
                $q->setContent($result[3]);
                $q->setDate($result[4]);
                $q->setUpvotes($result[5]);
                $q->setDownvotes($result[6]);
                $q->setTags(explode(' ', $result[7]));

                $questionArray[] = $q;
			}
		}
		catch(PDOException $e){
			$log->lwrite($e -> getMessage());
		}
		finally{
			unset($pdo);
		}
		// returns the questions array
		return $questionArray;
    }
    
    /**
	 * Returns questions with the specified content
	 *
	 * @param $content		Question's content
	 */
	static function getQuestionsByContent($content){
		$servername = self::$servername;
		$username = self::$username;
		$password = self::$password;
		$dbname = self::$dbname;
		$log = self::$log;
		$questionArray = [];
		$content = "%$content%";
		
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

			$stmt = $pdo -> prepare("SELECT id, account_id, header, content, date, upvotes, downvotes, tags FROM questions WHERE content LIKE :content;");						
			$stmt -> bindParam(':content', $content);
		
			$stmt -> execute();
			
            // while there is a question with specified content
            while($result = $stmt -> fetch()){
                $q = new Question();

				$q->setId($result[0]);
                $q->setAccountId($result[1]);
                $q->setHeader($result[2]);
                $q->setContent($result[3]);
                $q->setDate($result[4]);
                $q->setUpvotes($result[5]);
                $q->setDownvotes($result[6]);
                $q->setTags(explode(' ', $result[7]));

                $questionArray[] = $q;
			}
		}
		catch(PDOException $e){
			$log->lwrite($e -> getMessage());
		}
		finally{
			unset($pdo);
		}
		// returns the questions array
		return $questionArray;
	}
    
    /**
	 * Returns questions with the specified header
	 *
	 * @param $header		Question's header
	 */
	static function getQuestionsByHeader($header){
		$servername = self::$servername;
		$username = self::$username;
		$password = self::$password;
		$dbname = self::$dbname;
		$log = self::$log;
        $question = new Question();
		$questionArray = [];
		$header = "%$header%";		
		
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

			$stmt = $pdo -> prepare("SELECT id, account_id, header, content, date, upvotes, downvotes, tags FROM questions WHERE header LIKE :header;");						
			$stmt -> bindParam(':header', $header);
		
			$stmt -> execute();
			
			// while there is a question with specified header
			while($result = $stmt -> fetch()){
                $q = new Question();

				$q->setId($result[0]);
                $q->setAccountId($result[1]);
                $q->setHeader($result[2]);
                $q->setContent($result[3]);
                $q->setDate($result[4]);
                $q->setUpvotes($result[5]);
                $q->setDownvotes($result[6]);
                $q->setTags(explode(' ', $result[7]));

                $questionArray[] = $q;
			}
		}
		catch(PDOException $e){
			$log->lwrite($e -> getMessage());
		}
		finally{
			unset($pdo);
		}
		// returns the questions array
		return $questionArray;
	}

	/**
	* Updates a question in the question table of the Database
	*
	* @param $question		Question object
	*/
	static function updateQuestion($question){
		$servername = self::$servername;
		$username = self::$username;
		$password = self::$password;
		$dbname = self::$dbname;
		$log = self::$log;
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            $stmt = $pdo -> prepare('UPDATE questions set header = :header, content = :content, upvotes = :upvotes, downvotes = :downvotes, tags = :tags
				WHERE id = :id;');
				
			$header = $question->getHeader();
			$content = $question->getContent();
			$upvotes = $question->getUpvotes();
			$downvotes = $question->getDownvotes();
			$tags = implode(" ",$question->getTags());
			$id = $question->getId();

			$stmt -> bindParam(':header', $header);
			$stmt -> bindParam(':content', $content);
			$stmt -> bindParam(':upvotes', $upvotes);
			$stmt -> bindParam(':downvotes', $downvotes);
			$stmt -> bindParam(':tags', $tags);								
            $stmt -> bindParam(':id', $id);
			
			$stmt -> execute();
            $log->lwrite('Updated question succesfully. ID: '. $id);
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