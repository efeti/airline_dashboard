<?php
session_start();
$connection = mysqli_connect("localhost","root","","airline");

if(isset($_POST['registerbtn']))
{
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if($password === $cpassword)
    {
        $password = sha1($password);
        $query = "INSERT INTO admins (firstname,lastname,username,password) VALUES ('$firstname', '$lastname', '$username', '$password')";
        $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "pass";
        $_SESSION['message'] = "Registered successfully";
        header('location: register.php');
    }
    else
    {
        $_SESSION['status'] = "failed";
        $_SESSION['message'] = "admin profile not added";
        header('location: register.php');
    }
    }
    else
    {
        $_SESSION['status'] = "failed";
        $_SESSION['message'] = "Passwords do not match";
        header('location: register.php');

    }


    
}
?>