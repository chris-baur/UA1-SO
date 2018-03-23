<?php

include_once(dirname(__FILE__).'/../util/logging.php');
include_once(dirname(__FILE__).'/../util/sets.php');
include_once(dirname(__FILE__).'/../models/Question.php');
include_once(dirname(__FILE__).'/../models/Answer.php');
include_once(dirname(__FILE__).'/../models/Account.php');
// $config = parse_ini_file('../../../UA1-SO/config.ini');

class FavouriteController{

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
	* Adds a Favourite to the favourites table in the Database
	*
	* @param $account		Account object
	*/
    static function addFavourite($favourite){
        $servername = self::$servername;
		$username = self::$username;
		$password = self::$password;
		$dbname = self::$dbname;
		$log = self::$log;
		$favouriteId= 0;
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            $stmt = $pdo -> prepare('INSERT INTO favourites(account_id, question_id, answer_id) VALUES( 
                :account_id, :question_id, :answer_id);');
				//@TODO complete function
				
			$accountId = $favourite->getAccountId();
			$questionId = $favourite->getQuestionId();
			$answerId = $favourite->getAnswerId();
										
			$stmt -> bindParam(':account_id', $accountId);
			$stmt -> bindParam(':question_id', $questionId);
			$stmt -> bindParam(':answer_id', $answerId);			
			
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
	static function getFavouriteById($id){
        $servername = self::$servername;
		$username = self::$username;
		$password = self::$password;
		$dbname = self::$dbname;
		$log = self::$log;
		$favourite = new Favourite();
		
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

			$stmt = $pdo -> prepare('SELECT id, account_id, question_id, answer_id FROM favourites WHERE id=?;');						
			$stmt -> bindParam(1, $id);
		
			$stmt -> execute();
			
			// if there is a user with specified username
			if($result = $stmt -> fetch()){
				$favourite->setId($result[0]);
                $favourite->setAccountId($result[1]);
                $favourite->setQuestionId($result[2]);
                $favourite->setAnswerId($result[3]);
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
	static function getFavouriteQuestions($accountId){
        $servername = self::$servername;
		$username = self::$username;
		$password = self::$password;
		$dbname = self::$dbname;
		$log = self::$log;
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

				$q->setId($result[0]);
                $q->setAccountId($result[1]);
                $q->setHeader($result[2]);
                $q->setContent($result[3]);
                $q->setDate($result[4]);
                $q->setUpvotes($result[5]);
                $q->setDownvotes($result[6]);
                $q->setTags($result[7]);

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
	static function getFavouriteAnswers($accountId){
        $servername = self::$servername;
		$username = self::$username;
		$password = self::$password;
		$dbname = self::$dbname;
		$log = self::$log;
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

				$a->setId($result[0]);
                $a->setAccountId($result[1]);
                $a->setQuestionId($result[2]);
                $a->setContent($result[3]);
                $a->setDate($result[4]);
                $a->setUpvotes($result[5]);
                $a->setDownvotes($result[6]);
                $a->setBest($result[7]);

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
	static function deleteFavouriteQuestion($accountId, $questionId){
        $servername = self::$servername;
		$username = self::$username;
		$password = self::$password;
		$dbname = self::$dbname;
		$log = self::$log;
		
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

			$stmt = $pdo -> prepare('DELETE FROM favourites WHERE account_id=:account_id AND question_id=:question_id');						
			$stmt -> bindParam(':account_id', $accountId);
			$stmt -> bindParam(':question_id', $questionId);			
		
			$stmt -> execute();
			$log->lwrite("Favourite question ID: $questionId was removed from account ID: $accountId");
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
	static function deleteAllFavouriteQuestions($accountId){
        $servername = self::$servername;
		$username = self::$username;
		$password = self::$password;
		$dbname = self::$dbname;
		$log = self::$log;
		
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

			$stmt = $pdo -> prepare('DELETE FROM favourites WHERE account_id=:account_id AND question_id IS NOT NULL');						
			$stmt -> bindParam(':account_id', $accountId);		
		
			$stmt -> execute();
			$log->lwrite("All Favourite questions were removed from account ID: $accountId");
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
	static function deleteFavouriteAnswer($accountId, $answerId){
        $servername = self::$servername;
		$username = self::$username;
		$password = self::$password;
		$dbname = self::$dbname;
		$log = self::$log;
		
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

			$stmt = $pdo -> prepare('DELETE FROM favourites WHERE account_id=:account_id AND answer_id=:answer_id');						
			$stmt -> bindParam(':account_id', $accountId);
			$stmt -> bindParam(':answer_id', $answerId);			
		
			$stmt -> execute();
			$log->lwrite("Favourite answer ID: $answerId was removed from account ID: $accountId");
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
	static function deleteAllFavouriteAnswers($accountId){
		$servername = self::$servername;
		$username = self::$username;
		$password = self::$password;
		$dbname = self::$dbname;
		$log = self::$log;
		
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

			$stmt = $pdo -> prepare('DELETE FROM favourites WHERE account_id=:account_id AND answer_id IS NOT NULL');						
			$stmt -> bindParam(':account_id', $accountId);		
		
			$stmt -> execute();
			$log->lwrite("All Favourite answers were removed from account ID: $accountId");
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