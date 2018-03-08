<?php

class commentModelTest extends PHPUnit\Framework\TestCase{
    public function testConstructor(){
        $c = new Comment();
        $this->assertNotNull($c);
    }
    public function testId(){
        $c = new Comment();
        $c->set_id(1);
        $this->assertEquals($c->get_id(), 1);
    }

    public function testAccountId(){
        $c = new Comment();
        $c->set_accountId(1);
        $this->assertEquals($c->get_accountId(), 1);
    }
    public function testQuestionId(){
        $c = new Comment();
        $c->set_questionId(1);
        $this->assertEquals($c->get_questionId(), 1);
    }
    public function testAnswerId(){
        $c = new Comment();
        $c->set_answerId(1);
        $this->assertEquals($c->get_answerId(), 1);
    }

    public function testContent(){
        $c = new Comment();
        $c->set_content("This is a test comment");
        $this->assertEquals($c->get_content(), "This is a test comment");
    }
    public function testDate(){
        $c = new Comment();
        $c->set_date("2018-01-01 01:00:00.0");
        $this->assertEquals($c->get_date(), "2018-01-01 01:00:00.0");
    }
    public function testUpvotes(){
        $c = new Comment();
        $c->set_upvotes(7);
        $this->assertEquals($c->get_upvotes(), 7);
    }
    public function testDownvotes(){
        $c = new Comment();
        $c->set_downvotes(100);
        $this->assertEquals($c->get_downvotes(), 100);
    }
    public function testUpvotesIncrement(){
        $c = new Comment();
        $c->increment_upvotes();
        $this->assertEquals($c->get_upvotes(), 1);
    }
    public function testDownvotesIncrement(){
        $c = new Comment();
        $c->increment_downvotes();
        $this->assertEquals($c->get_downvotes(), 1);
    }
    public function testUpvotesDecrement(){
        $c = new Comment();
        $c->decrement_upvotes();
        $this->assertEquals($c->get_upvotes(), -1);
    }
    public function testDownvotesDecrement(){
        $c = new Comment();
        $c->decrement_downvotes();
        $this->assertEquals($c->get_downvotes(), -1);
    }
}