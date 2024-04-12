<?php
@include 'connect.php';

if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $cpass = mysqli_real_escape_string($conn, $_POST['cpassword']);
    $birthday = mysqli_real_escape_string($conn, $_POST['dob']);
    
    $select = "SELECT * FROM profile_info WHERE email = '$email' && password='$pass' ";
    
    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){
        $error[] = 'Profile already exists!';
    } else {
        if($pass != $cpass){
            $error[] = 'Passwords do not match';
        } else {
    
            $salt = bin2hex(random_bytes(16));
            $hashedPassword = password_hash($pass . $salt, PASSWORD_DEFAULT);
            $insert = "INSERT INTO profile_info(name, email, password, dob,salt) VALUES('$name', '$email', '$hashedPassword', '$birthday','$salt')";
            
            mysqli_query($conn, $insert);
    
            header('location: login_page.php');
        }
    }
};


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset = "UTF-8">
    <meta http-equiv= "X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register page</title>
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class = "form-container">
    <form action="" method="post">
        <h2>~ Register here ~</h2>
        <?php
        if(isset($error)){
            foreach($error as $error){
               echo '<span class="error-msg">'.$error.'</span>';
            };
         };
        ?>
        <input type= "text" name= "name" required placeholder="your name">
        <input type= "email" name= "email" required placeholder="your email">
        <input type= "password" name= "password" required placeholder="your password">
        <input type= "password" name= "cpassword" required placeholder="confirm password">
        <input type= "date" name= "dob" placeholder="your dob" required>
        <input type="submit" name="submit" value="Register Now!" class="form-btn">
        <p>Have an account? <a href="login_page.php">Login</a></p>
    </form>

</div>
</body>
</html>