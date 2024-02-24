<?php
include("connect.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the data from the POST request

    $name = $_POST['name'];
    $cost = $_POST['cost'];
    $description = $_POST['description'];
    $image = $_FILES['image'];

    // Process the data as needed
    // For example, you can save the image to a directory
    $targetDir = 'images/';
    $targetFile = $targetDir . basename($image['name']);
    move_uploaded_file($image['tmp_name'], $targetFile);

    $stmt = $pdo->prepare("INSERT INTO packages (name, cost, description, image) VALUES (?, ?, ?, ?)");
    $result = $stmt->execute([$name, $cost, $description, $targetFile]);

    if($result){
        $new_location = "admininsert.php";
        header("Cache-Control: no-cache, must-revalidate"); // HTTP 1.1
        header("Pragma: no-cache"); // HTTP 1.0
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
        header("Location: " .$new_location);
        exit();
    } else{
        echo "Something went wrong";
    }
}