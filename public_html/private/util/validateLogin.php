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
    $invalidArray = null;

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
    if(validateUser()){
        $username = htmlentities($_POST['username']);
        $account = getAccountByUsername($username);
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
                header('Location: ..\views\home_page\homepage.html');
            }
            //password doesnt match
            else{
                //increaseAttemptCounter($userObj);
                showUserError();
            }
        }
        //incorrect syntax/length password entered
        else{
            //increaseAttemptCounter($userObj);
            $invalidArray['password'] = true;
            showUserError();
        }
    }
    //username was incorrect from before
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

// increases the user's attempt ctr
// function increaseAttemptCounter($account){
//     global $errMessage;
//     $ctr = $account -> getAttemptCtr();
//     if($ctr < 5){
//         $account -> setAttemptCtr($ctr + 1);
//         updateUserAttempts($account);
//         $tries = 4 - $ctr;
//         $errMessage = "Wrong Password. $tries Attempts left. ";

//     }
//     else if($ctr >= 5){
//         $errMessage = 'User is locked out. Too many failed attempts';
//     }
// }

/**
 * Validates a username, makes sure actual name is valid. Then
 * checks in database for username to see if it exists.
 * 
 */
function validateUser(){
    global $invalidArray;
    $valid = false;
    $user_name = htmlentities($_POST['username']);
    if(validateString('username')){
        // user exsts, set valid to true
        if(UserExists($user_name))
            $valid = true;
        // user does not exist, show error
        else
            $invalidArray['username'] = true;
    //username provided is not a valid string
    }
    else
        $invalidArray['username'] = true;
    return $valid;
}

// show user error
function showUserError(){
    global $invalidArray;
    //echo 'in showuser error';
    // echo '<script language="javascript">';
    // echo 'alert("'.$string.'")';
    // echo '</script>';
    setcookie('invalidArray', json_encode($invalidArray), time()+20);
    header('Location: ..\views\login_register\loginregister.html');
}

// function test_input($data) {
//   $data = trim($data);
//   $data = stripslashes($data);
//   $data = htmlentities($data);
//   return $data;
// }
?>