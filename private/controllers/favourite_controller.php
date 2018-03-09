<?php

include_once '..\..\private\util\logging.php';
include_once '..\..\private\models\Favourite.php';
include_once '..\..\private\models\Question.php';
include_once '..\..\private\models\Answer.php';
$config = parse_ini_file('..\..\config.ini');


$servername = $config['servername'];
$username = $config['username'];
$password = $config['password'];
$dbname = $config['dbname'];

$log = new Logging();
$sets = new Sets();

	/**
	* Adds a Favourite to the favourites table in the Database
	*
	* @param $account		Account object
	*/
	function addFavourite($favourite){
		global $servername, $username, $password, $dbname, $log;
		$favouriteId= 0;
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            $stmt = $pdo -> prepare('INSERT INTO favourites(id, account_id, question_id, answer_id) VALUES(:id, 
                :account_id, :question_id, :answer_id);');
                //@TODO complete function
										
			$stmt -> bindParam(':id', $favourite->get_id());
			$stmt -> bindParam(':account_id', $favourite->get_accountId());
			$stmt -> bindParam(':question_id', $favourite->get_questionId());
            $stmt -> bindParam(':answer_id', $favourite->get_answerId());
			
			$stmt -> execute();
            $favouriteId = $pdo -> lastInsertId();
            $log->lwrite('added favourite succesfully. ID: '.$favouriteId);
		}
		catch(PDOException $e){
			$log->lwrite($e -> getMessage());
		}
		finally{
			unset($pdo);
		}
		return $favouriteId;
    }
    
    /**
	 * Returns a favourite with the specified id, otherwsie returns default faourite if none found
	 *
	 * @param $id		favourite's id
	 */
	function getFavouriteById($id){
		global $servername, $username, $password, $dbname, $log;
		$favourite = new Favourites();
		
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

			$stmt = $pdo -> prepare('SELECT id, account_id, question_id, answer_id FROM favourites WHERE id=?;');						
			$stmt -> bindParam(1, $id);
		
			$stmt -> execute();
			
			// if there is a user with specified username
			if($result = $stmt -> fetch()){
				$favourite->set_id($result[0]);
                $favourite->set_accountId($result[1]);
                $favourite->set_questionId($result[2]);
                $favourite->set_answerId($result[3]);
			}
		}
		catch(PDOException $e){
			$log->lwrite($e -> getMessage());
		}
		finally{
			unset($pdo);
		}
		// returns the favourite object
		return $favourite;
    }
    
    /**
	 * Returns a favourite array of questions with the specified account_id, otherwsie returns default faourite if none found
	 *
	 * @param $accountId		favourite's account id
	 */
	function getFavouriteQuestions($accountId){
		global $servername, $username, $password, $dbname, $log;
		$favouritesArray = [];
		
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

			$stmt = $pdo -> prepare('SELECT Q.id, Q.account_id, Q.header, Q.content, Q.date, Q.upvotes, Q.downvotes, Q.tags FROM questions Q JOIN favourites F 
                ON Q.id=F.question_id WHERE F.account_id=:account_id AND F.question_id IS NOT NULL;');						
			$stmt -> bindParam(':account_id', $accountId);
		
			$stmt -> execute();
			
			// if there is a user with specified username
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

                $favouritesArray[] = $q;
			}
		}
		catch(PDOException $e){
			$log->lwrite($e -> getMessage());
		}
		finally{
			unset($pdo);
		}
		// returns the favourite object
		return $favouritesArray;
	}
	
	/**
	 * Returns a favourite array of answers with the specified account_id, otherwsie returns default faourite if none found
	 *
	 * @param $accountId		favourite's account id
	 */
	function getFavouriteAnswers($accountId){
		global $servername, $username, $password, $dbname, $log;
		$favouritesArray = [];
		
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

			$stmt = $pdo -> prepare('SELECT A.id, A.account_id, A.question_id, A.content, A.date, A.upvotes, A.downvotes, A.best FROM answers A JOIN favourites F 
                ON A.id=F.answer_id WHERE F.account_id=:account_id AND F.answer_id IS NOT NULL;');						
			$stmt -> bindParam(':account_id', $accountId);
		
			$stmt -> execute();
			
			// if there is a user with specified username
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

                $favouritesArray[] = $a;
			}
		}
		catch(PDOException $e){
			$log->lwrite($e -> getMessage());
		}
		finally{
			unset($pdo);
		}
		// returns the favourite object
		return $favouritesArray;
	}

	/**
	 * removes the favourite question from the account
	 *
	 * @param $questionId		favourite's question id
	 * @param $accountId		favourite's account id
	 */
	function deleteFavouriteQuestion($accountId, $questionId){
		global $servername, $username, $password, $dbname, $log;
		
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

			$stmt = $pdo -> prepare('DELETE FROM favourites WHERE account_id=:account_id AND question_id=:question_id');						
			$stmt -> bindParam(':account_id', $accountId);
			$stmt -> bindParam(':question_id', $questionId);			
		
			$stmt -> execute();
			$low->lwrite("Favourite question ID: $questionId was removed from account ID: $accountId");
		}
		catch(PDOException $e){
			$log->lwrite($e -> getMessage());
		}
		finally{
			unset($pdo);
		}
	}
	
	/**
	 * removes all favourite questions from the account
	 *
	 * @param $questionId		favourite's question id
	 * @param $accountId		favourite's account id
	 */
	function deleteAllFavouriteQuestions($accountId){
		global $servername, $username, $password, $dbname, $log;
		
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

			$stmt = $pdo -> prepare('DELETE FROM favourites WHERE account_id=:account_id AND question_id IS NOT NULL');						
			$stmt -> bindParam(':account_id', $accountId);		
		
			$stmt -> execute();
			$low->lwrite("All Favourite questions were removed from account ID: $accountId");
		}
		catch(PDOException $e){
			$log->lwrite($e -> getMessage());
		}
		finally{
			unset($pdo);
		}
	}
	
	/**
	 * removes the favourite answer from the account
	 *
	 * @param $answerId		favourite's answer id
	 * @param $accountId		favourite's account id
	 */
	function deleteFavouriteAnswer($accountId, $answerId){
		global $servername, $username, $password, $dbname, $log;
		
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

			$stmt = $pdo -> prepare('DELETE FROM favourites WHERE account_id=:account_id AND answer_id=:answer_id');						
			$stmt -> bindParam(':account_id', $accountId);
			$stmt -> bindParam(':answer_id', $answerId);			
		
			$stmt -> execute();
			$low->lwrite("Favourite answer ID: $answerId was removed from account ID: $accountId");
		}
		catch(PDOException $e){
			$log->lwrite($e -> getMessage());
		}
		finally{
			unset($pdo);
		}
	}
	
	/**
	 * removes all favourite answers from the account
	 *
	 * @param $answerId		favourite's answer id
	 * @param $accountId		favourite's account id
	 */
	function deleteAllFavouriteAnswers($accountId){
		global $servername, $username, $password, $dbname, $log;
		
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

			$stmt = $pdo -> prepare('DELETE FROM favourites WHERE account_id=:account_id AND answer_id IS NOT NULL');						
			$stmt -> bindParam(':account_id', $accountId);		
		
			$stmt -> execute();
			$low->lwrite("All Favourite answers were removed from account ID: $accountId");
		}
		catch(PDOException $e){
			$log->lwrite($e -> getMessage());
		}
		finally{
			unset($pdo);
		}
    }

?>