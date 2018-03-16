<?php

include(dirname(__FILE__)."/../private/controllers/account_controller.php");

class accountDatabaseTest extends PHPUnit\Framework\TestCase{
    public function testConstructor(){
        $a = new Account();
        $this->assertNotNull($a);
    }
    public function testId(){
        $a = getAccountById(1);
        echo $a->get_name();
        $this->assertEquals($a->get_name(), 'John');
        
    }

    // public function testUsername(){
    //     $a = new Account();
    //     $a->set_username('sxephil');
    //     $this->assertEquals($a->get_username(), 'sxephil');
    // }

    // public function testPassword(){
    //     $a = new Account();
    //     $a->set_password('$2y$10$tLoj.N4SayWqMJvAJsEq3Om0w8mHwLllj7ddUgJpd/5gTeD6bGJvq');
    //     $this->assertEquals($a->get_password(), '$2y$10$tLoj.N4SayWqMJvAJsEq3Om0w8mHwLllj7ddUgJpd/5gTeD6bGJvq');
    // }
    // public function testName(){
    //     $a = new Account();
    //     $a->set_name('boomer');
    //     $this->assertEquals($a->get_name(), 'boomer');
    // }
    // public function testLastName(){
    //     $a = new Account();
    //     $a->set_last_name('The Pug');
    //     $this->assertEquals($a->get_last_name(), 'The Pug');
    // }
    // public function testGender(){
    //     $a = new Account();
    //     $a->set_gender('male');
    //     $this->assertEquals($a->get_gender(), 'male');
    // }
    // public function testSecurityOne(){
    //     $a = new Account();
    //     $a->set_security_one('How now brown cow');
    //     $this->assertEquals($a->get_security_one(), 'How now brown cow');
    // }
    // public function testSecurityTwo(){
    //     $a = new Account();
    //     $a->set_security_two('How much wood can a woodchuck chuck');
    //     $this->assertEquals($a->get_security_two(), 'How much wood can a woodchuck chuck');
    // }
    // public function testAnswerOne(){
    //     $a = new Account();
    //     $a->set_answer_one('I am ok');
    //     $this->assertEquals($a->get_answer_one(), 'I am ok');
    // }
    
    // public function testAnswerTwo(){
    //     $a = new Account();
    //     $a->set_answer_two('A lot of wood');
    //     $this->assertEquals($a->get_answer_two(), 'A lot of wood');
    // }
    // public function testBio(){
    //     $a = new Account();
    //     $a->set_bio('male');
    //     $this->assertEquals($a->get_bio(), 'male');
    // } 
    // public function testProfession(){
    //     $a = new Account();
    //     $a->set_profession('poor student');
    //     $this->assertEquals($a->get_profession(), 'poor student');
    // }
    // public function testPin(){
    //     $a = new Account();
    //     $a->set_pin('0000');
    //     $this->assertEquals($a->get_pin(), '0000');
    // }
}
