<?php

class questionModelTest extends PHPUnit\Framework\TestCase{
    public function testConstructor(){
        $q = new Question();
        $this->assertNotNull($q);
    }
    public function testId(){
        $q = new Question();
        $q->setId(1);
        $this->assertEquals($q->getId(), 1);
    }

    public function testAccountId(){
        $q = new Question();
        $q->setAccountId(1);
        $this->assertEquals($q->getAccountId(), 1);
    }

    public function testContent(){
        $q = new Question();
        $q->setContent("This is a test question");
        $this->assertEquals($q->getContent(), "This is a test question");
    }
    public function testDate(){
        $q = new Question();
        $q->setDate("2018-01-01 01:00:00.0");
        $this->assertEquals($q->getDate(), "2018-01-01 01:00:00.0");
    }
    public function testUpvotes(){
        $q = new Question();
        $q->setUpvotes(7);
        $this->assertEquals($q->getUpvotes(), 7);
    }
    public function testDownvotes(){
        $q = new Question();
        $q->setDownvotes(100);
        $this->assertEquals($q->getDownvotes(), 100);
    }
    public function testTags(){
        $q = new Question();
        $q->set_tags(array('sql','query','mysql','database','db'));
        $this->assertEquals($q->get_tags(), array('sql','query','mysql','database','db'));
    }
}