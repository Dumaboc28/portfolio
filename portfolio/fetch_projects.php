<?php
$conn = mysqli_connect("localhost", "root", "", "myportfoliodb");
$query = "SELECT * FROM projects";
$result = mysqli_query($conn, $query);

$projects = array();
while ($row = mysqli_fetch_assoc($result)) {
    $projects[] = array(
        'id' => $row['id'],
        'title' => $row['title'],
        'description' => $row['description'],
        'photo' => $row['photo'],
        'category' => $row['category']
    );
}

mysqli_close($conn);

header('Content-Type: application/json');
echo json_encode($projects);
?>
