<?php
// ------------------------------------------------------
// PEEF Platform - Events API Endpoint
// ------------------------------------------------------
// This script provides a public API to fetch all event
// data from the database and returns it in JSON format.
// ------------------------------------------------------

header('Content-Type: application/json');

require_once __DIR__ . '../../../includes/db_connect.php';
require_once __DIR__ . '../../../includes/functions.php';

$response = [
    'status' => 'success',
    'data' => []
];

try {
    // Fetch all events, ordered by the soonest first
    $sql = "SELECT id, title, description, start_datetime, location, poster_image 
            FROM events 
            ORDER BY start_datetime ASC";
    
    $stmt = $pdo->query($sql);
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $response['data'] = $events;

} catch (PDOException $e) {
    http_response_code(500); // Internal Server Error
    $response['status'] = 'error';
    $response['message'] = 'Database error: ' . $e->getMessage();
}

// Encode the response array into JSON and output it.
echo json_encode($response);
?>
