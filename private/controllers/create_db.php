<?php

/**
 * @author Christoffer Baur
 */

include '..\util\logging.php';
include '..\util\sets.php';
$config = parse_ini_file('..\..\config.ini');

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

// comment or uncomment for creating database and tables
//createDatabaseAndTables();

function createDatabaseAndTales(){
    createDatabase();
    createAccountsTable();
    createQuestionsTable();
}

function createDatabase(){
    global $servername, $username, $password, $dbname;
    
    try {
        $pdo = new PDO("mysql:host=$servername", $username, $password);

        $stmt = "DROP DATABASE IF EXISTS $dbname;
                 CREATE DATABASE $dbname;";

        $pdo -> exec($stmt);
    } catch (PDOException $e) {
        echo $e -> getMessage();	
    } finally{
        unset ($pdo);
    }
}

function createAccountsTable(){
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $log->lwrite('Connected successfully');

        //create accounts
        $sql = "DROP TABLE IF EXISTS `accounts`;CREATE TABLE IF NOT EXISTS `accounts` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
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
            `pin` tinyint(4) UNSIGNED NULL DEFAULT NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY `username` (`username`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1";

        $conn->exec($sql);
        $log->lwrite('Table accounts created successfully');
        
    }
    catch(PDOException $e)
    {
    $log->lwrite('Connection failed: ' . $e->getMessage());
    }finally{
        unset ($pdo);
    }
}

function createQuestionsTable(){
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $log->lwrite('Connected successfully');

        //create Questions Table
        $sql = "DROP TABLE IF EXISTS `questions`;
            CREATE TABLE IF NOT EXISTS `questions` (
            `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
            `header` varchar(100) NOT NULL DEFAULT 'Ain''t it Fun',
            `content` varchar(500) NOT NULL DEFAULT 'Brick by Boring Brick',
            `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `upvotes` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
            `downvotes` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
            `tags` varchar(100) NOT NULL DEFAULT 'noob',
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1";

        $conn->exec($sql);
        $log->lwrite('Questions Table created successfully');
        
    }
    catch(PDOException $e)
    {
        $log->lwrite('Connection failed: ' . $e->getMessage());
    }finally{
        unset ($pdo);
    }
}
?>