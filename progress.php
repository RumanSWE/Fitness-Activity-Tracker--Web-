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

if ($result->num_rows > 0) {
    // output data of each row
	echo " <h2 id='historyHeading'>History</h2>";
	echo "<table id='History'>
			<tr>
			<th>Timestamp</th>
			<th>Distance</th>
			<th>Speed</th>
			<th>Time</th>
			<th>Calories</th>
			
			</tr>";
    while($row = $result->fetch_assoc()) {
		
		echo "<tr>";
		echo "<td>" . $row["timestamp"] ."</td>";
		echo "<td>" . $row["distance"] . "</td>";
		echo "<td>" . $row["speed"] . "</td>";
		echo "<td>" . $row["time"] . "</td>";
		echo "<td>" . $row["calories"] . "</td>";
		echo "</tr>";
	}
	echo "</table>"; 
} else {
    echo "0 results";
}


?>


    <script type="text/javascript" src="Scripts/resetHome.js"></script>	 
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  

    </head>

    <body>
       

  </head>
 
	</div>
    </body>

 <div class="navBar">
  <button id="overallProgress" onclick="window.location.href='progress.php'"><img id="progressbutton" src="Assets/Images/graphButton.svg" alt="overallProgress" width="100%" height="100%">
  </button>
  <button id="home" onclick="window.location.href='home.php'"><img id="homeButton" src="Assets\Images\homeButton.svg" alt="Home" width="100%" height="100%"></button>
  <button id="settings" onclick="window.location.href='settings.html'"><img id="settingsButton" src="Assets/Images/settingsButton.svg" alt="Settings"  width="100%" height="100%"></button>
</div>

	
</html>