<?php

//include(dirname(__FILE__)."/../private/controllers/account_controller.php");

class favouriteDatabaseTest extends PHPUnit\Framework\TestCase{

    public function testAddFavourite(){
        $fc  = new FavouriteController();
        $f = new Favourite();
        $f->setAccountId(1);
        $expectedQuestionId = 1;
        $f->setQuestionId($expectedQuestionId);
        $f->setAnswerId(null); 
        $id = $fc::addFavourite($f);
        $addedF = $fc::getFavouriteById($id);
        $actualQuestionId = $addedF->getQuestionId();

        $this->assertEquals($expectedQuestionId, $actualQuestionId);
    }

    public function testGetFavouriteById(){
        $fc  = new FavouriteController();
        $expectedQuestionId = 4;
        $id = 1;
        $f = $fc::getFavouriteById($id);
        $actualQuestionId = $f->getQuestionId();

        $this->assertEquals($expectedQuestionId, $actualQuestionId);
    }
    public function testGetFavouriteQuestions(){
        $fc  = new FavouriteController();
        $id = 1;
        //This will be 2 since we added one to the database in previous test function
        $expectedNumber = 2;
        
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
        //This will be 1 since we added one to the database in previous test function
        $expectedNumber = 1;
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
