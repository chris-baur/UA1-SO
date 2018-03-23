<?php

//include(dirname(__FILE__)."/../private/controllers/account_controller.php");

class questionDatabaseTest extends PHPUnit\Framework\TestCase{
    public function testId(){
        $qc = new QuestionController();
        $q = $qc::getQuestionById(1);
        $this->assertEquals('Ain\'t it Fun', $q->getHeader());
        
    }

    public function testGetQuestionsByAccount(){
        $qc = new QuestionController();
        $account = new Account();
        $account->setId(1);
        $expectedNumber = 5;
        
        $actualNumber = sizeof($qc::getQuestionsByAccount($account));
        $this->assertEquals($expectedNumber, $actualNumber);
    }

    public function testGetQuestionsByContent(){
        $qc = new QuestionController();
        $expectedNumber = 1;
        $content = 'Foo FIghters';
        
        $actualNumber = sizeof($qc::getQuestionsByContent($content));
        $this->assertEquals($expectedNumber, $actualNumber);        
    }
    public function testGetQuestionsByHeader(){
        $qc = new QuestionController();
        $expectedNumber = 1;
        $header = 'Gooey';
        
        $actualNumber = sizeof($qc::getQuestionsByHeader($header));
        $this->assertEquals($expectedNumber, $actualNumber);        
    }
    public function testUpdateQuestion(){
        $qc = new QuestionController();
        $q = $qc::getQuestionById(1);
        $newHeader = 'klkfdnksdvk';
        $q->setHeader($newHeader);
        $qc::updateQuestion($q);
        $q = $qc::getQuestionById(1);

        $updatedHeader = $q->getHeader();
        $this->assertEquals($newHeader, $updatedHeader);
    }
}
