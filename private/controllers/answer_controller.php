<?php
include '..\..\private\util\logging.php';
include '..\..\private\util\sets.php';
include '..\..\private\models\Question.php';
include '..\..\private\models\Account.php';
include '..\..\private\models\Answer.php';
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

   
			
			// while there is an answer with specified account id
			while($result = $stmt -> fetch()){
                $a = new Answer();

				$a->set_id($result[0]);
                $a->set_accountId($result[1]);
                $a->set_header($result[2]);
                $a->set_content($result[3]);
                $a->set_date($result[4]);
                $a->set_upvotes($result[5]);
                $a->set_downvotes($result[6]);
                $a->set_tags($result[7]);

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
    
		
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

			$stmt = $pdo -> prepare("SELECT id, account_id, header, content, date, upvotes, downvotes, tags FROM answers WHERE content LIKE '%:content%';");						
			$stmt -> bindParam(':content', $content);
		
			$stmt -> execute();
			
            // while there is an answer with specified content
            while($result = $stmt -> fetch()){
                $a = new Answer();

				$a->set_id($result[0]);
                $a->set_accountId($result[1]);
                $a->set_header($result[2]);
                $a->set_content($result[3]);
                $a->set_date($result[4]);
                $a->set_upvotes($result[5]);
                $a->set_downvotes($result[6]);
                $a->set_tags($result[7]);

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
	 * Returns answers with the specified header
	 *
	 * @param $header		Answer's header
	 */
	function getanswerByHeader($header){
		global $servername, $username, $password, $dbname, $log;
        $answer = new Answer();
        $answerArray = [];
		
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

			$stmt = $pdo -> prepare("SELECT id, account_id, header, content, date, upvotes, downvotes, tags FROM answers WHERE header LIKE '%:header%';");						
			$stmt -> bindParam(':header', $header);
		
			$stmt -> execute();
			
			// while there is a answer with specified header
			while($result = $stmt -> fetch()){
                $a = new Answer();

				$a->set_id($result[0]);
                $a->set_accountId($result[1]);
                $a->set_header($result[2]);
                $a->set_content($result[3]);
                $a->set_date($result[4]);
                $a->set_upvotes($result[5]);
                $a->set_downvotes($result[6]);
                $a->set_tags($result[7]);

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

            $stmt = $pdo -> prepare('UPDATE answers set header = :header, content = :content, upvotes = :upvotes, downvotes = :downvotes, tags = :tags
                WHERE id = :id;');
										
			$stmt -> bindParam(':header', $Answer->get_header());
			$stmt -> bindParam(':content', $Answer->get_content());
            $stmt -> bindParam(':upvotes', $Answer->get_upvotes());
            $stmt -> bindParam(':downvotes', $Answer->get_downvotes());
            $stmt -> bindParam(':tags', $Answer->get_tags());
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