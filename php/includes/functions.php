 
<?php
// ------------------------------------------------------
// PEEF Platform - Core Functions Library
// ------------------------------------------------------
// This file contains essential helper functions that are
// used across the entire web application to perform
// common and repetitive tasks.
// ------------------------------------------------------

// Include the configuration file to access site settings.
require_once __DIR__ . '/../../config.php';

/**
 * Sanitizes user input to prevent XSS attacks.
 *
 * This function should be used on any data that is outputted to the browser.
 *
 * @param string $data The raw data to sanitize.
 * @return string The sanitized data.
 */
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

/**
 * Redirects the user to a specified URL.
 *
 * @param string $url The URL to redirect to.
 */
function redirect($url) {
    header("Location: " . $url);
    exit();
}

/**
 * Checks if a user is logged in as an administrator.
 * If not, it redirects them to the admin login page.
 *
 * This function should be called at the top of every secure admin page.
 */
function ensure_admin_is_logged_in() {
    // Session management logic will be added in session.php
    // For now, this is a placeholder.
    if (!isset($_SESSION['admin_user_id'])) {
        redirect('index.php');
    }
}

/**
 * Formats a date string into a more readable format.
 *
 * @param string $date_string The date string from the database (e.g., '2025-10-25 09:00:00').
 * @param string $format The desired output format (e.g., 'F j, Y').
 * @return string The formatted date.
 */
function format_date($date_string, $format = 'F j, Y') {
    $date = new DateTime($date_string);
    return $date->format($format);
}

/**
 * Generates a secure hash for a password.
 *
 * @param string $password The plain-text password.
 * @return string The hashed password.
 */
function hash_password($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

/**
 * Verifies a plain-text password against a hash.
 *
 * @param string $password The plain-text password.
 * @param string $hash The hash from the database.
 * @return bool True if the password matches, false otherwise.
 */
function verify_password($password, $hash) {
    return password_verify($password, $hash);
}

/**
 * Displays a formatted error or success message.
 *
 * @param string $message The message to display.
 * @param string $type The type of message ('success' or 'error').
 */
function display_message($message, $type = 'error') {
    if ($type === 'success') {
        echo '<div class="alert alert-success">' . sanitize_input($message) . '</div>';
    } else {
        echo '<div class="alert alert-danger">' . sanitize_input($message) . '</div>';
    }
}

?>
