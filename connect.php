<?php

$connection = mysqli_connect('127.0.0.1', 'root', '','test');
if (!$connection) {
    die("Database Connection Failed" . mysqli_error($connection));
}
