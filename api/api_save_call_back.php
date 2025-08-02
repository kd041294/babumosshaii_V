<?php
header('Content-Type: application/json');
require_once __DIR__ . '/common/common_function.php';

// Get POST data
$fullName = $_POST['fullName'] ?? '';
$contactNumber = $_POST['contactNumber'] ?? '';
$expectedHeads = $_POST['expectedHeads'] ?? '';
$eventType = $_POST['eventType'] ?? '';
$eventLocation = $_POST['eventLocation'] ?? '';
$eventDate = $_POST['eventDate'] ?? '';

// Basic validation (optional, since JS validates too)
if (
    empty($fullName) ||
    empty($contactNumber) ||
    empty($expectedHeads) ||
    empty($eventType) ||
    empty($eventLocation) ||
    empty($eventDate)
) {
    echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    exit;
}

// Save to DB
$result = saveCallBackRequest($fullName, $contactNumber, $expectedHeads, $eventType, $eventLocation, $eventDate);

if ($result) {
    echo json_encode(['success' => true, 'message' => 'Request saved successfully!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to save request.']);
}