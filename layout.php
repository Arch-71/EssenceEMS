<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy(); 
    header("Location: index.php"); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Event Management'; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="height:100px;font-size:20px;">
    <a href="#"><img src="images/logo.png" alt="Venue" style="margin-left:5rem;border-radius:50%;height:80px;"></a>
        <a class="navbar-brand" href="#" style="margin-left:1rem;font-size:24px;">EventEssence</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($title == 'Admin Dashboard - Event Management') ? 'active' : ''; ?>" href="admin_dashboard.php">Admin Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($title == 'Home - Event Management') ? 'active' : ''; ?>" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($title == 'Halls - Event Management') ? 'active' : ''; ?>" href="halls.php">View Halls</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($title == 'View Bookings - Event Management') ? 'active' : ''; ?>" href="events.php">View Bookings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($title == 'User  Management - Event Management') ? 'active' : ''; ?>" href="users.php">View Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="layout.php?logout=true">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($title == 'Home - Event Management') ? 'active' : ''; ?>" href="index.php">Home</a>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($title == 'Login - Event Management') ? 'active' : ''; ?> " href="login.php">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
    <?php 
    if (isset($content) && !empty($content)) {
        include($content); 
    }
    ?>
</div>
</body>
</html>