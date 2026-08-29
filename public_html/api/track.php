<?php
require_once '../config/database.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

if (!$input || !isset($input['event_type'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid payload']);
    exit;
}

$db = Database::getConnection();
$event_type = $input['event_type'];

// Session logic
session_start();
$session_id = session_id();

try {
    if ($event_type === 'page_view') {
        $url = $input['url'] ?? '';
        
        $stmt = $db->prepare("INSERT INTO page_views (session_id, page_url) VALUES (?, ?)");
        $stmt->execute([$session_id, $url]);

        // Capture UTMs if present and not already recorded for this session
        $utm = $input['utm'] ?? [];
        if (!empty($utm)) {
            $stmt = $db->prepare("SELECT id FROM utm_sessions WHERE session_id = ?");
            $stmt->execute([$session_id]);
            if (!$stmt->fetch()) {
                $stmt = $db->prepare("INSERT INTO utm_sessions (session_id, source, medium, campaign, content, term, fbclid, referrer, device, browser, country) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([
                    $session_id,
                    $utm['source'] ?? null,
                    $utm['medium'] ?? null,
                    $utm['campaign'] ?? null,
                    $utm['content'] ?? null,
                    $utm['term'] ?? null,
                    $utm['fbclid'] ?? null,
                    $input['referrer'] ?? null,
                    $input['device'] ?? null,
                    $input['browser'] ?? null,
                    $input['country'] ?? null
                ]);
            }
        }
        
        echo json_encode(['success' => true]);

    } elseif ($event_type === 'initiate_checkout') {
        $product_id = $input['product_id'] ?? null;
        $value = $input['value'] ?? null;
        $currency = $input['currency'] ?? 'INR';
        
        $stmt = $db->prepare("INSERT INTO checkout_events (session_id, product_id, value, currency) VALUES (?, ?, ?, ?)");
        $stmt->execute([$session_id, $product_id, $value, $currency]);
        
        echo json_encode(['success' => true]);
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Unknown event type']);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Server error']);
}
