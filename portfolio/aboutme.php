<?php
session_start();
// Check if admin is logged in
if (!isset($_SESSION['admin_email'])) {
    header("Location: login.php"); // Redirect to admin login page
    exit(); // Stop further execution
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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_about'])) {
    $user_id = $_POST['user_id']; // Assuming user_id is always 1 for About Me section (You might want to change this)
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $age = filter_input(INPUT_POST, 'age', FILTER_SANITIZE_NUMBER_INT);
    $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);
    $facebook = filter_input(INPUT_POST, 'facebook', FILTER_SANITIZE_URL);
    $linkedin = filter_input(INPUT_POST, 'linkedin', FILTER_SANITIZE_URL);
    $twitter = filter_input(INPUT_POST, 'twitter', FILTER_SANITIZE_URL);
    $about = filter_input(INPUT_POST, 'about', FILTER_SANITIZE_STRING);

    // Validate input
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email address.";
    } elseif (empty($age) || !filter_var($age, FILTER_VALIDATE_INT)) {
        $error_message = "Invalid age.";
    } elseif (empty($gender)) {
        $error_message = "Gender is required.";
    } else {
        // Update data in the database using prepared statement
        $sql = "UPDATE about_me SET email=?, age=?, gender=?, facebook=?, linkedin=?, twitter=?, about=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sisssssi", $email, $age, $gender, $facebook, $linkedin, $twitter, $about, $user_id);
        if ($stmt->execute()) {
            echo "<script>";
                echo "alert('Record updated successfully');";
                echo "</script>";
        } else {
            $error_message = "Error updating record: " . $stmt->error;
        }
        $stmt->close();
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
            $sql = "SELECT * FROM about_me";
            $result = $conn->query($sql);

            // Initialize variables for form fields
            $user_id = "";
            $email = "";
            $age = "";
            $gender = "";
            $facebook = "";
            $linkedin = "";
            $twitter = "";
            $about = "";

            // If data exists, populate form fields for editing
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $user_id = $row["id"];
                $email = $row["email"];
                $age = $row["age"];
                $gender = $row["gender"];
                $facebook = $row["facebook"];
                $linkedin = $row["linkedin"];
                $twitter = $row["twitter"];
                $about = $row["about"];
            }

            // Display editable fields
            echo "<div class='card'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>About Me Information</h5>";
            echo "<form action  ='' method='post'>";
            echo "<input type='hidden' name='user_id' value='$user_id'>";
            
            echo "<label for='email'>Email:</label>";
            echo "<input type='email' id='email' name='email' class='form-control' value='$email' required><br>";
            
            echo "<label for='age'>Age:</label>";
            echo "<input type='number' id='age' name='age' class='form-control' value='$age' required><br>";
            
            echo "<label for='gender'>Gender:</label>";
            echo "<select id='gender' name='gender' class='form-control'>";
            echo "<option value='male' " . ($gender == 'male' ? 'selected' : '') . ">Male</option>";
            echo "<option value='female' " . ($gender == 'female' ? 'selected' : '') . ">Female</option>";
            echo "<option value='other' " . ($gender == 'other' ? 'selected' : '') . ">Other</option>";
            echo "</select><br>";
            
            echo "<label for='facebook'>Facebook:</label>";
            echo "<input type='text' id='facebook' name='facebook' class='form-control' value='$facebook'><br>";
            
            echo "<label for='linkedin'>LinkedIn:</label>";
            echo "<input type='text' id='linkedin' name='linkedin' class='form-control' value='$linkedin'><br>";
            
            echo "<label for='twitter'>Twitter:</label>";
            echo "<input type='text' id='twitter' name='twitter' class='form-control' value='$twitter'><br>";
            
            echo "<label for='about'>About Me:</label><br>";
            echo "<textarea id='about' name='about' rows='4' cols='50' class='form-control'>$about</textarea><br>";
            
            echo "<button type='submit' name='update_about' class='btn btn-primary'>Update</button>";
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
