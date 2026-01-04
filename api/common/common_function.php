<?php

/**
 * Encrypt a string
 *
 * @param string $data
 * @return string Encrypted and base64 encoded string
 */
function encryptData($data)
{
    $encryptionMethod = "AES-256-CBC";
    return base64_encode(openssl_encrypt($data, $encryptionMethod, ENCRYPTION_KEY, 0, ENCRYPTION_IV));
}
/**
 * Decrypt a string
 *
 * @param string $data
 * @return string Decrypted string
 */
function decryptData($data)
{
    $encryptionMethod = "AES-256-CBC";
    return openssl_decrypt(base64_decode($data), $encryptionMethod, ENCRYPTION_KEY, 0, ENCRYPTION_IV);
}
//Function to save call back request using query from db_queries.php
function saveCallBackRequest($fullName, $contactNumber, $email, $expectedHeads, $eventType, $eventLocation, $eventDate)
{
    require_once __DIR__ . '/../db/db_connection.php';
    require_once __DIR__ . '/../db/db_queries.php';

    try {
        $stmt = $conn->prepare($get_call_back);
        $stmt->execute([
            $fullName,
            $contactNumber,
            $email,
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
//Function to gett all the banquet list
function getBanquetList()
{
    require_once __DIR__ . '/../db/db_connection.php';
    require_once __DIR__ . '/../db/db_queries.php';

    try {
        // Prepare the statement
        $stmt = $conn->prepare($get_banquet_list_query);
        $status = 1;
        $is_active = 1;
        $is_verified = 1;
        // Execute the query
        $stmt->execute([
            $status,
            $is_active,
            $is_verified
        ]);

        // Fetch all results as an associative array
        $banquetList = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $banquetList; // Return the array
    } catch (PDOException $e) {
        // Handle any database errors
        error_log("Database Error: " . $e->getMessage());
        return [];
    }
}
//Function to get banquet hall details
function getBanquetHallById($id)
{
    require_once __DIR__ . '/../db/db_connection.php';
    require_once __DIR__ . '/../db/db_queries.php';

    try {
        // Prepare the statement
        $stmt = $conn->prepare($get_banquet_details_by_id_query);
        $status = 1;
        $is_active = 1;

        // Execute the query
        $stmt->execute([
            $status,
            $is_active,
            $id
        ]);

        // Fetch a single banquet hall instead of all
        $banquetHall = $stmt->fetch(PDO::FETCH_ASSOC);

        return $banquetHall ?: null; // Return null if not found
    } catch (PDOException $e) {
        // Log error for debugging
        error_log("Database Error in getBanquetHallById: " . $e->getMessage());
        return null;
    }
}
//Function to get all banquet ratings by hall id
function getBanquetRatingsByHallId($id)
{
    require_once __DIR__ . '/../db/db_connection.php';
    require_once __DIR__ . '/../db/db_queries.php';
    $get_banquet_ratings_query = "SELECT
        tbr.id AS _id,
        tbr.tbr_hall_id AS _hall_id,
        tbr.tbr_user_id AS _user_id,
        tbr.tbr_rating_value AS _rating,
        tbr.tbr_customer_name AS _customer_name,
        tbr.tbr_review AS _review,
        tbr.tbr_created_at AS _created_on,
        tbr.tbr_updated_at AS _updated_on,
        tbr.status AS _status
        FROM
        tbl_banquet_hall_ratings AS tbr
        WHERE
        tbr.tbr_hall_id = ?
        AND tbr.status = ?";
    // Explicitly assign global connection
    $conn = $GLOBALS['conn'];
    try {
        $stmt = $conn->prepare($get_banquet_ratings_query);
        $status = 1;
        $stmt->execute([$id, $status]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all ratings for that hall
    } catch (PDOException $e) {
        error_log("Database Error in getBanquetRatingsByHallId: " . $e->getMessage());
        return [];
    }
}

//Function to create client visit schedule
function create_client_schedule_visit(
    $hall_id,
    $vendor_id,
    $fullName,
    $contactNumber,
    $email,
    $visitDate
) {
    require_once __DIR__ . '/../db/db_connection.php';
    require_once __DIR__ . '/../db/db_queries.php';
    try {
        // Basic validation
        if (empty($hall_id) || empty($vendor_id) || empty($fullName) || empty($contactNumber) || empty($visitDate)) {
            return ['success' => false, 'message' => 'Missing required fields'];
        }
        // Prepare the insert statement
        $stmt = $conn->prepare($create_banquet_visit_query);
        // Execute with values in order
        $executed = $stmt->execute([
            $hall_id,
            $vendor_id,
            $fullName,
            $contactNumber,
            $email,
            $visitDate
        ]);
        if ($executed) {
            return [
                'success' => true,
                'message' => 'Visit created successfully',
                'visit_id' => $conn->lastInsertId()
            ];
        }
        return ['success' => false, 'message' => 'Failed to create schedule. Try Later'];
    } catch (PDOException $e) {
        error_log("Database Error in create_client_schedule_visit: " . $e->getMessage());
        return ['success' => false, 'message' => 'Database error occurred'];
    }
}

//function to get client testimonials
function getEventReviewMedias()
{
    require_once __DIR__ . '/../db/db_connection.php';
    require_once __DIR__ . '/../db/db_queries.php';

    $conn = $GLOBALS['conn'];

    try {
        $stmt = $conn->prepare($get_review_medias_query);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        /**
         * 🔧 Clean NULL values from JSON arrays
         */
        foreach ($results as &$row) {
            $row['images'] = array_values(
                array_filter(json_decode($row['images'], true))
            );

            $row['videos'] = array_values(
                array_filter(json_decode($row['videos'], true))
            );
        }

        return $results;
    } catch (PDOException $e) {
        error_log("Database Error in getEventReviewMedias: " . $e->getMessage());
        return [];
    }
}

function get_all_bm_menus($status = 1)
{
    require_once __DIR__ . '/../db/db_connection.php'; // $conn PDO
    require_once __DIR__ . '/../db/db_queries.php';    // $get_all_bm_menu_list

    try {
        // Prepare statement
        $stmt = $conn->prepare($get_all_bm_menu_list);
        if (!$stmt) {
            throw new Exception("Query preparation failed");
        }

        // Bind status parameter
        $stmt->bindValue(1, $status, PDO::PARAM_INT);

        // Execute
        $stmt->execute();

        // Fetch results
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $menus = [];
        foreach ($results as $row) {

            // 🔧 Clean & normalize category fields
            $row['_live_counter'] = trim($row['_live_counter'] ?? '');
            $row['_starter']      = trim($row['_starter'] ?? '');
            $row['_main_course']  = trim($row['_main_course'] ?? '');
            $row['_dessert']      = trim($row['_dessert'] ?? '');
            $row['_Ads_on']       = trim($row['_Ads_on'] ?? '');
            $row['_beverages']    = trim($row['_beverages'] ?? '');

            // Price & discount normalization
            $row['_price']    = isset($row['_price']) ? (float) $row['_price'] : 0;
            $row['_discount'] = isset($row['_discount']) ? (int) $row['_discount'] : 0;

            // Status normalization
            $row['_status'] = isset($row['_status']) ? (int) $row['_status'] : 0;

            $menus[] = $row;
        }

        return [
            "status"  => true,
            "message" => count($menus) ? "Menu list fetched successfully" : "No menus found",
            "data"    => $menus
        ];
    } catch (PDOException $e) {
        error_log("Database Error in get_all_bm_menus: " . $e->getMessage());
        return [
            "status"  => false,
            "message" => "Database error while fetching menus",
            "data"    => []
        ];
    } catch (Exception $e) {
        error_log("Error in get_all_bm_menus: " . $e->getMessage());
        return [
            "status"  => false,
            "message" => $e->getMessage(),
            "data"    => []
        ];
    }
}
