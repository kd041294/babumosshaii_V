<?php
header('Content-Type: application/json');

error_reporting(0);
ini_set('display_errors', 0);
require_once __DIR__ . '/common/config.php';
require_once __DIR__ . '/db/db_connection.php';
require_once __DIR__ . '/db/db_queries.php';

try {

    // ✅ Get POST values
    $package_id        = $_POST['package_id'] ?? null;
    $package_code      = $_POST['package_code'] ?? null;
    $service_type      = $_POST['service_type'] ?? null;
    $customer_name     = $_POST['customer_name'] ?? null;
    $customer_phone    = $_POST['customer_phone'] ?? null;
    $customer_email    = $_POST['customer_email'] ?? null;
    $event_date        = $_POST['event_date'] ?? null;
    $event_time        = $_POST['event_time'] ?? null;
    $event_location    = $_POST['event_location'] ?? null;
    $message           = $_POST['message'] ?? null;
    $number_of_people  = $_POST['no_of_heads'] ?? null;
    $artist_id         = $_POST['artist_id'] ?? null;
    $artist_uniq_id    = $_POST['artist_uniq_id'] ?? null;

    // ✅ Validation
    if (!$customer_name || !$customer_phone) {
        echo json_encode([
            "status" => "error",
            "message" => "Name and phone are required"
        ]);
        exit;
    }

    if (!preg_match('/^[6-9]\d{9}$/', $customer_phone)) {
        echo json_encode([
            "status" => "error",
            "message" => "Invalid phone number"
        ]);
        exit;
    }

    if ($customer_email && !filter_var($customer_email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode([
            "status" => "error",
            "message" => "Invalid email"
        ]);
        exit;
    }

    $conn = getDBConnection('db_artist');
    
    // ✅ Check duplicate (phone OR email)
    $checkQuery = "SELECT id FROM booking_leads 
               WHERE (customer_phone = :phone 
               OR customer_email = :email)
               AND service_type = :service_type
               LIMIT 1";

    $checkStmt = $conn->prepare($checkQuery);

    $checkStmt->execute([
        ':phone' => $customer_phone,
        ':email' => $customer_email,
        ':service_type' => $service_type
    ]);

    if ($checkStmt->rowCount() > 0) {
        echo json_encode([
            "status" => "duplicate",
            "message" => "We already have your request. Our team will get back to you soon."
        ]);
        exit;
    }

    // ✅ Define query (FIXED)
    $query = "INSERT INTO booking_leads(
        package_id,
        package_code,
        service_type, 
        customer_name,
        customer_phone,
        customer_email,
        event_date,
        event_time,
        event_location,
        message,
        number_of_people,
        artist_id,
        artist_uniq_id
    ) VALUES (
        :package_id,
        :package_code,
        :service_type,
        :customer_name,
        :customer_phone,
        :customer_email,
        :event_date,
        :event_time,
        :event_location,
        :message,
        :number_of_people,
        :artist_id,
        :artist_uniq_id
    )";

    // ✅ DB Insert
    $stmt = $conn->prepare($query);

    $stmt->execute([
        ':package_id' => $package_id,
        ':package_code' => $package_code,
        ':service_type' => $service_type,
        ':customer_name' => $customer_name,
        ':customer_phone' => $customer_phone,
        ':customer_email' => $customer_email,
        ':event_date' => $event_date,
        ':event_time' => $event_time,
        ':event_location' => $event_location,
        ':message' => $message,
        ':number_of_people' => $number_of_people,
        ':artist_id' => $artist_id,
        ':artist_uniq_id' => $artist_uniq_id
    ]);

    // ✅ SUCCESS RESPONSE
    echo json_encode([
        "status" => true,
        "message" => "Inquiry saved successfully"
    ]);
    exit; // ✅ IMPORTANT


} catch (PDOException $e) {

    echo json_encode([
        "status" => false,
        "message" => $e->getMessage()
    ]);
    exit;
}
