<?php
// Database connection parameters
$servername = "localhost"; // Change this to your database server name
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$database = "signup"; // Change this to your database name

// Create connection
$connection = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission
if(isset($_POST['send'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $destination = $_POST['destination'];
    $guests = $_POST['guests'];
    $arrival = $_POST['arrival'];
    $leaving = $_POST['leaving'];
    
    // SQL query to insert data into the database
    $query = "INSERT INTO re (name, email, contact, destination, guests, arrival, leaving) VALUES ('$name','$email','$contact','$destination','$guests','$arrival','$leaving')";
    
    // Execute the query
    $result = mysqli_query($connection, $query);
    
    if($result){
        echo "Inserted successfully!";
        // Redirect to home.html after successful insertion
        header('location: home.html');
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}

// Close connection
mysqli_close($connection);
?>