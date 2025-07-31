 
<?php
// ------------------------------------------------------
// PEEF Platform - Admin Login Processing Script
// ------------------------------------------------------
// This script handles the server-side logic for admin
// authentication. It validates credentials, sets up a
// secure session, and redirects accordingly.
// ------------------------------------------------------

// Include all necessary core files.
// The paths are relative to this file's location in the /admin/ directory.
require_once __DIR__ . '/../php/includes/db_connect.php';
require_once __DIR__ . '/../php/includes/functions.php';
require_once __DIR__ . '/../php/includes/session.php'; // This also starts the session.

// Check if the form was submitted via the POST method.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Sanitize and retrieve form data.
    $email = sanitize_input($_POST['email']);
    $password = $_POST['password']; // Password should not be sanitized with htmlspecialchars.

    // Basic validation.
    if (empty($email) || empty($password)) {
        $_SESSION['error_message'] = "Email and password are required.";
        redirect('index.php');
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
            
            // 5. Redirect to the secure dashboard.
            redirect('dashboard.php');
            
        } else {
            // Invalid credentials (user not found, not an admin, or wrong password).
            $_SESSION['error_message'] = "Invalid login credentials. Please try again.";
            redirect('index.php');
        }

    } catch (PDOException $e) {
        // Handle potential database errors.
        // In a production environment, this should be logged, not displayed.
        $_SESSION['error_message'] = "A database error occurred. Please try again later.";
        // error_log($e->getMessage()); // Example of logging
        redirect('index.php');
    }

} else {
    // If the page was accessed directly without a POST request, redirect to the login page.
    redirect('index.php');
}
?>
