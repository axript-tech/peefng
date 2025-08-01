<?php
// ------------------------------------------------------
// PEEF Platform - Events API Endpoint (Full CRUD)
// ------------------------------------------------------
// This script provides a secure API to fetch, create,
// update, and delete event data from the database.
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
        $sql = "SELECT id, title, description, start_datetime, end_datetime, location, poster_image FROM events ORDER BY start_datetime DESC";
        $stmt = $pdo->query($sql);
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($events as &$event) {
            $tier_stmt = $pdo->prepare("SELECT tier_name, cost FROM event_participation_tiers WHERE event_id = ?");
            $tier_stmt->execute([$event['id']]);
            $event['tiers'] = $tier_stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        $response = ['data' => $events];
    } catch (PDOException $e) {
        http_response_code(500);
        $response['message'] = 'Database error: ' . $e->getMessage();
    }
} elseif ($method === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action === 'create' || $action === 'update') {
        $title = sanitize_input($_POST['title']);
        $description = sanitize_input($_POST['description']);
        $start_datetime = str_replace('T', ' ', $_POST['start_datetime']);
        $end_datetime = str_replace('T', ' ', $_POST['end_datetime']);
        $location = sanitize_input($_POST['location']);
        $created_by = $_SESSION['admin_user_id'];
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        
        $posterPath = $_POST['existing_poster'] ?? null;
        if (isset($_FILES['poster_image']) && $_FILES['poster_image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../uploads/events/';
            if (!is_dir($uploadDir)) { mkdir($uploadDir, 0755, true); }
            $fileName = 'event_' . time() . '_' . basename($_FILES['poster_image']['name']);
            $targetPath = $uploadDir . $fileName;
            if (move_uploaded_file($_FILES['poster_image']['tmp_name'], $targetPath)) {
                $posterPath = 'uploads/events/' . $fileName;
            }
        }

        try {
            $pdo->beginTransaction();
            if ($action === 'update' && $id) {
                $sql = "UPDATE events SET title=?, description=?, start_datetime=?, end_datetime=?, location=?, poster_image=? WHERE id=?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$title, $description, $start_datetime, $end_datetime, $location, $posterPath, $id]);
                
                // Clear old tiers before adding new ones
                $stmt = $pdo->prepare("DELETE FROM event_participation_tiers WHERE event_id = ?");
                $stmt->execute([$id]);
                
                $response['message'] = 'Event updated successfully!';
            } else {
                $sql = "INSERT INTO events (title, description, start_datetime, end_datetime, location, created_by, poster_image) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$title, $description, $start_datetime, $end_datetime, $location, $created_by, $posterPath]);
                $id = $pdo->lastInsertId();
                $response['message'] = 'Event created successfully!';
            }

            // Insert ticket tiers
            if (isset($_POST['tier_name']) && is_array($_POST['tier_name'])) {
                $tierSql = "INSERT INTO event_participation_tiers (event_id, tier_name, cost) VALUES (?, ?, ?)";
                $tierStmt = $pdo->prepare($tierSql);
                for ($i = 0; $i < count($_POST['tier_name']); $i++) {
                    $tier_name = sanitize_input($_POST['tier_name'][$i]);
                    $cost = filter_var($_POST['tier_cost'][$i], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    if (!empty($tier_name) && is_numeric($cost)) {
                        $tierStmt->execute([$id, $tier_name, $cost]);
                    }
                }
            }
            
            $pdo->commit();
            $response['status'] = 'success';

        } catch (PDOException $e) {
            $pdo->rollBack();
            http_response_code(500);
            $response['message'] = 'Database error: ' . $e->getMessage();
        }
    } elseif ($action === 'delete') {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        if ($id) {
            try {
                $stmt = $pdo->prepare("DELETE FROM events WHERE id = ?");
                $stmt->execute([$id]);
                $response = ['status' => 'success', 'message' => 'Event deleted successfully.'];
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
}

echo json_encode($response);
?>
