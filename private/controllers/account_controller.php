<?php

include_once '..\..\private\util\logging.php';
include_once '..\..\private\util\sets.php';
include_once '..\..\private\models\Account.php';
$config = parse_ini_file('..\..\..\UA1-SO\config.ini');

$config = parse_ini_file('..\..\config.ini');

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
				
			$user = $account->get_username();
			$pass = $account->get_password();
			$name = $account->get_name();
			$lname = $account->get_last_name();
			$gender = $account->get_gender();
			$s1 = $account->get_security_one();
			$s2 = $account->get_security_two();
			$a1 = $account->get_answer_one();
			$a2 = $account->get_answer_two();
			$bio = $account->get_bio();
			$profession = $account->get_profession();
			$pin = $account->get_pin();
										
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
		if ($account -> get_id() != 0){
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
				$account->set_id($result[0]);
                $account->set_username($result[1]);
                $account->set_password($result[2]);
                $account->set_name($result[3]);
                $account->set_last_name($result[4]);
                $account->set_gender($result[5]);
                $account->set_security_one($result[6]);
                $account->set_security_two($result[7]);
                $account->set_answer_one($result[8]);
                $account->set_answer_two($result[9]);
                $account->set_bio($result[10]);
                $account->set_profession($result[11]);
                $account->set_pin($result[12]);
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
		$user_id = 0;
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", "ua1", "Ua1password0)");

            $stmt = $pdo -> prepare('UPDATE accounts set password = :password, name = :name, last_name = :last_name, gender = :gender, 
                security_one = :security_one, security_two = :security_two, answer_one = :answer_one, answer_two = :answer_two,
				bio = :bio, profession = :profession, pin = :pin WHERE username = :username;');
                //@TODO complete function
										
			$stmt -> bindParam(':username', $account->get_username());
			$stmt -> bindParam(':password', $account->get_password());
			$stmt -> bindParam(':name', $account->get_username());
            $stmt -> bindParam(':last_name', $account->get_last_name());
            $stmt -> bindParam(':gender', $account->get_gender());
            $stmt -> bindParam(':security_one', $account->get_security_one());
            $stmt -> bindParam(':security_two', $account->get_security_two());
            $stmt -> bindParam(':answer_one', $account->get_answer_one());
            $stmt -> bindParam(':answer_two', $account->get_answer_two());
            $stmt -> bindParam(':bio', $account->get_bio());
            $stmt -> bindParam(':profession', $account->get_profession());
            $stmt -> bindParam(':pin', $account->get_pin());
			
			$stmt -> execute();
            $log->lwrite('account updated succesfully. user name: '.$account->get_username());
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
	 * Returns an account with the specified id, otherwsie returns default Account if none found
	 *
	 * @param $username		Account's username
	 */
	function getAccountById($id){
		global $servername, $username, $password, $dbname, $log;

		$account = new Account();
		

		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", "ua1", "Ua1password0)");

			$stmt = $pdo -> prepare('SELECT id, username, password, name, last_name, gender, security_one, security_two, answer_one, answer_two, bio, profession, pin FROM accounts WHERE id=?;');
			$stmt -> bindParam(1, $id);
		
			$stmt -> execute();
		
			// if there is a user with specified id
			if($result = $stmt -> fetch()){
				$account->set_id($result[0]);
                $account->set_username($result[1]);
                $account->set_password($result[2]);
                $account->set_name($result[3]);
                $account->set_last_name($result[4]);
                $account->set_gender($result[5]);
                $account->set_security_one($result[6]);
                $account->set_security_two($result[7]);
                $account->set_answer_one($result[8]);
                $account->set_answer_two($result[9]);
                $account->set_bio($result[10]);
                $account->set_profession($result[11]);
                $account->set_pin($result[12]);
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