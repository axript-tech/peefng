 
<?php
// ------------------------------------------------------
// PEEF Platform - Secure Session Management
// ------------------------------------------------------
// This script handles the creation, management, and
// security of user sessions for the admin panel.
// ------------------------------------------------------

// ** Secure Session Configuration ** //

// Set a custom session name to make it harder for attackers to guess.
session_name('peef_secure_session_id');

// Set session cookie parameters for enhanced security.
$cookieParams = [
    'lifetime' => 0, // Session cookie lasts until the browser is closed.
    'path'     => '/',
    'domain'   => '', // Set your domain in production.
    'secure'   => isset($_SERVER['HTTPS']), // Only send cookie over HTTPS.
    'httponly' => true, // Prevent JavaScript access to the session cookie.
    'samesite' => 'Lax' // Provides some protection against CSRF attacks.
];

session_set_cookie_params($cookieParams);

// Start the session.
session_start();

/**
 * Regenerates the session ID to prevent session fixation attacks.
 * This should be called after any change in privilege level (e.g., after login).
 */
function regenerate_session() {
    // If a session is active, regenerate the ID and delete the old session file.
    if (session_status() == PHP_SESSION_ACTIVE) {
        session_regenerate_id(true);
    }
}

/**
 * Logs in an administrator by setting session variables.
 *
 * @param int $user_id The ID of the admin user.
 * @param string $username The username of the admin user.
 */
function login_admin($user_id, $username) {
    // Regenerate the session ID upon successful login for security.
    regenerate_session();

    // Set session variables to mark the user as logged in.
    $_SESSION['admin_user_id'] = $user_id;
    $_SESSION['admin_username'] = $username;
    $_SESSION['admin_logged_in'] = true;
    $_SESSION['last_activity'] = time(); // Track user activity.
}

/**
 * Logs out the administrator by destroying the session.
 */
function logout_admin() {
    // Unset all session variables.
    $_SESSION = array();

    // Delete the session cookie.
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Destroy the session itself.
    session_destroy();
}

/**
 * Checks if an administrator is currently logged in.
 *
 * @return bool True if logged in, false otherwise.
 */
function is_admin_logged_in() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

?>
