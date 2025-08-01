<?php
// ------------------------------------------------------
// PEEF Platform - Homepage API Endpoint
// ------------------------------------------------------
// This script provides all necessary dynamic data for the
// main homepage in a single, efficient request.
// ------------------------------------------------------

header('Content-Type: application/json');

require_once __DIR__ . '/../includes/db_connect.php';
require_once __DIR__ . '/../includes/functions.php';

$response = [
    'status' => 'success',
    'data' => [
        'stats' => [],
        'upcoming_events' => [],
        'latest_posts' => []
    ]
];

try {
    // --- Fetch Impact Stats ---
    $response['data']['stats']['total_members'] = $pdo->query("SELECT count(id) FROM users WHERE role = 'Member'")->fetchColumn();
    $response['data']['stats']['total_events'] = $pdo->query("SELECT count(id) FROM events")->fetchColumn();

    // Fetch next 3 upcoming events
    $stmt = $pdo->query("SELECT * FROM events WHERE start_datetime > NOW() ORDER BY start_datetime ASC LIMIT 3");
    $response['data']['upcoming_events'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch latest 3 blog posts
    $sql = "SELECT p.id, p.title, p.published_at, u.full_name as author, SUBSTRING(p.content, 1, 100) AS snippet, p.featured_image
            FROM blog_posts p
            JOIN users u ON p.author_id = u.id
            WHERE p.status = 'Published'
            ORDER BY p.published_at DESC
            LIMIT 3";
    $stmt = $pdo->query($sql);
    $response['data']['latest_posts'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    http_response_code(500); // Internal Server Error
    $response['status'] = 'error';
    $response['message'] = 'Database error: ' . $e->getMessage();
}

// Encode the response array into JSON and output it.
echo json_encode($response);
?>
