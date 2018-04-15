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
  
    <p id=image><a href='../views/homepage.php'><img style='display: block; margin-left: auto; margin-right: auto;' src='../img/newlogo.png' alt='' width='50%' height='50%' /></a></p>
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
                <input ng-model='userName' type='text' placeholder='Enter Username' ";
        if(isset($_SESSION['uName']))
          echo 'ng-init="userName=' . "'" . $_SESSION['uName'] . "'" . '"';
        echo " name='username' required>
  
          <label><b>Password</b></label>
            <input ng-model='password' type='password' placeholder='Enter Password' name='password' required>
          
          <button type='submit'>Login</button>
          <button type='button' onclick=" . '"document.getElementById(' . "'login'" . ").style.display='none'" . '"' . "class='cancel'>Cancel</button>

          <label><input type='checkbox' checked='checked'> Remember me
          </label>
          <a href='forgotpassword.php' style = 'text-align: left; padding: 4%'> Forgot password? 
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
            <input ng-model='userName' type='text' placeholder='Enter Username' ";
        if(isset($_SESSION['uName']))
          echo 'ng-init="userName=' . "'" . $_SESSION['uName'] . "'" . '"';
      echo " name='username' required>
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
          <label><b>First Name</b></label>
          <input ng-model='firstName' type='text' placeholder='Enter First Name' name='firstName' maxlength='50' required=''";
          if(isset($_SESSION['firstName']))
            echo ' ng-init="firstName=' . "'" . $_SESSION['firstName'] . "'" . '"';
          echo "><span class='alert' ng-if='firstName.length<2 && firstName.length!=0'>First Name entered is too short (Minimum of 1 and maximum of 50 characters)</span>
        <br>
          <label><b>Last Name</b></label>
          <input ng-model='lastName' type='text' placeholder='Enter Last Name'";
          if(isset($_SESSION['lastName']))
            echo ' ng-init="lastName=' . "'" . $_SESSION['lastName'] . "'" . '"';
          echo " name='lastName' maxlength='50' required>
      <span class='alert' ng-if='lastName.length<2 && lastName.length!=0'>Last Name entered is too short (Minimum of 1 and maximum of 50 characters)</span>
      <br>
          <label><b>Bio</b></label>
          <div class='form-control'>
            <textarea ng-model='bio' style='width:100%' rows='10' placeholder='Enter Bio'";
            if(isset($_SESSION['bio']))
              echo 'ng-init="bio=' . "'" . $_SESSION['bio'] . "'" . '"';
            echo " name='bio' maxlength='500' required></textarea>
            <span class='alert' ng-if='bio.length<2 && bio.length!=0'>Bio entered is too short (Minimum of 1 and maximum of 500 characters)</span>
            
          </div>
      
      <br>
          <label><b>Username</b></label>
          <input ng-model='userName' type='text' placeholder='Enter Username'";
          if(isset($_SESSION['uName']))
            echo 'ng-init="userName=' . "'" . $_SESSION['uName'] . "'" . '"';
          echo " name='username' maxlength='20' required>
      <span class='alert' ng-if='userName.length<4 && userName.length!=0'>Username enter is too short (Minimum of 4 and maximum of 20 characters)</span>
      <br>
          <label><b>Password</b></label>
          <input ng-model='password' type='password' placeholder='Enter Password'";
          if(isset($_SESSION['password']))
            echo 'ng-init="password=' . "'" . $_SESSION['password'] . "'" . '"';
          echo " name='password' maxlength='20' required>
      <span class='alert' ng-if='password.length<8 && password.length!=0'>Password should have a minimum of 8 characters</span>
      <br>
          <label> <b> Security Question 1 </b>
            <select name = 'SQ1'>
              <option value = ";
              if(isset($_SESSION['SQ1']))
              echo "'" . $_SESSION['SQ1'] . "'> " . $_SESSION['SQ1'] . " ";
              else
                echo "'select'> -Please select- ";
              echo "</option>";

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
    <input ng-model='answer1' type='text' placeholder='Enter Answer'";
    if(isset($_SESSION['A1']))
      echo 'ng-init="answer1=' . "'" . $_SESSION['A1'] . "'" . '"';
    echo " name='Answer1' required>
    <br>
    <label> <b> Security Question 2 </b>
      <select name = 'SQ2'>
        <option value = ";
        if(isset($_SESSION['SQ2']))
          echo "'" . $_SESSION['SQ2'] . "'> " . $_SESSION['SQ2'] . " ";
        else
          echo "'select'> -Please select- ";
        echo "</option>";
  for($ctr = 0; $ctr < sizeof($s2Array); $ctr++){
    $element = $s2Array[$ctr];
    echo "<option value = '$element'> $element </option>";
  }


  echo "</select> 
    </label>
    <input ng-model='answer2' type='text' placeholder='Enter Answer'";
    if(isset($_SESSION['A2']))
      echo 'ng-init="answer2=' . "'" . $_SESSION['A2'] . "'" . '"';
    echo " name='Answer2' required>
    <br>
    <br>
    <label> <b> Profession </b>
      <select name = 'profession'>
        <option value = ";
        if(isset($_SESSION['profession']))
          echo "'" . $_SESSION['profession'] . "'> " . $_SESSION['profession'] . " ";
        else
          echo "'select'> -Please select- ";
        echo "</option>";
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
    <input ng-model='pin' type='pin' placeholder='Enter Pin'";
    if(isset($_SESSION['pin']))
      echo 'ng-init="pin=' . "'" . $_SESSION['pin'] . "'" . '"';
    echo " name='pin' maxlength='4' >
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
        

