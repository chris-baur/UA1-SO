<?php

use PHPUnit\Framework\TestCase;
final class questionModelTest extends TestCase{
    public function testOnePlusOne() {
        $this->assertEquals(1+1,2);
    }
    public function testConstructor(){
        $q = new Question();
        $this->assertNotNull($q);
    }
}