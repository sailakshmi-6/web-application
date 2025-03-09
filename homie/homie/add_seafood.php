<?php
session_start();
include __DIR__ . '/includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $address = $_POST['address'];

    $stmt = $pdo->prepare("INSERT INTO seafood (name, price, description, address) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$name, $price, $description, $address])) {
        header('Location: seafood_list.php');
        exit;
    } else {
        echo "<div class='alert alert-danger'>Error adding seafood. Please try again.</div>";
    }
}
?>

<?php include __DIR__ . '/includes/header.php'; ?>
<div class="container mt-5">
    <h2 class="text-center mb-4">Add New Seafood Item</h2>
    
    <!-- Centered Image -->
    <div class="text-center mb-4">
    <img src="images/OIP.jpg" alt="Fresh Salmon" class="img-fluid mb-2" style="max-height: 200px;">
</div> 
    <form method="post" class="border p-4 rounded shadow">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" placeholder="Enter seafood name" required>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" class="form-control" name="price" step="0.01" placeholder="Enter price" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" name="description" rows="4" placeholder="Enter a brief description" required></textarea>
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" name="address" placeholder="Enter address" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Add Seafood</button>
        <a href="seafood_list.php" class="btn btn-secondary btn-block mt-2">Cancel</a>
    </form>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
