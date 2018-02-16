<!DOCTYPE HTML>
<html>
  <head>
    <title>Ask It!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-route.js"></script>
    <script src="../js/homepage.js"></script>
    <script src="../js/pageRouting.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/homepage.css">
    <link rel="stylesheet" type="text/css" href="../css/button.css">
</head>
  <body>
    <header>
  <nav class="navbar navbar-inverse menu">
    <div class="col-lg-2 no-padding ">
      <a href="homepage.php"><img class="col-lg-12 no-padding" 
      src="../img/newlogo.png" alt=""/></a>
    </div>
    <div class="col-lg-10 container-fluid">          
      <div class="col-lg-3 row search-container no-padding">
        <input type="text" placeholder="Search.." name="search">
        <button type="submit"><i class="fa fa-search"></i></button>        
      </div>
        <div class="row col-lg-9 no-padding menubar">
            <?php include("menu_template.php");?>
      </div>
      </div>
    </header>