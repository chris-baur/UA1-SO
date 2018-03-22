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

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $log->lwrite("POST METHOD. for forgotpassword.php");
    
 $servername = $config['servername'];
        $username = $config['username'];
        $password = $config['password'];
        $dbname = $config['dbname'];

        $con = mysqli_connect($servername, $username, $password, $dbname) or die("Connection Failed");

      $result = mysqli_query($con,"SELECT username, security_one, security_two, answer_one, answer_two FROM `accounts` WHERE 1 ");
    }
echo "
<label> <b> Enter username </b>
<input ng-model='userName' type='text' placeholder='Enter Username' name='username' required>
<label> <b> Security Question 1 </b>
   <input ng-model='answer1' type='text' placeholder='Enter Answer'name='Answer1' required>
<br>
<label> <b> Security Question 2 </b>
  <input ng-model='answer1' type='text' placeholder='Enter Answer' name='Answer1' required>

  button type='submit'>Login</button>
          <button type='button' onclick=" . '"document.getElementById(' . "'login'" . ").style.display='none'" . '"' . "class='cancel'>Cancel</button>

  <p>&nbsp;</p>

  <p style='text-align: center;''> © All Rights Reserved 2018 </p>
</body>
</html>";
 ?>