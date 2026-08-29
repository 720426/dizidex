<?php
require_once '../config/database.php';
require_once '../includes/auth.php';
requireLogin();

$db = Database::getConnection();

// Fetch sources
$sources = $db->query("
    SELECT source, COUNT(*) as visitors 
    FROM utm_sessions 
    GROUP BY source 
    ORDER BY visitors DESC
")->fetchAll();

// Fetch recent sessions
$recent_sessions = $db->query("
    SELECT * FROM utm_sessions 
    ORDER BY created_at DESC 
    LIMIT 20
")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics - DiziDex</title>
    <style>
        body { font-family: 'Inter', sans-serif; background: #f9fafb; margin: 0; display: flex; }
        .sidebar { width: 250px; background: #1e3a8a; color: white; min-height: 100vh; padding: 2rem 0; }
        .sidebar h2 { padding: 0 2rem; margin-top: 0; font-size: 1.5rem; }
        .sidebar ul { list-style: none; padding: 0; margin: 2rem 0; }
        .sidebar li a { display: block; padding: 1rem 2rem; color: #cbd5e1; text-decoration: none; }
        .sidebar li a:hover, .sidebar li a.active { background: #1e40af; color: white; }
        .content { flex-grow: 1; padding: 2rem; }
        
        .header { margin-bottom: 2rem; }
        .card { background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-bottom: 2rem; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 0.75rem; text-align: left; border-bottom: 1px solid #e5e7eb; }
        th { background: #f3f4f6; font-weight: 600; color: #374151; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>DiziDex</h2>
        <ul>
            <li><a href="/admin/index.php">Overview</a></li>
            <li><a href="/admin/products.php">Products</a></li>
            <li><a href="/admin/analytics.php" class="active">Analytics</a></li>
            <li><a href="/admin/logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="header">
            <h1>Analytics</h1>
        </div>

        <div class="card">
            <h3>Traffic Sources</h3>
            <table>
                <thead>
                    <tr>
                        <th>Source</th>
                        <th>Visitors</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sources as $s): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($s['source'] ?: 'Direct / Unknown'); ?></td>
                        <td><?php echo htmlspecialchars($s['visitors']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="card">
            <h3>Recent Sessions (UTM)</h3>
            <table>
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>Source</th>
                        <th>Campaign</th>
                        <th>Device</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recent_sessions as $rs): ?>
                    <tr>
                        <td><?php echo date('M d, H:i', strtotime($rs['created_at'])); ?></td>
                        <td><?php echo htmlspecialchars($rs['source']); ?></td>
                        <td><?php echo htmlspecialchars($rs['campaign']); ?></td>
                        <td><?php echo htmlspecialchars($rs['device']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
