<?php
session_start();
// Check if admin is logged in
if (!isset($_SESSION['admin_email'])) {
    header("Location: login.php"); // Redirect to admin login page
}

// Check if project ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: project.php"); // Redirect back to projects page
}

// Include database connection
$servername = "sql309.infinityfree.com";
$username = "if0_36439499"; // Replace with your MySQL username
$password = "AAmTQjzSa2YCGHQ"; // Replace with your MySQL password
$dbname = "if0_36439499_dumabocdb"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Prepare a delete statement
$sql = "DELETE FROM projects WHERE id = ?";

if ($stmt = $conn->prepare($sql)) {
    // Bind variables to the prepared statement as parameters
    $stmt->bind_param("i", $param_id);

    // Set parameters
    $param_id = $_GET['id'];

    // Attempt to execute the prepared statement
    if ($stmt->execute()) {
        // Redirect to projects page after successful deletion
        header("Location: project.php");
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
