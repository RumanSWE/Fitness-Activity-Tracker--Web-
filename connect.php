<?php
//$connection = mysqli_connect('flowtrackdb.database.windows.net', 'RumanAdmin', 'Admin12345','FlowTrackDatabase');
//$connection  = new PDO("sqlsrv:server = tcp:flowtrackdb.database.windows.net,1433; Database = FlowTrackDatabase", "RumanAdmin", "Admin12345");
$connection = mysqli_connect('database-1-instance-1.ctqvev74bys7.eu-west-1.rds.amazonaws.com:3306', 'admin', 'halo47reach','test');
    //$connection ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (!$connection) {
    die("Database Connection Failed" . mysqli_error($connection));
}
