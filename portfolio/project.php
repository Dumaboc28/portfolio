<?php
session_start();
// Check if admin is logged in
if (!isset($_SESSION['admin_email'])) {
    header("Location: login.php"); // Redirect to admin login page
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
        #sidebar {
    height: 200vh; /* Adjust the height as needed */
    overflow-y: auto; /* Enable vertical scrolling if content exceeds the height */
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
   
<div class="card" style="margin-top: 30px;">
    <div class="card-body">
        <form action="process_project.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="photo">Photo:</label>
                <input type="file" class="form-control-file" id="photo" name="photo" accept="image/*" required>
            </div>
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="language">Language Used:</label>
                <input type="text" class="form-control" id="language" name="language" required>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <input type="text" class="form-control" id="role" name="role" required>
            </div>
            <div class="form-group">
                <label for="website">Website Link:</label>
                <input type="url" class="form-control" id="website" name="website" required>
            </div>
            <!-- Manual input field for the date -->
           

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>



    <?php
    // Include database connection
    $servername = "sql309.infinityfree.com";
    $username = "if0_36439499"; // Replace with your MySQL username
    $password = "AAmTQjzSa2YCGHQ"; // Replace with your MySQL password
    $dbname = "if0_36439499_dumabocdb"; // Replace with your database name
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    

    // Pagination
    $limit = 5; // Number of records per page
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start = ($page - 1) * $limit;

    // Fetch data from the projects table with pagination
    $sql = "SELECT * FROM projects LIMIT $start, $limit";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output table header
        echo "<table class='table table-bordered'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Photo</th>";
        echo "<th>Title</th>";
        echo "<th>Description</th>";
        echo "<th>Language Used</th>";
        echo "<th>Role</th>";
        echo "<th>Website Link</th>";
        echo "<th>Actions</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td><img src='" . $row["photo"] . "' alt='Project Photo' style='max-width: 100px;'></td>";
            echo "<td>" . $row["title"] . "</td>";
            echo "<td>" . $row["description"] . "</td>";
            echo "<td>" . $row["language_used"] . "</td>";
            echo "<td>" . $row["role"] . "</td>";
            echo "<td><a href='" . $row["website_link"] . "' class='btn btn-primary'>Visit Website</a></td>";
            echo "<td>";
            echo "<a href='edit_project.php?id=" . $row["id"] . "' class='btn btn-info'>Edit</a>";
            echo "<a href='delete_project.php?id=" . $row["id"] . "' class='btn btn-danger ml-2' onclick='return confirm(\"Are you sure you want to delete this project?\")'>Delete</a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        

        echo "</tbody>";
        echo "</table>";

        // Pagination links
        $sql = "SELECT COUNT(id) AS total FROM projects";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $total_pages = ceil($row["total"] / $limit);

        echo "<nav aria-label='Page navigation example'>";
        echo "<ul class='pagination justify-content-center'>";
        
        // Previous button
        if ($page > 1) {
            echo "<li class='page-item'><a class='page-link' href='?page=" . ($page - 1) . "'>&laquo; Previous</a></li>";
        } else {
            echo "<li class='page-item disabled'><span class='page-link'>&laquo; Previous</span></li>";
        }

        // Numbered pagination links
        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<li class='page-item'><a class='page-link' href='?page=" . $i . "'>" . $i . "</a></li>";
        }

        // Next button
        if ($page < $total_pages) {
            echo "<li class='page-item'><a class='page-link' href='?page=" . ($page + 1) . "'>Next &raquo;</a></li>";
        } else {
            echo "<li class='page-item disabled'><span class='page-link'>Next &raquo;</span></li>";
        }

        echo "</ul>";
        echo "</nav>";
    } else {
        echo "0 results";
    }

    // Close database connection
    $conn->close();
    ?>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
