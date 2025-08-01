<?php
// ------------------------------------------------------
// PEEF Platform - Gallery Albums API Endpoint
// ------------------------------------------------------
// This script fetches all gallery albums for public display.
// ------------------------------------------------------

header('Content-Type: application/json');

require_once __DIR__ . '/../includes/db_connect.php';
require_once __DIR__ . '/../includes/functions.php';

$response = ['status' => 'error', 'message' => 'An unknown error occurred.'];

try {
    $sql = "SELECT id, name, slug FROM gallery_albums ORDER BY name ASC";
    $stmt = $pdo->query($sql);
    $albums = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $response = ['status' => 'success', 'data' => $albums];
} catch (PDOException $e) {
    http_response_code(500);
    $response['message'] = 'Database error: ' . $e->getMessage();
}

echo json_encode($response);
?>
