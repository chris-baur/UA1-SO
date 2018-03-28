<?php

include_once '../../../private/controllers/Account.php';
include_once '../../../private/controllers/AccountController.php';

$status = session_status();
if($status == PHP_SESSION_NONE){
	//There is no active session
	session_start();					
}		 

$controller = new AccountController();
$account = new Account();
$account = $controller::getAccountByUsername($_SESSION['username']);

$currentPass = $_POST['currentPass'];
$new_password1 = $_POST['newpassword1'];
$new_password2 = $_POST['newpassword2'];

$error;

if(password_verify($currentPass, $account->getPassword())) {
	if ($new_password1 == $new_password2) {
		$newpassword = password_hash($_POST['newpassword1'], PASSWORD_DEFAULT);
		$account->setPassword($newpassword);
		$controller::updateAccount($account);
		$error = "The password has successfully been modified !";
	} else {
		$error = "The new password does not match..";
		header("Location: profile.php?errorMessage=$error");
	}
} else {
	$error = "The current password entered is incorrect..";
	header("Location: profile.php?errorMessage=$error");
}

header("Location: ..\profile.php?errorMessage=$error"); 

?>