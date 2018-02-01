<?php

include '..\util\logging.php';
include '..\util\sets.php';
$config = parse_ini_file('..\..\..\config.ini');

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
		global $servername, $username, $password, $dbname;
		$user_id = 0;
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            $stmt = $pdo -> prepare('INSERT INTO accounts(username, password, name, last_name, gender, 
                security_one, security_two, answer_one, answer_two, bio, profession, pin) VALUES(:username, 
                :password, :name, :last_name, :gender, :security_one, :security_two, :answer_one, :answer_two, 
                :bio, :profession, :pin);');
                //@TODO complete function
			$name = $userObj -> getName();
			$email = $userObj -> getEmail();
			$username = $userObj -> getUsername();
			$password = $userObj -> getPassword();
										
			$stmt -> bindParam(1, $name);
			$stmt -> bindParam(2, $email);
			$stmt -> bindParam(3, $username);
			$stmt -> bindParam(4, $password);
			
			$stmt -> execute();
			$user_id = $pdo -> lastInsertId();
		}
		catch(PDOException $e){
			echo $e -> getMessage();
		}
		finally{
			unset($pdo);
		}
		return $user_id;
    }
    
?>