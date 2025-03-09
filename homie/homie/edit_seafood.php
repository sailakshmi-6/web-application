<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM seafood WHERE id = ?");
    $stmt->execute([$id]);
    $seafood = $stmt->fetch();

    if (!$seafood) {
        echo "<div class='alert alert-danger'>Seafood not found.</div>";
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
        echo "<div class='alert alert-danger'>Error updating seafood.</div>";
    }
}
?>

<?php include 'includes/header.php'; ?>
<div class="container mt-5">
    <h2>Edit Seafood Item</h2>
    <form method="post">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($seafood['name']) ?>" required>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" class="form-control" name="price" step="0.01" value="<?= htmlspecialchars($seafood['price']) ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" name="description" rows="4" required><?= htmlspecialchars($seafood['description']) ?></textarea>
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" name="address" value="<?= htmlspecialchars($seafood['address']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Seafood</button>
        <a href="seafood_list.php" class="btn btn-secondary mt-2">Cancel</a>
    </form>
</div>
<?php include 'includes/footer.php'; ?>
