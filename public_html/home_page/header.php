<!DOCTYPE HTML>
<html>
  <head>
    <title>Ask It!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.1.5/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-route.js"></script>
    <script src="../js/homepage.js"></script>
    <script src="../js/pageRouting.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/homepage.css">
    <link rel="stylesheet" type="text/css" href="../css/button.css">
</head>
  <body>
    <header id="header">
      <div class="container">
        <a href="header.html">
		      <img src="../img/logobig.png" alt="" width="240" height="120" />
 		    </a>
		<div class="search-container">
			<form action="/action_page.php">
			<input type="text" placeholder="Search.." name="search">
			<button type="submit"><i class="fa fa-search"></i></button>
			</form>
		</div>
        <div>
            <?php include("menu_template.php");
            ?>
      </div>
      </div>
    </header>