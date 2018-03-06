<?php

class questionModelTest extends PHPUnit\Framework\TestCase{
    public function testOnePlusOne() {
        $int = 1+1;
        $expected = 2;
        $this->assertEquals($int,$expected);
    }
    public function testConstructor(){
        $q = new Question();
        $this->assertNotNull($q);
    }
    public function testId(){
        $q = new Question();
        $q->set_id('1');
        $this->assertEquals($q->get_id(), '1');
    }

    public function testAccountId(){
        $q = new Question();
        $q->set_accountId('1');
        $this->assertEquals($q->get_accountId(), '1');
    }

    public function testContent(){
        $q = new Question();
        $q->set_content("This is a test question");
        $this->assertEquals($q->get_content(), "This is a test question");
    }
}