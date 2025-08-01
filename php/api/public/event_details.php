<?php
// ------------------------------------------------------
// PEEF Platform - Event Details API Endpoint
// ------------------------------------------------------
// This script provides a public API to fetch detailed
// information for a single event, including its ticket tiers.
// ------------------------------------------------------

header('Content-Type: application/json');

require_once __DIR__ . '/../../includes/db_connect.php';
require_once __DIR__ . '/../../includes/functions.php';

$response = ['status' => 'error', 'message' => 'An unknown error occurred.'];

$event_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if (!$event_id) {
    http_response_code(400); // Bad Request
    $response['message'] = 'Event ID is required.';
    echo json_encode($response);
    exit;
}

try {
    // Fetch main event details
    $stmt = $pdo->prepare("SELECT * FROM events WHERE id = ?");
    $stmt->execute([$event_id]);
    $event = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($event) {
        // Fetch ticket tiers for the event
        $tier_stmt = $pdo->prepare("SELECT tier_name, cost, description FROM event_participation_tiers WHERE event_id = ? ORDER BY cost ASC");
        $tier_stmt->execute([$event_id]);
        $event['tiers'] = $tier_stmt->fetchAll(PDO::FETCH_ASSOC);

        $response['status'] = 'success';
        $response['data'] = $event;
    } else {
        http_response_code(404);
        $response['message'] = 'Event not found.';
    }

} catch (PDOException $e) {
    http_response_code(500);
    $response['message'] = 'Database error: ' . $e->getMessage();
}

echo json_encode($response);
?>
