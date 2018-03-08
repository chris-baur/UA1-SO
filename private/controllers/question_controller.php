<?php
include '..\..\private\models\Question.php';
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
		$question_id = 0;
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            $stmt = $pdo -> prepare('INSERT INTO questions(account_id, header, content, date, upvotes, downvotes, tags) VALUES(:account_id, :header, :content, :date, :upvotes, :downvotes, :tags);');
                //@TODO complete function
										
			$account_id=$question->get_accountId();
			$header  =	$question->get_header();
			$content =	$question->get_content();
			$date =	$question->get_date();
			$upvotes=$question->get_upvotes();
			$downvotes=$question->get_downvotes();
			$tags=  implode(" ",$question->get_tags());

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
			$accountID=$account->get_id();						
			$stmt -> bindParam(':account_id',$accountID );
		
			$stmt -> execute();
			
			// while there is a question with specified account id
			while($result = $stmt -> fetch()){
                $q = new Question();

				$q->set_id($result[0]);
                $q->set_accountId($result[1]);
                $q->set_header($result[2]);
                $q->set_content($result[3]);
                $q->set_date($result[4]);
                $q->set_upvotes($result[5]);
                $q->set_downvotes($result[6]);
                $q->set_tags($result[7]);

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

				$q->set_id($result[0]);
                $q->set_accountId($result[1]);
                $q->set_header($result[2]);
                $q->set_content($result[3]);
                $q->set_date($result[4]);
                $q->set_upvotes($result[5]);
                $q->set_downvotes($result[6]);
                $q->set_tags($result[7]);

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

				$q->set_id($result[0]);
                $q->set_accountId($result[1]);
                $q->set_header($result[2]);
                $q->set_content($result[3]);
                $q->set_date($result[4]);
                $q->set_upvotes($result[5]);
                $q->set_downvotes($result[6]);
                $q->set_tags($result[7]);

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
										
			$stmt -> bindParam(':header', $question->get_header());
			$stmt -> bindParam(':content', $question->get_content());
            $stmt -> bindParam(':upvotes', $question->get_upvotes());
            $stmt -> bindParam(':downvotes', $question->get_downvotes());
            $stmt -> bindParam(':tags', $question->get_tags());
            $stmt -> bindParam(':id', $question->get_id());
			
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