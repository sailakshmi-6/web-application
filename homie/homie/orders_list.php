<?php
session_start();
include __DIR__ . '/includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Fetch all orders
$stmt = $pdo->query("SELECT orders.id, users.username, seafood.name, orders.quantity, orders.order_date 
                      FROM orders 
                      JOIN users ON orders.user_id = users.id 
                      JOIN seafood ON orders.seafood_id = seafood.id");
$orders = $stmt->fetchAll();

include __DIR__ . '/includes/header.php';
?>

<h2 class="text-center mb-4">Order List</h2>
<table class="table">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Username</th>
            <th>Seafood Name</th>
            <th>Quantity</th>
            <th>Order Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?php echo htmlspecialchars($order['id']); ?></td>
                <td><?php echo htmlspecialchars($order['username']); ?></td>
                <td><?php echo htmlspecialchars($order['name']); ?></td>
                <td><?php echo htmlspecialchars($order['quantity']); ?></td>
                <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                <td>
                    <a href="delete_order.php?id=<?php echo $order['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this order?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="create_order.php" class="btn btn-primary">Add New Order</a>

<?php include __DIR__ . '/includes/footer.php'; ?>
