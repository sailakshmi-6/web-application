<?php
session_start();
include __DIR__ . '/includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Fetch total seafood items
$stmt = $pdo->query("SELECT COUNT(*) as total_seafood FROM seafood");
$total_seafood = $stmt->fetchColumn();

// Fetch total orders
$stmt = $pdo->query("SELECT COUNT(*) as total_orders FROM orders");
$total_orders = $stmt->fetchColumn();

// Fetch total users
$stmt = $pdo->query("SELECT COUNT(*) as total_users FROM users");
$total_users = $stmt->fetchColumn();

include __DIR__ . '/includes/header.php';
?>

<h2 class="text-center mb-4">Dashboard</h2>
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3 shadow">
            <div class="card-header">Total Seafood Items</div>
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($total_seafood); ?></h5>
                <p class="card-text">Manage your seafood products efficiently.</p>
                <a href="seafood_list.php" class="btn btn-light">View Seafood</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success mb-3 shadow">
            <div class="card-header">Total Orders</div>
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($total_orders); ?></h5>
                <p class="card-text">Keep track of your orders.</p>
                <a href="view_orders.php" class="btn btn-light">View Orders</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-warning mb-3 shadow">
            <div class="card-header">Total Users</div>
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($total_users); ?></h5>
                <p class="card-text">Manage registered users.</p>
                <a href="view_users.php" class="btn btn-light">View Users</a>
            </div>
        </div>
    </div>
</div>

<!-- Additional Features Section -->
<h3 class="text-center mb-4">Additional Features</h3>
<div class="row">
    <div class="col-md-6">
        <div class="card mb-3 shadow">
            <div class="card-header">Recent Orders</div>
            <div class="card-body">
                <ul class="list-group">
                    <?php
                    $stmt = $pdo->query("SELECT * FROM orders ORDER BY order_date DESC LIMIT 5");
                    $recent_orders = $stmt->fetchAll();
                    foreach ($recent_orders as $order): ?>
                        <li class="list-group-item">
                            Order ID: <?php echo htmlspecialchars($order['id']); ?>, 
                            Seafood ID: <?php echo htmlspecialchars($order['seafood_id']); ?>, 
                            Quantity: <?php echo htmlspecialchars($order['quantity']); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-3 shadow">
            <div class="card-header">System Status</div>
            <div class="card-body text-center">
                <h5 class="card-title">All systems operational</h5>
                <p class="card-text">Your seafood management system is running smoothly.</p>
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
