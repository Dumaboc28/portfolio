<?php
// Start session
session_start();
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
          <li class="list-group-item"><a href="#" class="nav-link active">Dashboard</a></li>
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
        <h3>Welcome!!
        <p>This is the dashboard content area. You can manage your profile settings, content settings, and logout using the sidebar.</p>
      </div>
    </main>
  </div>
</div>

</body>
</html>
