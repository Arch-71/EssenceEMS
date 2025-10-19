<?php
include 'db.php'; 
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}


$stmt = $pdo->query("SELECT * FROM event_halls ORDER BY created_at DESC");
$halls = $stmt->fetchAll(PDO::FETCH_ASSOC);
$title = 'Halls - Event Management';
include 'layout.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Manage Event Halls</h1>
        <div class="text-right mb-3">
            <a href="add_hall.php" class="btn btn-success">Add New Hall</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Hall Name</th>
                    <th>Description</th>
                    <th>Address</th>
                    <th>Size </th>
                    <th>Price per Hour</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($halls)): ?>
                    <?php foreach ($halls as $hall): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($hall['id']); ?></td>
                            <td><?php echo htmlspecialchars($hall['hall_name']); ?></td>
                            <td><?php echo htmlspecialchars($hall['description']); ?></td>
                            <td><?php echo htmlspecialchars($hall['address']); ?></td>
                            <td><?php echo htmlspecialchars($hall['size']); ?></td>
                            <td>$<?php echo htmlspecialchars($hall['price_per_hour']); ?></td>
                            <td><a href="delete_hall.php?id=<?php echo $hall['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this hall?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">No event halls found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>