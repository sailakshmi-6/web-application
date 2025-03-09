<?php
session_start();
include __DIR__ . '/includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Fetch the existing seafood data
    $stmt = $pdo->prepare("SELECT * FROM seafood WHERE id = ?");
    $stmt->execute([$id]);
    $seafood = $stmt->fetch();

    if (!$seafood) {
        echo "<div class='alert alert-danger'>Seafood item not found.</div>";
        exit;
    }
} else {
    header('Location: seafood_list.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $address = $_POST['address'];

    $stmt = $pdo->prepare("UPDATE seafood SET name = ?, price = ?, description = ?, address = ? WHERE id = ?");
    if ($stmt->execute([$name, $price, $description, $address, $id])) {
        header('Location: seafood_list.php');
        exit;
    } else {
        echo "<div class='alert alert-danger'>Error updating seafood. Please try again.</div>";
    }
}

include __DIR__ . '/includes/header.php';
?>

<h2 class="text-center mb-4">Update Seafood Item</h2>
<form method="post" class="border p-4 rounded shadow">
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($seafood['name']); ?>" required>
    </div>
    <div class="form-group">
        <label for="price">Price:</label>
        <input type="number" class="form-control" name="price" value="<?php echo htmlspecialchars($seafood['price']); ?>" step="0.01" required>
    </div>
    <div class="form-group">
        <label for="description">Description:</label>
        <textarea class="form-control" name="description" rows="4" required><?php echo htmlspecialchars($seafood['description']); ?></textarea>
    </div>
    <div class="form-group">
        <label for="address">Address:</label>
        <input type="text" class="form-control" name="address" value="<?php echo htmlspecialchars($seafood['address']); ?>" required>
    </div>
    <button type="submit" class="btn btn-primary btn-block">Update Seafood</button>
    <a href="seafood_list.php" class="btn btn-secondary btn-block mt-2">Cancel</a>
</form>

<?php include __DIR__ . '/includes/footer.php'; ?>
