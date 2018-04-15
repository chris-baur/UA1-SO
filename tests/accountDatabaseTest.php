<?php

//include(dirname(__FILE__)."/../private/controllers/account_controller.php");

class accountDatabaseTest extends PHPUnit\Framework\TestCase{
    public function testId(){
        $ac = new AccountController();
        $a = $ac::getAccountById(1);
        $this->assertEquals('John', $a->getName());
        
    }

    public function testAccountExists(){
        $a = new AccountController();
        $boolean = $a::accountExists('john117');
        $this->assertTrue($boolean);
    }

    public function testUsername(){
        $ac = new AccountController();
        $userName = 'john117';
        
        $account = $ac::getAccountByUsername($userName);
        $this->assertEquals($account->getUsername(), $userName);
    }

    public function testPassword(){
        $ac = new AccountController();
        $password = 'password';
        
        $account = $ac::getAccountById(1);
        //account has the hashed version of the password
        $this->assertTrue(password_verify($password, $account->getPassword()));
    }
    public function testName(){
        $ac = new AccountController();
        $name = 'John';        
        $account = $ac::getAccountById(1);

        $this->assertEquals($account->getName(), $name);
    }
    public function testLastName(){
        $ac = new AccountController();
        $name = 'Master Chief';        
        $account = $ac::getAccountById(1);

        $this->assertEquals($account->getLastName(), $name);
    }
    public function testGender(){
        $ac = new AccountController();
        $gender = 'Male';        
        $account = $ac::getAccountById(1);

        $this->assertEquals($account->getGender(), $gender);
    }
    public function testSecurityOne(){
        $ac = new AccountController();
        $sq1 = 'What is the first name of the person you first kissed?';        
        $account = $ac::getAccountById(1);

        $this->assertEquals($account->getSecurityOne(), $sq1);
    }
    public function testSecurityTwo(){
        $ac = new AccountController();
        $sq2 = 'In what city or town did your mother and father meet?';        
        $account = $ac::getAccountById(1);

        $this->assertEquals($account->getSecurityTwo(), $sq2);
    }
    public function testAnswerOne(){
        $ac = new AccountController();
        $a1 = 'Cortana';       
        $account = $ac::getAccountById(1);

        $this->assertEquals($account->getAnswerOne(), $a1);
    }
    
    public function testAnswerTwo(){
        $ac = new AccountController();
        $a2 = 'EDZ';        
        $account = $ac::getAccountById(1);

        $this->assertEquals($account->getAnswerTwo(), $a2);
    }
    public function testBio(){
        $ac = new AccountController();
        $bio = 'Last Spartan Alive';        
        $account = $ac::getAccountById(1);

        $this->assertEquals($account->getBio(), $bio);
    } 
    public function testProfession(){
        $ac = new AccountController();
        $p = 'Gamer';        
        $account = $ac::getAccountById(1);

        $this->assertEquals($account->getProfession(), $p);
    }
    public function testPin(){
        $ac = new AccountController();
        $pin = null;        
        $account = $ac::getAccountById(1);

        $this->assertNull($account->getPin());
    }

    public function testAddingAccount(){
        $account = new Account(-1, 'tester', 'password', 'T. testee', 'McTester', 'Other', 'What is the first name of the person you first kissed?',
        'In what city or town did your mother and father meet?', 'answer1', 'answer2', 'bio', 'Potatoe', '0000', '../img/avatar2.png');
        $ac = new AccountController();
        $accountId = $ac::addAccount($account);

        $accountInserted = $ac::getAccountById($accountId);
        $this->assertEquals($account->getName(), $accountInserted->getName());
    }

    public function testUpdatingAccount(){
        //changing the gender
        //must have valid ID, since update to accountController updateAccount method
        $account = new Account(1, 'john117', '$2y$10$C/uoZeY8TclVBl7UskXJceE7v800lyCnANBNtbTWX6jH7/dtOSqoK', 'John', 'Master Chief', 'Female', 'What is the first name of the person you first kissed?',
        'In what city or town did your mother and father meet?', 'Cortana', 'EDZ', 'Last Spartan Alive', 'Gamer', null, '../img/avatar2.png');
        $ac = new AccountController();
        $ac::updateAccount($account);

        $accountUpdated = $ac::getAccountByUsername('john117');
        $this->assertEquals($account->getGender(), $accountUpdated->getGender());

    }
}
