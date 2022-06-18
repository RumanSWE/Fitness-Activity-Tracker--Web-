<?php
$connection = mysqli_connect('flowtrackdb.database.windows.net', 'RumanAdmin', 'Admin12345');
if (!$connection) {
    die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'FlowTrackDatabase');
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}
//php script to connect the website to the database