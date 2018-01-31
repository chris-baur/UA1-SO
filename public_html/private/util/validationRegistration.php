<?php

include '..\util\sets.php';
//include '..\util\validation.php';
include '..\models\Account.php';



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
    //$pin = "";
    $validData = true;
    $errMessage = "";

    //get data from post form
    // $username = test_input($_POST["username"]);
    // $password = test_input($_POST["password"]);
    // $name = test_input($_POST["name"]);
    // $last_name = test_input($_POST["last_name"]);
    // $professions = test_input($_POST["professions"]);
    // $security_one = test_input($_POST["security_one"]);
    // $security_two = test_input($_POST["security_two"]);
    // $answer_one = test_input($_POST["answer_one"]);
    // $answer_two = test_input($_POST["answer_two"]);
    // $gender = test_input($_POST["gender"]);
    // $bio = test_input($_POST["bio"]);

    if(validateString('name'))
        $name = htmlentities($_POST['name']);
    else{
        $errMessage = "Invalid name.";
        $validData = false;
    }

    //validate last name
    if($validData){
        if(validateString('last_name'))
            $last_name = htmlentities($_POST['last_name']);
        else{
            $errMessage = "Invalid last name.";
            $validData = false;
        }
    }else
        showUserError($errMessage);

    //validate professions
    if($validData){
        if(validateString('profession') && in_array(($_POST['profession']), $sets->get_professions()))
            $profession = htmlentities($_POST['profession']);
        else{
            $errMessage = "Invalid Profession";
            $validData = false;
        }
    }else
        showUserError($errMessage);

    //validate gender
    if($validData){
        if(validateString('gender') && in_array(($_POST['gender']), $sets->get_genders()))
            $gender = htmlentities($_POST['gender']);
        else{
            $errMessage = "Invalid Gender";
            $validData = false;
        }
    }else
        showUserError($errMessage);
    
    //validate bio
    if($validData){
        if(validateString('bio'))
            $bio = htmlentities($_POST['bio']);
        else{
            $errMessage = "Invalid Bio.";
            $validData = false;
        }
    }else
        showUserError($errMessage);
    
    //validate security question one
    if($validData){
        if(validateString('SQ1') && in_array($_POST['SQ1'], $sets->get_security_one()))
            $security_one = htmlentities($_POST['SQ1']);
        else{
            $errMessage = "Invalid security question one";
            $validData = false;
        }
    }else
        showUserError($errMessage);

    //validate security question two
    if($validData){
        if(validateString('SQ2') && in_array($_POST['SQ2'], $sets->get_security_two()))
            $security_one = htmlentities($_POST['SQ1']);
        else{
            $errMessage = "Invalid security question two";
            $validData = false;
        }
    }else
        showUserError($errMessage);

    //validate answer one
    if($validData){
        if(validateString('Answer1'))
            $bio = htmlentities($_POST['Answer1']);
        else{
            $errMessage = "Invalid answer for security question one.";
            $validData = false;
        }
    }else
        showUserError($errMessage);
    
    //validate answer two
    if($validData){
        if(validateString('Answer2'))
            $bio = htmlentities($_POST['Answer2']);
        else{
            $errMessage = "Invalid answer for security question two.";
            $validData = false;
        }
    }else
        showUserError($errMessage);
    
    //validate pin
    // if($validData){
    //     if(validateString('pin'))
    //         $pin = htmlentities($_POST['pin']);
    //     else{
    //         $errMessage = "Invalid pin";
    //         $validData = false;
    //     }
    // }else
    //     showUserError($errMessage);

    //password TO BE HASHED
    if($validData){
        // validate password 
        if(validateString('password')){
            if(strlen($_POST['password']) < 8 ){
                $validData = false;
                $errMessage = 'Invalid Password, minimum 8 characters. ';
            }
            else
                $hash = password_hash(htmlentities($_POST['password']), PASSWORD_DEFAULT);
        }
        else{
            $validData = false;
            $errMessage = 'Invalid Password';
        }
    }
    
    //validate user name
    if($validData){
        if(validateUser('username') && strlen($_POST['username']) > 0 && strlen($_POST['username']) <= 20)
            // redirect to login page
            header('Location: login.php');
        else
            showUserError($errMessage);
    }
    else
        showUserError($errMessage);

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
function validateUser($string){
    global $name, $hash, $last_name, $gender, $security_one, $security_two,
        $answer_one, $answer_two, $bio, $profession, $pin, $errMessage;
    $valid = false;
    if(validateString($string)){
        $user_name = htmlentities($_POST['username']);
        // user does not exist, can add user to DB
        // @TODO
        //if(!(UserExists($user_name))){
          //  $userObj = new User(0, $name, $email, $user_name, $hash);
            //addUser($userObj);
            $valid = true;
        //}
        // user exists, show error
       // else
            //$errMessage = $errMessage."$user_name is already taken. ";
    }
    else
        $errMessage = $errMessage."$user_name is invalid";
    return $valid;
}

    // show user error
    function showUserError($string){
        echo '<script language="javascript">';
        echo 'alert("'.$string.'")';
        echo '</script>';
    }

// function test_input($data) {
//   $data = trim($data);
//   $data = stripslashes($data);
//   $data = htmlentities($data);
//   return $data;
// }
?>