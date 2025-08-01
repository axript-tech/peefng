<?php
// ------------------------------------------------------
// PEEF Platform - Gallery Albums API Endpoint (Full CRUD)
// ------------------------------------------------------
// This script provides a secure API to fetch, create,
// update, and delete gallery albums.
// ------------------------------------------------------

header('Content-Type: application/json');

require_once __DIR__ . '/../includes/db_connect.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/session.php';

$response = ['status' => 'error', 'message' => 'An unknown error occurred.'];

if (!is_admin_logged_in()) {
    http_response_code(403);
    $response['message'] = 'Access denied.';
    echo json_encode($response);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    try {
        $sql = "SELECT id, name, description, created_at FROM gallery_albums ORDER BY name ASC";
        $stmt = $pdo->query($sql);
        $albums = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $response = ['status' => 'success', 'data' => $albums];
    } catch (PDOException $e) {
        http_response_code(500);
        $response['message'] = 'Database error: ' . $e->getMessage();
    }
} elseif ($method === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action === 'create' || $action === 'update') {
        $name = sanitize_input($_POST['name']);
        $description = sanitize_input($_POST['description']);
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        if (empty($name)) {
            $response['message'] = 'Album name is required.';
        } else {
            try {
                if ($action === 'update' && $id) {
                    $sql = "UPDATE gallery_albums SET name = ?, description = ? WHERE id = ?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$name, $description, $id]);
                    $response = ['status' => 'success', 'message' => 'Album updated successfully!'];
                } else {
                    $sql = "INSERT INTO gallery_albums (name, description) VALUES (?, ?)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$name, $description]);
                    $response = ['status' => 'success', 'message' => 'Album created successfully!'];
                }
            } catch (PDOException $e) {
                http_response_code(500);
                $response['message'] = 'Database error: ' . $e->getMessage();
            }
        }
    } elseif ($action === 'delete') {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        if ($id) {
            try {
                $stmt = $pdo->prepare("DELETE FROM gallery_albums WHERE id = ?");
                $stmt->execute([$id]);
                $response = ['status' => 'success', 'message' => 'Album deleted successfully.'];
            } catch (PDOException $e) {
                http_response_code(500);
                $response['message'] = 'Database error: ' . $e->getMessage();
            }
        } else {
            $response['message'] = 'Invalid album ID.';
        }
    } else {
        $response['message'] = 'Invalid action specified.';
    }
} else {
    http_response_code(405);
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
?>
