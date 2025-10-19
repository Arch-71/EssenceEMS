<?php
include 'db.php'; 

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    
    $stmt = $pdo->prepare("
        SELECT e.*, u.name, u.email, u.phone 
        FROM events e 
        JOIN user u ON e.uid = u.uid 
        WHERE e.id = ?
    ");
    $stmt->execute([$id]);
    $event = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    m
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $total_time = $_POST['total_time'];
    $date = $_POST['date'];
    $audience_number = $_POST['audience_number'];
    $category = $_POST['category'];
    $hall_id = $_POST['hall_id']; 

   
    $stmt = $pdo->prepare("SELECT * FROM events WHERE hall_id = ? AND date = ? AND status != 'complete'");
    $stmt->execute([$hall_id, $date]);
    $existingEvent = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingEvent) {
        
        echo "<script>alert('The hall is already booked for the selected date. Please choose another date.');</script>";
    } else {
       
        $stmt = $pdo->prepare("UPDATE user SET name = ?, email = ?, phone = ? WHERE uid = ?");
        $stmt->execute([$name, $email, $phone, $event['uid']]); 

        $stmt = $pdo->prepare("UPDATE events SET total_time = ?, date = ?, audience_number = ?, category = ? WHERE id = ?");
        $stmt->execute([$total_time, $date, $audience_number, $category, $id]);

        header("Location: events.php"); 
        exit();
    }
}

$title = 'Edit Event - Event Management';
include 'layout.php'; 
?>
<h1 class="text-center">Edit Booking</h1>
<div class="container mt-5">
<div class="row justify-content-center">
    <div class="col-md-6">
        <form method="POST">
            <input type="hidden" name="hall_id" value="<?php echo htmlspecialchars($event['hall_id']); ?>"> <!-- Include hall_id -->
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($event['name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($event['email']); ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($event['phone']); ?>" required>
            </div>
            <div class="form-group">
                <label for="total_time">Total Time (in hours)</label>
                <input type="number" class="form-control" id="total_time" name="total_time" value="<?php echo htmlspecialchars($event['total_time']); ?>" required>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control" id="date" name="date" value="<?php echo htmlspecialchars($event['date']); ?>" required>
            </div>
            <div class="form-group">
                <label for="audience_number">Number of Audience</label>
                <input type="number" class="form-control" id="audience_number" name="audience_number" value="<?php echo htmlspecialchars($event['audience_number']); ?>" required>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" class="form-control" id="category" name="category" value="<?php echo htmlspecialchars($event['category']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Update Booking</button>
        </form>
    </div>
</div>
</div>