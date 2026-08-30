<?php
require_once __DIR__ . '/common/api_security.php';
require_once __DIR__ . '/common/common_function.php';

apiBootstrap('save-callback', 5, 60);

// Get POST data
$fullName = apiText($_POST['fullName'] ?? '', 100);
$contactNumber = apiText($_POST['contactNumber'] ?? '', 15);
$email = apiText($_POST['email'] ?? '', 254);
$expectedHeads = filter_var($_POST['expectedHeads'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 100000]]);
$eventType = apiText($_POST['eventType'] ?? '', 50);
$eventLocation = apiText($_POST['eventLocation'] ?? '', 255);
$eventDate = apiText($_POST['eventDate'] ?? '', 10);
$additionalNotes = apiText($_POST['additionalNotes'] ?? '', 2000);

// Basic validation (optional, since JS validates too)
if (
    empty($fullName) ||
    empty($contactNumber) ||
    empty($email) ||
    empty($expectedHeads) ||
    empty($eventType) ||
    empty($eventLocation) ||
    empty($eventDate)
) {
    apiRespond(['success' => false, 'message' => 'All fields are required.'], 422);
}

if (!preg_match('/^[\p{L}\p{M} .\'-]{2,100}$/u', $fullName)) {
    apiRespond(['success' => false, 'message' => 'Please enter a valid name.'], 422);
}

if (!preg_match('/^[6-9]\d{9}$/', $contactNumber)) {
    apiRespond(['success' => false, 'message' => 'Please enter a valid 10-digit mobile number.'], 422);
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !apiValidDate($eventDate)) {
    apiRespond(['success' => false, 'message' => 'Please check the email address and event date.'], 422);
}

// Save to DB
$result = saveCallBackRequest($fullName, $contactNumber, $email, $expectedHeads, $eventType, $eventLocation, $eventDate, $additionalNotes);

if ($result) {
    apiRespond(['success' => true, 'message' => 'Request saved successfully!'], 201);
} else {
    apiRespond(['success' => false, 'message' => 'Unable to save the request right now.'], 500);
}
