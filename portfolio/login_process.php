<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the MySQL connection code here
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydb";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind the SELECT statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=? AND password=?");
    $stmt->bind_param("ss", $email, $password);

    // Set parameters and execute
    $email = $_POST["email"];
    $password = $_POST["password"];
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Set session variables
        $row = $result->fetch_assoc();
        $_SESSION["username"] = $row["username"];
        $_SESSION["email"] = $row["email"];
        // Redirect to a dashboard or home page
        header("Location: dashboard.php");
        exit();
    } else {
        // Invalid credentials
        echo "<div class='container mt-3'><div class='alert alert-danger' role='alert'>Invalid email or password!</div></div>";
    }

    $stmt->close();
    $conn->close();
}
?>