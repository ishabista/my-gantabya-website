
<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Travel Booking Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    form {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 400px;
    }

    label {
      display: block;
      margin-bottom: 8px;
    }

    input,
    select {
      width: 100%;
      padding: 8px;
      margin-bottom: 16px;
      box-sizing: border-box;
    }

    button {
      background-color: #4caf50;
      color: #fff;
      padding: 10px 15px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <form method="post">
 
  <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    <label for="email">Email:</label>
    <input type="text" id="email" name="email" required>



    <label for="contact">Contact:</label>
    <input type="text" id="contact" name="contact" required>
    <label for="destination">Destination:</label>
    <input type="text" id="destination" name="destination" required>



    <label for="guests">Number of People:</label>
    <input type="text" id="guests" name="guests" required>
    <label for="arrival">Arrival:</label>
    <input type="date" id="arrival" name="arrival" required>
    <label for="leaving">Leaving:</label>
    <input type="date" id="leaving" name="leaving" required>
  
  
     
    
    <button type="submit" name="send">Book Now</button>
  </form>
</body>
</html>







<?php
if (isset($_POST['send'])) {
   
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $destination = $_POST['destination'];
    $guests = $_POST['guests'];
    $arrival = $_POST['arrival'];
    $leaving = $_POST['leaving'];

    
    $pdo = new PDO('mysql:host=localhost;dbname=signup', 'root', '');

   
    $stmt = $pdo->prepare("INSERT INTO re (name, email, contact, destination, guests, arrival, leaving) VALUES (?, ?, ?, ?, ?, ?, ?)");

    
    $stmt->execute([$name, $email, $contact, $destination, $guests, $arrival, $leaving]);

    
    header("Location: payment.html");
    exit();
}
?>
