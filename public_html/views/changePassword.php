<?php

include_once '../../private/controllers/AccountController.php';

$config = parse_ini_file('../../config.ini');
$username = $config['username'];
$password = $config['password'];
$dbname = $config['dbname'];
$servername = $config['servername'];

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$status = session_status();
if($status == PHP_SESSION_NONE){
	//There is no active session
	session_start();					
}		 

$controller = new AccountController();
$account = new Account();
$account = $controller::getAccountByUsername($_SESSION['username']);

$user = $_SESSION['username'];
$currentPass = $_POST['currentPass'];
$new_password1 = $_POST['newpassword1'];
$new_password2 = $_POST['newpassword2'];

$error;

if(password_verify($currentPass, $account->getPassword())) {
	if ($new_password1 == $new_password2) {
		if(strlen($_POST['newpassword1'])<8){
			$error = "The new password is too short";
			header("Location: profile.php?errorMessage=$error");
		}
		else if($new_password1 == $currentPass){
			$error = "The new password the same as the current pass, please enter a new password";
			header("Location: profile.php?errorMessage=$error");
		}
		else{
			$newpassword = password_hash($_POST['newpassword1'], PASSWORD_DEFAULT);
			$account->setPassword($newpassword);
			$controller::updateAccount($account);

			$stmt = $conn->prepare("UPDATE `accounts` SET `password` = '$newpassword' WHERE `accounts`.`username` = '$user'");
			$stmt->bindParam(':password', $newpassword);
			$stmt->execute();
			$error = "The password has successfully been modified!";
		}
	} else {
		$error = "The new password does not match";
		header("Location: profile.php?errorMessage=$error");
	}
} else {
	$error = "The current password entered is incorrect";
	header("Location: profile.php?errorMessage=$error");
}


header("Location: profile.php?errorMessage=$error"); 

?>