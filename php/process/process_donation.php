<?php
// ------------------------------------------------------
// PEEF Platform - Donation Processing Script (AJAX Version)
// ------------------------------------------------------
// This script handles the server-side logic for new
// donations via an AJAX request. It validates inputs,
// securely inserts the donation record, and returns a
// JSON response.
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
    $amount = filter_input(INPUT_POST, 'amount', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $fullName = sanitize_input($_POST['full_name']);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    
    // Determine donor type
    $userId = null;
    $donorName = 'Anonymous';
    $donorEmail = null;

    if (!empty($fullName) && !empty($email)) {
        // This is a Guest or Member donation
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $response['message'] = "Invalid email format provided.";
            echo json_encode($response);
            exit;
        }
        $donorName = $fullName;
        $donorEmail = $email;

        // Check if the email belongs to an existing member
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if ($user) {
            $userId = $user['id']; // It's a Member donation
        }
    }

    // --- 2. Validation ---
    if (empty($amount) || !is_numeric($amount) || $amount <= 0) {
        $response['message'] = "Please enter a valid donation amount.";
        echo json_encode($response);
        exit;
    }

    // --- 3. Database Insertion ---
    try {
        // For now, we'll mark the payment as 'Pending'.
        // In a real application, this would be updated by a payment gateway callback.
        $paymentStatus = 'Pending'; 
        $transactionId = 'PEEF-' . time() . '-' . mt_rand(1000, 9999); // Placeholder transaction ID

        $sql = "INSERT INTO donations (user_id, donor_name, donor_email, amount, payment_gateway_txn_id, payment_status) 
                VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $userId,
            $donorName,
            $donorEmail,
            $amount,
            $transactionId,
            $paymentStatus
        ]);

        // --- 4. Prepare Success Response ---
        // In a real application, you might return a payment URL here.
        $formattedAmount = number_format($amount, 2);
        $response['status'] = 'success';
        $response['message'] = "Thank you for your generosity! Your donation of ₦{$formattedAmount} is being processed.";

    } catch (PDOException $e) {
        http_response_code(500); // Internal Server Error
        $response['message'] = "A database error occurred. Please try again later.";
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
