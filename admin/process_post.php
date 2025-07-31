<?php
// ------------------------------------------------------
// PEEF Platform - Blog Post Processing Script (AJAX Version)
// ------------------------------------------------------
// This script handles Create, Update, and Delete (CUD)
// operations for blog posts via AJAX requests and returns
// a JSON response.
//
// --- FIX FOR DATABASE ERROR ---
// The error "Integrity constraint violation: 1452" means the `blog_categories` table is empty.
// Run the following SQL commands in your `peef_db` database to add the necessary categories.
/*
INSERT INTO `blog_categories` (`id`, `name`, `slug`) VALUES
(1, 'Workforce Development', 'workforce-development'),
(2, 'Technology', 'technology'),
(3, 'Announcements', 'announcements');
*/
// ------------------------------------------------------

// Set the content type header to JSON for all responses.
header('Content-Type: application/json');

require_once __DIR__ . '/../php/includes/db_connect.php';
require_once __DIR__ . '/../php/includes/functions.php';
require_once __DIR__ . '/../php/includes/session.php';

// Initialize the response array.
$response = [
    'status' => 'error',
    'message' => 'An unexpected error occurred.'
];

// Secure this script - only admins can perform these actions.
if (!is_admin_logged_in()) {
    http_response_code(403); // Forbidden
    $response['message'] = 'Authentication required.';
    echo json_encode($response);
    exit;
}

// --- HANDLE CREATE AND UPDATE ---
if (isset($_POST['title'])) { // Check for a key field from the form

    // 1. Sanitize and retrieve form data
    $post_id = filter_input(INPUT_POST, 'post_id', FILTER_SANITIZE_NUMBER_INT);
    $title = sanitize_input($_POST['title']);
    $content = $_POST['content']; // CKEditor provides clean HTML. Consider HTML Purifier for extra security.
    $category_id = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_NUMBER_INT);
    $status = sanitize_input($_POST['status']);
    $author_id = $_SESSION['admin_user_id'];

    // 2. Handle Featured Image Upload
    $featuredImagePath = null;
    if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../uploads/blog/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $fileName = 'post_' . time() . '_' . basename($_FILES['featured_image']['name']);
        $targetPath = $uploadDir . $fileName;

        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (in_array($_FILES['featured_image']['type'], $allowedTypes)) {
            if (move_uploaded_file($_FILES['featured_image']['tmp_name'], $targetPath)) {
                $featuredImagePath = 'uploads/blog/' . $fileName;
            } else {
                $response['message'] = 'Failed to move uploaded file.';
                echo json_encode($response);
                exit;
            }
        } else {
            $response['message'] = 'Invalid file type for featured image.';
            echo json_encode($response);
            exit;
        }
    }

    try {
        if (!empty($post_id)) {
            // --- UPDATE EXISTING POST ---
            $sql = "UPDATE blog_posts SET title = ?, content = ?, category_id = ?, status = ?";
            $params = [$title, $content, $category_id, $status];

            if ($featuredImagePath) {
                $sql .= ", featured_image = ?";
                $params[] = $featuredImagePath;
            }

            $sql .= " WHERE id = ?";
            $params[] = $post_id;

            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            $response['status'] = 'success';
            $response['message'] = "Post updated successfully!";

        } else {
            // --- CREATE NEW POST ---
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
            $published_at = ($status == 'Published') ? date('Y-m-d H:i:s') : null;

            $sql = "INSERT INTO blog_posts (title, slug, content, author_id, category_id, status, featured_image, published_at) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$title, $slug, $content, $author_id, $category_id, $status, $featuredImagePath, $published_at]);
            $response['status'] = 'success';
            $response['message'] = "Post created successfully!";
        }
        
    } catch (PDOException $e) {
        http_response_code(500);
        $response['message'] = "Database error: " . $e->getMessage();
        // error_log($e->getMessage());
    }

    echo json_encode($response);
    exit;
}

// --- HANDLE DELETE ---
if (isset($_POST['action']) && $_POST['action'] == 'delete' && isset($_POST['id'])) {
    $post_id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

    try {
        // First, get the featured image path to delete the file
        $stmt = $pdo->prepare("SELECT featured_image FROM blog_posts WHERE id = ?");
        $stmt->execute([$post_id]);
        $post = $stmt->fetch();

        if ($post && !empty($post['featured_image'])) {
            $filePath = __DIR__ . '/../' . $post['featured_image'];
            if (file_exists($filePath)) {
                unlink($filePath); // Delete the image file
            }
        }

        // Now, delete the post from the database
        $stmt = $pdo->prepare("DELETE FROM blog_posts WHERE id = ?");
        $stmt->execute([$post_id]);

        $response['status'] = 'success';
        $response['message'] = "Post deleted successfully.";

    } catch (PDOException $e) {
        http_response_code(500);
        $response['message'] = "Database error: " . $e->getMessage();
    }
    
    echo json_encode($response);
    exit;
}

// If no valid action is found, return an error.
http_response_code(400); // Bad Request
$response['message'] = 'Invalid request.';
echo json_encode($response);
?>
