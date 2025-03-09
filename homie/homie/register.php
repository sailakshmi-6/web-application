<?php
session_start();
include __DIR__ . '/includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    $stmt = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
    if ($stmt->execute([$username, $password, $email])) {
        header('Location: login.php');
        exit;
    } else {
        echo "<div class='alert alert-danger'>Error registering user. Please try again.</div>";
    }
}
?>

<?php include __DIR__ . '/includes/header.php'; ?>
<h2 class="text-center mb-4">Register</h2>
<form method="post" class="border p-4 rounded shadow">
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" name="username" required>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" name="password" required>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" name="email" required>
    </div>
    <button type="submit" class="btn btn-primary btn-block">Register</button>
    <a href="login.php" class="btn btn-secondary btn-block mt-2">Already have an account? Login</a>
</form>
<?php include __DIR__ . '/includes/footer.php'; ?>
