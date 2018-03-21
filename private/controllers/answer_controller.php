<?php
include_once '..\..\private\util\logging.php';
include_once '..\..\private\util\sets.php';
include_once '..\..\private\models\Question.php';
include_once '..\..\private\models\Account.php';
include_once '..\..\private\models\Answer.php';
$config = parse_ini_file('..\..\..\UA1-SO\config.ini');

$servername = $config['servername'];
$username = $config['username'];
$password = $config['password'];
$dbname = $config['dbname'];

$log = new Logging();

	/**
	* Adds a answer to the answer table in the Database
	*
	* @param $answer		answer object
	*/
	function addAnswer($Answer){
		global $servername, $username, $password, $dbname, $log;
		$answer_id = 0;
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            $stmt = $pdo -> prepare('INSERT INTO answers(account_id, header, content, date, upvotes, downvotes, tags) VALUES(:account_id, :header, :content, :date, :upvotes, :downvotes, :tags);');
                //@TODO complete function
										
			$stmt -> bindParam(':account_id', $answer->getAccountId());
			$stmt -> bindParam(':header', $answer->getHeader());
			$stmt -> bindParam(':content', $answer->getContent());
            $stmt -> bindParam(':date', $answer->getDate());
            $stmt -> bindParam(':upvotes', $answer->getUpvotes());
            $stmt -> bindParam(':downvotes', $answer->getDownvotes());
<<<<<<< HEAD
            $stmt -> bindParam(':tags', $answer->get_tags());
=======
            $stmt -> bindParam(':tags', $answer->getTags());
>>>>>>> master
			
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
	function getAnswersByAccount($account){
		global $servername, $username, $password, $dbname, $log;
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
<<<<<<< HEAD
                $a->set_question_id($result[2]);
=======
                $a->setQuestionId($result[2]);
>>>>>>> master
                $a->setContent($result[3]);
                $a->setDate($result[4]);
                $a->setUpvotes($result[5]);
                $a->setDownvotes($result[6]);
<<<<<<< HEAD
                $a->setBest($result[7]);
=======
                $a->settBest($result[7]);
>>>>>>> master

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
	function getAnswersByContent($content){
		global $servername, $username, $password, $dbname, $log;
        $answerArray = [];
		
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

			$stmt = $pdo -> prepare("SELECT id, account_id, question_id, content, date, upvotes, downvotes, best FROM answers WHERE content LIKE '%:content%';");						
			$stmt -> bindParam(':content', $content);
		
			$stmt -> execute();
			
            // while there is an answer with specified content
            while($result = $stmt -> fetch()){
                $a = new Answer();

				$a->setId($result[0]);
                $a->setAccountId($result[1]);
<<<<<<< HEAD
                $a->set_question_id($result[2]);
=======
                $a->setQuestionId($result[2]);
>>>>>>> master
                $a->setContent($result[3]);
                $a->setDate($result[4]);
                $a->setUpvotes($result[5]);
                $a->setDownvotes($result[6]);
<<<<<<< HEAD
                $a->setBest($result[7]);
=======
                $a->settBest($result[7]);
>>>>>>> master

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
	function getAnswersByQuestionId($questionId){
		global $servername, $username, $password, $dbname, $log;
        $answerArray = [];
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

			$stmt = $pdo -> prepare("SELECT id, account_id, question_id, content, date, upvotes, downvotes, best FROM answers WHERE question_id LIKE :questionId ORDER BY upvotes DESC, downvotes, date DESC");						
			$stmt -> bindParam(':questionId', $questionId);
		
			$stmt -> execute();
			
            // while there is an answer with specified content
            while($result = $stmt -> fetch()){
                $a = new Answer();
<<<<<<< HEAD
=======

>>>>>>> master
				$a->setId($result[0]);
                $a->setAccountId($result[1]);
                $a->setQuestionId($result[2]);
                $a->setContent($result[3]);
                $a->setDate($result[4]);
                $a->setUpvotes($result[5]);
                $a->setDownvotes($result[6]);
<<<<<<< HEAD
                $a->setBest($result[7]);
=======
                $a->settBest($result[7]);
>>>>>>> master

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
	function updateAnswer($answer){
		global $servername, $username, $password, $dbname, $log;
		$answer_id = 0;
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            $stmt = $pdo -> prepare('UPDATE answers set content = :content, upvotes = :upvotes, downvotes = :downvotes, best = :best
                WHERE id = :id;');
										
			$stmt -> bindParam(':content', $Answer->getContent());
            $stmt -> bindParam(':upvotes', $Answer->getUpvotes());
            $stmt -> bindParam(':downvotes', $Answer->getDownvotes());
            $stmt -> bindParam(':best', $Answer->getBest());
            $stmt -> bindParam(':id', $Answer->getId());
			
			$stmt -> execute();
            $log->lwrite('Updated Answer succesfully. ID: '.$answer_id);
		}
		catch(PDOException $e){
			$log->lwrite($e -> getMessage());
		}
		finally{
			unset($pdo);
		}
    }
    
?>