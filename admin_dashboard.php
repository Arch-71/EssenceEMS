<?php
session_start(); 
include 'db.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php"); 
    exit;
}
$success=true;
$title = 'Admin Dashboard - Event Management';
include 'layout.php'; 
$total_events = $pdo->query("SELECT COUNT(*) FROM events")->fetchColumn();
$total_halls = $pdo->query("SELECT COUNT(*) FROM event_halls")->fetchColumn();
$total_users = $pdo->query("SELECT COUNT(*) FROM user")->fetchColumn(); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>body, html {
           
            margin: 0; 
        }
        
        .card {
            height:200px;
            width: 100%; 
           
            margin-bottom: 20px; 
        }</style>
</head>
<body>
    
        <h1 class="text-center">Welcome, Admin!</h1>
        <div class="container">
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card text-center" >
                    <div class="card-body">
                        <h5 class="card-title">Total Events</h5>
                        <p class="card-text"><?php echo $total_events; ?></p>
                        <a href="events.php" class="btn btn-primary">View Events</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Total Event Halls</h5>
                        <p class="card-text"><?php echo $total_halls; ?></p>
                        <a href="halls.php" class="btn btn-primary">View Halls</a>
                    </div>
                </div>
            </div>
      
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Total Users</h5>
                        <p class="card-text"><?php echo $total_users; ?></p>
                        <a href="users.php" class="btn btn-primary">View Users</a> 
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
           
            <a href="add_hall.php" class="btn btn-success">Add New Hall</a>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>