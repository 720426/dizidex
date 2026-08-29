<?php
require_once '../config/database.php';
require_once '../includes/auth.php';

if (isLoggedIn()) {
    header('Location: /admin/index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCsrfToken($_POST['csrf_token'])) {
        $error = "Invalid CSRF token.";
    } else {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($password)) {
            $error = "Please enter both username and password.";
        } else {
            try {
                $db = Database::getConnection();
                $stmt = $db->prepare("SELECT id, username, password FROM users WHERE username = ?");
                $stmt->execute([$username]);
                $user = $stmt->fetch();

                if ($user && password_verify($password, $user['password'])) {
                    loginUser($user['id'], $user['username']);
                    header('Location: /admin/index.php');
                    exit;
                } else {
                    // To avoid enumeration, use generic error
                    $error = "Invalid username or password.";
                }
            } catch (Exception $e) {
                $error = "An error occurred during login.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - DiziDex</title>
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #111827;
        }
        .login-card {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            width: 100%;
            max-width: 400px;
        }
        .login-card h2 {
            text-align: center;
            margin-top: 0;
            color: #1e3a8a; /* Deep navy */
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        .form-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 1rem;
        }
        .btn {
            width: 100%;
            padding: 0.75rem;
            background-color: #2563eb; /* Bright blue */
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .btn:hover {
            background-color: #1d4ed8;
        }
        .error {
            color: #dc2626;
            margin-bottom: 1rem;
            text-align: center;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <h2>DiziDex Admin</h2>
        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <?php if (isset($_GET['msg']) && $_GET['msg'] === 'timeout'): ?>
             <div class="error" style="color: #ea580c;">Session expired. Please log in again.</div>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(generateCsrfToken()); ?>">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>
</body>
</html>
