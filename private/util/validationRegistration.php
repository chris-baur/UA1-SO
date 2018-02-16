<?php

/**
 * @author Christoffer Baur
 */

include '..\util\sets.php';
include '..\controllers\account_controller.php';
include '..\models\Account.php';

if($_SERVER["REQUEST_METHOD"] == "GET"){
    header("location: ..\..\public_html\home_page\about.html");
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $account = new Account();
    $sets = new Sets();
    $username = "";
    $password = "";
    $hash = "";
    $name = "";
    $last_name = "";
    $gender = "";
    $profession = "";
    $security_one = "";
    $security_two = "";
    $answer_one = "";
    $answer_two = "";
    $bio = "";
    $pin = null;
    $validData = true;
    $invalidArray = null;

    /**
     * Validating the inputs for the registraton form
     */

    //validating first name
    if(validateString('name'))
        $name = htmlentities($_POST['name']);
    else{
        $invalidArray['name'] = 'Invalid name provided';
        $validData = false;
    }

    //validate last name
    if(validateString('last_name'))
        $last_name = htmlentities($_POST['last_name']);
    else{
        $invalidArray['last_name'] = 'Invalid last name provided';
        $validData = false;
    }

    //validate professions
    if(validateString('profession') && in_array(($_POST['profession']), $sets->get_professions()))
        $profession = htmlentities($_POST['profession']);
    else{
        $invalidArray['profession'] = 'Invalid profession selected. Make sure it is part of the list';
        $validData = false;
    }

    //validate gender
    if(validateString('gender') && in_array(($_POST['gender']), $sets->get_genders()))
        $gender = htmlentities($_POST['gender']);
    else{
        $invalidArray['gender'] = 'Invalid gender selected. Make sure it is part of the list';
        $validData = false;
    }
    
    //validate bio
    if(validateString('bio'))
        $bio = htmlentities($_POST['bio']);
    else{
        $invalidArray['bio'] = 'Invalid bio provided. Make sure it is not empty and has proper text';
        $validData = false;
    }
    
    //validate security question one
    if(validateString('SQ1') && in_array($_POST['SQ1'], $sets->get_security_one()))
        $security_one = htmlentities($_POST['SQ1']);
    else{
        $invalidArray['SQ1'] = 'Invalid security question 1 selected. Make sure it is part of the list';
        $validData = false;
    }

    //validate security question two
    if(validateString('SQ2') && in_array($_POST['SQ2'], $sets->get_security_two()))
        $security_two = htmlentities($_POST['SQ2']);
    else{
        $invalidArray['SQ2'] = 'Invalid security question 2 selected. Make sure it is part of the list';
        $validData = false;
    }

    //validate answer one
    if(validateString('Answer1'))
        $answer_one = htmlentities($_POST['Answer1']);
    else{
        $invalidArray['Answer1'] = 'Invalid answer 1 provided. Make sure it is not empty and has proper text';
        $validData = false;
    }
    
    //validate answer two
    if(validateString('Answer2'))
        $answer_two = htmlentities($_POST['Answer2']);
    else{
        $invalidArray['Answer2'] = 'Invalid answer 2 provided. Make sure it is not empty and has proper text';
        $validData = false;
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
        }
        else
            $hash = password_hash(htmlentities($_POST['password']), PASSWORD_DEFAULT);
    }
    else{
        $validData = false;
        $invalidArray['password'] = 'Invalid password entered. It cannot be empty';
    }
    
    //validate user name
    if($validData){
        if(validateUser()){
            if(strlen($_POST['username']) > 0 && strlen($_POST['username']) <= 20){
                // redirect to login page
                setcookie('invalidArray', 'false', time() + 30);
                header('Location: ..\..\public_html\login_register\loginregister.html');
            )
            else{
                $invalidArray['username'] = 'Invalid username entered. It must be a maximum of 20 charcters, and at least one character';
                
            }
        }
        else{
            showUserError();
        }
    }
    //invalid data from previous input fields
    else
        showUserError();
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
    global $invalidArray;
    setcookie('invalidArray', json_encode($invalidArray), time()+20);
    header('Location: ..\..\public_html\login_register\loginregister.html');
}

?>