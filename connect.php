<?php
$connection = mysqli_connect('flowtrackdb.database.windows.net', 'RumanAdmin', 'Admin12345','FlowTrackDatabase');
//$connection  = new PDO("sqlsrv:server = tcp:flowtrackdb.database.windows.net,1433; Database = FlowTrackDatabase", "RumanAdmin", "Admin12345");
    //$connection ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (!$connection) {
    die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'FlowTrackDatabase');
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}
//php script to connect the website to the database