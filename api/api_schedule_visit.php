<?php
// api_schedule_visit.php

// Include database connection
require_once './common/common_function.php';

// Set response header
header('Content-Type: application/json');

// Validate request method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit;
}

// Retrieve POST data (with basic sanitization)
$hall_id        = isset($_POST['hall_id']) ? intval($_POST['hall_id']) : 0;
$vendor_id        = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;
$fullName       = isset($_POST['fullName']) ? trim($_POST['fullName']) : '';
$contactNumber  = isset($_POST['contactNumber']) ? trim($_POST['contactNumber']) : '';
$email          = isset($_POST['email']) ? trim($_POST['email']) : '';
$visitDate      = isset($_POST['visitDate']) ? trim($_POST['visitDate']) : '';

// Basic validation
if (empty($hall_id) || empty($fullName) || empty($contactNumber) || empty($visitDate) || empty($vendor_id)) {
    echo json_encode(['status' => 'error', 'message' => 'Required fields are missing']);
    exit;
}

$result = create_client_schedule_visit(
    $hall_id,
    $vendor_id,
    $fullName,
    $contactNumber,
    $email,
    $visitDate
);

echo json_encode([
    'status' => $result['success'] ? 'success' : 'error',
    'message' => $result['message'],
    'visit_id' => $result['visit_id'] ?? null
]);

exit();