<?php
echo '<html>
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
			<p> &nbsp; </p>';
			
			//TODO, echo this repetitive chunk of html in a loop with proper arrays
			$nameArray = array('Wissem Bahloul', 'Christoffer Baur', 'Seif Elderbi', 'Rodrigo Cordova Cespedes', 'Christopher Concio', 'Tooba Baig');
			$imgArray = array('wissem.png', 'chrisb.jpg', 'rodrigo.jpg', 'seif.jpg', 'rodrigo.jpg', 'chrisc.jpg', 'tooba.jpg');
			$fbArray = array('wissem.bahloul', 'christoffer.baur', 'seif.elderbi', 'rodrigo.cordova.cespedes', 'christopher.concio', 'tooba.baig');
			$mailArray = array('wi553m@hotmail.com', 'chriskbaur@gmail.com', 'seif.derby@yahoo.com', 'rodrigoSebastian9@hotmail.com', 'chris-768@hotmail.com', 'tooba.baig3@gmail.com');
			echo '<div class="slideshow-container">';

			for($ctr = 0; $ctr<6; $ctr++){
				$pos = $ctr + 1;
				echo "<div class='mySlides'>
					<div class='numbertext'> $pos / 6</div>
					<h1>
							<img src='../img/";
				if(file_exists('../img/'. $imgArray[$ctr]))
					echo $imgArray[$ctr] . "'";
				else
					echo "avatar2.png'";
				if($ctr == 1)
					echo ' width="150" height="200" style="margin-right:50px"';
				else
					echo " width='200' height='200' ";
				echo '>' . $nameArray[$ctr] . "
					</h1>
					<div>
						<a href='https://www.facebook.com/". $fbArray[$ctr] . "' class='grayButton facebook'>Find me on Facebook</a>					
						<a href='mailto:". $mailArray[$ctr] . "' class='grayButton mail'>Email me</a>
					</div>	
				</div>";
			}
echo "<a class='prev' onclick='plusSlides(-1)'>&#10094;</a>
			<a class='next' onclick='plusSlides(1)'>&#10095;</a>

			</div>
			<br>

			<div style='text-align:center'>
			  <span class='dot' onclick='currentSlide(1)'></span> 
			  <span class='dot' onclick='currentSlide(2)'></span> 
			  <span class='dot' onclick='currentSlide(3)'></span> 
			  <span class='dot' onclick='currentSlide(4)'></span> 
			  <span class='dot' onclick='currentSlide(5)'></span> 
			  <span class='dot' onclick='currentSlide(6)'></span> 
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
			  var slides = document.getElementsByClassName('mySlides');
			  var dots = document.getElementsByClassName('dot');
			  if (n > slides.length) {slideIndex = 1}    
			  if (n < 1) {slideIndex = slides.length}
			  for (i = 0; i < slides.length; i++) {
			      slides[i].style.display = 'none';  
			  }
			  for (i = 0; i < dots.length; i++) {
			      dots[i].className = dots[i].className.replace(' active', '');
			  }
			  slides[slideIndex-1].style.display = 'block';  
			  dots[slideIndex-1].className += ' active';
			}
			</script>



    </body>
</html>";