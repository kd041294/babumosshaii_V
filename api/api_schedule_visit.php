<?php
// api_schedule_visit.php

// Include database connection
require_once __DIR__ . '/common/api_security.php';
require_once __DIR__ . '/common/common_function.php';

apiBootstrap('schedule-visit', 5, 60);

// Retrieve POST data (with basic sanitization)
$hall_id        = isset($_POST['hall_id']) ? intval($_POST['hall_id']) : 0;
$vendor_id        = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;
$fullName       = apiText($_POST['fullName'] ?? '', 100);
$contactNumber  = apiText($_POST['contactNumber'] ?? '', 15);
$email          = apiText($_POST['email'] ?? '', 254);
$visitDate      = apiText($_POST['visitDate'] ?? '', 10);

// Basic validation
if (empty($hall_id) || empty($fullName) || empty($contactNumber) || empty($visitDate) || empty($vendor_id)) {
    apiRespond(['status' => 'error', 'message' => 'Required fields are missing'], 422);
}

if (!preg_match('/^[\p{L}\p{M} .\'-]{2,100}$/u', $fullName) ||
    !preg_match('/^[6-9]\d{9}$/', $contactNumber) ||
    ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) ||
    !apiValidDate($visitDate)) {
    apiRespond(['status' => 'error', 'message' => 'Please check the submitted details'], 422);
}

$result = create_client_schedule_visit(
    $hall_id,
    $vendor_id,
    $fullName,
    $contactNumber,
    $email,
    $visitDate
);

apiRespond([
    'status' => $result['success'] ? 'success' : 'error',
    'message' => $result['message'],
    'visit_id' => $result['visit_id'] ?? null
], $result['success'] ? 201 : 500);
