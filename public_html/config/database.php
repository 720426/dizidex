<?php
// Simple environment variable parser
function loadEnv($path)
{
    if (!file_exists($path)) {
        return false;
    }
    
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        
        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);
        
        if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
            putenv(sprintf('%s=%s', $name, $value));
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
        }
    }
    return true;
}

// Load .env file from project root (one level up from public_html)
$envPath = dirname(__DIR__, 2) . '/.env';
loadEnv($envPath);

class Database {
    private static $conn = null;

    public static function getConnection() {
        if (self::$conn === null) {
            $host = getenv('DB_HOST') ?: 'localhost';
            $db   = getenv('DB_DATABASE') ?: 'dizidex_db';
            $user = getenv('DB_USERNAME') ?: 'root';
            $pass = getenv('DB_PASSWORD') ?: '';
            $charset = 'utf8mb4';

            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            try {
                self::$conn = new PDO($dsn, $user, $pass, $options);
            } catch (\PDOException $e) {
                // Return an error or throw exception based on environment
                // In production, log this and display a generic error.
                if (getenv('APP_ENV') === 'development') {
                    throw new \PDOException($e->getMessage(), (int)$e->getCode());
                } else {
                    die("Database connection failed. Please try again later.");
                }
            }
        }
        return self::$conn;
    }
}
