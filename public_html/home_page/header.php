<!DOCTYPE HTML>
<html>

  <head>
    <title>Ask It!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/heade2.css">
  </head>

  <body>

    <?php 

      include_once '../../private/models/Account.php';
      include_once '../../private/controllers/AccountController.php';

      $status = session_status();
      if($status == PHP_SESSION_NONE){
        session_start();
      }
      if(isset($_SESSION['username'])) {
        $controller = new AccountController();
        $account = $controller::getAccountByUsername($_SESSION['username']);
      }
    ?>

    <div class = "head">
      
      <div class = "head_icon">
        <a href="homepage.php">
          <img src="../img/newlogo.png" alt=""/>
        </a>
      </div>

      <div class = "head_search"> 
        <form action="search.php">
          <input type="text" placeholder="Search.." name="search">
        </form>
      </div>

      <div class = "head_op">
        <div class = "head_options">
          <a href="homepage.php">Home</a>
          <a href="about.php">About</a>
        </div>
        <?php
          if(isset($_SESSION['username'])) {
          ?>
            <div class = "head_login">
              <div class="dropdown">
                <button class="dropbtn"> 
                  <?php 
                    $file_path = $account->getProfilePicturePath();
                    if(!file_exists($file_path)) {
                      $file_path = "..\img\avatar2.png";
                    }
                    echo "<img class='circle_img' src=\"".$file_path."\"> Hi, " .$account->getUsername(). " !"; 
                  ?>
                </button>
                <div class="dropdown-content">
                  <a href="profile.php">My Profile</a>
                  <a href="myquestions.php">My Questions</a>
                  <a href="favorites.php">Favorites</a>
                  <a href="logout.php">Logout</a>
                </div>
              </div>
            </div>
              <?php
          } 
          else {
            ?>
            <div class = "head_noSession">
              <a href="../login_register/loginregister.php">Log In/Sign Up</a> 
            </div>
            <?php
          }
        ?>
      </div>

    </div>
    
  </body>

</html>