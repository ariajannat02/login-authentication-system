<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
   header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset = "UTF-8">
    <meta http-equiv= "X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>welcome page</title>
   <link rel="stylesheet" href="css/style.css">
<head>
<body>

<div class= "container">
    <div class= "content">
        <h2>hi, <span><?php echo $_SESSION['user_name'] ?></span></h3>
        <h1>welcome <span>user</span></h1>
        <p>this is an user page</p>
        <a href= "login_page.php" class="btn">Login</a>
        <a href= "register_page.php" class="btn">Register</a>
        <a href= "logout_page.php" class="btn">Logout</a>
            
    <div>

<body>
<html>