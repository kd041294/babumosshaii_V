<?php
header('Content-Type: application/json');

error_reporting(0);
ini_set('display_errors', 0);

require_once __DIR__ . '/common/config.php';
require_once __DIR__ . '/db/db_connection.php';
require_once __DIR__ . '/db/db_queries.php';

try {

    // ✅ Get POST values
    $package_id      = $_POST['package_id'] ?? null;
    $artist_id       = $_POST['artist_id'] ?? null;
    $artist_uniq_id  = $_POST['artist_uniq_id'] ?? null;

    $name            = $_POST['name'] ?? null;
    $email           = $_POST['email'] ?? null;
    $event_date      = $_POST['event_date'] ?? null;
    $rating          = $_POST['rating'] ?? null;
    $message         = $_POST['message'] ?? null;
    $service_type     = $_POST['service_type'] ?? null;

    // ✅ Validation
    if (!$name || !$email || !$event_date || !$rating || !$message) {
        echo json_encode([
            "status" => "error",
            "message" => "All fields are required"
        ]);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode([
            "status" => "error",
            "message" => "Invalid email"
        ]);
        exit;
    }

    if ($rating < 1 || $rating > 5) {
        echo json_encode([
            "status" => "error",
            "message" => "Invalid rating value"
        ]);
        exit;
    }

    // ✅ DB Connection
    $conn = getDBConnection('db_artist');

    // ✅ Duplicate check
    $checkQuery = "SELECT id FROM user_reviews 
                   WHERE package_id = :package_id
                   LIMIT 1";

    $checkStmt = $conn->prepare($checkQuery);

    $checkStmt->execute([
        ':package_id' => $package_id
    ]);

    if ($checkStmt->rowCount() > 0) {
        echo json_encode([
            "status" => "duplicate",
            "message" => "You have already submitted a review for this package"
        ]);
        exit;
    }

    $reviewCode = generateReviewId($conn);

    // ✅ FIXED INSERT QUERY
    $query = "INSERT INTO user_reviews (
        review_id,
        package_id,
        user_id,
        user_unique_id,
        customer_name,
        customer_email,
        rating,
        review_message,
        event_type,
        event_date
    ) VALUES (
        :review_id,
        :package_id,
        :user_id,
        :user_unique_id,
        :customer_name,
        :customer_email,
        :rating,
        :message,
        :service_type,
        :event_date
    )";

    // ✅ EXECUTE
    $stmt = $conn->prepare($query);

    $stmt->execute([
        ':review_id'       => $reviewCode,
        ':package_id'      => $package_id,
        ':user_id'         => $artist_id,          // mapped correctly
        ':user_unique_id'  => $artist_uniq_id,
        ':customer_name'   => $name,
        ':customer_email'  => $email,
        ':rating'          => $rating,
        ':message'         => $message,
        ':service_type'    => $service_type,
        ':event_date'      => $event_date
    ]);

    // ✅ SUCCESS
    echo json_encode([
        "status" => true,
        "message" => "Review created successfully"
    ]);
    exit;

} catch (PDOException $e) {

    echo json_encode([
        "status" => false,
        "message" => $e->getMessage()
    ]);
    exit;
}