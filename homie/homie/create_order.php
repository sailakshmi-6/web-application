<?php
session_start();
include __DIR__ . '/includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Fetch all seafood for selection
$seafoodStmt = $pdo->query("SELECT id, name FROM seafood");
$seafoodItems = $seafoodStmt->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $seafood_id = $_POST['seafood_id'];
    $quantity = $_POST['quantity'];

    $stmt = $pdo->prepare("INSERT INTO orders (user_id, seafood_id, quantity) VALUES (?, ?, ?)");
    if ($stmt->execute([$user_id, $seafood_id, $quantity])) {
        header('Location: orders_list.php');
        exit;
    } else {
        echo "<div class='alert alert-danger'>Error placing order. Please try again.</div>";
    }
}

include __DIR__ . '/includes/header.php';
?>

<h2 class="text-center mb-4">Create New Order</h2>
<form method="post" class="border p-4 rounded shadow">
    <div class="form-group">
        <label for="seafood_id">Seafood:</label>
        <select class="form-control" name="seafood_id" required>
            <option value="">Select Seafood</option>
            <?php foreach ($seafoodItems as $item): ?>
                <option value="<?php echo $item['id']; ?>"><?php echo htmlspecialchars($item['name']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="quantity">Quantity:</label>
        <input type="number" class="form-control" name="quantity" required>
    </div>
    <button type="submit" class="btn btn-primary btn-block">Place Order</button>
    <a href="orders_list.php" class="btn btn-secondary btn-block mt-2">Cancel</a>
</form>

<?php include __DIR__ . '/includes/footer.php'; ?>
