<?php
// Function to retrieve booking requests from the database
function getBookingRequests() {
    include('connect.php');

    $stmt = $pdo->prepare("SELECT * FROM re");
    $stmt->execute();
    $requests = $stmt->fetchAll();

    return $requests;
}

// Function to update the status of a booking request
function updateRequestStatus($id, $status) {
    include('connect.php');

    $stmt = $pdo->prepare("UPDATE re SET status=? WHERE id=?");
    $stmt->execute([$status, $id]);
}

if(isset($_POST['approve'])) {
    $id = $_POST['id'];
    updateRequestStatus($id, 'approved');
}

if(isset($_POST['reject'])) {
    $id = $_POST['id'];
    updateRequestStatus($id, 'rejected');
}

$bookingRequests = getBookingRequests();

// Function to retrieve package requests from the database
function getpackagerequests() {
    include("connect.php");

    $stmt = $pdo->prepare("SELECT * FROM packages");
    $stmt->execute();
    $requests = $stmt->fetchAll();
    
    return $requests;
}

// Function to update an existing package
function updatePackage($id, $name, $cost, $description, $image) {
    include("connect.php");

    $stmt = $pdo->prepare("UPDATE packages SET name=?, cost=?, description=?, image=? WHERE id=?");
    $stmt->execute([$name, $cost, $description, $image, $id]);
}

// Function to delete a package
function deletePackage($id) {
    include("connect.php");

    $stmt = $pdo->prepare("DELETE FROM packages WHERE id=?");
    $stmt->execute([$id]);
}

// Check if form is submitted for adding/updating package
if(isset($_POST['send'])) {
    // Extract form data
    $name = $_POST['name'];
    $cost = $_POST['cost'];
    $description = $_POST['description'];
    // Handle image upload if needed
    if(isset($_FILES['image'])) {
        $image = $_FILES['image']['name'];
        // Move uploaded image to the desired location
        $target = "images/".basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    } else {
        // If image is not uploaded, set $image to null or an empty string
        $image = ""; // or $image = null;
    }

    include("connect.php");

    $stmt = $pdo->prepare("INSERT INTO packages (name, cost, description, image) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $cost, $description, $image]);
}

// Check if delete button is clicked
if(isset($_POST['del'])) {
    $id = $_POST['package_id'];
    deletePackage($id);
}

// Check if form is submitted for updating package
if(isset($_POST['update'])) {
    // Extract form data
    $id = $_POST['package_id'];
    $name = $_POST['name'];
    $cost = $_POST['cost'];
    $description = $_POST['description'];
    $image = $_POST['existing_image']; // Add this line to retain existing image path

    // Perform package update
    updatePackage($id, $name, $cost, $description, $image);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
       body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: left;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f2f2f2;
        }

        form {
            display: inline;
        }
    </style>
</head>
<body>
    <h1>Booking Requests</h1>
    <!-- Booking requests table -->
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Destination</th>
            <th>Guests</th>
            <th>Arrival</th>
            <th>Leaving</th>
            <th>Action</th>
        </tr>
        <?php foreach ($bookingRequests as $request): ?>
        <tr>
            <td><?= $request['name'] ?></td>
            <td><?= $request['email'] ?></td>
            <td><?= $request['contact'] ?></td>
            <td><?= $request['destination'] ?></td>
            <td><?= $request['guests'] ?></td>
            <td><?= $request['arrival'] ?></td>
            <td><?= $request['leaving'] ?></td>
            <td>
                <form method="post">
                    <input type="hidden" name="id" value="<?= $request['id'] ?>">
                    <button type="submit" name="approve">Approve</button>
                    <button type="submit" name="reject">Reject</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    
    <h1>Admin Panel - Manage Packages</h1>

    <!-- Form for adding/updating packages -->
    <form method="post" enctype="multipart/form-data" action="">
        <input type="text" name="name" placeholder="Package Name" required>
        <input type="text" name="cost" placeholder="Package Cost" required>
        <input type="text" name="description" placeholder="Package description" required>
        <input type="file" name="image" required>
        <button type="submit" name="send">Submit</button>
    </form>

    <!-- Table to display existing packages -->
    <table>
        <tr>
            <th>Package Name</th>
            <th>Package Cost</th>
            <th>Package Description</th>
            <th>Package Image</th>
            <th>Action</th>
        </tr>
        <?php
        $packages = getpackagerequests();
        foreach ($packages as $pack): ?>
        <tr>
            <td><?= $pack['name'] ?></td>
            <td><?= $pack['cost'] ?></td>
            <td><?= $pack['description'] ?></td>
            <td><img src="<?= $pack['image'] ?>" alt="Package Image" style="max-width: 100px;"></td>
            <td>
                <!-- Form for deleting a package -->
                <form method="post">
                    <input type="hidden" name="package_id" value="<?= $pack['id'] ?>">
                    <button type="submit" name="del">Delete</button>
                </form>
                <!-- Form for updating a package -->
                <form method="post">
                    <input type="hidden" name="package_id" value="<?= $pack['id'] ?>">
                    <input type="hidden" name="existing_image" value="<?= $pack['image'] ?>">
                    <input type="text" name="name" value="<?= $pack['name'] ?>">
                    <input type="text" name="cost" value="<?= $pack['cost'] ?>">
                    <input type="text" name="description" value="<?= $pack['description'] ?>">
                    <button type="submit" name="update">Update</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

