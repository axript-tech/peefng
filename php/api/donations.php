<?php
// ------------------------------------------------------
// PEEF Platform - Donations API Endpoint
// ------------------------------------------------------
// This script provides a secure API to fetch, create,
// update, and delete donation data from the database.
// ------------------------------------------------------

// Set the content type header to JSON.
header('Content-Type: application/json');

// Include all necessary core files.
require_once __DIR__ . '/../includes/db_connect.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/session.php'; // This also starts the session.

// ** Security Check **
if (!is_admin_logged_in()) {
    http_response_code(403); // Forbidden
    echo json_encode(['status' => 'error', 'message' => 'Access denied.']);
    exit;
}

// Initialize the response array.
$response = [
    'status' => 'error',
    'message' => 'An unknown error occurred.'
];

// Handle different request methods
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    // --- HANDLE FETCH (READ) REQUESTS ---
    try {
        $sql = "SELECT 
                    d.id,
                    COALESCE(u.full_name, d.donor_name) AS donor_name,
                    d.donor_email,
                    d.amount,
                    d.payment_status,
                    d.donation_date,
                    d.payment_gateway_txn_id
                FROM donations d
                LEFT JOIN users u ON d.user_id = u.id
                ORDER BY d.donation_date DESC";
        
        $stmt = $pdo->query($sql);
        $donations = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $response['status'] = 'success';
        $response['data'] = $donations;

    } catch (PDOException $e) {
        http_response_code(500);
        $response['message'] = 'Database error: ' . $e->getMessage();
    }

} elseif ($method === 'POST' && isset($_POST['action'])) {
    
    $action = $_POST['action'];

    if ($action === 'create' || $action === 'update') {
        // --- HANDLE CREATE AND UPDATE ---
        $donor_name = sanitize_input($_POST['donor_name']);
        $donor_email = filter_input(INPUT_POST, 'donor_email', FILTER_SANITIZE_EMAIL);
        $amount = filter_input(INPUT_POST, 'amount', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $status = sanitize_input($_POST['payment_status']);
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        if (empty($donor_name) || empty($amount) || empty($status)) {
            $response['message'] = 'Please fill in all required fields.';
        } else {
            try {
                if ($action === 'update') {
                    $sql = "UPDATE donations SET donor_name=?, donor_email=?, amount=?, payment_status=? WHERE id=?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$donor_name, $donor_email, $amount, $status, $id]);
                    $response['message'] = 'Donation updated successfully!';
                } else {
                    $txn_id = 'MANUAL-' . time();
                    $sql = "INSERT INTO donations (donor_name, donor_email, amount, payment_status, payment_gateway_txn_id) VALUES (?, ?, ?, ?, ?)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$donor_name, $donor_email, $amount, $status, $txn_id]);
                    $response['message'] = 'Donation added successfully!';
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
                $sql = "DELETE FROM donations WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$id]);
                if ($stmt->rowCount() > 0) {
                    $response['status'] = 'success';
                    $response['message'] = 'Donation deleted successfully.';
                } else {
                    $response['message'] = 'Donation not found or could not be deleted.';
                }
            } catch (PDOException $e) {
                http_response_code(500);
                $response['message'] = 'Database error: ' . $e->getMessage();
            }
        } else {
            $response['message'] = 'Invalid donation ID.';
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
