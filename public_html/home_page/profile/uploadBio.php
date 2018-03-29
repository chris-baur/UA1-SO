<?php

include_once '../../../private/models/Account.php';
include_once '../../../private/controllers/AccountController.php';

$status = session_status();
if($status == PHP_SESSION_NONE){
	//There is no active session
	session_start();					
}		

$uploadBio =  $_POST['bio'];

$controller = new AccountController();
$account = new Account();
$account = $controller::getAccountByUsername($_SESSION['username']);
$account->setBio($uploadBio);
$controller::updateAccount($account);

header('Location: ..\profile.php');

?> 