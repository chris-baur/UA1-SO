<?php

    $status = session_status();
	if($status == PHP_SESSION_NONE){
		//There is no active session
		session_start();
	}

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
    $invalidLogin = null;
    $log->lwrite('Form has requested a post for File: validateLogin.php');

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

    //validate uing pin
    if(isset($_POST['pin'])){
        $_SESSION['loginType'] = 'pin';
        //validate pin
        if($validData){
            if(is_numeric($_POST['pin'])){
                $pin = htmlentities($_POST['pin']);
                if($pin == $account->getPin()){
                    $log->lwrite('password is valid');
                    createSession();
                }
                else{
                    //increaseAttemptCounter($userObj);
                    $log->lwrite('Pin incorrect.');
                    $invalidLogin = 'Incorrect pin entered';
                    showUserError();
                }
            }else{
                $log->lwrite('invalid pin. It is not numeric');                
                $invalidLogin = "Invalid pin. It is not numeric";
                showUserError();
            }
        }else
            showUserError();
    }
    //validate using password
    else if(isset($_POST['password'])){
        $_SESSION['loginType'] = 'password';       
        if($validData){
            // verify password
            if(validateString('password') && strlen($_POST['password']) >= 8){
                $log->lwrite('Password passed prelim validaton');
                $pass = htmlentities($_POST['password']);
                if (password_verify($pass, $account -> getPassword())){
                    $log->lwrite('password is valid');
                    createSession();
                }
                //password doesnt match
                else{
                    //increaseAttemptCounter($userObj);
                    $log->lwrite('Password incorrect.');
                    $invalidLogin = 'Incorrect password entered';
                    showUserError();
                }
            }
            //incorrect syntax/length password entered
            else{
                //increaseAttemptCounter($userObj);
                $log->lwrite('Password failed prelim verification');
                $invalidLogin = 'Incorrect password entered. Check length/syntax';
                showUserError();
            }
        }
        //username was incorrect from before
        else
            showUserError();
    }
    else{
        $log->lwrite('Incorrect login method used');
        $invalidLogin = 'Incorrect login method used';
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
 * creates the session and redirects user to the home page
 */

 function createSession(){
    global $account;
    $_SESSION['userid'] = $account -> getId();
    $_SESSION['username'] = $account -> getUsername();
    unset($_SESSION['uName']);
    session_regenerate_id();
    // redirect to user home page
    header('Location: ..\views\homepage.php');
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
    global $invalidLogin;
    global $log;
    $valid = false;
    $user_name = htmlentities($_POST['username']);
    $_SESSION['uName'] = $user_name;
    if(validateString('username')){
        // user exsts, set valid to true
        $log -> lwrite("Username is: ".$user_name);
        if(accountExists($user_name)){
            $log -> lwrite("account exists with given username");
            $valid = true;
        }
        // user does not exist, show error
        else{
            $invalidLogin = 'Username does not exist';
            $log -> lwrite("account does not exist with given username");
        }
    //username provided is not a valid string
    }
    else{
        $log -> lwrite("Username provided is not a valid string");
        $invalidLogin = 'Username provided is not a valid string';
    }
    return $valid;
}

// show user error
function showUserError(){
    global $log;
    $log->lwrite('Showing user error');
    global $invalidLogin;
    // setcookie('invalidLogin', json_encode($invalidLogin), time()+20);
    $_SESSION['invalidLogin'] = $invalidLogin;
    header('Location: loginregister.php');
}
?>