 
<?php
// ------------------------------------------------------
// PEEF Platform - Database Connection Script
// ------------------------------------------------------
// This script uses the credentials from config.php to
// establish a secure connection to the MySQL database
// using PDO (PHP Data Objects).
// ------------------------------------------------------

// Include the configuration file.
// The path assumes this file is in /php/includes/ and config.php is in the root.
require_once __DIR__ . '/../../config.php';

// Initialize a variable for the database connection.
$pdo = null;

// Set PDO options for a secure and stable connection.
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Throw exceptions on errors.
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch associative arrays.
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Use native prepared statements.
];

// Define the Data Source Name (DSN) for the connection.
$dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;

try {
    // Attempt to create a new PDO instance.
    $pdo = new PDO($dsn, DB_USER, DB_PASSWORD, $options);
} catch (\PDOException $e) {
    // If the connection fails, catch the exception and display an error.
    // In a production environment, you would log this error instead of displaying it.
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// The $pdo variable can now be used in other scripts to interact with the database.
// Example:
// require_once 'php/includes/db_connect.php';
// $stmt = $pdo->query('SELECT name FROM users');
// while ($row = $stmt->fetch()) {
//     echo $row['name'] . "\n";
// }
?>
