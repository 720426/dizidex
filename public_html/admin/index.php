<?php
require_once '../config/database.php';
require_once '../includes/auth.php';
requireLogin();

$db = Database::getConnection();

// Fetch basic stats
$stats = [
    'visitors' => 0,
    'page_views' => 0,
    'checkouts' => 0,
    'checkout_rate' => '0%',
    'orders' => 0,
    'revenue' => 0
];

try {
    $stats['page_views'] = $db->query("SELECT COUNT(*) FROM page_views")->fetchColumn();
    $stats['visitors'] = $db->query("SELECT COUNT(DISTINCT session_id) FROM page_views")->fetchColumn();
    $stats['checkouts'] = $db->query("SELECT COUNT(*) FROM checkout_events")->fetchColumn();
    $stats['orders'] = $db->query("SELECT COUNT(*) FROM orders")->fetchColumn();
    $revenue = $db->query("SELECT SUM(amount) FROM orders")->fetchColumn();
    $stats['revenue'] = $revenue ? $revenue : 0;
    
    if ($stats['visitors'] > 0) {
        $stats['checkout_rate'] = number_format(($stats['checkouts'] / $stats['visitors']) * 100, 2) . '%';
    }
} catch (Exception $e) {
    // Log error, keep 0 stats
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - DiziDex</title>
    <style>
        body { font-family: 'Inter', sans-serif; background: #f9fafb; margin: 0; display: flex; }
        .sidebar { width: 250px; background: #1e3a8a; color: white; min-height: 100vh; padding: 2rem 0; }
        .sidebar h2 { padding: 0 2rem; margin-top: 0; font-size: 1.5rem; }
        .sidebar ul { list-style: none; padding: 0; margin: 2rem 0; }
        .sidebar li a { display: block; padding: 1rem 2rem; color: #cbd5e1; text-decoration: none; transition: background 0.2s; }
        .sidebar li a:hover, .sidebar li a.active { background: #1e40af; color: white; }
        .content { flex-grow: 1; padding: 2rem; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
        .stat-card { background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .stat-card h3 { margin: 0 0 0.5rem 0; font-size: 0.875rem; color: #6b7280; text-transform: uppercase; }
        .stat-card .value { font-size: 2rem; font-weight: 700; color: #111827; }
        .btn { background: #2563eb; color: white; border: none; padding: 0.5rem 1rem; border-radius: 4px; cursor: pointer; text-decoration: none; font-size: 0.875rem; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>DiziDex</h2>
        <ul>
            <li><a href="/admin/index.php" class="active">Overview</a></li>
            <li><a href="/admin/products.php">Products</a></li>
            <li><a href="/admin/analytics.php">Analytics</a></li>
            <li><a href="/admin/logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="header">
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
        </div>
        
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Visitors</h3>
                <div class="value"><?php echo number_format($stats['visitors']); ?></div>
            </div>
            <div class="stat-card">
                <h3>Page Views</h3>
                <div class="value"><?php echo number_format($stats['page_views']); ?></div>
            </div>
            <div class="stat-card">
                <h3>Checkout Clicks</h3>
                <div class="value"><?php echo number_format($stats['checkouts']); ?></div>
            </div>
            <div class="stat-card">
                <h3>Checkout Rate</h3>
                <div class="value"><?php echo $stats['checkout_rate']; ?></div>
            </div>
            <div class="stat-card">
                <h3>Orders</h3>
                <div class="value"><?php echo number_format($stats['orders']); ?></div>
            </div>
            <div class="stat-card">
                <h3>Revenue</h3>
                <div class="value">₹<?php echo number_format($stats['revenue'], 2); ?></div>
            </div>
        </div>
    </div>
</body>
</html>
