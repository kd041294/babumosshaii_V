<?php
require_once __DIR__ . '/../common/config.php';
date_default_timezone_set('Asia/Kolkata');

global $databases; // 🔥 IMPORTANT

/**
 * Default connection
 */
try {
    if (!isset($databases['db_bm'])) {
        throw new Exception("Default DB config (db_bm) not found");
    }

    $defaultDb = $databases['db_bm'];

    $conn = new PDO(
        "mysql:host={$defaultDb['host']};dbname={$defaultDb['dbname']};charset=utf8mb4",
        $defaultDb['user'],
        $defaultDb['pass'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );

    $GLOBALS['conn'] = $conn;

} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}


/**
 * 🔥 NEW: Dynamic DB connection
 */
function getDBConnection($dbKey = 'db_bm')
{
    global $databases;

    if (!isset($databases[$dbKey])) {
        throw new Exception("Database config '$dbKey' not found 123");
    }

    $db = $databases[$dbKey];

    try {
        $conn = new PDO(
            "mysql:host={$db['host']};dbname={$db['dbname']};charset=utf8mb4",
            $db['user'],
            $db['pass'],
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );

        return $conn;

    } catch (PDOException $e) {
        die("DB Connection Failed ({$dbKey}): " . $e->getMessage());
    }
}