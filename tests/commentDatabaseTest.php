<?php

//include(dirname(__FILE__)."/../private/controllers/account_controller.php");

class commentDatabaseTest extends PHPUnit\Framework\TestCase{

    public function testAddComment(){
        $cc  = new CommentController();
        $c = new Comment();
        $c->setAccountId(1);
        $c->setQuestionId(1);
        $c->setAnswerId(null);
        $expectedContent = 'A random content for testing'; 
        $c->setContent($expectedContent);
        $id = $cc::addComment($c);
        $addedC = $cc::getCommentById($id);
        $actualContent = $addedC->getContent();

        $this->assertEquals($expectedContent, $actualContent);
    }

    public function testGetCommentById(){
        $cc  = new CommentController();
        $expectedContent = 'This must be from paramore'; 
        $c = $cc::getCommentById(1);
        $actualContent = $c->getContent();

        $this->assertEquals($expectedContent, $actualContent);
    }
    public function testGetCommentsByAccount(){
        $cc  = new CommentController();
        $account = new Account();
        $account->setId(1);
        //2 since we added one in previous function
        $expectedNumber = 2;
        
        $actualNumber = sizeof($cc::getCommentsByAccount($account));
        $this->assertEquals($expectedNumber, $actualNumber);
    }

    public function testGetCommentsByContent(){
        $cc = new CommentController();
        $expectedNumber = 1;
        $expectedContent = 'This must be from paramore';
        
        $actualNumber = sizeof($cc::getCommentsByContent($expectedContent));
        $this->assertEquals($expectedNumber, $actualNumber);        
    }
    public function testgetCommentByAnswerQuestionId(){
        $cc = new CommentController();
        $expectedNumber = 1;
        $questionId = 1;
        $answerId = null;
        
        $actualNumber = sizeof($cc::getCommentByAnswerQuestionId($answerId, $questionId));
        $this->assertEquals($expectedNumber, $actualNumber);   

    }
    public function testUpdateComment(){
        $cc = new CommentController();
        $id = 1;
        $newContent = 'A random content for testing';
        $c = $cc::getCommentById($id);
        $c->setContent($newContent);
        $cc::updateComment($c);
        $c = $cc::getCommentById(1);

        $updatedContent = $c->getContent();

        $this->assertEquals($newContent, $updatedContent);
    }
}
