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
    //$pin = "";
    $validData = true;
    $errMessage = "";

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

    // verify username
    if(validateUser('username')){
        $username = htmlentities($_POST['username']);
        $account = getUserByUsername($username);
        // if(($account -> getAttemptCtr()) >= 5){
        //     $validData = false;
        //     $errMessage = "$username has been locked out. Too many failed login attempts.";
        // }
    }
    else
        $validData = false;
    if($validData){
        // verify password
        if(validateString('password') && strlen($_POST['password']) >= 6){
            $pass = htmlentities($_POST['password']);
            if (password_verify($pass, $account -> get_password())){
                $_SESSION['userid'] = $account -> get_id();
                $_SESSION['username'] = $account -> get_username();
                session_regenerate_id();
                // redirect to user home page
                header('Location: home.php');
            }
            else{
                //increaseAttemptCounter($userObj);
                showUserError($errMessage);
            }
        }
        else{
            //increaseAttemptCounter($userObj);
            showUserError($errMessage);
        }
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

// increases the user's attempt ctr
function increaseAttemptCounter($account){
    global $errMessage;
    $ctr = $account -> getAttemptCtr();
    if($ctr < 5){
        $account -> setAttemptCtr($ctr + 1);
        updateUserAttempts($account);
        $tries = 4 - $ctr;
        $errMessage = "Wrong Password. $tries Attempts left. ";

    }
    else if($ctr >= 5){
        $errMessage = 'User is locked out. Too many failed attempts';
    }
}

/**
 * Validates a username, makes sure actual name is valid. Then
 * checks in database for username to see if it exists.
 * 
 * @param string 	username to validate
 */
function validateUser($string){
    global $errMessage;
    $valid = false;
    $user_name = htmlentities($_POST[$string]);
    if(validateString($string)){
        // user exsts, set valid to true
        if(UserExists($user_name))
            $valid = true;
        // user does not exist, show error
        else
            $errMessage = "$user_name does not exist. Please enter an existing username. ";
    }
    else
        $errMessage = $errMessage."\\n$user_name is invalid ";
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