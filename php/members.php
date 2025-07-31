<?php
// ------------------------------------------------------
// PEEF Platform - Members API Endpoint
// ------------------------------------------------------
// This script provides a secure API to fetch, create,
// and delete member data from the database.
// Access is restricted to authenticated administrators.
//
// --- FIX FOR DATABASE ERROR ---
// The error "Integrity constraint violation: 1452" means the `membership_tiers` table is empty.
// Run the following SQL commands in your `peef_db` database to add the necessary tiers.
/*
INSERT INTO `membership_tiers` (`id`, `name`, `price`, `duration_days`, `description`) VALUES
(1, 'Basic', 15000.00, 365, 'Access to newsletter and public resources.'),
(2, 'Premium', 50000.00, 365, 'All Basic benefits plus premium resources and event discounts.'),
(3, 'Donor', 100000.00, 365, 'All Premium benefits plus special recognition and VIP access.');
*/
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
        $sql = "SELECT u.id, u.full_name, u.email, u.phone_number, mt.name as membership_tier, u.is_active
                FROM users u
                LEFT JOIN membership_tiers mt ON u.membership_tier_id = mt.id
                WHERE u.role = 'Member' 
                ORDER BY u.full_name ASC";
        
        $stmt = $pdo->query($sql);
        $members = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $response['status'] = 'success';
        $response['data'] = $members;

    } catch (PDOException $e) {
        http_response_code(500);
        $response['message'] = 'Database error: ' . $e->getMessage();
    }

} elseif ($method === 'POST' && isset($_POST['action'])) {
    
    if ($_POST['action'] === 'create') {
        // --- HANDLE CREATE REQUEST ---
        $fullName = sanitize_input($_POST['full_name']);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $phone = sanitize_input($_POST['phone_number']);
        $tierId = filter_input(INPUT_POST, 'membership_tier', FILTER_SANITIZE_NUMBER_INT);
        $password = $_POST['password'];

        if (empty($fullName) || empty($email) || empty($password) || empty($tierId)) {
            $response['message'] = 'Please fill in all required fields.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $response['message'] = 'Invalid email format.';
        } else {
            try {
                // Check if email already exists
                $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
                $stmt->execute([$email]);
                if ($stmt->fetch()) {
                    $response['message'] = 'A member with this email already exists.';
                } else {
                    $hashedPassword = hash_password($password);
                    $sql = "INSERT INTO users (full_name, email, phone_number, password, role, membership_tier_id, is_active) VALUES (?, ?, ?, ?, 'Member', ?, 1)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$fullName, $email, $phone, $hashedPassword, $tierId]);
                    
                    $response['status'] = 'success';
                    $response['message'] = 'New member added successfully!';
                }
            } catch (PDOException $e) {
                http_response_code(500);
                $response['message'] = 'Database error: ' . $e->getMessage();
            }
        }
    } elseif ($_POST['action'] === 'delete') {
        // --- HANDLE DELETE REQUEST ---
        $memberId = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        if ($memberId) {
            try {
                $sql = "DELETE FROM users WHERE id = ? AND role = 'Member'";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$memberId]);

                if ($stmt->rowCount() > 0) {
                    $response['status'] = 'success';
                    $response['message'] = 'Member deleted successfully.';
                } else {
                    $response['message'] = 'Member not found or could not be deleted.';
                }
            } catch (PDOException $e) {
                http_response_code(500);
                $response['message'] = 'Database error: ' . $e->getMessage();
            }
        } else {
            $response['message'] = 'Invalid member ID provided.';
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
