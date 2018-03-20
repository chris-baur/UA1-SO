<?php

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

$user = $_SESSION['username'];
$old_password = $_POST['oldpassword'];

$stmt = $conn->prepare("SELECT `password` FROM `accounts` WHERE `accounts`.`username` = '$user'");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

echo $result;

foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        echo $v;
    }

if(password_verify($old_password, htmlentities($_SESSION['password']))) {
	$new_password = password_hash($_POST['newpassword'], PASSWORD_DEFAULT);

	$stmt = $conn->prepare("UPDATE `accounts` SET `password` = '$new_password' WHERE `accounts`.`username` = '$user'");
	$stmt->bindParam(':password', $new_password);
	$stmt->execute();
} else {
	echo "ERROOOOOOR";
}
?>