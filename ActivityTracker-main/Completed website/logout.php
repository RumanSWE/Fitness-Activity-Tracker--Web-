<?php
session_start();
session_destroy();
header('Location: login.php');
#this is used to logout of the page and kill  the session
?>
