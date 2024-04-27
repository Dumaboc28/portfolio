<?php
session_start();
// Check if admin is logged in
if (!isset($_SESSION['admin_email'])) {
    header("Location: admin_login.php"); // Redirect to admin login page
    exit();
}

// Include database configuration
$servername = "sql309.infinityfree.com";
$username = "if0_36439499"; // Replace with your MySQL username
$password = "AAmTQjzSa2YCGHQ"; // Replace with your MySQL password
$dbname = "if0_36439499_dumabocdb"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are filled
    if (!empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['language']) && !empty($_POST['role'])) {
        // Prepare and bind parameters for the update statement
        if (!empty($_FILES['new_photo']['name'])) {
            // New photo uploaded, update photo field
            $stmt = $conn->prepare("UPDATE projects SET photo=?, title=?, description=?, language_used=?, role=?, website_link=? WHERE id=?");
            $stmt->bind_param("ssssssi", $photo, $title, $description, $language, $role, $website, $id);

            // Set parameters
            $photo = $_FILES['new_photo']['name'];
        } else {
            // No new photo uploaded, keep the old photo
            $stmt = $conn->prepare("UPDATE projects SET title=?, description=?, language_used=?, role=?, website_link=? WHERE id=?");
            $stmt->bind_param("sssssi", $title, $description, $language, $role, $website, $id);
        }

        // Set other parameters
        $title = $_POST['title'];
        $description = $_POST['description'];
        $language = $_POST['language'];
        $role = $_POST['role'];
        $website = $_POST['website'];
        $id = $_POST['project_id']; // Assuming you have an input field for the project ID

        // File upload handling
        if (!empty($_FILES['new_photo']['name'])) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["new_photo"]["name"]);
            move_uploaded_file($_FILES["new_photo"]["tmp_name"], $target_file);
        }

        // Execute the update statement
        if ($stmt->execute()) {
            // Redirect to projects page after successful update
            header("Location: project.php");
        } else {
            echo "Error updating project: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    } else {
        echo "All fields are required.";
    }
}

// Close database connection
$conn->close();
?>
