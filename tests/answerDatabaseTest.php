<?php

//include(dirname(__FILE__)."/../private/controllers/account_controller.php");

class answerDatabaseTest extends PHPUnit\Framework\TestCase{

    public function testAddAnswer(){
        $ac = new AnswerController();
        $a = new Answer();
        $expectedContent = 'A random content for testing'; 
        $a->setContent($expectedContent);
        $a->setQuestionId(1);
        $a->setAccountId(1);
        $id = $ac::addAnswer($a);
        $addedA = $ac::getAnswerById($id);
        $actualContent = $addedA->getContent();

        $this->assertEquals($expectedContent, $actualContent);
    }
    public function testGetAnswersByAccount(){
        $ac = new AnswerController();
        $account = new Account();
        $account->setId(1);
        //increased by 1 since we added an answer which corresponds to the account in previous function
        $expectedNumber = 20;
        
        $actualNumber = sizeof($ac::getAnswersByAccount($account));
        $this->assertEquals($expectedNumber, $actualNumber);
    }

    public function testGetAnswersByContent(){
        $ac = new AnswerController();
        $expectedNumber = 1;
        $content = 'Lonely Boy';
        
        $actualNumber = sizeof($ac::getAnswersByContent($content));
        $this->assertEquals($expectedNumber, $actualNumber);        
    }
    public function testGetAnswersByQuestionId(){
        $ac = new AnswerController();
        //increased by 1 since we added an answer which corresponds to the question id in previous function        
        $expectedNumber = 2;
        $questionId = 1;
        
        $actualNumber = sizeof($ac::getAnswersByQuestionId($questionId));
        $this->assertEquals($expectedNumber, $actualNumber);   

    }
    public function testUpdateAnswer(){
        $ac = new AnswerController();
        $id = 1;
        $newContent = 'A random content for testing';
        $a = $ac::getAnswerById($id);
        $a->setContent($newContent);
        $ac::updateAnswer($a);
        $a = $ac::getAnswerById(1);

        $updatedContent = $a->getContent();

        $this->assertEquals($newContent, $updatedContent);
    }
}
