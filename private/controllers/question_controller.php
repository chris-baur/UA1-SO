<?php

include_once '..\..\private\util\logging.php';
include_once '..\..\private\util\sets.php';
include_once '..\..\private\models\Question.php';
include_once '..\..\private\models\Account.php';
$config = parse_ini_file('..\..\..\UA1-SO\config.ini');

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
		$question_id = -1;
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            $stmt = $pdo -> prepare('INSERT INTO questions(account_id, header, content, date, upvotes, downvotes, tags) VALUES(:account_id, :header, :content, :date, :upvotes, :downvotes, :tags);');
                //@TODO complete function
										
			$account_id=$question->getAccountId();
			$header  =	$question->getHeader();
			$content =	$question->getContent();
			$date =	$question->getDate();
			$upvotes=$question->getUpvotes();
			$downvotes=$question->getDownvotes();
			$tags=  implode(" ",$question->getTags());

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
                $q->setTags($result[7]);

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
                $q->setTags($result[7]);

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
                $q->setTags($result[7]);

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
	 * Returns questions with the specified id
	 *
	 * @param $header		Question's header
	 */
	function getQuestionsById($id){
		global $servername, $username, $password, $dbname, $log;
        $question = new Question();
        $questionArray = [];
		
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

			$stmt = $pdo -> prepare("SELECT id, account_id, header, content, date, upvotes, downvotes, tags FROM questions WHERE id LIKE $id;");						
			$stmt -> bindParam('id', $id);
		
			$stmt -> execute();
			
			// while there is a question with specified id
			while($result = $stmt -> fetch()){
                $q = new Question();

				$q->setId($result[0]);
                $q->setAccountId($result[1]);
                $q->setHeader($result[2]);
                $q->setContent($result[3]);
                $q->setDate($result[4]);
                $q->setUpvotes($result[5]);
                $q->setDownvotes($result[6]);
                $q->setTags($result[7]);



                // get the username from the accounts table
                
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
										
			$stmt -> bindParam(':header', $question->getHeader());
			$stmt -> bindParam(':content', $question->getContent());
            $stmt -> bindParam(':upvotes', $question->getUpvotes());
            $stmt -> bindParam(':downvotes', $question->getDownvotes());
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