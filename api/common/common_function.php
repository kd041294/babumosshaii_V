<?php

// Function to save call back request using query from db_queries.php
function saveCallBackRequest($fullName, $contactNumber, $expectedHeads, $eventType, $eventLocation, $eventDate) {
    require_once __DIR__ . '/../db/db_connection.php';
    require_once __DIR__ . '/../db/db_queries.php';

    try {
        $stmt = $conn->prepare($get_call_back);
        $stmt->execute([
            $fullName,
            $contactNumber,
            $expectedHeads,
            $eventType,
            $eventLocation,
            $eventDate
        ]);
        return true;
    } catch (PDOException $e) {
        error_log("Error saving call back request: " . $e->getMessage());
        return false;
    }
}