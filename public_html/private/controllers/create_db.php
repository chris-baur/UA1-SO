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
	$sql = "DROP TABLE IF EXISTS `accounts`;CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL DEFAULT 'john117',
  `password` varchar(500) DEFAULT NULL,
  `name` varchar(25) NOT NULL DEFAULT 'default name',
  `last_name` varchar(25) NOT NULL DEFAULT 'default  last',
  `gender` set('male','female','other') NOT NULL DEFAULT 'other',
  `security_one` set('q1','q2','q3') DEFAULT 'q1',
  `security_two` set('q1','q2','q3') NOT NULL DEFAULT 'q1',
  `answer_one` varchar(20) NOT NULL DEFAULT 'a1',
  `answer_two` varchar(20) NOT NULL DEFAULT 'a1',
  `bio` varchar(500) NOT NULL DEFAULT 'Training to be like goku',
  `profession` set('gamer','student','potatoe','teacher','professor','hipster','trainer','sloth') NOT NULL DEFAULT 'potatoe',
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