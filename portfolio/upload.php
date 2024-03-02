<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];

    // Upload photo
    $photo = $_FILES['photo']['name'];
    $photo_tmp = $_FILES['photo']['tmp_name'];
    move_uploaded_file($photo_tmp, "img/" . $photo);

    // Upload project file
    $project_file = $_FILES['project_file']['name'];
    $project_file_tmp = $_FILES['project_file']['tmp_name'];
    move_uploaded_file($project_file_tmp, "projects/" . $project_file);

    // Insert into database
    $conn = mysqli_connect("localhost", "root", "", "myportfoliodb");
    $query = "INSERT INTO projects (title, description, photo, project_file, category) 
              VALUES ('$title', '$description', '$photo', '$project_file', '$category')";
    mysqli_query($conn, $query);
    mysqli_close($conn);

    // Redirect back to admin panel
    header("Location: admin.php");
    exit();
}
?>
