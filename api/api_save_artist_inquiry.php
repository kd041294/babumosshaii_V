<?php
require_once __DIR__ . '/common/api_security.php';

error_reporting(0);
ini_set('display_errors', 0);
require_once __DIR__ . '/common/config.php';
require_once __DIR__ . '/db/db_connection.php';
require_once __DIR__ . '/db/db_queries.php';

apiBootstrap('artist-inquiry', 5, 60);

try {

    // ✅ Get POST values
    $package_id        = $_POST['package_id'] ?? null;
    $package_code      = $_POST['package_code'] ?? null;
    $service_type      = $_POST['service_type'] ?? null;
    $customer_name     = apiText($_POST['customer_name'] ?? '', 100);
    $customer_phone    = apiText($_POST['customer_phone'] ?? '', 15);
    $customer_email    = apiText($_POST['customer_email'] ?? '', 254);
    $event_date        = apiText($_POST['event_date'] ?? '', 10);
    $event_time        = apiText($_POST['event_time'] ?? '', 8);
    $event_location    = apiText($_POST['event_location'] ?? '', 255);
    $message           = apiText($_POST['message'] ?? '', 2000);
    $number_of_people  = filter_var($_POST['no_of_heads'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 100000]]);
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

    if (!preg_match('/^[\p{L}\p{M} .\'-]{2,100}$/u', $customer_name)) {
        apiRespond(['status' => 'error', 'message' => 'Invalid customer name'], 422);
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
    apiRespond([
        "status" => true,
        "message" => "Inquiry saved successfully"
    ], 201);


} catch (PDOException $e) {
    error_log('Artist inquiry database error: ' . $e->getMessage());
    apiRespond([
        "status" => false,
        "message" => "Unable to save the inquiry right now"
    ], 500);
}
