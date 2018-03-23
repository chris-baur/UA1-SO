<?php

//include(dirname(__FILE__)."/../private/controllers/account_controller.php");

class favouriteDatabaseTest extends PHPUnit\Framework\TestCase{

    public function testAddFavourite(){
        $fc  = new FavouriteController();
        $f = new Favourite();
        $f->setAccountId(1);
        $f->setQuestionId(1);
        $f->setAnswerId(null);
        $expectedContent = 'A random content for testing'; 
        $f->setContent($expectedContent);
        $id = $fc::addFavourite($a);
        $addedC = $fc::getFavouriteById($id);
        $actualContent = $addedC->getContent();

        $this->assertEquals($expectedContent, $actualContent);
    }

    public function testGetFavouriteById(){
        $fc  = new FavouriteController();
        $expectedContent = 'This must be from paramore'; 
        $f = $fc::getFavouriteById(1);
        $actualContent = $f->getContent();

        $this->assertEquals($expectedContent, $actualContent);
    }
    public function testGetFavouriteQuestions(){
        $fc  = new FavouriteController();
        $id = 1;
        $expectedNumber = 1;
        
        $actualNumber = sizeof($fc::getFavouriteQuestions($id));
        $this->assertEquals($expectedNumber, $actualNumber);
    }
    public function testGetFavouriteAnswers(){
        $fc  = new FavouriteController();
        $id = 1;
        $expectedNumber = 1;
        
        $actualNumber = sizeof($fc::getFavouriteAnswers($id));
        $this->assertEquals($expectedNumber, $actualNumber);
    }

    public function testDeleteFavouriteQuestion(){
        $fc  = new FavouriteController();
        $accountId = 1;
        $questionId = 4;
        $fc::deleteFavouriteQuestion($accountId, $questionId);
        $expectedNumber = 0;
        $actualNumber = sizeof($fc::getFavouriteQuestions($accountId));
        $this->assertEquals($expectedNumber, $actualNumber);
    }
    public function testDeleteAllFavouriteQuestions(){
        $fc  = new FavouriteController();
        $accountId = 1;
        $fc::deleteAllFavouriteQuestions($accountId);
        $expectedNumber = 0;
        $actualNumber = sizeof($fc::getFavouriteQuestions($accountId));
        $this->assertEquals($expectedNumber, $actualNumber);
    }
    public function testDeleteFavouriteAnswer(){
        $fc  = new FavouriteController();
        $accountId = 1;
        $answerId = 13;
        $fc::deleteFavouriteAnswer($accountId, $answerId);
        $expectedNumber = 0;
        $actualNumber = sizeof($fc::getFavouriteQuestions($accountId));
        $this->assertEquals($expectedNumber, $actualNumber);
    }
    public function testDeleteAllFavouriteAnswers(){
        $fc  = new FavouriteController();
        $accountId = 1;
        $fc::deleteAllFavouriteAnswers($accountId);
        $expectedNumber = 0;
        $actualNumber = sizeof($fc::getFavouriteAnswers($accountId));
        $this->assertEquals($expectedNumber, $actualNumber);
    }
}
