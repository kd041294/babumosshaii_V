<?php

//Query to save call back request
$get_call_back = "INSERT INTO
        user_query (
        uq_user_full_name, 
        uq_user_number, 
        uq_user_email,
        uq_user_exp_heads, 
        uq_user_event_type, 
        uq_user_event_location, 
        uq_user_event_date) 
        VALUES 
        (?, ?, ?, ?, ?, ?, ?)";

//Query to get all the banquet list 
$get_banquet_list_query = "SELECT 
        tbh.id AS _id,
        tbh.tbh_hall_uniq_id AS _hall_uniq_id,
        tbh.tbh_user_id AS _user_id,
        tbh.tbh_user_uniq_id AS _user_uniq_id,
        tbh.tbh_person_name AS _person_name,
        tbh.tbh_person_contact AS _person_contact,
        tbh.tbh_website AS _website,
        tbh.tbh_hall_name AS _hall_name,
        tbh.tbh_hall_description AS _hall_description,
        tbh.tbh_hall_image_url AS _hall_image_url,
        tbh.tbh_hall_video_url AS _hall_video_url,
        tbh.tbh_flat_no AS _flat_no,
        tbh.tbh_address AS _address,
        tbh.tbh_city AS _city,
        tbh.tbh_state AS _state,
        tbh.tbh_pincode AS _pincode,
        tbh.tbh_landmark AS _landmark,
        tbh.tbh_location AS _location,
        tbh.tbh_total_capacity AS _total_capacity,
        tbh.tbh_seated_capacity AS _seated_capacity,
        tbh.tbh_floating_capacity AS _floating_capacity,
        tbh.tbh_number_of_floors AS _number_of_floors,
        tbh.tbh_hall_area_sqft AS _hall_area_sqft,
        tbh.tbh_number_of_halls AS _number_of_halls,
        tbh.tbh_ceiling_height AS _ceiling_height,
        tbh.tbh_hall_type AS _hall_type,
        tbh.tbh_air_conditioning AS _air_conditioning,
        tbh.tbh_stage_available AS _stage_available,
        tbh.tbh_stage_size AS _stage_size,
        tbh.tbh_dance_floor_available AS _dance_floor_available,
        tbh.tbh_is_parking_available AS _is_parking_available,
        tbh.tbh_parking_capacity_cars AS _parking_capacity_cars,
        tbh.tbh_parking_capacity_bikes AS _parking_capacity_bikes,
        tbh.tbh_changing_rooms AS _changing_rooms,
        tbh.tbh_restrooms AS _restrooms,
        tbh.tbh_accessible_facilities AS _accessible_facilities,
        tbh.tbh_lift_available AS _lift_available,
        tbh.tbh_sound_system_available AS _sound_system_available,
        tbh.tbh_wifi_available AS _wifi_available,
        tbh.tbh_power_backup_available AS _power_backup_available,
        tbh.tbh_seperate_kitchen_available AS _seperate_kitchen_available,
        tbh.tbh_inhouse_catering AS _inhouse_catering,
        tbh.tbh_outside_catering_allowed AS _outside_catering_allowed,
        tbh.tbh_per_plate_price_min AS _per_plate_price_min,
        tbh.tbh_per_plate_price_max AS _per_plate_price_max,
        tbh.tbh_alcohol_policy AS _alcohol_policy,
        tbh.tbh_inhouse_decor AS _inhouse_decor,
        tbh.tbh_outside_decor_allowed AS _outside_decor_allowed,
        tbh.tbh_theme_decor_support AS _theme_decor_support,
        tbh.tbh_furniture_provided AS _furniture_provided,
        tbh.tbh_rental_charge_type AS _rental_charge_type,
        tbh.tbh_rental_charge AS _rental_charge,
        tbh.tbh_advance_payment_percent AS _advance_payment_percent,
        tbh.tbh_booking_from AS _booking_from,
        tbh.tbh_booking_to AS _booking_to,
        tbh.tbh_cancellation_policy AS _cancellation_policy,
        tbh.tbh_peak_season_rates AS _peak_season_rates,
        tbh.tbh_off_season_rates AS _off_season_rates,
        tbh.tbh_fire_safety_certificate AS _fire_safety_certificate,
        tbh.tbh_food_license AS _food_license,
        tbh.tbh_event_permission_required AS _event_permission_required,
        tbh.tbh_created_at AS _created_dt,
        tbh.tbh_updated_at AS _updated_on,
        tbh.tbh_is_verified AS _is_verified,
        tbh.tbh_is_active AS _is_active,
        tbh.status AS _status,
        COALESCE(AVG(tbr.tbr_rating_value), 0) AS _avg_rating,
        COUNT(tbr.id) AS _rating_count
        FROM
        tbl_banquet_halls AS tbh
        LEFT JOIN
        tbl_banquet_hall_ratings AS tbr
        ON
        tbh.id = tbr.tbr_hall_id
        WHERE
        tbh.status = ?
        AND
        tbh.tbh_is_active = ?
        AND
        tbh.tbh_is_verified = ?
        GROUP BY
        tbh.id";

//Query to get all the banquet list 
$get_banquet_details_by_id_query = "SELECT 
        tbh.id AS _id,
        tbh.tbh_hall_uniq_id AS _hall_uniq_id,
        tbh.tbh_user_id AS _user_id,
        tbh.tbh_user_uniq_id AS _user_uniq_id,
        tbh.tbh_person_name AS _person_name,
        tbh.tbh_person_contact AS _person_contact,
        tbh.tbh_website AS _website,
        tbh.tbh_hall_name AS _hall_name,
        tbh.tbh_hall_description AS _hall_description,
        tbh.tbh_hall_image_url AS _hall_image_url,
        tbh.tbh_hall_video_url AS _hall_video_url,
        tbh.tbh_flat_no AS _flat_no,
        tbh.tbh_address AS _address,
        tbh.tbh_city AS _city,
        tbh.tbh_state AS _state,
        tbh.tbh_pincode AS _pincode,
        tbh.tbh_landmark AS _landmark,
        tbh.tbh_location AS _location,
        tbh.tbh_total_capacity AS _total_capacity,
        tbh.tbh_seated_capacity AS _seated_capacity,
        tbh.tbh_floating_capacity AS _floating_capacity,
        tbh.tbh_number_of_floors AS _number_of_floors,
        tbh.tbh_hall_area_sqft AS _hall_area_sqft,
        tbh.tbh_number_of_halls AS _number_of_halls,
        tbh.tbh_ceiling_height AS _ceiling_height,
        tbh.tbh_hall_type AS _hall_type,
        tbh.tbh_air_conditioning AS _air_conditioning,
        tbh.tbh_stage_available AS _stage_available,
        tbh.tbh_stage_size AS _stage_size,
        tbh.tbh_dance_floor_available AS _dance_floor_available,
        tbh.tbh_is_parking_available AS _is_parking_available,
        tbh.tbh_parking_capacity_cars AS _parking_capacity_cars,
        tbh.tbh_parking_capacity_bikes AS _parking_capacity_bikes,
        tbh.tbh_changing_rooms AS _changing_rooms,
        tbh.tbh_restrooms AS _restrooms,
        tbh.tbh_accessible_facilities AS _accessible_facilities,
        tbh.tbh_lift_available AS _lift_available,
        tbh.tbh_sound_system_available AS _sound_system_available,
        tbh.tbh_wifi_available AS _wifi_available,
        tbh.tbh_power_backup_available AS _power_backup_available,
        tbh.tbh_seperate_kitchen_available AS _seperate_kitchen_available,
        tbh.tbh_inhouse_catering AS _inhouse_catering,
        tbh.tbh_outside_catering_allowed AS _outside_catering_allowed,
        tbh.tbh_per_plate_price_min AS _per_plate_price_min,
        tbh.tbh_per_plate_price_max AS _per_plate_price_max,
        tbh.tbh_alcohol_policy AS _alcohol_policy,
        tbh.tbh_inhouse_decor AS _inhouse_decor,
        tbh.tbh_outside_decor_allowed AS _outside_decor_allowed,
        tbh.tbh_theme_decor_support AS _theme_decor_support,
        tbh.tbh_furniture_provided AS _furniture_provided,
        tbh.tbh_rental_charge_type AS _rental_charge_type,
        tbh.tbh_rental_charge AS _rental_charge,
        tbh.tbh_advance_payment_percent AS _advance_payment_percent,
        tbh.tbh_booking_from AS _booking_from,
        tbh.tbh_booking_to AS _booking_to,
        tbh.tbh_cancellation_policy AS _cancellation_policy,
        tbh.tbh_peak_season_rates AS _peak_season_rates,
        tbh.tbh_off_season_rates AS _off_season_rates,
        tbh.tbh_decorating_starting_price AS _decoration_charge,
        tbh.tbh_theme_decoration_price AS _theme_charge,
        tbh.tbh_florist_charge AS _flourist_charge,
        tbh.tbh_lighting_charge AS _lighting_charge,
        tbh.tbh_fire_safety_certificate AS _fire_safety_certificate,
        tbh.tbh_food_license AS _food_license,
        tbh.tbh_event_permission_required AS _event_permission_required,
        tbh.tbh_created_at AS _created_dt,
        tbh.tbh_updated_at AS _updated_on,
        tbh.tbh_is_verified AS _is_verified,
        tbh.tbh_is_active AS _is_active,
        tbh.status AS _status,
        COALESCE(AVG(tbr.tbr_rating_value), 0) AS _avg_rating,
        COUNT(tbr.id) AS _rating_count
        FROM
        tbl_banquet_halls AS tbh
        LEFT JOIN
        tbl_banquet_hall_ratings AS tbr
        ON
        tbh.id = tbr.tbr_hall_id
        WHERE
        tbh.status = ?
        AND
        tbh.tbh_is_active = ?
        AND
        tbh.id = ?
        GROUP BY
        tbh.id";

//Query to get hall reviews
$get_banquet_ratings_query = "SELECT
        tbr.id AS _id,
        tbr.tbr_hall_id AS _hall_id,
        tbr.tbr_user_id AS _user_id,
        tbr.tbr_rating_value AS _rating,
        tbr.tbr_review AS _review,
        tbr.tbr_created_at AS _created_on,
        tbr.tbr_updated_at AS _updated_on,
        tbr.status AS _status
        FROM
        tbl_banquet_hall_ratings AS tbr
        WHERE
        tbr.tbr_hall_id = ?
        AND tbr.status = ?";

//Query to create banquet visit
$create_banquet_visit_query = "INSERT INTO
        tbl_client_banquet_visit(
        tcbv_hall_id,
        tcbv_vendor_id,
        tcbv_client_name,
        tcbv_client_phone,
        tcbv_client_email,
        tcbv_visit_date)
        VALUES(?, ?, ?, ?, ?, ?)";

//Query to get review media's
$get_review_medias_query = "SELECT 
        term.term_event_id AS _event_id,
        tes.tes_client_name AS _client_name,
        tes.tes_event_date AS _event_date,

        /* ⭐ Ratings & Review */
        tr.tr_food_ratings        AS _food_rating,
        tr.tr_arrangement_ratings AS _arrangement_rating,
        tr.tr_behavior_ratings    AS _behavior_rating,
        tr.tr_review              AS _review_text,
        tr.tr_image               AS _review_image,

        /* 🖼 Images */
        JSON_ARRAYAGG(
                CASE 
                WHEN term.term_media_type = 'image' THEN
                        JSON_OBJECT(
                        'id', term.id,
                        'url', term.term_media_url,
                        'created_at', term.created_at,
                        'status', term.status
                        )
                END
        ) AS images,

        /* 🎥 Videos */
        JSON_ARRAYAGG(
                CASE 
                WHEN term.term_media_type = 'video' THEN
                        JSON_OBJECT(
                        'id', term.id,
                        'url', term.term_media_url,
                        'created_at', term.created_at,
                        'status', term.status
                        )
                END
        ) AS videos

        FROM tbl_event_reviews_media AS term

        INNER JOIN tbl_events_shedule AS tes
        ON term.term_event_id = tes.id

        LEFT JOIN tbl_review AS tr
        ON tr.tr_ticket_uniq_id COLLATE utf8mb4_unicode_ci
        = term.term_eve_uniq_id COLLATE utf8mb4_unicode_ci

        WHERE
        term.status = 1
        AND tes.status = 1

        GROUP BY
        term.term_event_id,
        tes.tes_client_name,
        tes.tes_event_date,
        tr.tr_food_ratings,
        tr.tr_arrangement_ratings,
        tr.tr_behavior_ratings,
        tr.tr_review,
        tr.tr_image

        ORDER BY tes.tes_event_date DESC";
