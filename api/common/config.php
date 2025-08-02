<?php
// Detect environment based on URL
$host = $_SERVER['HTTP_HOST'];
$isLocal = (strpos($host, 'localhost') !== false || strpos($host, '127.0.0.1') !== false);

// Set config based on environment
if ($isLocal) {
    // Local environment
    define('ENVIRONMENT', 'local');
    define('BASE_URL', 'http://localhost/babumosshaii_v2.0/');
    define('DB_HOST', '127.0.0.1');
    define('DB_NAME', 'babumosshaii_db');
    define('DB_USER', 'root');
    define('DB_PASS', '');
} else {
    // Development/Production environment
    define('ENVIRONMENT', 'development');
    define('BASE_URL', 'https://babumosshaii.in/');
    define('DB_HOST', '127.0.0.1');
    define('DB_NAME', 'u469745365_babu_20');
    define('DB_USER', 'u469745365_babumosshaii');
    define('DB_PASS', 'kd961194KD@');
}