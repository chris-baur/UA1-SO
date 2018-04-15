<?php

//include(dirname(__FILE__)."/../private/controllers/account_controller.php");

class questionThreadDatabaseTest extends PHPUnit\Framework\TestCase{
    public function testGetQuestionThread(){
        $qtc = new QuestionThreadController();
        $qId = 6;
        $qt = $qtc::getQuestionThread($qId);
        $expectedAccountId = 1;
        $q = $qt->getQuestion();
        $actualAccountId = $q->getAccountId();
        $this->assertEquals($expectedAccountId, $actualAccountId);
        
    }

    public function testGetQuestionThreadAnswers(){
        $qtc = new QuestionThreadController();
        $qId = 6;
        $qt = $qtc::getQuestionThread($qId);
        $expectedNumber = 2;
        
        $actualNumber = sizeof($qt->getAnswerThreadArray());
        $this->assertEquals($expectedNumber, $actualNumber);
        
    }
    public function testGetQuestionThreadComments(){
        $qtc = new QuestionThreadController();
        $qId = 6;
        $qt = $qtc::getQuestionThread($qId);
        $expectedNumber = 0;
        
        $actualNumber = sizeof($qt->getCommentThreadArray());
        $this->assertEquals($expectedNumber, $actualNumber);
        
    }
}
