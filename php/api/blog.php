<?php
// ------------------------------------------------------
// PEEF Platform - Blog API Endpoint (Full CRUD)
// ------------------------------------------------------
// This script provides a secure API to fetch, create,
// update, and delete blog post data.
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
        $sql = "SELECT p.id, p.title, u.full_name AS author, c.name AS category, c.id as category_id, p.status, p.published_at, p.featured_image, p.content, SUBSTRING(p.content, 1, 400) AS snippet
                FROM blog_posts p
                JOIN users u ON p.author_id = u.id
                LEFT JOIN blog_categories c ON p.category_id = c.id
                ORDER BY p.published_at DESC";
        $stmt = $pdo->query($sql);
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(['data' => $posts]); // DataTables expects a "data" key
    } catch (PDOException $e) {
        http_response_code(500);
        $response['message'] = 'Database error: ' . $e->getMessage();
        echo json_encode($response);
    }
} elseif ($method === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action === 'create' || $action === 'update') {
        $title = sanitize_input($_POST['title']);
        $content = $_POST['content'];
        $category_id = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_NUMBER_INT);
        $status = sanitize_input($_POST['status']);
        $author_id = $_SESSION['admin_user_id'];
        
        // --- File Upload Handling ---
        $featuredImagePath = $_POST['existing_image'] ?? null;
        if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../uploads/blog/';
            if (!is_dir($uploadDir)) { mkdir($uploadDir, 0755, true); }
            $fileName = 'post_' . time() . '_' . basename($_FILES['featured_image']['name']);
            $targetPath = $uploadDir . $fileName;
            if (move_uploaded_file($_FILES['featured_image']['tmp_name'], $targetPath)) {
                $featuredImagePath = 'uploads/blog/' . $fileName;
            }
        }

        try {
            if ($action === 'update') {
                $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
                $sql = "UPDATE blog_posts SET title = ?, content = ?, category_id = ?, status = ?, featured_image = ? WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$title, $content, $category_id, $status, $featuredImagePath, $id]);
                $response = ['status' => 'success', 'message' => 'Post updated successfully!'];
            } else {
                $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
                $published_at = ($status == 'Published') ? date('Y-m-d H:i:s') : null;
                $sql = "INSERT INTO blog_posts (title, slug, content, author_id, category_id, status, featured_image, published_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$title, $slug, $content, $author_id, $category_id, $status, $featuredImagePath, $published_at]);
                $response = ['status' => 'success', 'message' => 'Post created successfully!'];
            }
        } catch (PDOException $e) {
            http_response_code(500);
            $response['message'] = 'Database error: ' . $e->getMessage();
        }
    } elseif ($action === 'delete') {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        try {
            $stmt = $pdo->prepare("DELETE FROM blog_posts WHERE id = ?");
            $stmt->execute([$id]);
            $response = ['status' => 'success', 'message' => 'Post deleted successfully.'];
        } catch (PDOException $e) {
            http_response_code(500);
            $response['message'] = 'Database error: ' . $e->getMessage();
        }
    } else {
        $response['message'] = 'Invalid action specified.';
    }
    echo json_encode($response);
}
?>
