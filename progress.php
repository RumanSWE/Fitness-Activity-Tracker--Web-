<?php
session_start();

if(!(isset($_SESSION['username'])))
{
    header("Location: login.php");
}
require('connect.php');

$loggedInUsername = $_SESSION['username'];



 
?>
<!DOCTYPE html>
<meta charset="UTF-8">
<html lang="en">
    <head>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <title>Progress</title>
        <link rel="stylesheet" href="mystyle.css">
<?php

# Grab the data2 from the database
$query = "SELECT * FROM `userdata` WHERE username ='$loggedInUsername' ORDER BY timestamp DESC";

$result = mysqli_query($connection, $query);
$calChartData = [['timestamp','calories'],];
$disChartData = [['timestamp','distance',],]; 
$speedChartData = [['timestamp','speed',],];
$lenArr = 0;
$stampArr = array();
$timeArr = array();
$disArr = array();
$speedArr = array();
$caloriesArr = array();

if ($result->num_rows > 0) {
	while ($row =  mysqli_fetch_array($result))
	{
		$calChartData[] = [$row['timestamp'],(int)$row['calories']];
		$disChartData[] = [$row['timestamp'],(int)$row['distance']];
		$speedChartData[] = [$row['timestamp'],(int)$row['speed']];
		
		array_push($stampArr,$row['timestamp']);
		array_push($timeArr,$row['time']);
		array_push($disArr,$row['distance']);
		array_push($speedArr,$row['speed']);
		array_push($caloriesArr,$row['calories']);
		
		$lenArr = count($stampArr);
	}
}
?>


    <script type="text/javascript" src="Scripts/resetHome.js"></script>
    <script type="text/javascript">
            var timeArray = <?php echo json_encode($timeArr); ?>;
			var stampArray = <?php echo json_encode($stampArr); ?>;
			var disArray = <?php echo json_encode($disArr); ?>;
			var speedArray = <?php echo json_encode($speedArr); ?>;
			var caloriesArray = <?php echo json_encode($caloriesArr); ?>;
			var len = <?php echo $lenArr; ?>;
    </script>
	<script type="text/javascript" src="Scripts/progressNextPrev.js"></script>
		 
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" >
		var calChartData =  <?php echo json_encode($calChartData);?>;
		var disChartData = <?php echo json_encode($disChartData);?>;
		var speedChartData = <?php echo json_encode($speedChartData);?>;
	</script>
	<script type="text/javascript" src="Scripts/googlechart.js"></script>

    </head>

    <body>
        <h2 id="historyHeading">History</h2>

<style>
#container_slideshow
{
	width: 90%;
    height: 50px;
    margin: auto;
    align-items: center;
    text-align: center;
    padding-top: 10px;
    border-radius: 10px;
    justify-content: center;
}
.boxes
{
  width: 50%;
  margin: auto;
 
}
</style>
	 <!-- Slideshow container -->
<div class="container_slideshow" >
  <div class="mySlides fade" id="slide">
    <div class="boxes" id="calorieChart"></div>
  </div>

  <div class="mySlides fade" id="slide">
   
    <div class="boxes" id="distanceChart"></div> 
  </div>
  
  <div class="mySlides fade" id="slide">

    <div class="boxes" id="speedChart"></div> 
  </div>
  
  <a class="prevSlide" onclick="plusSlides(-1)">&#10094;</a>
  <a class="nextSlide" onclick="plusSlides(1)">&#10095;</a>
</div>

<script>
var slideIndex = 1;

showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
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
<br>

<!-- The dots/circles -->
<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span>
  <span class="dot" onclick="currentSlide(2)"></span>
  <span class="dot" onclick="currentSlide(3)"></span>
</div>

	<div class="runInfoBody">
            <div class="runInfoButtons">
               <script src="https://unpkg.com/tlx/browser/tlx.js"></script>
               <div id="historyBtn">

                <p id="result">Time:</p>
                <p id="result1">Date Time:</p>
                <p id="result3">Average Speed(kph):</p>
                <p id="result2">Distance(km):</p>
                <p id="result4">Calories Burnt:</p>


                <input type="button" class="cycle" id="prev" value="Previous">
                <input type="button" class="cycle" id="next" value="Next">
				
				<!--<form name="form" action="" method="post">	
					<button type="submit" value="Submit">Submit</button>
				</form>
				-->
			
                </div>
            </div>

               


  </head>
 
    

	</div>
    </body>

    <div class="navBar">
  <button id="weight" onclick="window.location.href='exercise.html'"><img id="weightButton" src="Assets\Images\weightButton.svg" alt="weightButton" width="100%" height="100%"></button>
  <button id="overallProgress" onclick="window.location.href='progress.php'"><img id="progressbutton" src="Assets/Images/graphButton.svg" alt="overallProgress" width="100%" height="100%"></button>
  <button id="home" onclick="window.location.href='home.php'"><img id="homeButton" src="Assets\Images\homeButton.svg" alt="Home" width="100%" height="100%"></button>
  <button id="runInfo" onclick="window.location.href='runInfo.php'"><img id="runButton" src="Assets/Images/runInfoButton.svg" alt="Run Info"  width="100%" height="100%"></button>
  <button id="settings" onclick="window.location.href='settings.html'"><img id="settingsButton" src="Assets/Images/settingsButton.svg" alt="Settings"  width="100%" height="100%"></button>
</div>

	
</html>