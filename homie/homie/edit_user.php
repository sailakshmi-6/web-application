<?php
session_start();
include __DIR__ . '/includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch user data
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch();

    if (!$user) {
        die("User not found.");
    }
} else {
    header('Location: users_list.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
    if ($stmt->execute([$username, $email, $id])) {
        header('Location: users_list.php');
        exit;
    } else {
        echo "<div class='alert alert-danger'>Error updating user. Please try again.</div>";
    }
}
?>

<?php include __DIR__ . '/includes/header.php'; ?>
<h2 class="text-center mb-4">Edit User</h2>
<form method="post" class="border p-4 rounded shadow">
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
    </div>
    <button type="submit" class="btn btn-primary btn-block">Update User</button>
    <a href="users_list.php" class="btn btn-secondary btn-block mt-2">Cancel</a>
</form>
<?php include __DIR__ . '/includes/footer.php'; ?>
