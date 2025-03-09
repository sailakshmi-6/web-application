<?php
session_start();
include __DIR__ . '/includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include __DIR__ . '/includes/header.php';
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Welcome to the Seafood Management System</h1>
    <p class="text-center mb-4">Explore our fresh and delicious seafood offerings!</p>

    <div class="row mb-4">
        <div class="col-md-4 text-center">
            <img src="images/salmon1.jpg" alt="Fresh Salmon" class="img-fluid mb-2" style="max-height: 200px;">
            <h3>Fresh Salmon</h3>
            <p>Our wild-caught salmon is perfect for grilling or baking, offering rich flavor and health benefits.</p>
        </div>
        <div class="col-md-4 text-center">
            <img src="images/shrimp1.jpg" alt="Tasty Shrimp" class="img-fluid mb-2" style="max-height: 200px;">
            <h3>Tasty Shrimp</h3>
            <p>Succulent shrimp that are ideal for any dish, whether sautéed, grilled, or in a seafood boil.</p>
        </div>
        <div class="col-md-4 text-center">
            <img src="images/tuna.jpg" alt="Premium Tuna" class="img-fluid mb-2" style="max-height: 200px;">
            <h3>Premium Tuna</h3>
            <p>Indulge in our premium Tuna, a delicacy that elevates any dining experience.</p>
        </div>
    </div>

    <h2 class="text-center mb-4">Quick Actions</h2>
    <div class="text-center mb-4">
        <a href="add_seafood.php" class="btn btn-primary btn-lg mx-2">Add Seafood</a>
        <a href="view_orders.php" class="btn btn-success btn-lg mx-2">View Orders</a>
        <a href="view_users.php" class="btn btn-warning btn-lg mx-2">View Users</a>
    </div>

    <h2 class="text-center mt-5">Latest Updates</h2>
    <ul class="list-group mt-4">
        <li class="list-group-item">🚀 New seafood items added regularly!</li>
        <li class="list-group-item">💼 Check out our new pricing plans.</li>
        <li class="list-group-item">🔒 Enhanced user management features.</li>
        <li class="list-group-item">📈 Improved order tracking functionalities.</li>
    </ul>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
