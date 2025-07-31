<?php
// ------------------------------------------------------
// PEEF Platform - Events API Endpoint
// ------------------------------------------------------
// This script provides a secure API to fetch, create,
// update, and delete event data from the database.
// ------------------------------------------------------

// Set the content type header to JSON.
header('Content-Type: application/json');

// Include all necessary core files.
require_once __DIR__ . '/../includes/db_connect.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/session.php'; // This also starts the session.

// Initialize the response array.
$response = [
    'status' => 'error',
    'message' => 'An unknown error occurred.'
];

// ** Security Check **
// Only allow GET requests for public viewing. POST for modifications requires admin login.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !is_admin_logged_in()) {
    http_response_code(403); // Forbidden
    $response['message'] = 'Access denied.';
    echo json_encode($response);
    exit;
}


// Handle different request methods
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    // --- HANDLE FETCH (READ) REQUESTS ---
    try {
        $sql = "SELECT id, title, description, start_datetime, end_datetime, location, ticket_price, poster_image 
                FROM events 
                ORDER BY start_datetime DESC";
        
        $stmt = $pdo->query($sql);
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $response['status'] = 'success';
        $response['data'] = $events;

    } catch (PDOException $e) {
        http_response_code(500);
        $response['message'] = 'Database error: ' . $e->getMessage();
    }

} elseif ($method === 'POST' && isset($_POST['action'])) {

    $action = $_POST['action'];
    
    if ($action === 'create' || $action === 'update') {
        // --- HANDLE CREATE AND UPDATE ---
        $title = sanitize_input($_POST['title']);
        $description = sanitize_input($_POST['description']);
        $start_datetime = str_replace('T', ' ', $_POST['start_datetime']);
        $end_datetime = str_replace('T', ' ', $_POST['end_datetime']);
        $location = sanitize_input($_POST['location']);
        $ticket_price = filter_input(INPUT_POST, 'ticket_price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $created_by = $_SESSION['admin_user_id'];
        
        if (empty($title) || empty($description) || empty($start_datetime)) {
            $response['message'] = 'Please fill in all required fields.';
        } else {
            try {
                if ($action === 'update') {
                    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
                    $sql = "UPDATE events SET title=?, description=?, start_datetime=?, end_datetime=?, location=?, ticket_price=? WHERE id=?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$title, $description, $start_datetime, $end_datetime, $location, $ticket_price, $id]);
                    $response['message'] = 'Event updated successfully!';
                } else {
                    $sql = "INSERT INTO events (title, description, start_datetime, end_datetime, location, ticket_price, created_by) VALUES (?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$title, $description, $start_datetime, $end_datetime, $location, $ticket_price, $created_by]);
                    $response['message'] = 'Event created successfully!';
                }
                $response['status'] = 'success';
            } catch (PDOException $e) {
                http_response_code(500);
                $response['message'] = 'Database error: ' . $e->getMessage();
            }
        }
    } elseif ($action === 'delete') {
        // --- HANDLE DELETE REQUEST ---
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        if ($id) {
            try {
                $sql = "DELETE FROM events WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$id]);
                if ($stmt->rowCount() > 0) {
                    $response['status'] = 'success';
                    $response['message'] = 'Event deleted successfully.';
                } else {
                    $response['message'] = 'Event not found or could not be deleted.';
                }
            } catch (PDOException $e) {
                http_response_code(500);
                $response['message'] = 'Database error: ' . $e->getMessage();
            }
        } else {
            $response['message'] = 'Invalid event ID.';
        }
    } else {
        $response['message'] = 'Invalid action specified.';
    }

} else {
    http_response_code(405); // Method Not Allowed
    $response['message'] = 'Invalid request method.';
}

// Encode the response array into JSON and output it.
echo json_encode($response);
?>
