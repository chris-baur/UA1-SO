<?php

//include(dirname(__FILE__)."/../private/controllers/account_controller.php");

class questionThreadDatabaseTest extends PHPUnit\Framework\TestCase{
    public function testGetQuestionThread(){
        $qtc = new QuestionThreadController();
        $qId = 6;
        $qt = $qtc::getQuestionThread($qId);
        $expectedAccountId = 1;
        
        

        // try{
        //     $pdo = new PDO("mysql:host=localhost;dbname=ua1_so", 'ua1', 'Ua1password0)');
        //     $stmt = $pdo -> prepare("SELECT Q.id, Q.account_id, Q.header, Q.content, Q.date, Q.upvotes, Q.downvotes, Q.tags, AC.username, AC.profile_picture_path 
        //         FROM questions Q 
        //         JOIN accounts AC ON AC.id = Q.account_id 
        //         WHERE Q.id = :id;");						
        //     $stmt -> bindParam(':id', $qId);
        //     $stmt -> execute();
        //     $result = $stmt -> fetch();

        //     if(isset($result)){
        //         echo '************ is set**********';
        //         $q = new Question();
        //         $q->setId($result[0]);
        //         $q->setAccountId($result[1]);
        //         $q->setHeader($result[2]);
        //         $q->setContent($result[3]);
        //         $q->setDate($result[4]);
        //         $q->setUpvotes($result[5]);
        //         $q->setDownvotes($result[6]);
        //         $q->setTags(explode(' ', $result[7]));
        //         $uname = $result[8];                    
        //         $qt->setQuestion($q);
        //         $qt->setQuestionName($uname);
        //         $qt->setQuestionFileName($result[9]);               
        //     }
        //     else
        //         echo '********** is NOT set*********';
        // }
        // catch(PDOException $e){
        //     echo $e -> getMessage();
        // }
        // finally{
        //     unset($pdo);
        // }
        $name = $qt->getQuestionName();
        $pic = $qt->getQuestionFileName();
        echo '** ' . $name . ' what is this name"s value ?**';
        echo '** ' . $pic . ' what is this pic"s value ?**';

        $qc = new QuestionController();
        $account = new Account();
        $account->setId(1);
        $expectedNumber = 5;
        $q = $qc::getQuestionById(6);
        $accountId = $q->getAccountId();
        $header = $q->getHeader();
        
        $actualNumber = sizeof($qc::getQuestionsByAccount($account));
        echo '** ' . $actualNumber . " actual number of questions in DB**";
        echo '** ' . $accountId . "Actual account id for the question**";
        // $q = $qt->getQuestion();
        // $actualAccountId = $q->getAccountId();
        // $this->assertEquals($expectedAccountId, $actualAccountId);
        
    }

    // public function testAddQuestion(){
    //     $qc = new QuestionThreadController();
    //     $q = new Question();
    //     $id = 1;
    //     $expectedHeader = 'A random header for testing'; 
    //     $q->setHeader($expectedHeader);
    //     $id = $qc::addQuestion($q);
    //     $addedQ = $qc::getQuestionById($id);
    //     $actualHeader = $addedQ->getHeader();

    //     $this->assertEquals($expectedHeader, $actualHeader);
    // }

    // public function testGetQuestionsByAccount(){
    //     $qc = new QuestionController();
    //     $account = new Account();
    //     $account->setId(1);
    //     $expectedNumber = 5;
        
    //     $actualNumber = sizeof($qc::getQuestionsByAccount($account));
    //     $this->assertEquals($expectedNumber, $actualNumber);
    // }

    // public function testGetQuestionsByContent(){
    //     $qc = new QuestionController();
    //     $expectedNumber = 1;
    //     $content = 'Foo FIghters';
        
    //     $actualNumber = sizeof($qc::getQuestionsByContent($content));
    //     $this->assertEquals($expectedNumber, $actualNumber);        
    // }
    // public function testGetQuestionsByHeader(){
    //     $qc = new QuestionController();
    //     $expectedNumber = 1;
    //     $header = 'Gooey';
        
    //     $actualNumber = sizeof($qc::getQuestionsByHeader($header));
    //     $this->assertEquals($expectedNumber, $actualNumber);        
    // }
    // public function testUpdateQuestion(){
    //     $qc = new QuestionController();
    //     $q = $qc::getQuestionById(1);
    //     $newHeader = 'klkfdnksdvk';
    //     $q->setHeader($newHeader);
    //     $qc::updateQuestion($q);
    //     $q = $qc::getQuestionById(1);

    //     $updatedHeader = $q->getHeader();
    //     $this->assertEquals($newHeader, $updatedHeader);
    // }
}
