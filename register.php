<?php
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
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Prepare SQL statement
    $sql = "INSERT INTO users (firstname, username, email, password) VALUES ('$firstname', '$username', '$email', '$password')";

    // Execute query
    if ($conn->query($sql) === TRUE) {
        header("Location: login.html"); 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
