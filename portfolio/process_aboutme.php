<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $facebook = isset($_POST['facebook']) ? $_POST['facebook'] : ''; // Check if Facebook field is set
    $linkedin = isset($_POST['linkedin']) ? $_POST['linkedin'] : ''; // Check if LinkedIn field is set
    $twitter = isset($_POST['twitter']) ? $_POST['twitter'] : ''; // Check if Twitter field is set
    $about = $_POST['about'];

    // Sanitize input
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $age = filter_var($age, FILTER_SANITIZE_NUMBER_INT);
    $gender = filter_var($gender, FILTER_SANITIZE_STRING);
    $facebook = filter_var($facebook, FILTER_SANITIZE_URL);
    $linkedin = filter_var($linkedin, FILTER_SANITIZE_URL);
    $twitter = filter_var($twitter, FILTER_SANITIZE_URL);
    $about = filter_var($about, FILTER_SANITIZE_STRING);

    // Validate input
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }
    if (!filter_var($age, FILTER_VALIDATE_INT)) {
        die("Invalid age format");
    }
    if (!in_array($gender, array('male', 'female', 'other'))) {
        die("Invalid gender");
    }
    // You may add further validation for Facebook, LinkedIn, Twitter, and about fields as needed

    // Process data (e.g., store in database)
    // Example: Insert data into a database
    $servername = "sql309.infinityfree.com";
    $username = "if0_36439499"; // Replace with your MySQL username
    $password = "AAmTQjzSa2YCGHQ"; // Replace with your MySQL password
    $dbname = "if0_36439499_dumabocdb"; // Replace with your database name
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    

    $sql = "INSERT INTO about_me (email, age, gender, facebook, linkedin, twitter, about)
            VALUES ('$email', '$age', '$gender', '$facebook', '$linkedin', '$twitter', '$about')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('New record created successfully'); window.location.href = 'aboutme.php';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

    $conn->close();
}
?>
