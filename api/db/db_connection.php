<?php
require_once __DIR__ . '/../common/config.php';
date_default_timezone_set('Asia/Kolkata');
try {
    $conn = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
    // This line ensures $conn is available globally
    $GLOBALS['conn'] = $conn;
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>