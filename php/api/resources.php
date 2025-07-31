<?php
// ------------------------------------------------------
// PEEF Platform - Resources API Endpoint
// ------------------------------------------------------
// This script provides a secure API to fetch, create,
// update, and delete downloadable resources.
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
        $sql = "SELECT r.id, r.title, r.description, r.file_path, r.file_type, r.created_at, u.full_name as uploader_name 
                FROM resources r
                JOIN users u ON r.uploaded_by = u.id
                ORDER BY r.created_at DESC";
        $stmt = $pdo->query($sql);
        $resources = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $response = ['data' => $resources];
    } catch (PDOException $e) {
        http_response_code(500);
        $response['message'] = 'Database error: ' . $e->getMessage();
    }
} elseif ($method === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action === 'create' || $action === 'update') {
        $title = sanitize_input($_POST['title']);
        $description = sanitize_input($_POST['description']);
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $uploader_id = $_SESSION['admin_user_id'];

        $filePath = $_POST['existing_file_path'] ?? null;
        $fileType = $_POST['existing_file_type'] ?? null;

        if (isset($_FILES['resource_file']) && $_FILES['resource_file']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../uploads/resources/';
            if (!is_dir($uploadDir)) { mkdir($uploadDir, 0755, true); }
            
            $fileName = 'resource_' . time() . '_' . basename($_FILES['resource_file']['name']);
            $targetPath = $uploadDir . $fileName;
            
            if (move_uploaded_file($_FILES['resource_file']['tmp_name'], $targetPath)) {
                $filePath = 'uploads/resources/' . $fileName;
                $fileType = $_FILES['resource_file']['type'];
            }
        }

        if (empty($title) || empty($filePath)) {
            $response['message'] = 'Title and file are required.';
        } else {
            try {
                if ($action === 'update' && $id) {
                    $sql = "UPDATE resources SET title = ?, description = ?, file_path = ?, file_type = ? WHERE id = ?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$title, $description, $filePath, $fileType, $id]);
                    $response = ['status' => 'success', 'message' => 'Resource updated successfully!'];
                } else {
                    $sql = "INSERT INTO resources (title, description, file_path, file_type, uploaded_by) VALUES (?, ?, ?, ?, ?)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$title, $description, $filePath, $fileType, $uploader_id]);
                    $response = ['status' => 'success', 'message' => 'Resource uploaded successfully!'];
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
                $stmt = $pdo->prepare("DELETE FROM resources WHERE id = ?");
                $stmt->execute([$id]);
                $response = ['status' => 'success', 'message' => 'Resource deleted successfully.'];
            } catch (PDOException $e) {
                http_response_code(500);
                $response['message'] = 'Database error: ' . $e->getMessage();
            }
        } else {
            $response['message'] = 'Invalid resource ID.';
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
