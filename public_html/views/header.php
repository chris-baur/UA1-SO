<!DOCTYPE HTML>
<html>
  <?php
  ?>
  <head>
    <title>Ask It!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/header1.css"> 
  </head>

  <body>
    <header>
      <div class="navbar navbar-inverse menu">
        <div class="col-lg-2 no-padding">
          <a href="homepage.php"><img class="col-lg-12 no-padding"
          src="../img/newlogo.png" alt=""/></a>
        </div>
        <div class="col-lg-10 container-fluid">          
          <div class="col-lg-3 row search-container">
            <form method="get" action="search.php">
              <input type="text" placeholder="Search.." name="search">
              <button type="submit" value="search"><i class="fa fa-search"></i></button>
            </form>        
          </div>
          <div class="row col-lg-9 no-padding menubar">
                <?php include("menu_template.php");?>
          </div>
        </div>
      </div>
    </header>
<<<<<<< HEAD:public_html/home_page/header.php
=======

    <div class = "header" >
     <!--<div class = "hamburger"> </div>-->
        <span>
          <a class = "hamburger"> </a>
          <a class = "option" href = "../views/about.php">About</a>
          <a class = "option" href = "../views/myquestions.php">My Question</a> 
          <a class = "option" href = "../views/homepage.php">Home</a>      
        </span> 
        <img src="../img/newlogo.png">
    </div>

>>>>>>> 10049027833ca31d1e4ec4f2d37dfb7bc0e99f36:public_html/views/header.php
  </body>

</html>