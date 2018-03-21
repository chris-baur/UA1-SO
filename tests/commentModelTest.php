<?php

class commentModelTest extends PHPUnit\Framework\TestCase{
    public function testConstructor(){
        $c = new Comment();
        $this->assertNotNull($c);
    }
    public function testId(){
        $c = new Comment();
        $c->setId(1);
        $this->assertEquals($c->getId(), 1);
    }

    public function testAccountId(){
        $c = new Comment();
        $c->setAccountId(1);
        $this->assertEquals($c->getAccountId(), 1);
    }
    public function testQuestionId(){
        $c = new Comment();
        $c->setQuestionId(1);
        $this->assertEquals($c->getQuestionId(), 1);
    }
    public function testAnswerId(){
        $c = new Comment();
        $c->setAnswerId(1);
        $this->assertEquals($c->getAnswerId(), 1);
    }

    public function testContent(){
        $c = new Comment();
        $c->setContent("This is a test comment");
        $this->assertEquals($c->getContent(), "This is a test comment");
    }
    public function testDate(){
        $c = new Comment();
        $c->setDate("2018-01-01 01:00:00.0");
        $this->assertEquals($c->getDate(), "2018-01-01 01:00:00.0");
    }
}