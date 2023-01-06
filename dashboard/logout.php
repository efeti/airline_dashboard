<?php
session_start();
$_SESSION['loggedin'] = FALSE;
unset($_SESSION["id"]);
unset($_SESSION["name"]);
header("Location: " . DASHBOARD_URL . "/login.php");
