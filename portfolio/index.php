<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <style>
        /* Custom styles can be added here */
        .profile-img {
            max-width: 250px;
            margin-top: 20px;
         
        }
        .navbar-custom {
            background-color: transparent;
            border-bottom: 1px solid #ced4da; /* Add a border at the bottom */
        }
        .navbar-custom .navbar-brand,
        .navbar-custom .navbar-nav .nav-link {
            color: #000000; /* Text color */
            font-weight: bold; /* Bold font weight */
            text-transform: uppercase; /* Uppercase text */
            padding: 0.5rem 1rem; /* Adjust padding */
        }
        .navbar-custom .navbar-brand:hover,
        .navbar-custom .navbar-nav .nav-link:hover {
            color: #6c757d; /* Hover text color */
        }
        body {
            margin: 0;
            padding: 0;
        }
        main {
            background-color: #343a40; /* Set the background color here */
            padding-top: 20px;
            padding-bottom: 30px;
        }
      
    /* Custom styles for the carousel controls */

    .card-img-top {
        width: 100%; /* Set the width to 100% */
        height: 200px; /* Set the height to your desired value */
        object-fit: cover; /* Ensure the image covers the entire area */
    }
</style>
    
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#">Portfolio</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Portfolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main>


    
    <?php
$servername = "sql309.infinityfree.com";
$username = "if0_36439499"; // Replace with your MySQL username
$password = "AAmTQjzSa2YCGHQ"; // Replace with your MySQL password
$dbname = "if0_36439499_dumabocdb"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Fetching data from the database
$sql = "SELECT * FROM user_profiles";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
<section id="home">
    <div class="container bg-dark text-light p-4" style="width: 100%; height: 620px;">
        
        <div class="row">
            <div class="col-md-12 text-center mb-4">
                <img src="<?php echo $row['photo']; ?>" alt="User Photo" class="profile-img img-fluid" style="border: 3px solid white; border-radius: 50%;">
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 mx-auto text-center">
                <h1 class="mb-4"><?php echo $row['fullname']; ?></h1>
               
                <div class="mb-4">
                    <span class="badge badge-primary skill-badge"><?php echo $row['skill1']; ?></span>
                    <span class="badge badge-primary skill-badge"><?php echo $row['skill2']; ?></span>
                    <span class="badge badge-primary skill-badge"><?php echo $row['skill3']; ?></span>
                    <span class="badge badge-primary skill-badge"><?php echo $row['skill4']; ?></span>
                </div>
                
                <p><?php echo $row['introduction']; ?></p>
            </div>
        </div>
    </div>
</section>
<?php
  }
} else {
  echo "0 results";
}
$conn->close();
?>



<?php
// Assuming you have a database connection established already
$servername = "sql309.infinityfree.com";
$username = "if0_36439499"; // Replace with your MySQL username
$password = "AAmTQjzSa2YCGHQ"; // Replace with your MySQL password
$dbname = "if0_36439499_dumabocdb"; // Replace with your database name
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Fetching data from the database
$sql = "SELECT * FROM about_me";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of the first row (assuming only one row exists)
  $row = $result->fetch_assoc();
?>
<section id="about-us">
    <div class="container" style="width: 100%; height: 400px;">
        <div class="row">
            <div class="container bg-dark text-light p-4">
                <div class="col-md-10 mx-auto text-center">
                    <h2 class="mb-4" style="font-family: 'Roboto', sans-serif;">About Me</h2>
                    <p class="lead">
                        <?php echo $row['about']; ?>
                    </p>
                    <!-- Contact Information -->
                    <div class="contact-info mt-5" style="font-size: 1.5rem;">
                        <ul class="list-unstyled" style="text-align: center;">
                            <li><strong>Email:</strong> <a href="mailto:<?php echo $row['email']; ?>"><?php echo $row['email']; ?></a></li>
                            <li><strong>Age:</strong> <?php echo $row['age']; ?></li>
                            <li><strong>Gender:</strong> <?php echo ucfirst($row['gender']); ?></li>
                            <li><strong>Social Media Links:</strong>
                                <?php if ($row['facebook']) { ?>
                                    <a href="<?php echo $row['facebook']; ?>" class="mr-2">Facebook</a>
                                <?php } ?>
                                <?php if ($row['twitter']) { ?>
                                    <a href="<?php echo $row['twitter']; ?>" class="mr-2">Twitter</a>
                                <?php } ?>
                                <?php if ($row['linkedin']) { ?>
                                    <a href="<?php echo $row['linkedin']; ?>" class="mr-2">LinkedIn</a>
                                <?php } ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
} else {
  echo "0 results";
}
$conn->close();
?>





<?php
// Assuming you have a database connection established already
$servername = "sql309.infinityfree.com";
$username = "if0_36439499"; // Replace with your MySQL username
$password = "AAmTQjzSa2YCGHQ"; // Replace with your MySQL password
$dbname = "if0_36439499_dumabocdb"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Pagination settings
$projectsPerPage = 3;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $projectsPerPage;

// Fetching data from the database
$sql = "SELECT * FROM projects LIMIT $offset, $projectsPerPage";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
?>
<section id="projects" style="padding-top: 150px;">
    <div class="container py-5">
        <div class="container bg-dark text-light p-4">
            <div class="col-md-10 mx-auto text-center">
                <h2 class="mb-4" style="font-family: 'Roboto', sans-serif;">My Projects</h2>
            </div>
        </div>
        <div class="carousel-inner">
            <div class="row">
                <?php
                  while($row = $result->fetch_assoc()) {
                ?>
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <img src="<?php echo $row['photo']; ?>" class="card-img-top" alt="<?php echo $row['title']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['title']; ?></h5>
                            <p class="card-text"><?php echo $row['description']; ?></p>
                           
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#projectModal<?php echo $row['id']; ?>">Learn More</button>
                        </div>
                    </div>
                </div>
                <?php
                  }
                ?>
            </div>
        </div>
        <!-- Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center mt-4">
                <?php
                  // Previous button
                  if ($page > 1) {
                      echo '<li class="page-item"><a class="page-link" href="?page='.($page - 1).'">Previous</a></li>';
                  }

                  // Next button
                  if ($result->num_rows == $projectsPerPage) {
                      echo '<li class="page-item"><a class="page-link" href="?page='.($page + 1).'">Next</a></li>';
                  }
                ?>
            </ul>
        </nav>
    </div>
</section>

<!-- Project Modals -->
<?php
  $result = $conn->query("SELECT * FROM projects");
  while($row = $result->fetch_assoc()) {
?>
<div class="modal fade" id="projectModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="projectModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="projectModalLabel<?php echo $row['id']; ?>"><?php echo $row['title']; ?> Details</h5>
                <!-- Remove the data-dismiss attribute from the button below -->
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
                <!--    <span aria-hidden="true">&times;</span> -->
                <!-- </button> -->
            </div>
            <div class="modal-body">
                <img src="<?php echo $row['photo']; ?>" class="img-fluid mb-3" alt="<?php echo $row['title']; ?>">
                <p>Title: <?php echo $row['title']; ?></p>
                <p>Description: <?php echo $row['description']; ?></p>
                
                <p>Language Used: <?php echo $row['language_used']; ?></p>
                <p>Role: <?php echo $row['role']; ?></p>
                <p>Website Link: <a href="<?php echo $row['website_link']; ?>"><?php echo $row['website_link']; ?></a></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php
  }
?>
<?php
} else {
  echo "0 results";
}
$conn->close();
?>



<!-- Add modals for Project 2, Project 3, and any additional projects -->



<section id="contact" style="padding-top: 90px;">
    <div class="container py-5 bg-light" style="border-radius: 10px;">
        <h2 class="text-center mb-5">Contact Us</h2>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <form action="contact_process.php" method="post">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" placeholder="Enter your message"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</section>


</main>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
