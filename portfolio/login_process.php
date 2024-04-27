<?php
session_start();

// Database connection
$servername = "sql309.infinityfree.com";
$username = "if0_36439499"; // Replace with your MySQL username
$password = "AAmTQjzSa2YCGHQ"; // Replace with your MySQL password
$dbname = "if0_36439499_dumabocdb"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Get form data
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Prepare SQL statement
$sql = "SELECT * FROM admins WHERE email=? AND password=?";
$stmt = $conn->prepare($sql);

// Bind parameters and execute query
$stmt->bind_param("ss", $email, $password);
$stmt->execute();

// Check if a matching record is found
$result = $stmt->get_result();
if ($result->num_rows == 1) {
    // Admin login successful
    $_SESSION['admin_email'] = $email;
    header("Location:dashboard.php"); // Redirect to admin dashboard
    exit();
} else {
    // Admin login failed
    echo "Invalid email or password";
}

$stmt->close();
$conn->close();

?>