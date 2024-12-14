
<?php


session_start();

// Check if the session is not set
if (!isset($_SESSION['username'])) {
    // Redirect the user to the login page
    header('Location: login.php');
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matatu Sacco App</title>

    <link rel="stylesheet" href="../css/custom-styles.css">
    <link rel="stylesheet" href="../css/home-styles.css">
</head>
<body>
 

<?php 

include '../pages/header.php'; 

?>

<div class="card-section">
        <div class="card">
            <img src="../images/metro2.jpg" alt="Image 1">
            <div class="card-content">
                <h2>Card 1</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <a href="#" class="btn">Read More</a>
            </div>
        </div>
        
        <div class="card">
            <img src="../images/smetro.jpg" alt="Image 2">
            <div class="card-content">
                <h2>Card 2</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <a href="#" class="btn">Read More</a>
            </div>
        </div>

        <div class="card">
            <img src="../images/metro3.jpg" alt="Image 2">
            <div class="card-content">
                <h2>Card 2</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <a href="#" class="btn">Read More</a>
            </div>
        </div>

        <div class="card">
            <img src="../images/metro4.jpg" alt="Image 2">
            <div class="card-content">
                <h2>Card 2</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <a href="#" class="btn">Read More</a>
            </div>
        </div>

        <div class="card">
            <img src="../images/image2.jpg" alt="Image 2">
            <div class="card-content">
                <h2>Card 2</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <a href="#" class="btn">Read More</a>
            </div>
        </div>

        <div class="card">
            <img src="../images/image2.jpg" alt="Image 2">
            <div class="card-content">
                <h2>Card 2</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <a href="#" class="btn">Read More</a>
            </div>
        </div>
 
    </div>
    




<?php 

include '../pages/footer.php';

?>
</body>
</html>