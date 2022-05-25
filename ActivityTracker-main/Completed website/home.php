<?php
session_start();

if(!(isset($_SESSION['username'])))
{
    header("Location: login.php");
}
require('connect.php');

$loggedInUsername = $_SESSION['username'];

			if(isset($_POST['saveBtn']))
			{
				$timeCookie = "time";
				$distanceCookie = "distance";
				$caloriesCookie = "calories";
				
				if(!isset($_COOKIE[$timeCookie]) && !isset($_COOKIE[$distanceCookie]) && !isset($_COOKIE[$caloriesCookie])) 
				{
          echo "<script type='text/javascript'>alert('Please press reset or start an activity');</script>";
					// echo "Please press reset or start an activity";
				} 
				else
				{
					$time = $_COOKIE[$timeCookie];
					$distance = $_COOKIE[$distanceCookie];
					$calories = $_COOKIE[$caloriesCookie];
					
					
					$timeSplit = str_split($time);
					
					$hours = $timeSplit[0].$timeSplit[1];
					$minutes = $timeSplit[3].$timeSplit[4];
					$seconds= $timeSplit[6].$timeSplit[7];
					
					$mins = $minutes/60;
					$sec  = $seconds/60;
					$secFinal = $sec/60;
					$timeFinal = $hours + $secFinal + $mins;
					                                                             
					$avgSpeed = $distance/$timeFinal;                                                               
					
					
					
					
					
				  $query = "INSERT INTO `userdata` (username, distance, time,speed,calories) VALUES ('$loggedInUsername', '$distance','$time','$avgSpeed','$calories')";
				  $result = mysqli_query($connection, $query);
				
				  if($result){
					  echo "Uploaded Sucessfully";
				  }else{
					  echo "Upload Failed";
					  
						}
				}
			}				
			
	?>
<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="mystyle.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/css/ol.css"
    type="text/css">
  <meta charset="UTF-8">
  <title>Activity Tracker</title>
  <!-- Pointer events polyfill for old browsers, see https://caniuse.com/#feat=pointer -->
  <script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/build/ol.js"></script>

  <h1>Activity Tracker</h1>
</head>

<body>
  <div id="map" class="map"></div>
  <div id="info" style="display: none;"></div>	
  <div id="container">


   

    <!--Stats -->
    <div class="stats">

      <!--Checkbox lable -->
        <!-- <input id="track" type="checkbox"  /> -->
      <p>
        Calories: <span id="calories" class="calories"></span><!--calories-->
      </p>
      <p>
        Speed: <span id="speed"></span>kph
      </p>
      Distance: <span id="distance">0</span>Km<!--distance-->
    </div>

     <!-- stopwatch contols -->
     <div class="controls">

      <div class="playPauseButtons">
        <button id="buttonPlay">
          <img id="playButton" src="Assets/Images/playImg.svg" onclick="activeDist=true"/>
        </button>
      </div>
      
      <div class="resetStopButtons">
        <button id="buttonStop">
          <img id="stopButton" src="Assets/Images/stopImg.svg" />
        </button>
        <button id="buttonReset" onclick="reset()">
          <img id="resetButton" src="Assets/Images/resetImg.svg" /> <!--Reset button-->
        </button>
      </div>
    </div>


    <!-- stopwatch body -->
    <div class="stopwatch">
      <div class="circle">
        <span class="time" id="display">00:00:00</span><!--time-->
      </div>
    </div>


  </div>
  
  <div id = saveButton>
  <form method="POST">
  <input id ="saveBtn" type="submit" value="Save" name="saveBtn">
  </form>
  </div>
	

	
  <script src="Scripts/geo.js"></script>
  <script src="Scripts/calories.js"></script>
  <script src="Scripts/Timer.js"></script>
  <script src="Scripts/resetHome.js"></script>
  


<div class="navBar">
  <button id="weight" onclick="window.location.href='exercise.html'"><img id="weightButton" src="Assets\Images\weightButton.svg" alt="weightButton" width="100%" height="100%"></button>
  <button id="overallProgress" onclick="window.location.href='progress.php'"><img id="progressbutton" src="Assets/Images/graphButton.svg" alt="overallProgress" width="100%" height="100%"></button>
  <button id="home" onclick="window.location.href='home.php'"><img id="homeButton" src="Assets\Images\homeButton.svg" alt="Home" width="100%" height="100%"></button>
  <button id="runInfo" onclick="window.location.href='runInfo.php'"><img id="runButton" src="Assets/Images/runInfoButton.svg" alt="Run Info"  width="100%" height="100%"></button>
  <button id="settings" onclick="window.location.href='settings.html'"><img id="settingsButton" src="Assets/Images/settingsButton.svg" alt="Settings"  width="100%" height="100%"></button>
</div>
</body>
</html>