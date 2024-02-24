<?php
        include("connect.php");
       
        if (isset($_GET['id'])) 
            $id = $_GET['id'];
        
        $stmt = $pdo->prepare("SELECT * FROM packages");
        $stmt->execute();


       

        $packages = $stmt->fetchAll(PDO::FETCH_ASSOC);
       
         ?>
  


<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="package.css"> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OUR PACKAGES</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .package-details {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .package-details img {
            max-width: 100%;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .package-details p {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>OUR PACKAGES</h1>
    <div class="package-details">
    <?php
        include("connect.php");
        $stmt = $pdo->prepare("SELECT * FROM packages");
        $stmt->execute();
        $packages = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <?php foreach ($packages as $package): ?>
        <img src="images/<?php echo $package['image']; ?>" alt="<?php echo $package['name']; ?>">
        <p><strong>Name:</strong> <?php echo $package['name']; ?></p>
        <p><strong>Cost:</strong> Rs <?php echo $package['cost']; ?></p>
        <p><strong>Description:</strong> <?php echo $package['description']; ?></p>
        
    <?php endforeach; ?>
   
        <!-- Example: <img src="images/<?php echo $_GET['image']; ?>" alt=""> -->
    </div>
    <!--div class="content"-->
        
        <!-- Use PHP to echo the package name, cost, and description -->
        <!--h3><?php echo $_GET['name']; ?></h3>
        <h4>Cost: Rs <?php echo $_GET['cost']; ?></h4>
        <p>Description: <?php echo $_GET['description']; ?></p-->
        <!-- The "Book now" button can remain the same -->  <a href="book2.php" class="btn">Book now</a>
        <!--a href="book.html" class="btn">Book now</a>
    </div-->
</div>



    </div>
</form>
</body>
</html>