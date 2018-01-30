<?php

include '..\util\logging.php';
include '..\util\sets.php';
$config = parse_ini_file('..\..\..\config.ini');

$servername = $config['servername'];
$username = $config['username'];
$password = $config['password'];
$dbname = $config['dbname'];

$log = new Logging();
$sets = new Sets();
$genders = $sets->to_string_genders();
$security_one = $sets->to_string_security_one();
$security_two = $sets->to_string_security_two();
$professions = $sets->to_string_professions();

//echo $professions;
//echo "   " . $sets->get_professions()[1];


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $log->lwrite('Connected successfully');

	//create accounts
	$sql = "DROP TABLE IF EXISTS `accounts`;CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL DEFAULT 'john117',
  `password` varchar(500) DEFAULT NULL,
  `name` varchar(25) NOT NULL DEFAULT 'default name',
  `last_name` varchar(25) NOT NULL DEFAULT 'default  last',
  `gender` set($genders) NOT NULL DEFAULT '".$sets->get_genders()[0]."',
  `security_one` set($security_one) DEFAULT '".$sets->get_security_one()[0]."',
  `security_two` set($security_two) NOT NULL DEFAULT '".$sets->get_security_two()[0]."',
  `answer_one` varchar(20) NOT NULL DEFAULT 'a1',
  `answer_two` varchar(20) NOT NULL DEFAULT 'a1',
  `bio` varchar(500) NOT NULL DEFAULT 'Training to be like goku',
  `profession` set($professions) NOT NULL DEFAULT '".$sets->get_professions()[2]."',
  `pin` tinyint(4) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1";

	$conn->exec($sql);
    $log->lwrite('Table accounts created successfully');
    
}
catch(PDOException $e)
    {
    $log->lwrite('Connection failed: ' . $e->getMessage());
    }
?>