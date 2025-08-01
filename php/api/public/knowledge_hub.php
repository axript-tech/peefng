<?php
// ------------------------------------------------------
// PEEF Platform - Knowledge Hub API Endpoint
// ------------------------------------------------------
// This script provides a public API to fetch all published
// blog posts and resources for the Knowledge Hub page.
// ------------------------------------------------------

header('Content-Type: application/json');

require_once __DIR__ . '/../../includes/db_connect.php';
require_once __DIR__ . '/../../includes/functions.php';

$response = [
    'status' => 'success',
    'data' => [
        'posts' => [],
        'resources' => []
    ]
];

try {
    // Fetch all published blog posts
    $sql_posts = "SELECT p.id, p.title, p.published_at, u.full_name as author, SUBSTRING(p.content, 1, 150) AS snippet, p.featured_image
                  FROM blog_posts p
                  JOIN users u ON p.author_id = u.id
                  WHERE p.status = 'Published'
                  ORDER BY p.published_at DESC";
    $stmt_posts = $pdo->query($sql_posts);
    $response['data']['posts'] = $stmt_posts->fetchAll(PDO::FETCH_ASSOC);

    // Fetch all resources
    $sql_resources = "SELECT id, title, description, file_type, created_at 
                      FROM resources 
                      ORDER BY created_at DESC";
    $stmt_resources = $pdo->query($sql_resources);
    $response['data']['resources'] = $stmt_resources->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    http_response_code(500); // Internal Server Error
    $response['status'] = 'error';
    $response['message'] = 'Database error: ' . $e->getMessage();
}

// Encode the response array into JSON and output it.
echo json_encode($response);
?>
