<?php

/**
 * @author Christoffer Baur
 */

include_once '..\util\logging.php';
include_once '..\util\sets.php';
include_once '.\account_controller.php';
$config = parse_ini_file('..\..\config.ini');

$servername = $config['servername'];
$username = $config['username'];
$password = $config['password'];
$dbname = $config['dbname'];

$log = new Logging();

// comment or uncomment for creating database and tables
createDatabaseAndTables();

function createDatabaseAndTables(){
    createDatabase();
    createAccountsTable();
    createQuestionsTable();
    createAnswersTable();
    createCommentsTable();
    createFavouritesTable();
    //createDefaultAccount();
}

function createDatabase(){
    global $servername, $username, $password, $dbname, $log;
    
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
// function createDefaultAccount(){
//     global $servername, $username, $password, $dbname, $log, $sets;
//     $s1 = strtok($sets->to_string_security_one(), ',');
//     $s1 = str_replace("'","",$s1);
//     $s2 = strtok($sets->to_string_security_two(), ',');
//     $s2 = str_replace("'","",$s2);
//     //password is hashed version of 'password'
//     $a = new Account(-1, 'John118', '$2y$10$C/uoZeY8TclVBl7UskXJceE7v800lyCnANBNtbTWX6jH7/dtOSqoK', 'John', 'Master Chief', 'Male', $s1, $s2, 'Cortana', 'EDZ', 'Last Spartan Alive', 'Gamer', null);
//     $id = addAccount($a);
// }

function createAccountsTable(){
    global $servername, $username, $password, $dbname, $log;
    
    $sets = new Sets();
    $genders = $sets->to_string_genders();
    $security_one = $sets->to_string_security_one();
    $security_two = $sets->to_string_security_two();
    $professions = $sets->to_string_professions();

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
            `answer_two` varchar(20) NOT NULL DEFAULT 'a2',
            `bio` varchar(500) NOT NULL DEFAULT 'Training to be like goku',
            `profession` set($professions) NOT NULL DEFAULT '".$sets->get_professions()[2]."',
            `pin` varchar(4) DEFAULT NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY `username` (`username`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;INSERT INTO `accounts` (`username`, `password`, `name`, `last_name`, `gender`, `security_one`, `security_two`, `answer_one`, `answer_two`, `bio`, `profession`, `pin`) VALUES
            ('john117', '$2y$10\$C/uoZeY8TclVBl7UskXJceE7v800lyCnANBNtbTWX6jH7/dtOSqoK', 'John', 'Master Chief', 'Male', 'What is the first name of the person you first kissed?', 'In what city or town did your mother and father meet?', 'Cortana', 'EDZ', 'Last Spartan Alive', 'Gamer', NULL);
            COMMIT;";

        $conn->exec($sql);
        $log->lwrite('Table accounts created successfully');
        
    }
    catch(PDOException $e){
        $log->lwrite('Connection failed: ' . $e->getMessage());
    }finally{
        unset ($pdo);
    }
}

function createAnswersTable(){
    global $servername, $username, $password, $dbname, $log;

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $log->lwrite('Connected successfully');

        //create Questions Table
        $sql = "DROP TABLE IF EXISTS `answers`;
            CREATE TABLE IF NOT EXISTS `answers` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `account_id` int(11) DEFAULT NULL,
            `question_id` int(11) DEFAULT NULL,
            `content` varchar(500) NOT NULL DEFAULT 'noob did not answer',
            `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `upvotes` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
            `downvotes` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
            `best` BOOLEAN DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `fk_answers_account_id` (`account_id`),
            KEY `fk_answers_question_id` (`question_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;ALTER TABLE `answers`
            ADD CONSTRAINT `fk_answers_account_id` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE SET NULL,
            ADD CONSTRAINT `fk_answers_question_id` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;COMMIT";

        $conn->exec($sql);
        $log->lwrite('Answers Table created successfully');
        
    }
    catch(PDOException $e){
        $log->lwrite('Connection failed: ' . $e->getMessage());
    }finally{
        unset ($pdo);
    }
}

function createCommentsTable(){
    global $servername, $username, $password, $dbname, $log;

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $log->lwrite('Connected successfully');

        //create Comments Table
        $sql = "DROP TABLE IF EXISTS `comments`;
        CREATE TABLE IF NOT EXISTS `comments` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `content` varchar(250) NOT NULL DEFAULT 'This is noob''s comment',
          `account_id` int(11) DEFAULT NULL,
          `question_id` int(11) DEFAULT NULL,
          `answer_id` int(11) DEFAULT NULL,
          `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          PRIMARY KEY (`id`),
          KEY `fk_comments_account_id` (`account_id`),
          KEY `fk_comments_question_id` (`question_id`),
          KEY `fk_comments_answer_id` (`answer_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;ALTER TABLE `comments`
        ADD CONSTRAINT `fk_comments_account_id` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE SET NULL,
        ADD CONSTRAINT `fk_comments_answer_id` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`id`) ON DELETE CASCADE,
        ADD CONSTRAINT `fk_comments_question_id` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;COMMIT";

        $conn->exec($sql);
        $log->lwrite('Comments Table created successfully');
        
    }
    catch(PDOException $e){
        $log->lwrite('Connection failed: ' . $e->getMessage());
    }finally{
        unset ($pdo);
    }   
}

function createFavouritesTable(){
    global $servername, $username, $password, $dbname, $log;

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $log->lwrite('Connected successfully');

        //create Favourites Table
        $sql = "DROP TABLE IF EXISTS `favourites`;
        CREATE TABLE IF NOT EXISTS `favourites` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `account_id` int(11) DEFAULT NULL,
          `question_id` int(11) DEFAULT NULL,
          `answer_id` int(11) DEFAULT NULL,
          PRIMARY KEY (`id`),
          KEY `fk_favourties_account_id` (`account_id`),
          KEY `fk_favourites_question_id` (`question_id`),
          KEY `fk_favourites_answer_id` (`answer_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;ALTER TABLE `favourites`
        ADD CONSTRAINT `fk_favourites_question_id` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
        ADD CONSTRAINT `fk_favourties_account_id` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE,
        ADD CONSTRAINT `fk_favourites_answer_id` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`id`) ON DELETE CASCADE;
      COMMIT;";

        $conn->exec($sql);
        $log->lwrite('Favourites Table created successfully');
        
    }
    catch(PDOException $e){
        $log->lwrite('Connection failed: ' . $e->getMessage());
    }finally{
        unset ($pdo);
    }
}

function createQuestionsTable(){
    global $servername, $username, $password, $dbname, $log;

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $log->lwrite('Connected successfully');

        //create Questions Table
        $sql = "DROP TABLE IF EXISTS `questions`;
            CREATE TABLE IF NOT EXISTS `questions` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `account_id` int(11) DEFAULT NULL,
            `header` varchar(100) NOT NULL DEFAULT 'Ain''t it Fun',
            `content` varchar(500) NOT NULL DEFAULT 'Brick by Boring Brick',
            `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `upvotes` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
            `downvotes` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
            `tags` varchar(100) NOT NULL DEFAULT 'noob',
            PRIMARY KEY (`id`),
            KEY `fk_questions_account_id` (`account_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;ALTER TABLE `questions`
            ADD CONSTRAINT `fk_questions_account_id` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE SET NULL;
            INSERT INTO `questions` (`id`, `account_id`, `header`, `content`, `date`, `upvotes`, `downvotes`, `tags`) VALUES
            (1, 1, 'How many fingers does a gopher have?', 'I cant seem to find the information on google. can anyone help ?', '2018-03-16 02:39:48', 0, 0, 'animal, silly'),
            (2, 1, 'Where can you go to the bathroom legally?', 'Im asking about the non usual places? for Science reasons. ', '2018-03-16 02:39:48', 0, 0, 'potty, bathroom'),
            (3, 1, 'Ain\'t it Fun?', 'Riot! or Self titled is better?\r\n\r\npersonally Riot! is the best', '2018-03-16 02:43:34', 0, 0, 'Paramore. album, music'),
            (4, NULL, 'How now brown cow', 'Testing question with no account id (i.e. account was removed)', '2018-03-16 02:43:34', 0, 0, 'removed, test');COMMIT";

        $conn->exec($sql);
        $log->lwrite('Questions Table created successfully');
        
    }
    catch(PDOException $e){
        $log->lwrite('Connection failed: ' . $e->getMessage());
    }finally{
        unset ($pdo);
    }
}
?>