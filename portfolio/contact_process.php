<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database configuration
    $servername = "sql309.infinityfree.com";
    $username = "if0_36439499"; // Replace with your MySQL username
    $password = "AAmTQjzSa2YCGHQ"; // Replace with your MySQL password
    $dbname = "if0_36439499_dumabocdb"; // Replace with your database name
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    

    // Prepare and bind parameters for the insert statement
    $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    // Set parameters
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Execute the insert statement
    if ($stmt->execute()) {
        echo "<script>alert('Thank you for the message'); window.location.href = 'index.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
} else {
    // If form is not submitted, redirect to the contact page
    header("Location: contact.php");
    exit();
}
?>
