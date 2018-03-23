<?php

include_once '../../private/models/Account.php';
include_once '../../private/controllers/accountController.php';

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

$uploadBio =  $_POST['bio'];

$controller = new AccountController();
$account = new Account();
$account = $controller::getAccountByUsername($_SESSION['username']);
$account->setBio($uploadBio);
$controller::updateAccount($account);

$stmt = $conn->prepare("UPDATE `accounts` SET `bio` = '$uploadBio' WHERE `accounts`.`username` = '$user'");
$stmt->bindParam(':bio', $uploadBio);
$stmt->execute();

header('Location: profile.php');

?> 