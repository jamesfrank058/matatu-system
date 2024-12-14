<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="../css/custom-styles.css">
   
    <link rel="stylesheet" href="../css/register.css">

</head>
<body>





<?php
include '../pages/dbconnect.php';

if (isset($_POST['register'])) {
    // Get the form input values
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Check if a user with the same username or email already exists
    $query = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) > 0) {
        // User with the same username or email already exists
        $error = "Username or email already exists. Please choose a different one.";
    } else {
        // Insert the user into the users database
        $sql = "INSERT INTO users (username, email, password, phone, address, created_at, role) 
                VALUES ('$username', '$email', '$password', '$phone', '$address', NOW(), 'user')";

        if (mysqli_query($db, $sql)) {
            // Registration successful
            header('Location: ../pages/login.php');
            exit;
        } else {
            // Registration failed
            $error = "Registration failed. Please try again.";
        }
    }
}
?>

    <div class="registration-page-cont">
        
        <form class="registration-form"  method="POST">
        <h1>Registration</h1>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" required>
            </div>
          
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" required>
            </div>
            <button type="submit" name="register">Register</button>

            <a href="../pages/login.php">

                    <button type="button" id="login-redir">Login</button>
                    </a>
        </form>
    </div>
</body>
</html>
