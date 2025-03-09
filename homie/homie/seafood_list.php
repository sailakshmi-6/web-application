<?php
include __DIR__ . '/includes/db.php';

$stmt = $pdo->query("SELECT * FROM seafood");
$seafoods = $stmt->fetchAll();

include __DIR__ . '/includes/header.php';
?>

<h2 class="text-center mb-4">Seafood List</h2>
<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Address</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($seafoods as $seafood): ?>
            <tr>
                <td><?php echo htmlspecialchars($seafood['name']); ?></td>
                <td><?php echo htmlspecialchars($seafood['price']); ?></td>
                <td><?php echo htmlspecialchars($seafood['description']); ?></td>
                <td><?php echo htmlspecialchars($seafood['address']); ?></td>
                <td>
                    <a href="update_seafood.php?id=<?php echo $seafood['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete_seafood.php?id=<?php echo $seafood['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include __DIR__ . '/includes/footer.php'; ?>
