<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/about.css" />

        <style>
		* {box-sizing: border-box}
		body {font-family: Verdana, sans-serif; margin:0}
		.mySlides {display: none}
		img {vertical-align: middle;}

		/* Slideshow container */
		.slideshow-container {
		  max-width: 1000px;
		  position: relative;
		  margin: auto;
		}

		/* Next & previous buttons */
		.prev, .next {
		  cursor: pointer;
		  position: absolute;
		  top: 50%;
		  width: auto;
		  padding: 16px;
		  margin-top: -22px;
		  color: white;
		  font-weight: bold;
		  font-size: 18px;
		  transition: 0.6s ease;
		  border-radius: 0 3px 3px 0;
		}

		/* Position the "next button" to the right */
		.next {
		  right: 0;
		  border-radius: 3px 0 0 3px;
		}

		/* On hover, add a black background color with a little bit see-through */
		.prev:hover, .next:hover {
		  background-color: rgba(0,0,0,0.8);
		}

		/* Caption text */
		.text {
		  color: black;
		  font-size: 15px;
		  padding: 8px 12px;
		  position: absolute;
		  bottom: 8px;
		  width: 100%;
		  text-align: center;
		}

		/* Number text (1/3 etc) */
		.numbertext {
		  color: #f2f2f2;
		  font-size: 12px;
		  padding: 8px 12px;
		  position: absolute;
		  top: 0;
		}

		/* The dots/bullets/indicators */
		.dot {
		  cursor: pointer;
		  height: 15px;
		  width: 15px;
		  margin: 0 2px;
		  background-color: #bbb;
		  border-radius: 50%;
		  display: inline-block;
		  transition: background-color 0.6s ease;
		}

		.active, .dot:hover {
		  background-color: black;
		}

		/* Fading animation */
		.fade {
		  -webkit-animation-name: fade;
		  -webkit-animation-duration: 1.5s;
		  animation-name: fade;
		  animation-duration: 1.5s;
		}

		@-webkit-keyframes fade {
		  from {opacity: .4} 
		  to {opacity: 1}
		}

		@keyframes fade {
		  from {opacity: .4} 
		  to {opacity: 1}
		}

		/* On smaller screens, decrease text size */
		@media only screen and (max-width: 300px) {
		  .prev, .next,.text {font-size: 11px}
		}
		</style>
    </head>

    <body>

    	<p> &nbsp; </p>
    	<p> &nbsp; </p>
    	<p> &nbsp; </p>

    	<div class="slideshow-container">

			<div class="mySlides">
			  <div class="numbertext">1 / 6</div>
			  	<h1 style = "background-color: #D2B48C">
			  		<img src="../img/avatar2.png" alt="" width="200" height="200"> 
			  		Wissem Bahloul
			  	</h1>
				<a href="https://www.facebook.com/wissem.bahloul" class="grayButton facebook">Find me on Facebook</a>
				<a href="mailto:wi55em@hotmail.com" class="grayButton mail">Email me</a>
			  <div class="text">Wissem Bahloul</div>
			</div>

			<div class="mySlides">
			  <div class="numbertext">2 / 6</div>
			  <h1 style = "background-color: #D2B48C">
			  		<img src="../img/avatar2.png" alt="" width="200" height="200"> 
			  		Christoffer Baur
			  	</h1>
				<a href="#" class="grayButton facebook">Find me on Facebook</a>
				<a href="mailto:chriskbaur@gmail.com" class="grayButton mail">Email me</a>
			  <div class="text">Christoffer Baur </div>
			</div>

			<div class="mySlides">
			  <div class="numbertext">3 / 6</div>
			  <h1 style = "background-color: #D2B48C">
			  		<img src="../img/avatar2.png" alt="" width="200" height="200"> 
			  		Seif Elderbi
			  	</h1>
				<a href="https://www.facebook.com/selderby" class="grayButton facebook">Find me on Facebook</a>
				<a href="mailto:seif.derby@yahoo.com" class="grayButton mail">Email me</a>
			  <div class="text">Seif Elderbi</div>
			</div>

			<div class="mySlides">
			  <div class="numbertext">4 / 6</div>
			  <h1 style = "background-color: #D2B48C">
			  		<img src="../img/avatar2.png" alt="" width="200" height="200"> 
			  		Rodrigo Cespedes
			  	</h1>
				<a href="#" class="grayButton facebook">Find me on Facebook</a>
				<a href="mailto:rodrigoSebastian9@hotmail.com" class="grayButton mail">Email me</a>
			  <div class="text">Rodrigo Cespedes</div>
			</div>

			<div class="mySlides">
			  <div class="numbertext">5 / 6</div>
			  <h1 style = "background-color: #D2B48C">
			  		<img src="../img/avatar2.png" alt="" width="200" height="200"> 
			  		Christopher Concio
			  	</h1>
				<a href="#" class="grayButton facebook">Find me on Facebook</a>
				<a href="mailto:chris-768@hotmail.com" class="grayButton mail">Email me</a>
			  <div class="text">Christopher Concio</div>
			</div>

			<div class="mySlides">
			  <div class="numbertext">6 / 6</div>
			  <h1 style = "background-color: #D2B48C">
			  		<img src="../img/avatar2.png" alt="" width="200" height="200"> 
			  		Tooba Baig
			  	</h1>
				<a href="#" class="grayButton facebook">Find me on Facebook</a>
				<a href="mailto:tooba.baig3@gmail.com" class="grayButton mail">Email me</a>
			  <div class="text">Tooba Baig</div>
			</div>

			<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
			<a class="next" onclick="plusSlides(1)">&#10095;</a>

			</div>
			<br>

			<div style="text-align:center">
			  <span class="dot" onclick="currentSlide(1)"></span> 
			  <span class="dot" onclick="currentSlide(2)"></span> 
			  <span class="dot" onclick="currentSlide(3)"></span> 
			  <span class="dot" onclick="currentSlide(4)"></span> 
			  <span class="dot" onclick="currentSlide(5)"></span> 
			  <span class="dot" onclick="currentSlide(6)"></span> 
			</div>

			<script>
			var slideIndex = 1;
			showSlides(slideIndex);

			function plusSlides(n) {
			  showSlides(slideIndex += n);
			}

			function currentSlide(n) {
			  showSlides(slideIndex = n);
			}

			function showSlides(n) {
			  var i;
			  var slides = document.getElementsByClassName("mySlides");
			  var dots = document.getElementsByClassName("dot");
			  if (n > slides.length) {slideIndex = 1}    
			  if (n < 1) {slideIndex = slides.length}
			  for (i = 0; i < slides.length; i++) {
			      slides[i].style.display = "none";  
			  }
			  for (i = 0; i < dots.length; i++) {
			      dots[i].className = dots[i].className.replace(" active", "");
			  }
			  slides[slideIndex-1].style.display = "block";  
			  dots[slideIndex-1].className += " active";
			}
			</script>



    </body>
</html>

<!--
        	<div class="row">
				<div class="column" style="background-color:#aaa;">
					<h1><img src="../img/avatar2.png" alt="" width="200" height="200">
						Christoffer Baur
					</h1>
					<a href="#" class="grayButton facebook">Find me on Facebook</a>
					<a href="mailto:chriskbaur@gmail.com" class="grayButton mail">Email me</a>
				</div>

				<div class="column" style="background-color:#bbb;">
					<h1><img src="../img/avatar2.png" alt="" width="200" height="200">
						Seif Elderbi
					</h1>
					<a href="https://www.facebook.com/selderby" class="grayButton facebook">Find me on Facebook</a>
					<a href="mailto:seif.derby@yahoo.com" class="grayButton mail">Email me</a>
				</div>

				<div class="column" style="background-color:#ccc;">
					<h1><img src="../img/avatar2.png" alt="" width="200" height="200">
						Rodrigo Cespedes
					</h1>
					<a href="#" class="grayButton facebook">Find me on Facebook</a>
					<a href="mailto:rodrigoSebastian9@hotmail.com" class="grayButton mail">Email me</a>
				</div>
			
				<div class="column" style="background-color:#ddd;">
					<h1><img src="../img/avatar2.png" alt="" width="200" height="200">
						Christopher Concio
					</h1>
					<a href="#" class="grayButton facebook">Find me on Facebook</a>
					<a href="mailto:chris-768@hotmail.com" class="grayButton mail">Email me</a>
				</div>

				<div class="column" style="background-color:#eee;">
					<h1><img src="../img/avatar2.png" alt="" width="200" height="200">
						Tooba Baig
					</h1>
					<a href="#" class="grayButton facebook">Find me on Facebook</a>
					<a href="mailto:tooba.baig3@gmail.com" class="grayButton mail">Email me</a>
				</div>

				<div class="column" style="background-color:#fff;">
					<h1><img src="../img/avatar2.png" alt="" width="200" height="200">
						Wissem Bahloul
					</h1>
					<a href="https://www.facebook.com/wissem.bahloul" class="grayButton facebook">Find me on Facebook</a>
					<a href="mailto:wi55em@hotmail.com" class="grayButton mail">Email me</a>
				</div>
			</div>
      -->