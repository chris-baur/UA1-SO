<?php

class accountModelTest extends PHPUnit\Framework\TestCase{
    public function testConstructor(){
        $a = new Account();
        $this->assertNotNull($a);
    }
    public function testId(){
        $a = new Account();
        $a->setId('1');
        $this->assertEquals($a->getId(), '1');
    }

    public function testUsername(){
        $a = new Account();
        $a->setUsername('sxephil');
        $this->assertEquals($a->getUsername(), 'sxephil');
    }

    public function testPassword(){
        $a = new Account();
        $a->setPassword('$2y$10$tLoj.N4SayWqMJvAJsEq3Om0w8mHwLllj7ddUgJpd/5gTeD6bGJvq');
        $this->assertEquals($a->getPassword(), '$2y$10$tLoj.N4SayWqMJvAJsEq3Om0w8mHwLllj7ddUgJpd/5gTeD6bGJvq');
    }
    public function testName(){
        $a = new Account();
        $a->setName('boomer');
        $this->assertEquals($a->getName(), 'boomer');
    }
    public function testLastName(){
        $a = new Account();
        $a->setLastName('The Pug');
        $this->assertEquals($a->getLastName(), 'The Pug');
    }
    public function testGender(){
        $a = new Account();
        $a->setGender('male');
        $this->assertEquals($a->getGender(), 'male');
    }
    public function testSecurityOne(){
        $a = new Account();
        $a->setSecurityOne('How now brown cow');
        $this->assertEquals($a->getSecurityOne(), 'How now brown cow');
    }
    public function testSecurityTwo(){
        $a = new Account();
        $a->setSecurityTwo('How much wood can a woodchuck chuck');
        $this->assertEquals($a->getSecurityTwo(), 'How much wood can a woodchuck chuck');
    }
    public function testAnswerOne(){
        $a = new Account();
        $a->setAnswerOne('I am ok');
        $this->assertEquals($a->getAnswerOne(), 'I am ok');
    }
    
    public function testAnswerTwo(){
        $a = new Account();
        $a->setAnswerTwo('A lot of wood');
        $this->assertEquals($a->getAnswerTwo(), 'A lot of wood');
    }
    public function testBio(){
        $a = new Account();
        $a->setBio('male');
        $this->assertEquals($a->getBio(), 'male');
    } 
    public function testProfession(){
        $a = new Account();
        $a->setProfession('poor student');
        $this->assertEquals($a->getProfession(), 'poor student');
    }
    public function testPin(){
        $a = new Account();
        $a->setPin('0000');
        $this->assertEquals($a->getPin(), '0000');
    }
}
