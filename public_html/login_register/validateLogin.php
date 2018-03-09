<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once '..\..\private\util\sets.php';
    include_once '..\..\private\util\logging.php';
    include_once '..\..\private\controllers\account_controller.php';
    include_once '..\..\private\models\Account.php';    

    $account = new Account();
    $sets = new Sets();
    $log = new Logging();
    $user = "";
    $pass = "";
    $hash = "";
    //$pin = "";
    $validData = true;
    $invalidArray = null;
    $log->lwrite('Form has requested a post for File: validateLogin.php');

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
        $log->lwrite('inside valid user');
        $user = htmlentities($_POST['username']);
        $account = getAccountByUsername($user);
        // if(($account -> getAttemptCtr()) >= 5){
        //     $validData = false;
        //     $errMessage = "$user has been locked out. Too many failed login attempts.";
        // }
    }
    else{
        $log->lwrite('invalid username. Valid data is false');
        $validData = false;
    }

    if($validData){
        // verify password
        if(validateString('password') && strlen($_POST['password']) >= 6){
            $log->lwrite('Password passed prelim validaton');
            $pass = htmlentities($_POST['password']);
            if (password_verify($pass, $account -> get_password())){
                $log->lwrite('password is valid');
                $_SESSION['userid'] = $account -> get_id();
                $_SESSION['username'] = $account -> get_username();
                session_regenerate_id();
                // redirect to user home page
                header('Location: ..\home_page\homepage.php');
            }
            //password doesnt match
            else{
                //increaseAttemptCounter($userObj);
                $log->lwrite('Password incorrect.');
                $invalidArray['password'] = 'Incorrect password entered';
                showUserError();
            }
        }
        //incorrect syntax/length password entered
        else{
            //increaseAttemptCounter($userObj);
            $log->lwrite('Password failed prelim verification');
            $invalidArray['password'] = 'Incorrect password entered. Check length/syntax';
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
    global $log;
    $valid = false;
    $user_name = htmlentities($_POST['username']);
    if(validateString('username')){
        // user exsts, set valid to true
        $log -> lwrite("Username is: ".$user_name);
        if(accountExists($user_name)){
            $log -> lwrite("account exists with given username");
            $valid = true;
        }
        // user does not exist, show error
        else{
            $invalidArray['username'] = 'Username does not exist';
            $log -> lwrite("account does not exist with given username");
        }
    //username provided is not a valid string
    }
    else{
        $log -> lwrite("Username provided is not a valid string");
        $invalidArray['username'] = 'Username provided is not a valid string';
    }
    return $valid;
}

// show user error
function showUserError(){
    global $log;
    $log->lwrite('Showing user error');
    global $invalidArray;
    setcookie('invalidArray', json_encode($invalidArray), time()+20);
    header('Location: loginregister.php');
}
?>