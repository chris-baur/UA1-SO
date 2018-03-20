<?php

/**
 * @author Christoffer Baur
 */



if($_SERVER["REQUEST_METHOD"] == "GET"){
    header("location: ..\home_page\about.php");
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
    $password = "null";
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
    $invalidArray = null;

    $log->lwrite("in validation registration");
    

    /**
     * Validating the inputs for the registraton form
     */

    //validating first name
    // if(validateString('name')){
    //     $name = htmlentities($_POST['name']);
    //     $log->lwrite("name is ok");
    // }
    // else{
    //     $invalidArray['name'] = 'Invalid name provided';
    //     $validData = false;
    //     $log->lwrite("Name is not ok");
        
    // }

    //validate last name
    // if(validateString('last_name')){
    //     $last_name = htmlentities($_POST['last_name']);
    //     $log->lwrite("last Name is ok");
        
    // }
    // else{
    //     $invalidArray['last_name'] = 'Invalid last name provided';
    //     $validData = false;
    //     $log->lwrite("last Name is not ok");
        
    // }

    //validate professions
    if(validateString('profession') && in_array(($_POST['profession']), $sets->get_professions())) {
        $profession = htmlentities($_POST['profession']);
        $log->lwrite('Profession option succeeded');
    }else{
        $invalidArray['profession'] = 'Invalid profession selected. Make sure it is part of the list';
        $validData = false;
        $log->lwrite("Profession is not ok");
        
    }

    //validate gender
    if(validateString('gender') && in_array(($_POST['gender']), $sets->get_genders())){
        $gender = htmlentities($_POST['gender']);
        $log->lwrite('Gender option succeeded');
    }else{
        $invalidArray['gender'] = 'Invalid gender selected. Make sure it is part of the list';
        $validData = false;
        $log->lwrite("Gender is not ok");
        
    }
    
    //validate bio
    // if(validateString('bio')) {
    //     $log->lwrite("bio is ok");        
    //     $bio = htmlentities($_POST['bio']);
    // }
    // else{
    //     $invalidArray['bio'] = 'Invalid bio provided. Make sure it is not empty and has proper text';
    //     $validData = false;
    //     $log->lwrite("bio is not ok");
        
    // }
    
    //validate security question one
    if(validateString('SQ1') && in_array($_POST['SQ1'], $sets->get_security_one())){
            $security_one = htmlentities($_POST['SQ1']);
            $log->lwrite('Security question 1 option succeeded');
    }
    else{
        $invalidArray['SQ1'] = 'Invalid security question 1 selected. Make sure it is part of the list';
        $validData = false;
        $log->lwrite("security ONE is not ok");
        
    }

    //validate security question two
    if(validateString('SQ2') && in_array($_POST['SQ2'], $sets->get_security_two())){
            $security_two = htmlentities($_POST['SQ2']);
            $log->lwrite('Security question 2 option succeeded');
        }
    else{
        $invalidArray['SQ2'] = 'Invalid security question 2 selected. Make sure it is part of the list';
        $validData = false;
        $log->lwrite("security TWO is not ok");
        
    }

    //validate answer one
    if(validateString('Answer1')){
            $answer_one = htmlentities($_POST['Answer1']);
            $log->lwrite(' answer 1 option succeeded');
        }
    else{
        $invalidArray['Answer1'] = 'Invalid answer 1 provided. Make sure it is not empty and has proper text';
        $validData = false;
        $log->lwrite("asnwer 1 is not ok");
        
    }
    
    //validate answer two
    if(validateString('Answer2')){
            $answer_two = htmlentities($_POST['Answer2']);
            $log->lwrite('Security answer 2 option succeeded');
    }
    else{
        $invalidArray['Answer2'] = 'Invalid answer 2 provided. Make sure it is not empty and has proper text';
        $validData = false;
        $log->lwrite("answer TWO is not ok");
        
    }
    
    //validate pin
    // if(validateString('pin'))
    //     $pin = htmlentities($_POST['pin']);
    // //invalid pin
    // else{
    //     $invalidArray['pin'] = true;
    //     $validData = false;
    // }

    //password TO BE HASHED
    // validate password 
    if(validateString('password')){
        if(strlen($_POST['password']) < 8 ){
            $validData = false;
            $invalidArray['password'] = 'Invalid password length entered. It must be a minimum of 8 characters';
            $log->lwrite("password is not ok");
            
        }
        else {
            $hash = password_hash(htmlentities($_POST['password']), PASSWORD_DEFAULT);
            $log->lwrite('Password hashed succeeded');
        }
    }
    else{
        $validData = false;
        $invalidArray['password'] = 'Invalid password entered. It cannot be empty';
        $log->lwrite("password is not ok");        
    }
    
    //validate user name
    if($validData){
        $log->lwrite('valid data true');
        if(validateUser()){
            $log->lwrite('valid user true');
            if(strlen($_POST['username']) > 0 && strlen($_POST['username']) <= 20){
                // redirect to login page
                //setcookie('invalidArray', 'false', time() + 30);
                $log->lwrite('valid username true');
                header('Location: loginregister.php');
            }
            else{
                $log->lwrite('valid username false');
                $invalidArray['username'] = 'Invalid username entered. It must be a maximum of 20 characters, and at least one character';         
            }
        }
        else{
            showUserError();
            $log->lwrite('valid user false');
        }
    }
    //invalid data from previous input fields
    else {
        $log->lwrite('valid data false');
        showUserError();
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
        $answer_one, $answer_two, $bio, $profession, $pin, $invalidArray;
    $valid = false;
    if(validateString('username')){
        $user_name = htmlentities($_POST['username']);
        // user does not exist, can add user to DB
        // @TODO
        if(!(accountExists($user_name))){
            $account = new Account(0, $user_name, $hash, $name, $last_name, $gender, $security_one,
                $security_two, $answer_one, $answer_two, $bio, $profession, $pin);
            addAccount($account);
            $valid = true;
        }
        // username already in use, show error
       else
            $invalidArray['username'] = true;
    }
    //invalid username
    else
        $invalidArray['username'] = true;
    return $valid;
}

// show user error
function showUserError(){

    global $invalidArray, $log;
    $log->lwrite("in show user error: " . $invalidArray[0]);    
    setcookie('invalidArray', json_encode($invalidArray), time()+20);
    header('Location: loginregister.php');
}

?>