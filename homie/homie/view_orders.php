<?php
session_start();
include __DIR__ . '/includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Fetch orders
$stmt = $pdo->prepare("SELECT o.id, o.quantity, o.order_date, s.name AS seafood_name, u.username 
                        FROM orders o 
                        JOIN seafood s ON o.seafood_id = s.id 
                        JOIN users u ON o.user_id = u.id 
                        ORDER BY o.order_date DESC");
$stmt->execute();
$orders = $stmt->fetchAll();

include __DIR__ . '/includes/header.php';
?>

<h2 class="text-center mb-4">Orders List</h2>
<table class="table">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Username</th>
            <th>Seafood</th>
            <th>Quantity</th>
            <th>Order Date</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?php echo htmlspecialchars($order['id']); ?></td>
                <td><?php echo htmlspecialchars($order['username']); ?></td>
                <td><?php echo htmlspecialchars($order['seafood_name']); ?></td>
                <td><?php echo htmlspecialchars($order['quantity']); ?></td>
                <td><?php echo htmlspecialchars($order['order_date']); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include __DIR__ . '/includes/footer.php'; ?>
