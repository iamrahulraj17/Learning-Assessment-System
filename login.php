<?php
// Start the session
session_start();

// Database configuration
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "raj";

// Create connection
$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect and validate form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); // Plain text password

    // Prepare SQL statement
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        // Successful login
        $_SESSION['username'] = $username; // Store username in session
        header("Location: option.html"); // Redirect to option.html page
        exit(); // End script after redirect
    } else {
        // Invalid credentials
        header("Location: error.html");
    }
}

// Close connection
$conn->close();
?>
