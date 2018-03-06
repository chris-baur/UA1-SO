<?php

class answerModelTest extends PHPUnit\Framework\TestCase{
    public function testConstructor(){
        $a = new Answer();
        $this->assertNotNull($a);
    }
    public function testId(){
        $a = new Answer();
        $a->set_id('1');
        $this->assertEquals($a->get_id(), '1');
    }

    public function testAccountId(){
        $a = new Answer();
        $a->set_accountId('1');
        $this->assertEquals($a->get_accountId(), '1');
    }
    public function testQuestionId(){
        $a = new Answer();
        $a->set_questionId('1');
        $this->assertEquals($a->get_questionId(), '1');
    }

    public function testContent(){
        $a = new Answer();
        $a->set_content("This is a test answer");
        $this->assertEquals($a->get_content(), "This is a test answer");
    }
    public function testDate(){
        $a = new Answer();
        $a->set_date("2018-01-01 01:00:00.0");
        $this->assertEquals($a->get_date(), "2018-01-01 01:00:00.0");
    }
    public function testUpvotes(){
        $a = new Answer();
        $a->set_upvotes(7);
        $this->assertEquals($a->get_upvotes(), 7);
    }
    public function testDownvotes(){
        $a = new Answer();
        $a->set_downvotes(100);
        $this->assertEquals($a->get_downvotes(), 100);
    }
    public function testBest(){
        $a = new Answer();
        $a->set_best(true);
        $this->assertTrue($a->get_best());
    }
}