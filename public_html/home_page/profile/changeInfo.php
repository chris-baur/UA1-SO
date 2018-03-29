<?php

include_once '../../../private/controllers/Account.php';
include_once '../../../private/controllers/AccountController.php';

$status = session_status();
if($status == PHP_SESSION_NONE){
	//There is no active session
	session_start();					
}		 

$controller = new AccountController();
$account = $controller::getAccountByUsername($_SESSION['username']);

$uname = $_POST['username'];
$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$profession = $_POST['profession'];
$gender = $_POST['gender'];

$error = "General Informations has successfully been modified !";

/*if(!($uname = $_SESSION['username'])) {
	if ($controller::accountExists($uname)) {
		$error = "The username entered already exists. Please try something else.";
	} else {
		//$account->setUsername($uname);
	}	
}*/

$account->setName($fname);
$account->setLastname($lname);
$account->setProfession($profession);
$account->setGender($gender);
$controller::updateAccount($account);

$error = "General Informations has successfully been modified !";

header("Location: ..\profile.php?Message=$error"); 

?>