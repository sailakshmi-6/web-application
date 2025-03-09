<?php
session_start();
include __DIR__ . '/includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: seafood_list.php');
        exit;
    } else {
        echo "<div class='alert alert-danger'>Invalid username or password.</div>";
    }
}
?>

<?php include __DIR__ . '/includes/header.php'; ?>
<h2 class="text-center mb-4">Login</h2>
<form method="post" class="border p-4 rounded shadow">
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" name="username" required>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary btn-block">Login</button>
    <a href="register.php" class="btn btn-secondary btn-block mt-2">Don't have an account? Register</a>
</form>
<?php include __DIR__ . '/includes/footer.php'; ?>
