<?php

class answerModelTest extends PHPUnit\Framework\TestCase{
    public function testConstructor(){
        $a = new Answer();
        $this->assertNotNull($a);
    }
    public function testId(){
        $a = new Answer();
        $a->setId(1);
        $this->assertEquals($a->getId(), 1);
    }

    public function testAccountId(){
        $a = new Answer();
        $a->setAccountId(1);
        $this->assertEquals($a->getAccountId(), 1);
    }
    public function testQuestionId(){
        $a = new Answer();
        $a->setQuestionId(1);
        $this->assertEquals($a->getQuestionId(), 1);
    }

    public function testContent(){
        $a = new Answer();
        $a->setContent("This is a test answer");
        $this->assertEquals($a->getContent(), "This is a test answer");
    }
    public function testDate(){
        $a = new Answer();
        $a->setDate("2018-01-01 01:00:00.0");
        $this->assertEquals($a->getDate(), "2018-01-01 01:00:00.0");
    }
    public function testUpvotes(){
        $a = new Answer();
        $a->setUpvotes(7);
        $this->assertEquals($a->getUpvotes(), 7);
    }
    public function testDownvotes(){
        $a = new Answer();
        $a->setDownvotes(100);
        $this->assertEquals($a->getDownvotes(), 100);
    }
    public function testBest(){
        $a = new Answer();
        $a->settBest(true);
        $this->assertTrue($a->getBest());
    }
}