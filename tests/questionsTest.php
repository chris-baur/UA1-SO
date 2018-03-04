<?php

require_once '..\private\models\Question.php';
require_once '..\private\controllers\create_db.php';

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
}