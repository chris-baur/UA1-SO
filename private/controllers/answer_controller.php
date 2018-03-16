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
										
			$stmt -> bindParam(':account_id', $answer->getAccountId());
			$stmt -> bindParam(':header', $answer->getHeader());
			$stmt -> bindParam(':content', $answer->getContent());
            $stmt -> bindParam(':date', $answer->getDate());
            $stmt -> bindParam(':upvotes', $answer->getUpvotes());
            $stmt -> bindParam(':downvotes', $answer->getDownvotes());
            $stmt -> bindParam(':tags', $answer->getTags());
			
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

				$a->setId($result[0]);
                $a->setAccountId($result[1]);
                $a->setHeader($result[2]);
                $a->setContent($result[3]);
                $a->setDate($result[4]);
                $a->setUpvotes($result[5]);
                $a->setDownvotes($result[6]);
                $a->setTags($result[7]);

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

				$a->setId($result[0]);
                $a->setAccountId($result[1]);
                $a->setHeader($result[2]);
                $a->setContent($result[3]);
                $a->setDate($result[4]);
                $a->setUpvotes($result[5]);
                $a->setDownvotes($result[6]);
                $a->setTags($result[7]);

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

				$a->setId($result[0]);
                $a->setAccountId($result[1]);
                $a->setHeader($result[2]);
                $a->setContent($result[3]);
                $a->setDate($result[4]);
                $a->setUpvotes($result[5]);
                $a->setDownvotes($result[6]);
                $a->setTags($result[7]);

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
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            $stmt = $pdo -> prepare('UPDATE answers set header = :header, content = :content, upvotes = :upvotes, downvotes = :downvotes, tags = :tags
                WHERE id = :id;');
										
			$stmt -> bindParam(':header', $answer->getHeader());
			$stmt -> bindParam(':content', $nswer->getContent());
            $stmt -> bindParam(':upvotes', $answer->getUpvotes());
            $stmt -> bindParam(':downvotes', $answer->getDownvotes());
            $stmt -> bindParam(':tags', $answer->getTags());
            $stmt -> bindParam(':id', $answer->getId());
			
			$stmt -> execute();
            $log->lwrite('Updated Answer succesfully. ID: '. $answer->getId());
		}
		catch(PDOException $e){
			$log->lwrite($e -> getMessage());
		}
		finally{
			unset($pdo);
		}
    }
    
?>