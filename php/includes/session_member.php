<?php
// ------------------------------------------------------
// PEEF Platform - Secure Member Session Management
// ------------------------------------------------------
// This script handles sessions specifically for public-
// facing members, keeping them separate from admin sessions.
// ------------------------------------------------------

session_name('peef_member_session_id');

$cookieParams = [
    'lifetime' => 0,
    'path'     => '/',
    'domain'   => '',
    'secure'   => isset($_SERVER['HTTPS']),
    'httponly' => true,
    'samesite' => 'Lax'
];

session_set_cookie_params($cookieParams);
session_start();

function regenerate_member_session() {
    if (session_status() == PHP_SESSION_ACTIVE) {
        session_regenerate_id(true);
    }
}

function login_member($user_id, $username) {
    regenerate_member_session();
    $_SESSION['member_user_id'] = $user_id;
    $_SESSION['member_username'] = $username;
    $_SESSION['member_logged_in'] = true;
}

function logout_member() {
    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();
}

function is_member_logged_in() {
    return isset($_SESSION['member_logged_in']) && $_SESSION['member_logged_in'] === true;
}
?>
