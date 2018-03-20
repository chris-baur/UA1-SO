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
										
			$stmt -> bindParam(':account_id', $answer->get_accountId());
			$stmt -> bindParam(':header', $answer->get_header());
			$stmt -> bindParam(':content', $answer->get_content());
            $stmt -> bindParam(':date', $answer->get_date());
            $stmt -> bindParam(':upvotes', $answer->get_upvotes());
            $stmt -> bindParam(':downvotes', $answer->get_downvotes());
            $stmt -> bindParam(':tags', $answer->get_tags());
			
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
			$accountID=$account->get_id();						
			$stmt -> bindParam(':account_id',$accountID );
		
			$stmt -> execute();
			
			// while there is an answer with specified account id
			while($result = $stmt -> fetch()){
                $a = new Answer();

				$a->set_id($result[0]);
                $a->set_accountId($result[1]);
                $a->set_question_id($result[2]);
                $a->set_content($result[3]);
                $a->set_date($result[4]);
                $a->set_upvotes($result[5]);
                $a->set_downvotes($result[6]);
                $a->set_best($result[7]);

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

				$a->set_id($result[0]);
                $a->set_accountId($result[1]);
                $a->set_question_id($result[2]);
                $a->set_content($result[3]);
                $a->set_date($result[4]);
                $a->set_upvotes($result[5]);
                $a->set_downvotes($result[6]);
                $a->set_best($result[7]);

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

			$stmt = $pdo -> prepare("SELECT id, account_id, question_id, content, date, upvotes, downvotes, best FROM answers WHERE question_id LIKE :questionId");						
			$stmt -> bindParam(':questionId', $questionId);
		
			$stmt -> execute();
			
            // while there is an answer with specified content
            while($result = $stmt -> fetch()){
                $a = new Answer();
				$a->set_id($result[0]);
                $a->set_accountId($result[1]);
                $a->set_questionId($result[2]);
                $a->set_content($result[3]);
                $a->set_date($result[4]);
                $a->set_upvotes($result[5]);
                $a->set_downvotes($result[6]);
                $a->set_best($result[7]);

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
										
			$stmt -> bindParam(':content', $Answer->get_content());
            $stmt -> bindParam(':upvotes', $Answer->get_upvotes());
            $stmt -> bindParam(':downvotes', $Answer->get_downvotes());
            $stmt -> bindParam(':best', $Answer->get_best());
            $stmt -> bindParam(':id', $Answer->get_id());
			
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