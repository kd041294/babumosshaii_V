<?php

/**
 * Encrypt a string
 *
 * @param string $data
 * @return string Encrypted and base64 encoded string
 */
function encryptData($data)
{
    $method = "AES-256-CBC";

    $key = hash('sha256', ENCRYPTION_KEY, true); // 32 bytes key
    $ivLength = openssl_cipher_iv_length($method);
    $iv = random_bytes($ivLength);

    // Encrypt
    $encrypted = openssl_encrypt($data, $method, $key, OPENSSL_RAW_DATA, $iv);

    // Generate HMAC (tamper protection)
    $hmac = hash_hmac('sha256', $encrypted, $key, true);

    // Combine → iv + hmac + encrypted
    $final = base64_encode($iv . $hmac . $encrypted);

    // URL safe
    return str_replace(['+', '/', '='], ['-', '_', ''], $final);
}
/**
 * Decrypt a string
 *
 * @param string $data
 * @return string Decrypted string
 */
function decryptData($data)
{
    $method = "AES-256-CBC";
    $key = hash('sha256', ENCRYPTION_KEY, true);

    // ✅ STEP 1: Fix URL issues
    $data = str_replace(['-', '_'], ['+', '/'], $data);

    // ✅ STEP 2: Fix missing padding
    $mod4 = strlen($data) % 4;
    if ($mod4) {
        $data .= substr('====', $mod4);
    }

    $decoded = base64_decode($data, true);
    if ($decoded === false) {
        return false;
    }

    $ivLength = openssl_cipher_iv_length($method);

    // ✅ STEP 3: Validate length
    if (strlen($decoded) < ($ivLength + 32)) {
        return false;
    }

    $iv        = substr($decoded, 0, $ivLength);
    $hmac      = substr($decoded, $ivLength, 32);
    $encrypted = substr($decoded, $ivLength + 32);

    // ✅ STEP 4: Verify HMAC
    $calcHmac = hash_hmac('sha256', $encrypted, $key, true);
    if (!hash_equals($hmac, $calcHmac)) {
        return false;
    }

    // ✅ STEP 5: Decrypt
    $decrypted = openssl_decrypt($encrypted, $method, $key, OPENSSL_RAW_DATA, $iv);

    return $decrypted;
}

function safeHtml($html)
{
    return strip_tags($html, '<p><br><ul><ol><li><b><strong><i>');
}

function updatePackageViewCount($conn, $id, $category)
{
    try {

        $id = (int)$id;

        $allowed = ['mehendi', 'makeup'];
        if (!in_array($category, $allowed)) {
            return false;
        }

        if ($category === 'mehendi') {
            $query = "UPDATE mehendi_packages 
                      SET views_count = views_count + 1 
                      WHERE id = ? AND status = 1";
        } elseif ($category === 'makeup') {
            $query = "UPDATE makeup_packages 
                      SET views_count = views_count + 1 
                      WHERE id = ? AND status = 1";
        }

        $stmt = $conn->prepare($query);
        $stmt->execute([$id]);

        return $stmt->rowCount() > 0;
    } catch (PDOException $e) {
        error_log("Error updating view count: " . $e->getMessage());
        return false;
    }
}

//Function to save call back request using query from db_queries.php
function saveCallBackRequest($fullName, $contactNumber, $email, $expectedHeads, $eventType, $eventLocation, $eventDate, $additionalNotes)
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
            $eventDate,
            $additionalNotes
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
function get_bm_menus_by_id($id, $status = 1)
{
    require_once __DIR__ . '/../db/db_connection.php';
    require_once __DIR__ . '/../db/db_queries.php';

    try {
        $stmt = $conn->prepare($get_all_bm_menu_by_id);

        if (!$stmt) {
            throw new Exception("Query preparation failed");
        }

        // ✅ Bind BOTH params correctly
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->bindValue(2, $status, PDO::PARAM_INT);

        $stmt->execute();

        // ✅ Fetch SINGLE row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return [
                "status"  => false,
                "message" => "Menu not found",
                "data"    => null
            ];
        }

        // 🔧 Clean fields
        $row['_live_counter'] = trim($row['_live_counter'] ?? '');
        $row['_starter']      = trim($row['_starter'] ?? '');
        $row['_main_course']  = trim($row['_main_course'] ?? '');
        $row['_dessert']      = trim($row['_dessert'] ?? '');
        $row['_Ads_on']       = trim($row['_Ads_on'] ?? '');
        $row['_beverages']    = trim($row['_beverages'] ?? '');

        // 💰 Normalize price
        $row['_price']    = (float) ($row['_price'] ?? 0);
        $row['_discount'] = (int) ($row['_discount'] ?? 0);

        // 📊 Status normalize
        $row['_status'] = (int) ($row['_status'] ?? 0);

        return [
            "status"  => true,
            "message" => "Menu fetched successfully",
            "data"    => $row // ✅ SINGLE object (not array)
        ];
    } catch (PDOException $e) {
        error_log("DB Error: " . $e->getMessage());
        return [
            "status"  => false,
            "message" => "Database error",
            "data"    => null
        ];
    } catch (Exception $e) {
        error_log("Error: " . $e->getMessage());
        return [
            "status"  => false,
            "message" => $e->getMessage(),
            "data"    => null
        ];
    }
}


//function to get all the mehendi package list 
function getMehendiPackageList($is_approved = 1, $status = 1)
{
    require_once __DIR__ . '/../db/db_connection.php';
    require_once __DIR__ . '/../db/db_queries.php';

    try {
        // 🔥 USE CORRECT DATABASE
        $conn = getDBConnection('db_artist');

        $stmt = $conn->prepare($get_mehendi_package_list_query);

        $stmt->execute([
            ':is_approved' => $is_approved,
            ':status' => $status
        ]);

        $mehendiPackageList = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return [
            "status" => true,
            "data" => $mehendiPackageList
        ];
    } catch (PDOException $e) {
        return [
            "status" => false,
            "message" => $e->getMessage(), // 🔥 important for debugging
            "data" => []
        ];
    }
}

//function to get mehendi package details by id
function getMehendiPackageDetailsById($id, $is_approved = 1, $status = 1)
{
    require_once __DIR__ . '/../db/db_connection.php';
    require_once __DIR__ . '/../db/db_queries.php';

    try {
        $conn = getDBConnection('db_artist');

        $id = (int)$id; // ✅ safety

        $stmt = $conn->prepare($get_mehendi_package_details_by_id_query);

        $stmt->execute([
            ':id' => $id,
            ':is_approved' => $is_approved,
            ':status' => $status
        ]);

        $package = $stmt->fetch(PDO::FETCH_ASSOC);

        // ✅ Only increment if package exists
        if ($package) {

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            if (!isset($_SESSION['viewed_packages'])) {
                $_SESSION['viewed_packages'] = [];
            }

            if (!in_array($id, $_SESSION['viewed_packages'])) {

                $_SESSION['viewed_packages'][] = $id;

                updatePackageViewCount($conn, $id, 'mehendi');
            }
        }

        return [
            "status" => $package ? true : false,
            "data" => $package ?: []
        ];
    } catch (PDOException $e) {
        return [
            "status" => false,
            "message" => $e->getMessage(),
            "data" => []
        ];
    }
}

//function to get all the mehendi package list 
function getMakeupPackageList($is_approved = 1, $status = 1)
{
    require_once __DIR__ . '/../db/db_connection.php';
    require_once __DIR__ . '/../db/db_queries.php';

    try {
        // 🔥 USE CORRECT DATABASE
        $conn = getDBConnection('db_artist');

        $stmt = $conn->prepare($get_makeup_package_list_query);

        $stmt->execute([
            ':is_approved' => $is_approved,
            ':status' => $status
        ]);

        $makeupPackageList = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return [
            "status" => true,
            "data" => $makeupPackageList
        ];
    } catch (PDOException $e) {
        return [
            "status" => false,
            "message" => $e->getMessage(), // 🔥 important for debugging
            "data" => []
        ];
    }
}

//function to get makeup package details by id
function getMakeupPackageDetailsById($id, $is_approved = 1, $status = 1)
{
    require_once __DIR__ . '/../db/db_connection.php';
    require_once __DIR__ . '/../db/db_queries.php';

    try {
        $conn = getDBConnection('db_artist');

        $id = (int)$id;

        $stmt = $conn->prepare($get_makeup_package_details_by_id_query);

        $stmt->execute([
            ':id' => $id,
            ':is_approved' => $is_approved,
            ':status' => $status
        ]);

        $package = $stmt->fetch(PDO::FETCH_ASSOC);

        // ✅ Only increment if package exists
        if ($package) {

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            if (!isset($_SESSION['viewed_packages'])) {
                $_SESSION['viewed_packages'] = [];
            }

            if (!in_array($id, $_SESSION['viewed_packages'])) {

                $_SESSION['viewed_packages'][] = $id;

                updatePackageViewCount($conn, $id, 'makeup');
            }
        }

        return [
            "status" => $package ? true : false,
            "data" => $package ?: []
        ];
    } catch (PDOException $e) {
        return [
            "status" => false,
            "message" => $e->getMessage(),
            "data" => []
        ];
    }
}

//function to get artist gallery images
function getArtistGalleryImages($artist_id, $artist_uniq_id)
{
    require_once __DIR__ . '/../db/db_connection.php';

    try {
        $conn = getDBConnection('db_artist');

        // ✅ FIXED QUERY
        $query = "SELECT  
        ug.media_type AS _media_type,
        ug.media_url AS _media_url,
        ug.public_id AS _public_id,
        ug.title AS _title,
        ug.description AS _desc,
        ug.create_dt AS _created_on,
        ug.update_dt AS _last_updated
        FROM user_gallary AS ug 
        WHERE ug.user_id = :artist_id
        AND ug.user_uniq_id = :artist_uniq_id
        ORDER BY ug.create_dt DESC";

        $stmt = $conn->prepare($query);

        $stmt->execute([
            ':artist_id' => $artist_id,
            ':artist_uniq_id' => $artist_uniq_id
        ]);

        // ✅ MULTIPLE RESULTS
        $gallery = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return [
            "status" => !empty($gallery),
            "data" => $gallery
        ];
    } catch (PDOException $e) {
        return [
            "status" => false,
            "message" => $e->getMessage(),
            "data" => []
        ];
    }
}

