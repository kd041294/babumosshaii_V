<?php
// Detect environment based on URL
$host = $_SERVER['HTTP_HOST'];
$isLocal = (strpos($host, 'localhost') !== false || strpos($host, '127.0.0.1') !== false);
define('ENCRYPTION_KEY', 'b8kE#vW^T3z!Y9s@2h&Uj$Lq7pF*GmD1'); 
define('ENCRYPTION_IV', '4H!x8z$Wq@1vB#c7');
// Set config based on environment
if ($isLocal) {
    // Local environment
    define('ENVIRONMENT', 'local');
    define('BASE_URL', 'http://localhost:8383/babumosshaii_V/');
    define('REVIEW_LINK', 'http://localhost:8383/babumosshaii_review/');
    // 🔥 MULTIPLE DATABASES
    $databases = [
        'db_bm' => [
            'host' => '127.0.0.1',
            'dbname' => 'babumosshaii_db',
            'user' => 'root',
            'pass' => ''
        ],
        'db_artist' => [
            'host' => '127.0.0.1',
            'dbname' => 'babumosshaii_db_artist',
            'user' => 'root',
            'pass' => ''
        ]
    ];
} else {
    // Development/Production environment
    define('ENVIRONMENT', 'development');
    define('BASE_URL', 'https://babumosshaii.in/');
    define('REVIEW_LINK', 'https://review.babumosshaii.in/');
    $databases = [
        'db_bm' => [
            'host'   => '127.0.0.1',
            'dbname' => 'u469745365_babu_20',
            'user'   => 'u469745365_babumosshaii',
            'pass'   => 'kd961194KD@'
        ],
        'db_artist' => [
            'host'   => '127.0.0.1',
            'dbname' => 'u469745365_bm_artist',
            'user'   => 'u469745365_artist',
            'pass'   => 'krishuKD@961194'
        ]
    ];
}