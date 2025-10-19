<?php
include 'db.php'; 
$title = 'Home - Event Management'; 
include 'layout.php'; 

$stmt = $pdo->query("SELECT * FROM event_halls ORDER BY created_at DESC");
$halls = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <style>

    div.scroll-container {
    background-color: #333;
    overflow: auto;
    white-space: nowrap;
    padding: 10px;
  }
  
  div.scroll-container img {
    padding: 10px;
  }
  .card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.1);
    height: 95%;
    margin-left:1rem;
}

.card-title {
    font-size: 1.5rem;
    color: #343a40; 
}

.card-subtitle {
    font-size: 1rem;
    color: #6c757d;
}

.card-text {
    text-align: left;
}

.card-footer {
    background-color: white; 
}
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h2>Welcome to EventEssence</h2>
            <p>
                At EventEssence, we specialize in creating unforgettable experiences for all types of events. 
                Whether you're planning a wedding, corporate event, or a private party, our dedicated team is here to help you every step of the way. 
                We offer a range of services including venue selection, event planning, catering, and entertainment to ensure your event is a success.
            </p>
            <p>
                Our mission is to bring your vision to life with creativity and professionalism. 
                Let us take care of the details while you enjoy the celebration!
            </p>
        </div>
        <div class="col-md-4">
            <img src="images/event.jpg" alt="EventEssence Services" class="img-fluid"  style="border-radius:5px;">
        </div>
    </div>
</div>

    <h2 class="text-center">Event Gallery</h2>
    
<div class="scroll-container">
  <img src="images/birth.jpeg" alt="Cinque Terre" width="400" height="300">
  <img src="images/wedding.jpg" alt="Forest"  width="400" height="300">
  <img src="images/eng.jpeg" alt="Northern Lights" width="400" height="300">
  <img src="images/night.jpg" alt="Mountains"  width="400" height="300">
  <img src="images/pai.jpg" alt="Mountains"  width="400" height="300">
  <img src="images/event.jpg" alt="Mountains"  width="400" height="300">
  <img src="images/birthday.webp" alt="Mountains" width="400" height="300">
</div>


    <div class="text-center ">
        
    <div class="text-center mt-5">
    <h1 class="text-center">Available Event Halls</h1>
    <div class="row">
        <?php if (!empty($halls)): ?>
            <?php foreach ($halls as $hall): ?>
                <div class="col-md-4">
                    <div class="card mb-4 text-center">
                        <img src="<?php echo htmlspecialchars($hall['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($hall['hall_name']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($hall['hall_name']); ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($hall['address']); ?></h6>
                            <p class="card-text"><?php echo htmlspecialchars($hall['description']); ?></p>
                            <p class="card-text"><strong>Rate Per Hour:</strong> $<?php echo htmlspecialchars($hall['price_per_hour']); ?></p> 
                            <p class="card-text"><strong>Size:</strong> <?php echo htmlspecialchars($hall['size']); ?></p>  
                        </div>
                        <div class="card-footer">
                            <a href="booking.php?hall_id=<?php echo $hall['id']; ?>" class="btn btn-primary btn-block">Book</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">No event halls available at the moment.</p>
        <?php endif; ?>
    </div>
</div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
</body>
</html>