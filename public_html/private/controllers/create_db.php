<?php

include '../util/logging.php';
$config = parse_ini_file('../../../config.ini');

$servername = $config['servername'];
$username = $config['username'];
$password = $config['password'];
$dbname = $config['dbname'];

$log = new Logging();

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $log->lwrite('Connected successfully');
	
	//create accounts
	
    }
catch(PDOException $e)
    {
    $log->lwrite('Connection failed: ' . $e->getMessage());
    }
?>