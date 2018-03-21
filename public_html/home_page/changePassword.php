<?php

echo "I LOVE YOU <br>";

$config = parse_ini_file('../../config.ini');
$username = $config['username'];
$password = $config['password'];
$dbname = $config['dbname'];
$servername = $config['servername'];

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo "Connected successfully to database <br>" ; 

$status = session_status();
if($status == PHP_SESSION_NONE){
	//There is no active session
	session_start();
	echo "Session exists <br>";					
}

echo $status;	

?>