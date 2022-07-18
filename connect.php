<?php

$connection = mysqli_connect('database-1.cy53qqkottd0.us-east-1.rds.amazonaws.com:3306', 'admin', 'halo47reach','test');
if (!$connection) {
    die("Database Connection Failed" . mysqli_error($connection));
}
