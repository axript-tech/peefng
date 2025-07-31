<?php
// ------------------------------------------------------
// PEEF Platform - Dashboard API Endpoint
// ------------------------------------------------------
// This script provides a secure API to fetch all necessary
// summary data for the admin dashboard in a single request.
// Access is restricted to authenticated administrators.
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
    'status' => 'success',
    'data' => [
        'stats' => [],
        'charts' => [],
        'recent_activity' => []
    ]
];

try {
    // --- 1. Fetch Summary Stats ---
    $response['data']['stats']['total_members'] = $pdo->query("SELECT count(id) FROM users WHERE role = 'Member'")->fetchColumn();
    $response['data']['stats']['total_donations'] = $pdo->query("SELECT SUM(amount) FROM donations WHERE payment_status = 'Completed'")->fetchColumn();
    $response['data']['stats']['upcoming_events'] = $pdo->query("SELECT count(id) FROM events WHERE start_datetime > NOW()")->fetchColumn();
    $response['data']['stats']['blog_posts'] = $pdo->query("SELECT count(id) FROM blog_posts")->fetchColumn();

    // --- 2. Fetch Chart Data (Member Growth - Last 6 Months) ---
    $memberGrowthQuery = "SELECT DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(id) as new_members 
                          FROM users 
                          WHERE role = 'Member' AND created_at >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
                          GROUP BY month 
                          ORDER BY month ASC";
    $stmt = $pdo->query($memberGrowthQuery);
    $response['data']['charts']['member_growth'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // --- 3. Fetch Chart Data (Donations - Last 6 Months) ---
    $donationQuery = "SELECT DATE_FORMAT(donation_date, '%Y-%m') as month, SUM(amount) as total_donations
                      FROM donations 
                      WHERE payment_status = 'Completed' AND donation_date >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
                      GROUP BY month 
                      ORDER BY month ASC";
    $stmt = $pdo->query($donationQuery);
    $response['data']['charts']['donations'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // --- 4. Fetch Recent Activity ---
    // This is a simplified example. A real activity log would be more complex.
    $activityQuery = "SELECT 'New Member' as action, full_name as detail, created_at as date FROM users WHERE role = 'Member' ORDER BY created_at DESC LIMIT 2";
    $stmt = $pdo->query($activityQuery);
    $response['data']['recent_activity'] = array_merge($response['data']['recent_activity'], $stmt->fetchAll(PDO::FETCH_ASSOC));
    
    $activityQuery = "SELECT 'New Donation' as action, CONCAT(donor_name, ' (₦', FORMAT(amount, 0), ')') as detail, donation_date as date FROM donations WHERE payment_status = 'Completed' ORDER BY donation_date DESC LIMIT 2";
    $stmt = $pdo->query($activityQuery);
    $response['data']['recent_activity'] = array_merge($response['data']['recent_activity'], $stmt->fetchAll(PDO::FETCH_ASSOC));

    // Sort combined activity by date
    usort($response['data']['recent_activity'], function($a, $b) {
        return strtotime($b['date']) - strtotime($a['date']);
    });
    $response['data']['recent_activity'] = array_slice($response['data']['recent_activity'], 0, 4);


} catch (PDOException $e) {
    http_response_code(500); // Internal Server Error
    $response['status'] = 'error';
    $response['message'] = 'Database error: ' . $e->getMessage();
}

// Encode the response array into JSON and output it.
echo json_encode($response);
?>
