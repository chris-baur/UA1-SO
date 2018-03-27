<?php

include_once '../../private/models/Account.php';
include_once '../../private/controllers/AccountController.php';

$status = session_status();
if($status == PHP_SESSION_NONE){
	//There is no active session
	session_start();					
}		 

$uploaddir = '../img/accounts/';
$newfilename = $_SESSION['username'];
$uploadfile =  $uploaddir. $newfilename. '.png';
	
$controller = new AccountController();
$account = new Account();
$account = $controller::getAccountByUsername($_SESSION['username']);
$account->setProfilePicturePath($uploadfile);
$controller::updateAccount($account);

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
  echo "File is valid, and was successfully uploaded.\n";
} else {
   echo "Upload failed";
}

header('Location: profile.php'); 

?> 