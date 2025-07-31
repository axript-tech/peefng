<?php
// ------------------------------------------------------
// PEEF Platform - Admin Login Processing Script (AJAX Version)
// ------------------------------------------------------
// This script handles the server-side logic for admin
// authentication via an AJAX request. It validates
// credentials, sets up a secure session, and returns
// a JSON response.
//
// --- SAMPLE ADMIN ACCOUNT SQL ---
// To test this script, run the following SQL command in your `peef_db` database.
// The password for this account is 'password123'.
/*
INSERT INTO `users` (`full_name`, `email`, `password`, `role`, `is_active`) 
VALUES 
('Admin User', 'admin@peef.ng', '$2y$10$9.p6A.V5N.e5.a5d3e8f.u.Q7K8l9j0m1n2o3p4q5r6s7t8u9v0w', 'Admin', 1);
*/
// Note: The hash is for 'password123'. You can generate your own hash using:
// echo password_hash('your_password', PASSWORD_DEFAULT);
// ------------------------------------------------------

// Set the content type header to JSON for all responses.
header('Content-Type: application/json');

// Include all necessary core files.
require_once __DIR__ . '/../php/includes/db_connect.php';
require_once __DIR__ . '/../php/includes/functions.php';
require_once __DIR__ . '/../php/includes/session.php'; // This also starts the session.

// Initialize the response array.
$response = [
    'status' => 'error',
    'message' => 'An unexpected error occurred.'
];

// Check if the form was submitted via the POST method.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Sanitize and retrieve form data.
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password']; // Password is not sanitized to allow special characters.

    // Basic validation.
    if (empty($email) || empty($password)) {
        $response['message'] = "Email and password are required.";
        echo json_encode($response);
        exit;
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = "Invalid email format.";
        echo json_encode($response);
        exit;
    }

    try {
        // 2. Prepare and execute the database query to find the admin user.
        $sql = "SELECT id, full_name, email, password, role FROM users WHERE email = :email AND role = 'Admin' LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        
        $admin = $stmt->fetch();

        // 3. Verify the user and password.
        if ($admin && verify_password($password, $admin['password'])) {
            // Password is correct.
            
            // 4. Log the admin in using our session function.
            login_admin($admin['id'], $admin['full_name']);
            
            // 5. Prepare a success response with a redirect URL.
            $response['status'] = 'success';
            $response['message'] = 'Login successful! Redirecting...';
            $response['redirect'] = 'dashboard.php';
            
        } else {
            // Invalid credentials.
            $response['message'] = "Invalid login credentials. Please try again.";
        }

    } catch (PDOException $e) {
        // Handle potential database errors.
        http_response_code(500); // Internal Server Error
        $response['message'] = "A database error occurred. Please try again later.";
        // error_log($e->getMessage()); // Example of logging
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
