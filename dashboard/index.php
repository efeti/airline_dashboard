<?php
include('includes/header.php');

session_start();
include ('includes/connect.php');

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == TRUE)
{
    header("Location: dashboard.php");
}
else
{
    header("Location: login.php");
}

include('includes/scripts.php');
include('includes/footer.php');
?>