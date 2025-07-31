<?php
// ------------------------------------------------------
// PEEF Platform - Member Logout Script
// ------------------------------------------------------
// This script securely destroys a member's session and
// redirects them to the homepage.
// ------------------------------------------------------

// Start the session to access session variables.
// In a real application, you would have a dedicated session config file.
session_name('peef_member_session');
session_start();

// Unset all of the session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();

// Redirect to the homepage after logout.
header("Location: index.php");
exit;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logging Out... - PEEF</title>
    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            background-color: #f7fafc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #1a202c;
        }
        .container {
            text-align: center;
        }
        .spinner {
            border: 4px solid rgba(0, 0, 0, 0.1);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border-left-color: #044F04;
            animation: spin 1s ease infinite;
            margin: 0 auto 20px;
        }
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="spinner"></div>
        <p>You are being logged out. Redirecting...</p>
    </div>
</body>
</html>
