<?php

  $status = session_status();
	if($status == PHP_SESSION_NONE){
		//There is no active session
		session_start();
	}

  echo "<html ng-app='myRegister' ng-controller='myCtrl'>
  <head>
      <title>login</title>
      <meta name='viewport' content='width=device-width, initial-scale=1'>			
      <script src='https://ajax.googleapis.com/ajax/libs/angularjs/1.1.5/angular.min.js'></script>
      <link rel='stylesheet' type='text/css' href='../css/loginregister.css'>
      <script src='../js/login.js'></script>
      <script src='../js/register.js'></script>
  </head>
  <body>
  
    <p><a href='../home_page/homepage.php'><img style='display: block; margin-left: auto; margin-right: auto;' src='../img/newlogo.png' alt='' width='800' height='450' /></a></p>
    <p>&nbsp;</p>";
  
  echo  "<p style='text-align: center;'><button id='loginButton' onclick=" . '"document.getElementById(' . "'login'" . ").style.display='block'" . '"' . "style='width:auto;'>Login</button></p>
    <div id='login' class='modal'>
      <form class='modal-content animate' action='validateLogin.php' method='POST'>
        <div class='imgcontainer'>
          <span onclick=" . '"document.getElementById(' . "'login'" . ").style.display='none'" . '"' . "class='close' title='Close Modal'>&times;</span>
          <img src='../img/avatar.png' alt='Avatar' class='avatar'>
        </div>";

        if((isset($_SESSION['invalidLogin']) && isset($_SESSION['loginType']) && $_SESSION['loginType'] == 'password')){
          echo "<p id='invalid'>Error: " . $_SESSION['invalidLogin'] . "</p>";
        }
  
  
        echo "<div class='container'>

          <label><b>Username</b></label>
            <input ng-model='userName' type='text' placeholder='Enter Username' name='username' required>
  
          <label><b>Password</b></label>
            <input ng-model='password' type='password' placeholder='Enter Password' name='password' required>
          
          <button type='submit'>Login</button>
          <button type='button' onclick=" . '"document.getElementById(' . "'login'" . ").style.display='none'" . '"' . "class='cancel'>Cancel</button>

          <label><input type='checkbox' checked='checked'> Remember me
          </label>
          <a href='forgotpassword.html' style = 'text-align: left; padding: 4%'> Forgot password? 
          </a>

        </div>
  
      </form>
    </div>
  
    <p style='text-align: center;'><button id='loginPinButton' onclick=" . '"document.getElementById(' . "'pin_login'" . ").style.display='block'" . '"' . "style='width:auto;'>Login using Pin</button></p>
  
  <div id='pin_login' class='modal'>
      <form class='modal-content animate' action='validateLogin.php' method='POST'>
        <div class='imgcontainer'>
          <span onclick=" . '"document.getElementById(' . "'pin_login'" . ").style.display='none'" . '"' . "class='close' title='Close Modal'>&times;</span>
          <img src='../img/avatar.png' alt='Avatar' class='avatar'>
        </div>";
          if((isset($_SESSION['invalidLogin']) && isset($_SESSION['loginType']) && $_SESSION['loginType'] == 'pin')){
            echo "<p id='invalid'>Error: " . $_SESSION['invalidLogin'] . "</p>";
          }
  
        echo "<div class='container'>
            <label><b>Username</b></label>
            <input ng-model='userName' type='text' placeholder='Enter Username' name='username' required>
          <label><b>Pin: </b></label>
            <input ng-model='pin' type='number' placeholder='Enter Pin' name='pin' required>
          <button type='submit'>Login</button>
        </div>
  
        <div class='container' style='background-color:#f1f1f1'>
          <button type='button' onclick=" . '"document.getElementById(' . "'pin_login'" . ").style.display='none'"  . '"' . "class='cancel'>Cancel</button>
        </div>
      </form>
    </div>
  
    <p style='text-align: center;'><button id='registerButton' onclick=" . '"document.getElementById(' . "'register'" . ").style.display='block'" . '"' . "style='width:auto;' ng-click='newAccount'>Sign Up</button></p>
  
  
    <div id='register' class='modal'>
      <span onclick=" . '"document.getElementById(' . "'register'" . ").style.display='none'" . '"' . "class='close' title='Close Modal'>&times;</span>
      <form class='modal-content' method='POST' action='validationRegistration.php'>
        <div class='container'>
          <h1>Sign Up</h1>
          <p>Please fill in this form to create an account.</p>";

          if(isset($_SESSION['invalidRegister'])){
            for($i=0; $i<sizeof($_SESSION['invalidRegister']);$i++)
              echo "<p id='invalid'>Error: " . $_SESSION['invalidRegister'][$i] . "</p>";
          }

          echo "<hr>
          <label><b>Username</b></label>
          <input ng-model='userName' type='text' placeholder='Enter Username' name='username' maxlength='20' required>
      <span class='alert' ng-if='userName.length<4 && userName.length!=0'>Username enter is too short (Minimum of 4 and maximum of 20 characters)</span>
      <br>
          <label><b>Password</b></label>
          <input ng-model='password' type='password' placeholder='Enter Password' name='password' maxlength='20' required>
      <span class='alert' ng-if='password.length<8 && password.length!=0'>Password should have a minimum of 8 characters</span>
      <br>
          <label> <b> Security Question 1 </b>
            <select name = 'SQ1'>
              <option value = 'select'> -Please select- </option>";

  include '..\..\private\util\sets.php';
  include '..\..\private\util\logging.php';

  $sets = new Sets();
  $sets = json_decode(file_get_contents('../../sets.txt', true));
  $log = new Logging();
  $log->lwrite('in login register');

  //$s = $sets->toStringGenders();
  $s1Array = $sets->security_one;
  $s2Array = $sets->security_two;
  $professionArray = $sets->professions;
  $genderArray = $sets->genders;
  $aa = $s2Array[0];
  $log->lwrite('Got the arrays');
  // $log->lwrite($aa);
  // $log->lwrite($s2Array);
  // $log->lwrite($professionArray);              
  // $log->lwrite($genderArray);
  //$log->lwrite(var_dump($s));
  
  

  for($ctr = 0; $ctr < sizeof($s1Array); $ctr++){
    $element = $s1Array[$ctr];
    echo "<option value = '$element'> $element </option>";
  }
  echo "</select> 
    </label>
    <input ng-model='answer1' type='text' placeholder='Enter Answer' name='Answer1' required>
    <br>
    <label> <b> Security Question 2 </b>
      <select name = 'SQ2'>
        <option value = 'select'> -Please select- </option>";
  for($ctr = 0; $ctr < sizeof($s2Array); $ctr++){
    $element = $s2Array[$ctr];
    echo "<option value = '$element'> $element </option>";
  }


  echo "</select> 
    </label>
    <input ng-model='answer2' type='text' placeholder='Enter Answer' name='Answer2' required>
    <br>
    <br>
    <label> <b> Profession </b>
      <select name = 'profession'>
        <option value = 'select'> -Please select- </option>";
  for($ctr = 0; $ctr < sizeof($professionArray); $ctr++){
    $element = $professionArray[$ctr];
    echo "<option value = '$element'> $element </option>";
  } 
  
  echo "
    </select> 
  </label>
  <br>
  <br>
  <b> Pin (for quick login): </b>
    <input ng-model='pin' type='pin' placeholder='Enter Pin' name='pin' maxlength='4' >
    <span class='alert' ng-if='pin.length<4 && pin.length!=0'>Pin enter is too short</span>
  <br>
  <br>
  <form action='gender'> <b> Gender </b>";

  for($ctr = 0; $ctr < sizeof($genderArray); $ctr++){
    $element = $genderArray[$ctr];
    echo "<input type='radio' name='gender' value='$element' ng-model='gender'> $element";
  }

  echo "</form>

  <p>&nbsp;</p>

  <label>
    <input type='checkbox' checked='checked' style='margin-bottom:15px'> Remember me
  </label>

  <p>By creating an account you agree to our <a href='#' style='color:blue'>Terms & Privacy</a>.</p>

  <div>
    <button type='submit'>Sign Up</button>
    <button type='button' onclick=" . '"document.getElementById(' . "'register'" . ").style.display='none'" . '"' . ">Cancel</button>
  </div>
  </div>
</form>
</div>

<p>&nbsp;</p>
<p style='text-align: center;'> © All Rights Reserved 2018 </p>";


if((isset($_SESSION['invalidLogin']) && isset($_SESSION['loginType']) && $_SESSION['loginType'] == 'password') || isset($_SESSION['validRegister'])){
  $log->lwrite('in simulating login form button click');
  
  echo '<script>
    window.addEventListener("load", function(event) {
        document.getElementById("loginButton").click();
    });
  </script>
  </body>
  </html>';
  unset($_SESSION['invalidLogin']);
  unset($_SESSION['validRegister']);
  $log->lwrite('unsset invalidLogin session');
}
else if((isset($_SESSION['invalidLogin']) && isset($_SESSION['loginType']) && $_SESSION['loginType'] == 'pin') || isset($_SESSION['validRegister'])){
  $log->lwrite('in simulating login form button click');
  
  echo '<script>
    window.addEventListener("load", function(event) {
        document.getElementById("loginPinButton").click();
    });
  </script>
  </body>
  </html>';
  unset($_SESSION['invalidLogin']);
  unset($_SESSION['validRegister']);
  unset($_SESSION['loginType']);
  $log->lwrite('unsset invalidLogin session');
}
else if(isset($_SESSION['invalidRegister'])){
  $log->lwrite('in invalid register isset');
  echo '<script>
  window.addEventListener("load", function(event) {
      document.getElementById("registerButton").click();
  });
</script>
</body>
</html>';
  $log->lwrite('echoed script for on click');
  unset($_SESSION['invalidRegister']);
  $log->lwrite('unsset invalidRegister session');
}else{
  $log->lwrite('no session errors');
  echo"
    </body>
    </html>";
}

?>
        

