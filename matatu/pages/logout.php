<?php

session_start();

// Clear all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect the user to the login page
header('Location: ../pages/login.php');
exit;


?>
