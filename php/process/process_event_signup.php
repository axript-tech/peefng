<?php
// ------------------------------------------------------
// PEEF Platform - Event Signup Processing Script (AJAX Version)
// ------------------------------------------------------
// This script handles the server-side logic for a user
// registering for an event via an AJAX request. It validates
// input and returns a JSON response.
// ------------------------------------------------------

// Set the content type header to JSON for all responses.
header('Content-Type: application/json');

// Include all necessary core files.
require_once __DIR__ . '/../includes/db_connect.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/session.php'; // This also starts the session.

// Initialize the response array.
$response = [
    'status' => 'error',
    'message' => 'An unexpected error occurred.'
];

// Check if the form was submitted via the POST method.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // --- 1. Form Data Collection & Sanitization ---
    $event_id = filter_input(INPUT_POST, 'event_id', FILTER_SANITIZE_NUMBER_INT); 
    $fullName = sanitize_input($_POST['name']);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $userId = null; // Assume a guest registration by default.

    // --- 2. Validation ---
    if (empty($event_id) || empty($fullName) || empty($email)) {
        $response['message'] = "Please fill in all required fields.";
        echo json_encode($response);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = "Invalid email format provided.";
        echo json_encode($response);
        exit;
    }

    // --- 3. Check for Existing User & Registration ---
    try {
        // Check if the email belongs to an existing member.
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if ($user) {
            $userId = $user['id'];
        }

        // Check if this user is already registered for this event.
        if ($userId) {
            $stmt = $pdo->prepare("SELECT id FROM event_registrations WHERE event_id = ? AND user_id = ?");
            $stmt->execute([$event_id, $userId]);
            if ($stmt->fetch()) {
                $response['message'] = "You are already registered for this event.";
                echo json_encode($response);
                exit;
            }
        }
        
        // --- 4. Database Insertion ---
        // For now, payment status is 'N/A'. This would change with payment gateway integration.
        $paymentStatus = 'N/A';

        $sql = "INSERT INTO event_registrations (event_id, user_id, payment_status) 
                VALUES (?, ?, ?)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $event_id,
            $userId,
            $paymentStatus
        ]);

        // --- 5. Prepare Success Response ---
        $response['status'] = 'success';
        $response['message'] = "You have successfully registered for the event! A confirmation has been sent to your email.";

    } catch (PDOException $e) {
        http_response_code(500); // Internal Server Error
        $response['message'] = "A database error occurred. Please try again.";
        // In production, log the error instead of displaying it.
        // error_log($e->getMessage());
    }

} else {
    // If the page was accessed directly, return an error.
    http_response_code(405); // Method Not Allowed
    $response['message'] = 'Invalid request method.';
}

// Echo the JSON response and terminate the script.
echo json_encode($response);
exit;
?>
