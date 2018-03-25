<?php
$config = parse_ini_file('..\..\..\UA1-SO\config.ini');
echo "
<html ng-app='myRegister' ng-controller='myCtrl'>
<head>
    <title>Forgot Password</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>      
    <script src='https://ajax.googleapis.com/ajax/libs/angularjs/1.1.5/angular.min.js'></script>
    <link rel='stylesheet' type='text/css' href='../css/forgotpassword.css'>
    <script src='../js/login.js'></script>
    <script src='../js/register.js'></script>
</head>
<body>
  <p><a href='../home_page/homepage.php'><img style='display: block; margin-left: auto; margin-right: auto;' src='../img/newlogo.png' alt=''width='100' height='100' /></a></p>
  <p>&nbsp;</p>
"
;

if($_SERVER["REQUEST_METHOD"] == "GET")
{
  include_once '..\..\private\util\sets.php';
    include_once '..\..\private\util\logging.php';
    include_once '..\..\private\controllers\AccountController.php';
    include_once '..\..\private\models\Account.php';    

  $log = new logging();
    $log->lwrite("GET METHOD. for forgotpassword.php");
    
 $servername = $config['servername'];
        $username = $config['username'];
        $password = $config['password'];
        $dbname = $config['dbname'];
    
 $ac = new AccountController();
 $account = $ac::getAccountById($SESSION["id"]);
 $s1 = $account->getSecurityOne();
$s2 = $account->getSecurityTwo();
echo "
<label> <b> Enter username </b>
<input ng-model='userName' type='text' placeholder='Enter Username' name='username' required>
<label> <b> Security Question 1 </b>". $s1;

echo"
   <input ng-model='answer1' type='text' placeholder='Enter Answer'name='Answer1' required>
<br>
<label> <b> Security Question 2 </b>". $s2;

echo"
  <input ng-model='answer1' type='text' placeholder='Enter Answer' name='Answer1' required>

  button type='submit'>Login</button>
          <button type='button' onclick=" . '"document.getElementById(' . "'login'" . ").style.display='none'" . '"' . "class='cancel'>Cancel</button>

  <p>&nbsp;</p>

  <p style='text-align: center;''> © All Rights Reserved 2018 </p>
</body>
</html>";
}
 ?>