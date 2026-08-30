<?php
require_once __DIR__ . '/common/api_security.php';

error_reporting(0);
ini_set('display_errors', 0);

require_once __DIR__ . '/common/config.php';
require_once __DIR__ . '/db/db_connection.php';
require_once __DIR__ . '/db/db_queries.php';

apiBootstrap('artist-review', 3, 300);

try {

    // ✅ Get POST values
    $package_id      = $_POST['package_id'] ?? null;
    $artist_id       = $_POST['artist_id'] ?? null;
    $artist_uniq_id  = $_POST['artist_uniq_id'] ?? null;

    $name            = apiText($_POST['name'] ?? '', 100);
    $email           = apiText($_POST['email'] ?? '', 254);
    $event_date      = apiText($_POST['event_date'] ?? '', 10);
    $rating          = filter_var($_POST['rating'] ?? null, FILTER_VALIDATE_INT);
    $message         = apiText($_POST['message'] ?? '', 2000);
    $service_type    = apiText($_POST['service_type'] ?? '', 50);

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

    if (!preg_match('/^[\p{L}\p{M} .\'-]{2,100}$/u', $name) || !apiValidDate($event_date, true)) {
        apiRespond(['status' => 'error', 'message' => 'Please check the name and event date'], 422);
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
    apiRespond([
        "status" => true,
        "message" => "Review created successfully"
    ], 201);

} catch (PDOException $e) {
    error_log('Artist review database error: ' . $e->getMessage());
    apiRespond([
        "status" => false,
        "message" => "Unable to save the review right now"
    ], 500);
}
