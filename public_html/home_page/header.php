<!DOCTYPE HTML>
<html>
  <?php
  ?>
  <head>
    <title>Ask It!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/header.css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular.min.js"></script>    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css" integrity="sha384-v2Tw72dyUXeU3y4aM2Y0tBJQkGfplr39mxZqlTBDUZAb9BGoC40+rdFCG0m10lXk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/fontawesome.css" integrity="sha384-q3jl8XQu1OpdLgGFvNRnPdj5VIlCvgsDQTQB6owSOHWlAurxul7f+JpUOVdAiJ5P" crossorigin="anonymous">
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

    <div class = "header" >
     <!--<div class = "hamburger"> </div>-->
        <span>
          <a class = "hamburger"> </a>
          <a class = "option" href = "../home_page/about.php">About</a>
          <a class = "option" href = "../home_page/myquestions.php">My Question</a> 
          <a class = "option" href = "../home_page/homepage.php">Home</a>      
        </span> 
        <img src="../img/newlogo.png">
    </div>

  </body>

</html>