<?php
// ------------------------------------------------------
// PEEF Platform - Gallery API Endpoint (Full CRUD)
// ------------------------------------------------------
// This script provides a secure API to fetch, create,
// update, and delete gallery images.
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
        $sql = "SELECT g.id, g.title, g.description, g.image_path, g.created_at, u.full_name as uploader_name, a.name as album_name, g.album_id 
                FROM gallery_images g
                JOIN users u ON g.uploaded_by = u.id
                LEFT JOIN gallery_albums a ON g.album_id = a.id
                ORDER BY g.created_at DESC";
        $stmt = $pdo->query($sql);
        $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $response = ['data' => $images];
    } catch (PDOException $e) {
        http_response_code(500);
        $response['message'] = 'Database error: ' . $e->getMessage();
    }
} elseif ($method === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action === 'create' || $action === 'update') {
        $title = sanitize_input($_POST['title']);
        $description = sanitize_input($_POST['description']);
        $album_id = filter_input(INPUT_POST, 'album_id', FILTER_SANITIZE_NUMBER_INT);
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $uploader_id = $_SESSION['admin_user_id'];

        $imagePath = $_POST['existing_image_path'] ?? null;
        if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../uploads/gallery/';
            if (!is_dir($uploadDir)) { mkdir($uploadDir, 0755, true); }
            $fileName = 'gallery_' . time() . '_' . basename($_FILES['image_file']['name']);
            $targetPath = $uploadDir . $fileName;
            if (move_uploaded_file($_FILES['image_file']['tmp_name'], $targetPath)) {
                $imagePath = 'uploads/gallery/' . $fileName;
            }
        }

        if (empty($title) || ($action === 'create' && empty($imagePath))) {
            $response['message'] = 'Title and image file are required.';
        } else {
            try {
                if ($action === 'update' && $id) {
                    $sql = "UPDATE gallery_images SET title = ?, description = ?, album_id = ?, image_path = ? WHERE id = ?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$title, $description, $album_id, $imagePath, $id]);
                    $response = ['status' => 'success', 'message' => 'Image updated successfully!'];
                } else {
                    $sql = "INSERT INTO gallery_images (title, description, image_path, album_id, uploaded_by) VALUES (?, ?, ?, ?, ?)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$title, $description, $imagePath, $album_id, $uploader_id]);
                    $response = ['status' => 'success', 'message' => 'Image uploaded successfully!'];
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
                $stmt = $pdo->prepare("DELETE FROM gallery_images WHERE id = ?");
                $stmt->execute([$id]);
                $response = ['status' => 'success', 'message' => 'Image deleted successfully.'];
            } catch (PDOException $e) {
                http_response_code(500);
                $response['message'] = 'Database error: ' . $e->getMessage();
            }
        } else {
            $response['message'] = 'Invalid image ID.';
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
