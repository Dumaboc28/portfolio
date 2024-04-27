<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_email'])) {
    header("Location: login.php"); // Redirect to admin login page
    exit(); // Stop further execution
}

// Include database connection
$servername = "sql309.infinityfree.com";
$username = "if0_36439499"; // Replace with your MySQL username
$password = "AAmTQjzSa2YCGHQ"; // Replace with your MySQL password
$dbname = "if0_36439499_dumabocdb"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define variables and initialize with empty values
    $photo = $title = $description = $language = $role = $website = "";

    // Process photo upload
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $photo_tmp = $_FILES["photo"]["tmp_name"];
        $photo_name = $_FILES["photo"]["name"];
        $upload_directory = "uploads/"; // Directory where the photo will be uploaded
        $photo = $upload_directory . basename($photo_name);
        move_uploaded_file($photo_tmp, $photo);
    }

    // Get form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $language = $_POST['language'];
    $role = $_POST['role'];
    $website = $_POST['website'];

    // Prepare SQL insert statement
    $sql = "INSERT INTO projects (photo, title, description, language_used, role, website_link) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters to the statement
        $stmt->bind_param("ssssss", $photo, $title, $description, $language, $role, $website);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Redirect to dashboard with success message
            header("Location: project.php?success=1");
            exit();
        } else {
            // Redirect to dashboard with error message
            header("Location: project.php?error=1");
            exit();
        }
    } else {
        // Redirect to dashboard with error message
        header("Location: project.php?error=1");
        exit();
    }

    // Close statement
    $stmt->close();
}

// Close database connection
$conn->close();
?>
