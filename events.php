<?php
include 'db.php'; 


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM events WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: events.php");
    exit();
}


if (isset($_GET['complete'])) {
    $id = $_GET['complete'];
    $stmt = $pdo->prepare("UPDATE events SET status = 'Accepted' WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: events.php");
    exit();
}


$stmt = $pdo->prepare("
    SELECT e.*, u.name, u.email, u.phone, h.hall_name 
    FROM events e 
    JOIN user u ON e.uid = u.uid 
    JOIN event_halls h ON e.hall_id = h.id 
    ORDER BY e.created_at DESC
");
$stmt->execute();
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

$title = 'View Bookings - Event Management';
include 'layout.php';
?>
<body>
<h1 class="text-center">Event Bookings</h1>
<div class="container mt-5">
<table class="table table-bordered mt-4">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Total Time</th>
            <th>Date</th>
            <th>Audience Number</th>
            <th>Category</th>
            <th>Hall Name</th> 
            <th>Status</th> 
            <th>Created At</th>
            <th>Edit</th>
            <th>Complete</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($events as $event): ?>
            <tr>
                <td><?php echo htmlspecialchars($event['name']); ?></td>
                <td><?php echo htmlspecialchars($event['email']); ?></td>
                <td><?php echo htmlspecialchars($event['phone']); ?></td>
                <td><?php echo htmlspecialchars($event['total_time']); ?></td>
                <td><?php echo htmlspecialchars($event['date']); ?></td>
                <td><?php echo htmlspecialchars($event['audience_number']); ?></td>
                <td><?php echo htmlspecialchars($event['category']); ?></td>
                <td><?php echo htmlspecialchars($event['hall_name']); ?></td> 
                <td><?php echo htmlspecialchars($event['status']); ?></td> 
                <td><?php echo htmlspecialchars($event['created_at']); ?></td>
                <td><a href="edit.php?id=<?php echo $event['id']; ?>" class="btn btn-warning btn-sm">Edit</a></td>
                <td>
                    <?php if ($event['status'] === 'pending'): ?>
                        <a href="events.php?complete=<?php echo $event['id']; ?>" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to accept this event?');">Accept</a>
                    <?php else: ?>
                        <span class="text-success">Accept</span>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="events.php?delete=<?php echo $event['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this booking?');">Cancel</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="text-center">
    <a href="index.php" class="btn btn-secondary">Back to Home</a>
</div>

</div>
</body>