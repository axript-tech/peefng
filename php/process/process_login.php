<?php
// ------------------------------------------------------
// PEEF Platform - Member Login Processing Script (AJAX)
// ------------------------------------------------------
// This script handles the server-side logic for member
// authentication via an AJAX request.
// ------------------------------------------------------

header('Content-Type: application/json');

require_once '../includes/db_connect.php';
require_once  '../includes/functions.php';
// We'll create a separate session handler for members to keep it clean.
require_once  '../includes/session_member.php'; 

$response = [
    'status' => 'error',
    'message' => 'An unexpected error occurred.'
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $response['message'] = "Email and password are required.";
        echo json_encode($response);
        exit;
    }

    try {
        $sql = "SELECT id, full_name, email, password, role, is_active FROM users WHERE email = :email AND role = 'Member' LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $member = $stmt->fetch();

        if ($member && verify_password($password, $member['password'])) {
            if ($member['is_active']) {
                login_member($member['id'], $member['full_name']);
                
                $response['status'] = 'success';
                $response['message'] = 'Login successful! Redirecting...';
                $response['redirect'] = 'user_dashboard.php';
            } else {
                $response['message'] = 'Your account is currently inactive. Please contact support.';
            }
        } else {
            $response['message'] = "Invalid login credentials. Please try again.";
        }
    } catch (PDOException $e) {
        http_response_code(500);
        $response['message'] = "A database error occurred.";
    }
} else {
    http_response_code(405);
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
exit;
?>
