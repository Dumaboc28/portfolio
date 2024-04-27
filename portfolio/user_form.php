<?php
session_start();
// Database connection
$servername = "sql309.infinityfree.com";
$username = "if0_36439499"; // Replace with your MySQL username
$password = "AAmTQjzSa2YCGHQ"; // Replace with your MySQL password
$dbname = "if0_36439499_dumabocdb"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Get form data
$fullname = $_POST['fullname'];
$skill1 = $_POST['skill1'];
$skill2 = $_POST['skill2'];
$skill3 = $_POST['skill3'];
$skill4 = $_POST['skill4'];
$introduction = $_POST['introduction'];

// Check if a new photo was uploaded
if ($_FILES["photo"]["size"] > 0) {
    echo "New photo uploaded."; // Debug statement
    // File upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . "."; // Debug statement
        $uploadOk = 1;
    } else {
        echo "File is not an image."; // Debug statement
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists."; // Debug statement
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["photo"]["size"] > 500000) {
        echo "Sorry, your file is too large."; // Debug statement
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed."; // Debug statement
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded."; // Debug statement
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["photo"]["name"])). " has been uploaded."; // Debug statement
        } else {
            echo "Sorry, there was an error uploading your file."; // Debug statement
        }
    }

    // Insert data into database with new photo
    $photo = $target_file;
} else {
    echo "No new photo uploaded."; // Debug statement
    // Keep the old photo
    $sql_photo = "SELECT photo FROM user_profiles WHERE fullname='$fullname'";
    $result_photo = $conn->query($sql_photo);
    if ($result_photo->num_rows > 0) {
        $row = $result_photo->fetch_assoc();
        $photo = $row["photo"];
    }
}

// Insert data into database
$sql = "INSERT INTO user_profiles (fullname, skill1, skill2, skill3, skill4, introduction, photo) 
        VALUES ('$fullname', '$skill1', '$skill2', '$skill3', '$skill4', '$introduction', '$photo')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
