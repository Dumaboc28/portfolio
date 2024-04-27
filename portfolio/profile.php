<?php
session_start();
// Check if admin is logged in
if (!isset($_SESSION['admin_email'])) {
    header("Location: login.php"); // Redirect to admin login page
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

// Define a variable to store potential error messages
$error_message = '';

// Handle form submission for updating data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_profile'])) {
    $user_id = $_POST['user_id'];
    $fullname = $_POST['fullname'];
    $skill1 = $_POST['skill1'];
    $skill2 = $_POST['skill2'];
    $skill3 = $_POST['skill3'];
    $skill4 = $_POST['skill4'];
    $introduction = $_POST['introduction'];

    // Check if a new photo is uploaded
    if ($_FILES['photo']['name'] !== '') {
        // Handle photo upload
        $photo = $_FILES['photo']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($photo);
        // Move uploaded file to specified location
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            // Update profile data with new photo
            $sql = "UPDATE user_profiles SET fullname='$fullname', skill1='$skill1', skill2='$skill2', skill3='$skill3', skill4='$skill4', introduction='$introduction', photo='$target_file' WHERE id=$user_id";
            if ($conn->query($sql) === TRUE) {
                echo "<script>";
                echo "alert('Record updated successfully');";
                echo "</script>";
            } else {
                $error_message = "Error updating record: " . $conn->error;
            }
        } else {
            $error_message = "Error uploading file";
        }
    } else {
        // Update profile data without changing the photo
        $sql = "UPDATE user_profiles SET fullname='$fullname', skill1='$skill1', skill2='$skill2', skill3='$skill3', skill4='$skill4', introduction='$introduction' WHERE id=$user_id";
        if ($conn->query($sql) === TRUE) {
            echo "<script>";
echo "alert('Record updated successfully');";
echo "</script>";
        } else {
            $error_message = "Error updating record: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
 
    <style>
        body {
            padding-top: 50px;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 960px;
        }
        .card {
            margin-bottom: 20px;
        }
        #sidebar.hovered {
            background-color: #343a40;
        }
        #sidebar .nav-link i {
            font-size: 24px; /* Adjust the size as needed */
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="#">Admin Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Welcome, <?php echo $_SESSION['admin_email']; ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
    <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active text-white" href="dashboard.php">
                    <i class="fas fa-tachometer-alt fa-fw mr-2"></i>Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="profile.php">
                    <i class="fas fa-user fa-fw mr-2"></i>Profile
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="aboutme.php">
                    <i class="fas fa-user fa-fw mr-2"></i>About Me Settings
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="project.php">
                    <i class="fas fa-cogs fa-fw mr-2"></i>Projects Settings
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="contact.php">
                    <i class="fas fa-envelope fa-fw mr-2"></i>Contact Me Settings
                </a>
            </li>
            <!-- Add more sidebar items as needed -->
        </ul>
    </div>
</nav>

<div class="container">
    <div class="row">
   
        <div class="col-md-12" style="margin-top: 30px;">
            <?php
            // Fetch data from the database
            $sql = "SELECT * FROM user_profiles";
            $result = $conn->query($sql);

            // Initialize variables for form fields
            $user_id = "";
            $fullname = "";
            $skill1 = "";
            $skill2 = "";
            $skill3 = "";
            $skill4 = "";
            $introduction = "";
            $photo = "";

            // If data exists, populate form fields for editing
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $user_id = $row["id"];
                $fullname = $row["fullname"];
                $skill1 = $row["skill1"];
                $skill2 = $row["skill2"];
                $skill3 = $row["skill3"];
                $skill4 = $row["skill4"];
                $introduction = $row["introduction"];
                $photo = $row["photo"];
            }

            // Display editable fields
            echo "<div class='card'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>Profile Information</h5>";
            echo "<form action='' method='post' enctype='multipart/form-data'>";
            echo "<input type='hidden' name='user_id' value='$user_id'>";
            echo "<label for='photo'>Photo:</label><br>";
            echo "<img src='$photo' alt='User Photo' style='width: 150px; height: 150px;'><br>";
            echo "<input type='file' id='photo' name='photo' accept='image/*'><br><br>";
            
            echo "<label for='fullname'>Full Name:</label>";
            echo "<input type='text' id='fullname' name='fullname' value='$fullname' required class='form-control'><br><br>";
            
            echo "<label for='skill1'>Skill 1:</label>";
            echo "<input type='text' id='skill1' name='skill1' value='$skill1' required class='form-control'><br><br>";
            
            echo "<label for='skill2'>Skill 2:</label>";
            echo "<input type='text' id='skill2' name='skill2' value='$skill2' required class='form-control'><br><br>";
            
            echo "<label for='skill3'>Skill 3:</label>";
            echo "<input type='text' id='skill3' name='skill3' value='$skill3' required class='form-control'><br><br>";
            
            echo "<label for='skill4'>Skill 4:</label>";
            echo "<input type='text' id='skill4' name='skill4' value='$skill4' required class='form-control'><br><br>";
            
            echo "<label for='introduction'>Introduction:</label><br>";
            echo "<textarea id='introduction' name='introduction' rows='4' cols='50' required class='form-control'>$introduction</textarea><br><br>";
            
            echo "<button type='submit' name='update_profile' class='btn btn-primary'>Update</button>";
            echo "</form>";
            echo "</div>";
            echo "</div>";

            // Display potential error message
            if (!empty($error_message)) {
                echo "<div class='alert alert-danger' role='alert'>$error_message</div>";
            }
            ?>
        </div>
  
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
