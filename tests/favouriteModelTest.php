<?php

class favouriteModelTest extends PHPUnit\Framework\TestCase{
    public function testConstructor(){
        $f = new Favourite();
        $this->assertNotNull($f);
    }
    public function testId(){
        $f = new Favourite();
        $f->setId(1);
        $this->assertEquals($f->getId(), 1);
    }
    public function testAccountId(){
        $f = new Favourite();
        $f->setAccountId(1);
        $this->assertEquals($f->getAccountId(), 1);
    }
    public function testQuestionId(){
        $f = new Favourite();
        $f->setQuestionId(1);
        $this->assertEquals($f->getQuestionId(), 1);
    }
    public function testAnswerId(){
        $f = new Favourite();
        $f->setAnswerId(1);
        $this->assertEquals($f->getAnswerId(), 1);
    }
}