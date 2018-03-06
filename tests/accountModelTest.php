<?php

class accountModelTest extends PHPUnit\Framework\TestCase{
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
    public function testDate(){
        $q = new Question();
        $q->set_date("2018-01-01 01:00:00.0");
        $this->assertEquals($q->get_date(), "2018-01-01 01:00:00.0");
    }
    public function testUpvotes(){
        $q = new Question();
        $q->set_upvotes(7);
        $this->assertEquals($q->get_upvotes(), 7);
    }
    public function testDownvotes(){
        $q = new Question();
        $q->set_downvotes(100);
        $this->assertEquals($q->get_downvotes(), 100);
    }
    public function testTags(){
        $q = new Question();
        $q->set_tags(array('sql','query','mysql','database','db'));
        $this->assertEquals($q->get_tags(), array('sql','query','mysql','database','db'));
    }
}