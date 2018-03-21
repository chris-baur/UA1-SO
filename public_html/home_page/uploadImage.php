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

$uploaddir = '../img/accounts/';
$newfilename = $_SESSION['username'];
$uploadfile =  $uploaddir. $newfilename. '.png';
$_SESSION['name'] = $uploadfile;

echo $uploadfile;

$stmt = $conn->prepare("UPDATE `accounts` SET `name` = '$uploadfile' WHERE `accounts`.`username` = '$newfilename'");
//$stmt = $conn->prepare("UPDATE accounts SET name = $uploadfile");
$stmt->bindParam(':name', $uploadfile);
$stmt->execute();	

echo "<p>";

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
  echo "File is valid, and was successfully uploaded.\n";
} else {
   echo "Upload failed";
}

header('Location: profile.php'); 

echo "</p>";
echo '<pre>';
echo 'Here is some more debugging info:';
print_r($_FILES);
print "</pre>";

?> 