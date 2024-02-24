<?php
// Database connection parameters
$servername = "localhost"; // MySQL server name (usually localhost)
$username = "root"; // MySQL username
$password = ""; // MySQL password (if any)
$database = "signup"; // MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch data
$sql = "SELECT * FROM packages";
$result = $conn->query($sql);

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . " - Name: " . $row["name"] . "<br>";
    }
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>