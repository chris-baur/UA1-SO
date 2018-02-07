<?php

include '..\util\logging.php';
include '..\util\sets.php';
include '..\models\Question.php';
include '..\models\Account.php';
$config = parse_ini_file('..\..\..\config.ini');

$servername = $config['servername'];
$username = $config['username'];
$password = $config['password'];
$dbname = $config['dbname'];

$log = new Logging();

	/**
	* Adds a question to the question table in the Database
	*
	* @param $question		Question object
	*/
	function addQuestion($question){
		global $servername, $username, $password, $dbname, $log;
		$question_id = 0;
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            $stmt = $pdo -> prepare('INSERT INTO questions(account_id, header, content, date, upvotes, downvotes, tags) VALUES(:account_id, :header, :content, :date, :upvotes, :downvotes, :tags);');
                //@TODO complete function
										
			$stmt -> bindParam(':account_id', $question->getAccountId());
			$stmt -> bindParam(':header', $question->getHeader());
			$stmt -> bindParam(':content', $question->getContent());
            $stmt -> bindParam(':date', $question->getDate());
            $stmt -> bindParam(':upvotes', $question->getUpvotes());
            $stmt -> bindParam(':downvotes', $question->getownvotes());
            $stmt -> bindParam(':tags', $question->getTags());
			
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
	 * Returns questions with the specified account
	 *
	 * @param $account		Question's account owner
	 */
	function getQuestionsByAccount($account){
		global $servername, $username, $password, $dbname, $log;
        $question = new Question();
        $questionArray = [];
		
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

			$stmt = $pdo -> prepare("SELECT id, account_id, header, content, date, upvotes, downvotes, tags FROM questions WHERE account_id = :account_id;");						
			$stmt -> bindParam(':account_id', $account->get_id());
		
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
                $q->tags($result[7]);

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
	function getQuestionsByContent($content){
		global $servername, $username, $password, $dbname, $log;
        $question = new Question();
        $questionArray = [];
		
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

			$stmt = $pdo -> prepare("SELECT id, account_id, header, content, date, upvotes, downvotes, tags FROM questions WHERE content LIKE '%:content%';");						
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
                $q->tags($result[7]);

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
	function getQuestionsByHeader($header){
		global $servername, $username, $password, $dbname, $log;
        $question = new Question();
        $questionArray = [];
		
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

			$stmt = $pdo -> prepare("SELECT id, account_id, header, content, date, upvotes, downvotes, tags FROM questions WHERE header LIKE '%:header%';");						
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
                $q->tags($result[7]);

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
	function updateQuestion($question){
		global $servername, $username, $password, $dbname, $log;
		$question_id = 0;
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            $stmt = $pdo -> prepare('UPDATE questions set header = :header, content = :content, upvotes = :upvotes, downvotes = :downvotes, tags = :tags
                WHERE id = :id;');
                //@TODO complete function
										
			$stmt -> bindParam(':header', $question->getHeader());
			$stmt -> bindParam(':content', $question->getContent());
            $stmt -> bindParam(':upvotes', $question->getUpvotes());
            $stmt -> bindParam(':downvotes', $question->getownvotes());
            $stmt -> bindParam(':tags', $question->getTags());
            $stmt -> bindParam(':id', $question->getId());
			
			$stmt -> execute();
            $log->lwrite('Updated question succesfully. ID: '.$question_id);
		}
		catch(PDOException $e){
			$log->lwrite($e -> getMessage());
		}
		finally{
			unset($pdo);
		}
    }
    
?>