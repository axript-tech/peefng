 
<?php
// ------------------------------------------------------
// PEEF Platform - Configuration File
// ------------------------------------------------------
// This file contains the essential configuration settings
// for the web platform, primarily the database credentials.
// 
// IMPORTANT: This file should be secured and not be
// publicly accessible on a live server.
// ------------------------------------------------------

// ** MySQL Database Settings ** //

// The name of the database for the PEEF platform.
define('DB_NAME', 'peefng');

// Your MySQL database username.
define('DB_USER', 'root');

// Your MySQL database password.
define('DB_PASSWORD', ''); // <-- IMPORTANT: Change this to your actual password

// Your MySQL hostname (usually 'localhost').
define('DB_HOST', 'localhost');

// The character set to use in communicating with the database.
define('DB_CHARSET', 'utf8mb4');


// ** Site Settings ** //

// The base URL of your website.
// Example: define('SITE_URL', 'http://localhost/peef-platform');
define('SITE_URL', 'http://peef.ng');

// The name of your website.
define('SITE_NAME', 'PEEF Foundation');


// ** Error Reporting ** //
// Set to 'development' or 'production'.
// 'development' will show all errors.
// 'production' will hide errors from the public.
define('ENVIRONMENT', 'development');

if (ENVIRONMENT == 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

?>
