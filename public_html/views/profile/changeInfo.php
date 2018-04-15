<?php

include_once '../../../private/models/Account.php';
include_once '../../../private/controllers/AccountController.php';

$status = session_status();
if($status == PHP_SESSION_NONE){
	session_start();					
}		 

$controller = new AccountController();
$account = $controller::getAccountByUsername($_SESSION['username']);

//$uname = $_POST['username'];

$error;

if (isset($_POST['profession'])) {
	$profession = $_POST['profession'];
} else {
	$profession = $account->getProfession();
	$error = "Profession options has not been set properly. Please try again.<br>";
}

if (isset($_POST['gender'])) {
	$gender = $_POST['gender'];
}
else {
	$gender = $account->getGender();
	$error .= "Gender options has not been set properly. Please try again.";
}


$fname = $_POST['firstname'];
$lname = $_POST['lastname'];

echo $_POST['profession']. "<br>";
echo $_POST['gender'];

$account->setName($fname);
$account->setLastname($lname);
$account->setProfession($profession);
$account->setGender($gender);
$controller::updateAccount($account);

header("Location: ..\profile.php?Message=$error"); 

/*if(!($uname == $account->getUsername())) {
	if ($controller::accountExists($uname)) {
		$error .= "The username entered already exists. Please try something else.";
	} else {
		$account->setUsername($uname);

	}	
}*/
?>