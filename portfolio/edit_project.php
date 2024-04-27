<?php
session_start();
// Check if admin is logged in
if (!isset($_SESSION['admin_email'])) {
    header("Location: login.php"); // Redirect to admin login page
    exit();
}

// Check if project ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: project.php"); // Redirect back to projects page if ID is not provided
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

// Fetch project data based on ID
$project_id = $_GET['id'];
$sql = "SELECT * FROM projects WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $project_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $project = $result->fetch_assoc();
} else {
    // If project with given ID doesn't exist, redirect to projects page
    header("Location: project.php");
    exit();
}

// Close database connection
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        img {
            max-width: 200px;
            height: auto;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="mb-4 pb-4">Edit Project</h2>
    <form action="update_project.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="project_id" value="<?php echo $project['id']; ?>">
        
        <!-- Image Preview -->
        <div class="form-group">
            <label for="photo">Current Photo:</label><br>
            <img src="<?php echo $project['photo']; ?>" alt="Project Photo">
        </div>

        <!-- Upload New Image -->
        <div class="form-group">
            <label for="new_photo">Upload New Photo:</label>
            <input type="file" id="new_photo" name="new_photo" class="form-control-file" accept="image/*">
        </div>
        
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" class="form-control" value="<?php echo $project['title']; ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="3" class="form-control" required><?php echo $project['description']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="language">Language Used:</label>
            <input type="text" id="language" name="language" class="form-control" value="<?php echo $project['language_used']; ?>" required>
        </div>
        <div class="form-group">
            <label for="role">Role:</label>
            <input type="text" id="role" name="role" class="form-control" value="<?php echo $project['role']; ?>" required>
        </div>
        <div class="form-group">
            <label for="website">Website Link:</label>
            <input type="url" id="website" name="website" class="form-control" value="<?php echo $project['website_link']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="project.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

</body>
</html>
