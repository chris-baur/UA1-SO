<?php

/**
 * @author Christoffer Baur
 */

$status = session_status();
	if($status == PHP_SESSION_NONE){
		//There is no active session
		session_start();
    }   


if($_SERVER["REQUEST_METHOD"] == "GET"){
    header("location: ..\views\about.php");
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once '..\..\private\util\sets.php';
    include_once '..\..\private\util\logging.php';
    include_once '..\..\private\controllers\account_controller.php';
    include_once '..\..\private\models\Account.php';

    $account = new Account();
    $sets = new Sets();
    $log = new Logging();
    $username = "";
    $password = "";
    $hash = "";
    $name = "null";
    $last_name = "null";
    $gender = "";
    $profession = "";
    $security_one = "";
    $security_two = "";
    $answer_one = "";
    $answer_two = "";
    $bio = "null";
    $pin = null;
    $validData = true;
    $invalidRegister = null;

    $log->lwrite("in validation registration");
    

    /**
     * Validating the inputs for the registraton form
     */

    //validating first name
    if(validateString('firstName')){
        $name = htmlentities($_POST['firstName']);
        $_SESSION['firstName'] = $name;
        $log->lwrite("name is ok");
    }
    else{
        $invalidRegister[] = 'Invalid name provided';
        $validData = false;
        $log->lwrite("Name is not ok");
        
    }

    //validate last name
    if(validateString('lastName')){
        $last_name = htmlentities($_POST['lastName']);
        $_SESSION['lastName'] = $last_name;
        
        $log->lwrite("last Name is ok");
        
    }
    else{
        $invalidRegister[] = 'Invalid last name provided';
        $validData = false;
        $log->lwrite("last Name is not ok");
        
    }

    //validate professions
    if(validateString('profession') && in_array(($_POST['profession']), $sets->getProfessions())) {
        $profession = htmlentities($_POST['profession']);
        $_SESSION['profession'] = $profession;        
        $log->lwrite('Profession option succeeded');
    }else{
        $invalidRegister[] = 'Invalid profession selected. Make sure it is part of the list';
        $validData = false;
        $log->lwrite("Profession is not ok");
        
    }

    //validate gender
    if(validateString('gender') && in_array(($_POST['gender']), $sets->getGenders())){
        $gender = htmlentities($_POST['gender']);
        $_SESSION['gender'] = $gender;
        $log->lwrite('Gender option succeeded');
    }else{
        $invalidRegister[] = 'Invalid gender selected. Make sure it is part of the list';
        $validData = false;
        $log->lwrite("Gender is not ok");
        
    }
    
    // validate bio
    if(validateString('bio')) {
        $bio = htmlentities($_POST['bio']);
        $_SESSION['bio'] = $bio;
        $log->lwrite("bio is ok");
    }
    else{
        $invalidRegister[] = 'Invalid bio provided. Make sure it is not empty and has proper text';
        $validData = false;
        $log->lwrite("bio is not ok");
        
    }
    
    //validate security question one
    if(validateString('SQ1') && in_array($_POST['SQ1'], $sets->getSecurityOne())){
            $security_one = htmlentities($_POST['SQ1']);
            $_SESSION['SQ1'] = $security_one;            
            $log->lwrite('Security question 1 option succeeded');
    }
    else{
        $invalidRegister[] = 'Invalid security question 1 selected. Make sure it is part of the list';
        $validData = false;
        $log->lwrite("security ONE is not ok");
        
    }

    //validate security question two
    if(validateString('SQ2') && in_array($_POST['SQ2'], $sets->getSecurityTwo())){
            $security_two = htmlentities($_POST['SQ2']);
            $_SESSION['SQ2'] = $security_two;                        
            $log->lwrite('Security question 2 option succeeded');
        }
    else{
        $invalidRegister[] = 'Invalid security question 2 selected. Make sure it is part of the list';
        $validData = false;
        $log->lwrite("security TWO is not ok");
        
    }

    //validate answer one
    if(validateString('Answer1')){
            $answer_one = htmlentities($_POST['Answer1']);
            $_SESSION['A1'] = $answer_one;                        
            $log->lwrite(' answer 1 option succeeded');
        }
    else{
        $invalidRegister[] = 'Invalid answer 1 provided. Make sure it is not empty and has proper text';
        $validData = false;
        $log->lwrite("asnwer 1 is not ok");
        
    }
    
    //validate answer two
    if(validateString('Answer2')){
            $answer_two = htmlentities($_POST['Answer2']);
            $_SESSION['A2'] = $answer_two;                        
            $log->lwrite('Security answer 2 option succeeded');
    }
    else{
        $invalidRegister[] = 'Invalid answer 2 provided. Make sure it is not empty and has proper text';
        $validData = false;
        $log->lwrite("answer TWO is not ok");
        
    }
    
    //validate pin
    if(isset($_POST['pin']) && !(empty($_POST['pin'])))
        if(is_numeric($_POST['pin']) && strlen($_POST['pin']) == 4){
            $pin = htmlentities($_POST['pin']);
            $_SESSION['pin'] = $pin;                        
            $log->lwrite('Pin is good');
        }

        //invalid pin
        else{
            $invalidRegister[] = 'Pin must be a number and of length 4';
            $validData = false;
            $log->lwrite('Pin is invalid');
            
        }
    else
        //pin is not set, it is not required so nohing wrong here
        $log->lwrite('Pin left empty. nothing wrong.');

    //password TO BE HASHED
    // validate password 
    if(validateString('password')){
        if(strlen($_POST['password']) < 8 ){
            $validData = false;
            $invalidRegister[] = 'Invalid password length entered. It must be a minimum of 8 characters';
            $log->lwrite("password is not ok");
            
        }
        else {
            $hash = password_hash(htmlentities($_POST['password']), PASSWORD_DEFAULT);
            $_SESSION['password'] = htmlentities($_POST['password']);                 
            $log->lwrite('Password hashed succeeded');
        }
    }
    else{
        $validData = false;
        $invalidRegister[] = 'Invalid password entered. It cannot be empty';
        $log->lwrite("password is not ok");        
    }
    
    $_SESSION['uName'] = htmlentities($_POST['username']);
    //validate user name
    if($validData){
        $log->lwrite('valid data true');                         
        if(validateUser()){
            $log->lwrite('valid user true');
            if(strlen($_POST['username']) >= 4 && strlen($_POST['username']) <= 20){
                // redirect to login page
                //setcookie('invalidArray', 'false', time() + 30);
                $log->lwrite('valid username true');
                $_SESSION['validRegister'] = true;
                unsetSessionFormVariables();
                header('Location: loginregister.php');
            }
            else{
                $log->lwrite('valid username false');
                $invalidRegister[] = 'Invalid username entered. It must be a maximum of 20 characters, and at least one character';         
            }
        }
        else{
            $log->lwrite('valid user false');
            showUserError();
        }
    }
    //invalid data from previous input fields
    else {
        $log->lwrite('valid data false');
        showUserError();
    }
}

/**
 * Unsets all the form variables that were stored in the session in case of a error in the form input
 */
function unsetSessionFormVariables(){
    $array = array('firstName', 'lastName', 'password', 'bio', 'profession', 'gender', 'SQ1', 'SQ2', 'A1', 'A2', 'pin');
    foreach($array as $element){
        unset($_SESSION[$element]);
    }
}

/**
 * Validates a String.
 * 
 * @param string 	string to validate
 */
function validateString($string){
    if(!(empty($_POST[$string])) && isset($_POST[$string]) && IS_STRING($_POST[$string]))
        return true;
    else
        return false;
}

/**
 * Validates a username, makes sure actual name is valid. Then
 * checks in database for username to see if it exists.
 * 
 * @param string 	username to validate
 */
function validateUser(){
    global $name, $hash, $last_name, $gender, $security_one, $security_two,
        $answer_one, $answer_two, $bio, $profession, $pin, $invalidRegister;
    $valid = false;
    if(validateString('username')){
        $user_name = htmlentities($_POST['username']);
        if(strlen($user_name) > 3) {
        // user does not exist, can add user to DB
        // @TODO
            if(!(accountExists($user_name))){
                $account = new Account(0, $user_name, $hash, $name, $last_name, $gender, $security_one,
                    $security_two, $answer_one, $answer_two, $bio, $profession, $pin);
                addAccount($account);
                $valid = true;
            }
            // username already in use, show error
           else {
                $invalidRegister[] = 'Username is already in use. Please choose another one.';
            }
        } else {
            $invalidRegister[] = 'Username is too short. Please enter a username with at least 4 characters.';
        }
    } 
    else {
        $invalidRegister[] = 'Invalid username entered';
    }
    return $valid;
}

// show user error
function showUserError(){
    global $invalidRegister, $log;

    $e = $invalidRegister[0];
    $log->lwrite("in show user error: $e");    
    // setcookie('invalidRegister', json_encode($invalidRegister), time()+20);
    $_SESSION['invalidRegister'] = $invalidRegister;
    header('Location: loginregister.php');
}

?>