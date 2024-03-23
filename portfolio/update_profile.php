<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Database connection
$host = 'localhost'; // Change this to your database host
$dbname = 'mydb'; // Change this to your database name
$username = 'root'; // Change this to your database username
$password = ''; // Change this to your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set PDO to throw exceptions
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // If connection fails, show error message
    die("Error: Could not connect. " . $e->getMessage());
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    // Add other fields as needed

    // Update user information in the database
    $email = $_SESSION['email'];
    $stmt = $pdo->prepare("UPDATE users SET name = ?, age = ?, gender = ? WHERE email = ?");
    $stmt->execute([$name, $age, $gender, $email]);

    // Optionally, handle photo upload if included in the form

    // Redirect back to profile settings page or display success message
    header("Location: profile_settings.php");
    exit();
}
?>
