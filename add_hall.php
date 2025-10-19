<?php
include 'db.php'; 

$success = false;
$title='ADD Hall - Event Management';
include 'layout.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hall_name = $_POST['hall_name'];
    $address = $_POST['address'];
    $description = $_POST['description'];
    $size = $_POST['size'];
    $price_per_hour = $_POST['price_per_hour'];

    
    $image = $_FILES['image']['name'];
    $target = "images/" . basename($image);
    
    
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
       
        $stmt = $pdo->prepare("INSERT INTO event_halls (hall_name, image, address, description, size, price_per_hour) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$hall_name, $target, $address, $description, $size, $price_per_hour]);
        $success = true; 
    } else {
        echo "Failed to upload image.";
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event Hall</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Add New Event Hall</h1>
        
        <?php if ($success): ?>
            <div class="alert alert-success" role="alert">
                Event hall added successfully!
            </div>
        <?php endif; ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="hall_name">Hall Name</label>
                <input type="text" class="form-control" id="hall_name" name="hall_name" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="size">Size (sq ft)</label>
                <input type="number" class="form-control" id="size" name="size" required>
            </div>
            <div class="form-group">
                <label for="price_per_hour">Price per Hour</label>
                <input type="number" class="form-control" id="price_per_hour" name="price_per_hour" required>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control-file" id="image" name="image" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Hall</button>
            <a href="admin_dashboard.php" class="btn btn-success">Back</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>