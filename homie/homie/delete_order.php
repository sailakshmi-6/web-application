<?php
session_start();
include __DIR__ . '/includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $stmt = $pdo->prepare("DELETE FROM orders WHERE id = ?");
    if ($stmt->execute([$id])) {
        header('Location: orders_list.php');
        exit;
    } else {
        echo "<div class='alert alert-danger'>Error deleting order. Please try again.</div>";
    }
} else {
    header('Location: orders_list.php');
    exit;
}
?>
