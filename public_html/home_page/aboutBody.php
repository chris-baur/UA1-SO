<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/about.css" />

        <style>
		
		</style>
    </head>

    <body>

    	<p> &nbsp; </p>
    	<p class = "title"> ABOUT THE COMPANY
    		<span>
    			<br>
		    	Our mission is to share and grow the world’s knowledge. A vast amount of the knowledge that would be valuable to many people is currently only available to a few — either locked in people’s heads, or only accessible to select groups. We want to connect the people who have knowledge to the people who need it, to bring together people with different perspectives so they can understand each other better, and to empower everyone to share their knowledge for the benefit of the rest of the world. 
    		</span>
    	</p>
    	<p> &nbsp; </p>

    	<div class="slideshow-container">

			<div class="mySlides">
				<div class="numbertext">1 / 6</div>
				<h1>
			  		<img src="../img/wissem.png" width="200" height="200"> Wissem Bahloul
				</h1>
				<a href="https://www.facebook.com/wissem.bahloul" class="grayButton facebook">Find me on Facebook</a>
				<a href="mailto:wi55em@hotmail.com" class="grayButton mail">Email me</a>
				<div class="text">Wissem Bahloul</div>
			</div>

			<div class="mySlides">
			  <div class="numbertext">2 / 6</div>
			  <h1>
			  		<img src="../img/avatar2.png" alt="" width="200" height="200"> 
			  		Christoffer Baur
			  	</h1>
				<a href="#" class="grayButton facebook">Find me on Facebook</a>
				<a href="mailto:chriskbaur@gmail.com" class="grayButton mail">Email me</a>
			  <div class="text">Christoffer Baur </div>
			</div>

			<div class="mySlides">
			  <div class="numbertext">3 / 6</div>
			  <h1>
			  		<img src="../img/avatar2.png" alt="" width="200" height="200"> 
			  		Seif Elderbi
			  	</h1>
				<a href="https://www.facebook.com/selderby" class="grayButton facebook">Find me on Facebook</a>
				<a href="mailto:seif.derby@yahoo.com" class="grayButton mail">Email me</a>
			  <div class="text">Seif Elderbi</div>
			</div>

			<div class="mySlides">
			  <div class="numbertext">4 / 6</div>
			  <h1>
			  		<img src="../img/avatar2.png" alt="" width="200" height="200"> 
			  		Rodrigo Cespedes
			  	</h1>
				<a href="#" class="grayButton facebook">Find me on Facebook</a>
				<a href="mailto:rodrigoSebastian9@hotmail.com" class="grayButton mail">Email me</a>
			  <div class="text">Rodrigo Cespedes</div>
			</div>

			<div class="mySlides">
			  <div class="numbertext">5 / 6</div>
			  <h1>
			  		<img src="../img/avatar2.png" alt="" width="200" height="200"> 
			  		Christopher Concio
			  	</h1>
				<a href="#" class="grayButton facebook">Find me on Facebook</a>
				<a href="mailto:chris-768@hotmail.com" class="grayButton mail">Email me</a>
			  <div class="text">Christopher Concio</div>
			</div>

			<div class="mySlides">
			  <div class="numbertext">6 / 6</div>
			  <h1>
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