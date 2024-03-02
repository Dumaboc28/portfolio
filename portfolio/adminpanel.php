<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Panel</title>
<link rel="stylesheet" href="admin-style.css">
<style>
/* CSS for the sidebar */
.sidebar {
    height: 100%;
    width: 250px;
    position: fixed;
    top: 0;
    left: 0;
    background-color: #333;
    padding-top: 20px;
}

.sidebar h2 {
    color: white;
    text-align: center;
}

.sidebar ul {
    list-style-type: none;
    padding: 0;
}

.sidebar ul li {
    padding: 10px 20px;
}

.sidebar ul li a {
    text-decoration: none;
    color: white;
    display: block;
    padding: 8px 16px;
}

.sidebar ul li a:hover {
    background-color: #555;
}

/* CSS for the admin container */
.admin-container {
    margin-left: 250px; /* Same as the width of the sidebar */
    padding: 20px;
}

.admin-container h1 {
    margin-bottom: 20px;
}

</style>
</head>
<body>

<div class="sidebar">
    <h2>Admin Panel</h2>
    <ul>
        <li><a href="#" onclick="showAdminSettings()">Admin Settings
    </a></li>
        <li><a href="admin.php" onclick="showManageProjects()">Manage Projects</a></li>
    </ul>
</div>

<div class="admin-container">
    <div id="admin-settings">
        <h1>Admin Settings</h1>
        <!-- Admin settings CRUD form goes here -->
    </div>

    <div id="manage-projects" style="display: none;">
        <h1>Manage Projects</h1>
        <!-- Project CRUD functionality goes here -->
    </div>
</div>

<script>
function showAdminSettings() {
    document.getElementById("admin-settings").style.display = "block";
    document.getElementById("manage-projects").style.display = "none";
}

function showManageProjects() {
    document.getElementById("admin-settings").style.display = "none";
    document.getElementById("manage-projects").style.display = "block";
}
</script>

</body>
</html>
