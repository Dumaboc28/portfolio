<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect to login page or handle authentication
    header("Location: login.php"); // Change this to your login page URL
    exit();
}

// Establish database connection
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

// Retrieve user information from the database based on the logged-in user's email
$email = $_SESSION['email'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if user exists
if (!$user) {
    die("User not found.");
}

// Display user information
$name = $user['name'];
$age = $user['age'];
$gender = $user['gender'];
$email = $user['email'];
$photo = $user['photo'];

// You can use this information to populate your HTML form for editing

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .sidebar {
      background-color: #f8f9fa;
      border-right: 1px solid #dee2e6;
      min-height: 100vh;
    }

    .sidebar-heading {
      padding: 0.875rem 1.25rem;
      font-size: 1.2rem;
      font-weight: 600;
      color: #333;
    }

    .list-group-item {
      border: none;
      border-radius: 0;
      color: #555;
    }

    .list-group-item.active {
      background-color: #007bff;
      color: #fff;
      border-color: #007bff;
    }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <nav class="col-md-2 d-none d-md-block sidebar">
      <div class="sidebar-sticky">
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          Menu
        </h6>
        <ul class="list-group">
          <li class="list-group-item"><a href="dashboard.php" class="nav-link active">Dashboard</a></li>
          <li class="list-group-item"><a href="profile_settings.php" class="nav-link">Profile Settings</a></li>
          <li class="list-group-item"><a href="content_settings.php" class="nav-link">Content Settings</a></li>
          <li class="list-group-item"><a href="logout.php" class="nav-link">Logout</a></li>
        </ul>
      </div>
    </nav>

    <!-- Page Content -->
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
      </div>

      <div class="container">
  <form action="update_profile.php" method="post">
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" name="name" id="name" value="<?php echo htmlspecialchars($name); ?>">
    </div>
    
    <div class="form-group">
      <label for="age">Age:</label>
      <input type="number" class="form-control" name="age" id="age" value="<?php echo htmlspecialchars($age); ?>">
    </div>
    
    <div class="form-group">
      <label for="gender">Gender:</label>
      <select class="form-control" name="gender" id="gender">
          <option value="male" <?php if ($gender == 'male') echo 'selected'; ?>>Male</option>
          <option value="female" <?php if ($gender == 'female') echo 'selected'; ?>>Female</option>
      </select>
    </div>
    
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" readonly>
    </div>
    
    <div class="form-group">
      <label for="photo">Photo:</label>
      <input type="file" class="form-control-file" name="photo" id="photo">
    </div>
    
    <!-- Add more fields as needed -->
    
    <button type="submit" class="btn btn-primary">Update</button>
  </form>
</div>

    </main>
  </div>
</div>

</body>
</html>
