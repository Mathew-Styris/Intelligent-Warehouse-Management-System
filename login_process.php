<?php
// Start session
session_start();

// Define valid credentials
$validUsername = 'admin';
$validPassword = 'password';

// Get username and password from form
$username = $_POST['username'];
$password = $_POST['password'];

// Check if username and password are correct
if ($username === $validUsername && $password === $validPassword) {
    // Store username in session
    $_SESSION['username'] = $username;

    // Redirect to home.php
    header('Location: home.php');
    exit();
} else {
    // Redirect back to login page with error message
    header('Location: login.php?error=invalid');
    exit();
}
?>
