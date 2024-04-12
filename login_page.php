<?php
 @include 'connect.php';

session_start();

 if(isset($_POST['submit'])){
    // $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $cpass = mysqli_real_escape_string($conn, $_POST['cpassword']);
    $birthday = mysqli_real_escape_string($conn, $_POST['dob']);
    
    $select = "SELECT * FROM profile_info WHERE email = '$email'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $storedHashedPassword = $row['password'];
        $storedSalt = $row['salt'];

        if (password_verify($pass . $storedSalt, $storedHashedPassword)) {
            $_SESSION['user_name'] = $row['name'];
            header('location:user_page.php');
        } else {
            $error[] = 'Incorrect email or password';
        }
    } else {
        // User not found
        $error[] = 'Incorrect email or password';
    }




};



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset = "UTF-8">
    <meta http-equiv= "X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login page</title>
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class = "form-container">
    <form action="" method="post">
        <h2>~ Login here ~</h2>
        <?php
        if(isset($error)){
            foreach($error as $error){
               echo '<span class="error-msg">'.$error.'</span>';
            };
         };
        ?>
        <input type= "email" name= "email" required placeholder="your email">
        <input type= "password" name= "password" required placeholder="your password">
        <input type="submit" name="submit" value="Login Now!" class="form-btn">
        <p>Don't have an account? <a href="register_page.php">Register</a></p>
    </form>

</body>
</html>