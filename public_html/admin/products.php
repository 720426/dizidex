<?php
require_once '../config/database.php';
require_once '../includes/auth.php';
requireLogin();

$db = Database::getConnection();
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCsrfToken($_POST['csrf_token'])) {
        $message = "Invalid CSRF token.";
    } else {
        $action = $_POST['action'] ?? '';
        
        if ($action === 'create') {
            $title = $_POST['title'];
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
            $price = $_POST['price'];
            $status = $_POST['status'] ?? 'Draft';
            
            try {
                $stmt = $db->prepare("INSERT INTO products (title, slug, price, status) VALUES (?, ?, ?, ?)");
                $stmt->execute([$title, $slug, $price, $status]);
                $message = "Product created successfully.";
            } catch (Exception $e) {
                $message = "Error creating product: " . $e->getMessage();
            }
        } elseif ($action === 'delete') {
            $id = $_POST['id'];
            $stmt = $db->prepare("DELETE FROM products WHERE id = ?");
            $stmt->execute([$id]);
            $message = "Product deleted.";
        } elseif ($action === 'update') {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $price = $_POST['price'];
            $status = $_POST['status'];
            $checkout_url = $_POST['checkout_url'];
            
            $stmt = $db->prepare("UPDATE products SET title = ?, price = ?, status = ?, checkout_url = ? WHERE id = ?");
            $stmt->execute([$title, $price, $status, $checkout_url, $id]);
            $message = "Product updated.";
        }
    }
}

$products = $db->query("SELECT * FROM products ORDER BY created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products - DiziDex</title>
    <style>
        /* Shared admin styles */
        body { font-family: 'Inter', sans-serif; background: #f9fafb; margin: 0; display: flex; }
        .sidebar { width: 250px; background: #1e3a8a; color: white; min-height: 100vh; padding: 2rem 0; }
        .sidebar h2 { padding: 0 2rem; margin-top: 0; font-size: 1.5rem; }
        .sidebar ul { list-style: none; padding: 0; margin: 2rem 0; }
        .sidebar li a { display: block; padding: 1rem 2rem; color: #cbd5e1; text-decoration: none; }
        .sidebar li a:hover, .sidebar li a.active { background: #1e40af; color: white; }
        .content { flex-grow: 1; padding: 2rem; }
        
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; }
        .btn { background: #2563eb; color: white; border: none; padding: 0.5rem 1rem; border-radius: 4px; cursor: pointer; }
        .btn-danger { background: #dc2626; }
        
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        th, td { padding: 1rem; text-align: left; border-bottom: 1px solid #e5e7eb; }
        th { background: #f3f4f6; font-weight: 600; color: #374151; }
        
        .card { background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-bottom: 2rem; }
        .form-group { margin-bottom: 1rem; }
        .form-group label { display: block; margin-bottom: 0.5rem; font-weight: 500; }
        .form-group input, .form-group select { width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 4px; }
        .message { padding: 1rem; background: #d1fae5; color: #065f46; border-radius: 4px; margin-bottom: 1rem; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>DiziDex</h2>
        <ul>
            <li><a href="/admin/index.php">Overview</a></li>
            <li><a href="/admin/products.php" class="active">Products</a></li>
            <li><a href="/admin/analytics.php">Analytics</a></li>
            <li><a href="/admin/logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="header">
            <h1>Products</h1>
        </div>

        <?php if ($message): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <div class="card">
            <h3>Add New Product</h3>
            <form method="POST">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(generateCsrfToken()); ?>">
                <input type="hidden" name="action" value="create">
                <div class="form-group">
                    <label>Product Title</label>
                    <input type="text" name="title" required>
                </div>
                <div class="form-group">
                    <label>Price (₹)</label>
                    <input type="number" step="0.01" name="price" required>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status">
                        <option value="Draft">Draft</option>
                        <option value="Published">Published</option>
                    </select>
                </div>
                <button type="submit" class="btn">Create Product</button>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo htmlspecialchars($product['title']); ?></td>
                    <td>₹<?php echo htmlspecialchars($product['price']); ?></td>
                    <td><?php echo htmlspecialchars($product['status']); ?></td>
                    <td><?php echo date('M d, Y', strtotime($product['created_at'])); ?></td>
                    <td>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(generateCsrfToken()); ?>">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($products)): ?>
                <tr>
                    <td colspan="5" style="text-align: center;">No products found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
