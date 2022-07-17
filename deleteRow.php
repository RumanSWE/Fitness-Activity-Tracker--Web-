<?php
session_start();
$id = $_GET['id'];

require('connect.php');


$sql = "DELETE FROM userdata WHERE ID = $id"; 

if (mysqli_query($connection, $sql)) {
    mysqli_close($connection);
    header('Location: progress.php'); //If book.php is your main page where you list your all records
    exit;
} else {
    echo "Error deleting record";
}

?>