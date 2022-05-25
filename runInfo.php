<?php
session_start();

if(!(isset($_SESSION['username'])))
{
    header("Location: login.php");
}
require('connect.php');

$loggedInUsername = $_SESSION['username'];

$query = "SELECT * FROM `userdata` WHERE username ='$loggedInUsername' ORDER BY timestamp DESC";
$result = mysqli_query($connection, $query);

$row = mysqli_fetch_row($result);

$dis =  $row[0]; 
$speed = $row[1];
$time = $row[2];
$cal = $row[3];



?>
<!DOCTYPE html>
<meta charset="UTF-8">
<html lang="en">
    <head>
        <title>Run Information</title>
        <link rel="stylesheet" href="mystyle.css">
        
    </head>

    <body onload="exercisePrompts()">
        <h1>Recent Run Information</h1>
        <div id="runInfoTop">
            <img id="guyPicture" src="Assets/Images/Muscular.png" alt="Muscular Man">
        </div>
        <div id="runInfoBottom">
        <?php if($row != null){?>
			<p>Distance:<span id="distanceSpan"><?php echo $dis ?></span>km</p>
			<p>Time: <span id="timeSpan"><?php echo $time ?></span> </p>
			<p>Speed:<span id="speedSpan"><?php echo $speed ?></span>km/h</p>
			<p>Calories Burnt:<span id="caloriesSpan"><?php echo $cal ?></span> </p>
            <p><span id="adviseSpan">Advise:</span></p>
            <?php }else {echo "No Activities Recorded.";}?>
        </div>
        
        
    </body>
    <div class="navBar">
  <button id="weight" onclick="window.location.href='exercise.html'"><img id="weightButton" src="Assets\Images\weightButton.svg" alt="weightButton" width="100%" height="100%"></button>
  <button id="overallProgress" onclick="window.location.href='progress.php'"><img id="progressbutton" src="Assets/Images/graphButton.svg" alt="overallProgress" width="100%" height="100%"></button>
  <button id="home" onclick="window.location.href='home.php'"><img id="homeButton" src="Assets\Images\homeButton.svg" alt="Home" width="100%" height="100%"></button>
  <button id="runInfo" onclick="window.location.href='runInfo.php'"><img id="runButton" src="Assets/Images/runInfoButton.svg" alt="Run Info"  width="100%" height="100%"></button>
  <button id="settings" onclick="window.location.href='settings.html'"><img id="settingsButton" src="Assets/Images/settingsButton.svg" alt="Settings"  width="100%" height="100%"></button>
</div>
<script src="Scripts/exercisePrompts.js"></script>
</html>