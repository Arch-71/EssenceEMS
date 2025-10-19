<?php
include 'db.php'; 

$success = false;
$message = "";

$hall_id = isset($_GET['hall_id']) ? $_GET['hall_id'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $total_time = $_POST['total_time'];
    $date = $_POST['date'];
    $audience_number = $_POST['audience_number'];
    $category = $_POST['category'];

    if (!preg_match('/^\d{10}$/', $phone)) {
        $message = "Phone number must be exactly 10 digits.";
    } else {
       
        $stmt = $pdo->prepare("SELECT * FROM events WHERE hall_id = ? AND date = ? AND status != 'complete'");
        $stmt->execute([$hall_id, $date]);
        $existingEvent = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingEvent) {
          
            $message = "The hall is already booked for the selected date. Please choose another date.";
        } else {
           
            $stmt = $pdo->prepare("INSERT INTO user (name, email, phone) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $phone]);
            
           
            $uid = $pdo->lastInsertId();

            $stmt = $pdo->prepare("INSERT INTO events (uid, hall_id, total_time, date, audience_number, category) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$uid, $hall_id, $total_time, $date, $audience_number, $category]);

            $success = true;

            
            if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
                header("Location: events.php");
                exit();
            } else {
             
                $message = "Thank you for your booking! We will contact you soon.";
            }
        }
    }
}
$title = 'Book New Event - Event Management';
include 'layout.php'; 
?>
<h1 class="text-center">Book New Event</h1>

<?php if ($message): ?>
        <div class="alert alert-info" role="alert">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <form method="POST">
            <input type="hidden" name="hall_id" value="<?php echo htmlspecialchars($hall_id); ?>">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="total_time">Total Time (in hours)</label>
                <input type="number" class="form-control" id="total_time" name="total_time" required>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="audience_number">Number of Audience</label>
                <input type="number" class="form-control" id="audience_number" name="audience_number" required>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" class="form-control" id="category" name="category" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Book Now</button>
        </form>
    </div>
</div>