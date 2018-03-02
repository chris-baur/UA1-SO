<?php

use PHPUnit\Framework\TestCase;
//include '..\private\models\Question.php';
class questionModelTest extends PHPUnit_Framework_TestCase{
    public function testOnePlusOne() {
        $int = 1+1;
        $expected = 2;
        $this->assertEquals($int,$expected);
    }
    public function testConstructor(){
        $q = new Question();
        $this->assertNotNull($q);
    }
}