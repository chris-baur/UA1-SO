<?php

class favouriteModelTest extends PHPUnit\Framework\TestCase{
    public function testConstructor(){
        $f = new Favourite();
        $this->assertNotNull($f);
    }
    public function testId(){
        $f = new Favourite();
        $f->set_id(1);
        $this->assertEquals($f->get_id(), 1);
    }
    public function testAccountId(){
        $f = new Favourite();
        $f->set_accountId(1);
        $this->assertEquals($f->get_accountId(), 1);
    }
    public function testQuestionId(){
        $f = new Favourite();
        $f->set_questionId(1);
        $this->assertEquals($f->get_questionId(), 1);
    }
    public function testAnswerId(){
        $f = new Favourite();
        $f->set_answerId(1);
        $this->assertEquals($f->get_answerId(), 1);
    }
}