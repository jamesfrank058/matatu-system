
<?php


$db = mysqli_connect("localhost", "root", "", "matatu_sacco");

// Check if the connection was successful
if (!$db) {
    die('Database connection failed: ' . mysqli_connect_error());
}

