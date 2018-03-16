<?php

include_once(dirname(__FILE__).'/../util/logging.php');
include_once(dirname(__FILE__).'/../util/sets.php');
include_once(dirname(__FILE__).'/../models/Account.php');
// $config = parse_ini_file('..\..\..\UA1-SO\config.ini');

$config = parse_ini_file(dirname(__FILE__).'/../../config.ini');

$servername = $config['servername'];
$username = $config['username'];
$password = $config['password'];
$dbname = $config['dbname'];

$log = new Logging();
$sets = new Sets();
$genders = $sets->to_string_genders();
$security_one = $sets->to_string_security_one();
$security_two = $sets->to_string_security_two();
$professions = $sets->to_string_professions();

	/**
	* Adds an account to the account table in the Database
	*
	* @param $account		Account object
	*/
	function addAccount($account){
		global $servername, $username, $password, $dbname, $log;
		$user_id = -9;
		try{

			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", "ua1", "Ua1password0)");

			//$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo -> prepare('INSERT INTO accounts(username, password, name, last_name, gender, 
                security_one, security_two, answer_one, answer_two, bio, profession, pin) VALUES(:username, 
                :password, :name, :last_name, :gender, :security_one, :security_two, :answer_one, :answer_two, 
                :bio, :profession, :pin);');
				//@TODO complete function
				
			$user = $account->getUsername();
			$pass = $account->getPassword();
			$name = $account->getName();
			$lname = $account->getLastName();
			$gender = $account->getGender();
			$s1 = $account->getSecurityOne();
			$s2 = $account->getSecurityTwo();
			$a1 = $account->getAnswerOne();
			$a2 = $account->getAnswerTwo();
			$bio = $account->getBio();
			$profession = $account->getProfession();
			$pin = $account->getPin();
										
			$stmt -> bindParam(':username', $user);
			$stmt -> bindParam(':password', $pass);
			$stmt -> bindParam(':name', $name);
            $stmt -> bindParam(':last_name', $lname);
            $stmt -> bindParam(':gender', $gender);
            $stmt -> bindParam(':security_one', $s1);
            $stmt -> bindParam(':security_two', $s2);
            $stmt -> bindParam(':answer_one', $a1);
            $stmt -> bindParam(':answer_two', $a2);
            $stmt -> bindParam(':bio', $bio);
            $stmt -> bindParam(':profession', $profession);
            $stmt -> bindParam(':pin', $pin);
			
			$stmt -> execute();
            $user_id = $pdo -> lastInsertId();
            $log->lwrite('added account succesfully. ID: '.$user_id);
		}
		catch(PDOException $e){
			$log->lwrite($e -> getMessage());
		}
		finally{
			unset($pdo);
		}
		return $user_id;
    }

    /**
	 * Checks if the account currently exists with specific username
	 *
	 * @param $username			Account's username
	 */
	function accountExists($username){
		$exists = false;
		$account = getAccountByUsername($username);
		
		// user id will be we be 0 if there is no such user
		if ($account -> getId() != 0){
			$exists = true;
		}
		return $exists;
    }
    
    /**
	 * Returns an account with the specified username, otherwsie returns default Account if none found
	 *
	 * @param $username		Account's username
	 */
	function getAccountByUsername($user){
		global $servername, $username, $password, $dbname, $log;

		$account = new Account();
		

		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", "ua1", "Ua1password0)"); //hardcoded

			$stmt = $pdo -> prepare('SELECT id, username, password, name, last_name, gender, security_one, security_two, answer_one, answer_two, bio, profession, pin FROM accounts WHERE username=?;');						
			$stmt -> bindParam(1, $user);
		
			$stmt -> execute();
		
			// if there is a user with specified username
			if($result = $stmt -> fetch()){
				$account->setId($result[0]);
                $account->setUsername($result[1]);
                $account->setPassword($result[2]);
                $account->setName($result[3]);
                $account->setLastName($result[4]);
                $account->setGender($result[5]);
                $account->setSecurityOne($result[6]);
                $account->setSecurityTwo($result[7]);
                $account->setAnswerOne($result[8]);
                $account->setAnswerTwo($result[9]);
                $account->setBio($result[10]);
                $account->setProfession($result[11]);
                $account->setPin($result[12]);
			}
		}
		catch(PDOException $e){
			$log->lwrite($e -> getMessage());
		}
		finally{
			unset($pdo);
		}
		// returns the account object
		return $account;
	}

	/**
	* Updates an account in the account table of the Database
	*
	* @param $account		Account object
	*/
	function updateAccount($account){
		global $servername, $username, $password, $dbname, $log;
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", "ua1", "Ua1password0)");

            $stmt = $pdo -> prepare('UPDATE accounts set password = :password, name = :name, last_name = :last_name, gender = :gender, 
                security_one = :security_one, security_two = :security_two, answer_one = :answer_one, answer_two = :answer_two,
				bio = :bio, profession = :profession, pin = :pin WHERE username = :username;');
                //@TODO complete function
										
			$stmt -> bindParam(':username', $account->getUsername());
			$stmt -> bindParam(':password', $account->getPassword());
			$stmt -> bindParam(':name', $account->getUsername());
            $stmt -> bindParam(':last_name', $account->getLastName());
            $stmt -> bindParam(':gender', $account->getGender());
            $stmt -> bindParam(':security_one', $account->getSecurityOne());
            $stmt -> bindParam(':security_two', $account->getSecurityTwo());
            $stmt -> bindParam(':answer_one', $account->getAnswerOne());
            $stmt -> bindParam(':answer_two', $account->getAnswerTwo());
            $stmt -> bindParam(':bio', $account->getBio());
            $stmt -> bindParam(':profession', $account->getProfession());
            $stmt -> bindParam(':pin', $account->getPin());
			
			$stmt -> execute();
            $log->lwrite('account updated succesfully. user name: '. $account->getUsername());
		}
		catch(PDOException $e){
			$log->lwrite($e -> getMessage());
		}
		finally{
			unset($pdo);
		}
    }

    /**
	 * Returns an account with the specified id, otherwsie returns default Account if none found
	 *
	 * @param $username		Account's username
	 */
	function getAccountById($id){
		global $servername, $username, $password, $dbname, $log;

		$account = new Account();
		

		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

			$stmt = $pdo -> prepare('SELECT id, username, password, name, last_name, gender, security_one, security_two, answer_one, answer_two, bio, profession, pin FROM accounts WHERE id=?;');
			$stmt -> bindParam(1, $id);
		
			$stmt -> execute();
		
			// if there is a user with specified id
			if($result = $stmt -> fetch()){
				$account->setId($result[0]);
                $account->setUsername($result[1]);
                $account->setPassword($result[2]);
                $account->setName($result[3]);
                $account->setLastName($result[4]);
                $account->setGender($result[5]);
                $account->setSecurityOne($result[6]);
                $account->setSecurityTwo($result[7]);
                $account->setAnswerOne($result[8]);
                $account->setAnswerTwo($result[9]);
                $account->setBio($result[10]);
                $account->setProfession($result[11]);
                $account->setPin($result[12]);
			}
		}
		catch(PDOException $e){
			$log->lwrite($e -> getMessage());
		}
		finally{
			unset($pdo);
		}
		// returns the account object
		return $account;
	}
    
?>