
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matatu Sacco App</title>

    <link rel="stylesheet" href="../css/custom-styles.css">
    <link rel="stylesheet" href="../css/login-styles.css">
    <link rel="stylesheet" href="../css/home-styles.css">


</head>
<body  style="background: #079992;">


<div class="login-page-cont">

<?php
include '../pages/dbconnect.php';

// Check if the login form is submitted
if (isset($_POST['login'])) {
    // Get the form input values
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the SQL statement to fetch user data
    $sql = "SELECT * FROM users WHERE (username = '$username' OR email = '$username') AND password = '$password'";
    $result = mysqli_query($db, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Valid login
        // Set session variables or perform additional tasks as needed
        session_start();
        $_SESSION['username'] = $username;

        // Redirect the user to the home page or any other desired page
        header('Location: ../pages/home.php');
        exit;
    } else {
        // Invalid login
        $error = "Invalid username or password. Please try again.";
    }
}
?>


<div class="login-page-cont">



                <form class="login-form" action="login.php" method="POST">
                <h1>Admin Login</h1>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <button type="submit" name="login">Login</button>
                    <a href="register.php">

                    <button type="button" id="reg-redir">Register</button>
                    </a>
                   


                    <?php if (isset($error)): ?>
                        <p class="error" id="error"><?php echo $error; ?></p>
                    <?php endif; ?>
                </form>
        </div>

        </div>
    
</body>
</html>



      
