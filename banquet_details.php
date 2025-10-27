<?php
require 'template_header.php';

$enc_id = isset($_GET['id']) ? decryptData($_GET['id']) : null;
$banquet = [];
$ratingResult = [];
if ($enc_id) {
    $banquet = getBanquetHallById($enc_id) ?? [];

    if (empty($banquet)) {
        echo "<p class='text-danger'>Banquet hall not found.</p>";
        exit;
    }
    $ratingResult = getBanquetRatingsByHallId($enc_id);
    $totalReviews = count($ratingResult);
    $averageRating = 0;

    if ($totalReviews > 0) {
        $sum = array_sum(array_column($ratingResult, '_rating'));
        $averageRating = round($sum / $totalReviews, 1); // e.g., 4.0
    }
}
?>
<style>
    .banquet-header {
        background: linear-gradient(135deg, #24ba38ff, #c9dfc0ff);
        color: #000;
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.25);
    }

    .banquet-image {
        max-height: 380px;
        object-fit: cover;
        border-radius: 1rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    .service-badge {
        display: inline-flex;
        align-items: center;
        border-radius: 50px;
        padding: 0.45rem 1rem;
        font-size: 0.85rem;
        font-weight: 500;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.25);
        transition: 0.2s;
    }

    .service-badge:hover {
        box-shadow: 0 4px 12px rgba(255, 255, 255, 0.15);
    }

    .book-btn {
        background: linear-gradient(135deg, #0AA865, #078a57);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 0.9rem 2rem;
        font-size: 1.1rem;
        font-weight: 500;
        transition: 0.3s;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
    }

    .book-btn:hover {
        background: linear-gradient(135deg, #078a57, #056d46);
    }

    h3 {
        font-size: 1.4rem;
        font-weight: 600;
        color: #f1f1f1;
        border-left: 4px solid #0AA865;
        padding-left: 0.6rem;
        margin-bottom: 1rem;
    }

    hr {
        border-color: rgba(255, 255, 255, 0.1);
    }

    .review-card {
        border-left: 4px solid #0AA865;
        background-color: #1f1f1f;
        border-radius: 0.75rem;
        padding: 1.2rem;
        margin-bottom: 1rem;
        color: #FFF;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    }
</style>
</head>

<body>
    <?php require 'navbar.php'; ?>
    <div id="eventLoader" class="event-loader">
        <div class="loader-inner">
            <div class="loader-ring"></div>
            <div class="loader-text">Loading Banquet Hall Details.....</div>
        </div>
    </div>
    <div class="content">
        <div class="container py-5">
            <?php if (!empty($banquet)): ?>
                <!-- Banquet Header -->
                <div class="banquet-header mb-4 text-center shadow-lg">
                    <h1 class="mb-2 fw-bold"><?= htmlspecialchars($banquet['_hall_name']) ?></h1>
                    <p class="mb-0">
                        <i class="bi bi-people-fill text-success"></i>
                        <strong>Capacity:</strong> <?= (int) $banquet['_total_capacity'] ?> Guests |
                        <i class="bi bi-currency-rupee text-warning"></i> <strong>Price:</strong>
                        ₹<?= number_format($banquet['_rental_charge']) ?> onwards
                    </p>
                </div>
                <div class="row g-4 text-white">
                    <!-- Banquet Image -->
                    <div class="col-md-6">
                        <img src="<?= htmlspecialchars($banquet['_hall_image_url']) ?>" class="w-100 banquet-image"
                            alt="Banquet Image">
                    </div>
                    <!-- Banquet Details -->
                    <div class="col-md-6 d-flex flex-column justify-content-between">
                        <div class="mt-5">
                            <?php $hall_id = $banquet['_id']; ?>
                            <?php $vendor_id = $banquet['_user_id']; ?>
                            <!-- Hall Name -->
                            <h3 class="mb-3 fw-bold text-white"><?= htmlspecialchars($banquet['_hall_name']) ?></h3>
                            <!-- Capacity -->
                            <p class="mb-2">
                                <strong>Capacity:</strong> <?= (int) $banquet['_total_capacity'] ?> Guests
                            </p>
                            <!-- Starting Price -->
                            <p class="mb-2">
                                <strong>Starting Price:</strong>
                                <span class="text-success fw-bold">
                                    ₹<?= number_format($banquet['_rental_charge'], 0) ?> onwards
                                </span>
                            </p>
                            <!-- Description -->
                            <p class="text-white">
                                <?= nl2br(htmlspecialchars($banquet['_hall_description'])) ?>
                            </p>
                            <!-- Booking Time -->
                            <p
                                class="card-text text-white small rounded-pill bg-success d-inline-flex align-items-center px-3 py-1 fw-bold">
                                <i class="bi bi-clock me-2"></i>
                                <?php
                                if (!empty($banquet['_booking_from']) && !empty($banquet['_booking_to'])) {
                                    $from = date('g:i A', strtotime($banquet['_booking_from']));
                                    $to = date('g:i A', strtotime($banquet['_booking_to']));
                                    echo $from . ' - ' . $to;
                                } else {
                                    echo 'Not Specified';
                                }
                                ?>
                            </p>
                        </div>
                        <!-- Schedule Visit Button -->
                        <div class="mt-4">
                            <button class="btn btn-success btn-lg rounded-pill fw-bold w-100 schedule-visit-btn"
                                data-bs-toggle="modal" data-bs-target="#scheduleVisitModal"
                                data-hall-id="<?= $hall_id ?>"
                                data-vendor-id="<?= $banquet['_user_id'] ?>">
                                <i class="bi bi-calendar-plus me-2"></i> Schedule Visit
                            </button>
                        </div>
                    </div>
                </div>
                <div class="mt-5 text-white">
                    <h3>Other Charges</h3>
                    <hr>
                    <div class="d-flex flex-wrap align-items-center gap-3 mb-3">
                        <span class="service-badge bg-dark px-3 py-2 rounded-pill d-flex align-items-center">
                            <i class="bi bi-brush-fill text-warning me-2"></i>
                            <strong>Decoration :</strong>&nbsp;
                            ₹<?= number_format((float) $banquet['_decoration_charge'], 0) ?>
                        </span>
                        <span class="service-badge bg-dark px-3 py-2 rounded-pill d-flex align-items-center">
                            <i class="bi bi-stars text-info me-2"></i>
                            <strong>Theme Decoration :</strong>&nbsp;
                            ₹<?= number_format((float) $banquet['_theme_charge'], 0) ?>
                        </span>
                        <span class="service-badge bg-dark px-3 py-2 rounded-pill d-flex align-items-center">
                            <i class="bi bi-flower3 text-danger me-2"></i>
                            <strong>Florist :</strong>&nbsp;
                            ₹<?= number_format((float) $banquet['_flourist_charge'], 0) ?>
                        </span>
                        <span class="service-badge bg-dark px-3 py-2 rounded-pill d-flex align-items-center">
                            <i class="bi bi-lightbulb-fill text-warning me-2"></i>
                            <strong>Lighting :</strong>&nbsp;
                            ₹<?= number_format((float) $banquet['_lighting_charge'], 0) ?>
                        </span>
                    </div>
                </div>
                <div class="mt-5 text-white">
                    <h3>Hall Specifications</h3>
                    <hr>
                    <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                        <span class="service-badge bg-dark px-3 py-2 rounded-pill">
                            <i class="bi bi-people-fill me-1"></i>
                            <strong>Total Capacity : </strong>&nbsp;
                            <?= htmlspecialchars($banquet['_total_capacity']) ?>
                        </span>
                        <span class="service-badge bg-dark px-3 py-2 rounded-pill">
                            <i class="bi bi-chair me-1"></i>
                            <strong>Seating : </strong>&nbsp;
                            <?= htmlspecialchars($banquet['_seated_capacity']) ?>
                        </span>
                        <span class="service-badge bg-dark px-3 py-2 rounded-pill">
                            <i class="bi bi-person-arms-up me-1"></i>
                            <strong>Floating : </strong>&nbsp;
                            <?= htmlspecialchars($banquet['_floating_capacity']) ?>
                        </span>
                        <span class="service-badge bg-dark px-3 py-2 rounded-pill">
                            <i class="bi bi-building me-1"></i>
                            <strong>Floors : </strong>&nbsp;
                            <?= htmlspecialchars($banquet['_number_of_floors']) ?>
                        </span>
                        <span class="service-badge bg-dark px-3 py-2 rounded-pill">
                            <i class="bi bi-house-door me-1"></i>
                            <strong>Halls : </strong>&nbsp;
                            <?= htmlspecialchars($banquet['_number_of_halls']) ?>
                        </span>
                        <span class="service-badge bg-dark px-3 py-2 rounded-pill">
                            <i class="bi bi-arrows-expand me-1"></i>
                            <strong>Area : </strong>&nbsp;
                            <?= htmlspecialchars($banquet['_hall_area_sqft']) ?> sq.ft
                        </span>
                        <span class="service-badge bg-dark px-3 py-2 rounded-pill">
                            <i class="bi bi-arrows-vertical me-1"></i>
                            <strong>Ceiling : </strong>&nbsp;
                            <?= htmlspecialchars($banquet['_ceiling_height']) ?> ft
                        </span>
                        <span class="service-badge bg-dark px-3 py-2 rounded-pill">
                            <i class="bi bi-door-open me-1"></i>
                            <strong>Type : </strong>&nbsp;
                            <?= htmlspecialchars($banquet['_hall_type']) ?>
                        </span>
                        <span class="service-badge bg-dark px-3 py-2 rounded-pill">
                            <i class="bi bi-box me-1"></i>
                            <strong>Stage Area : </strong> &nbsp;
                            <?= htmlspecialchars($banquet['_stage_size']) ?>
                        </span>
                        <span
                            class="service-badge px-3 py-2 rounded-pill text-white <?= $banquet['_dance_floor_available'] ? 'bg-success' : 'bg-secondary' ?>">
                            <i
                                class="bi <?= $banquet['_dance_floor_available'] ? 'bi-check-circle-fill' : 'bi-x-circle-fill' ?> me-1"></i>
                            <strong>Dance Floor</strong>
                        </span>
                        <span
                            class="service-badge px-3 py-2 rounded-pill text-white <?= $banquet['_air_conditioning'] ? 'bg-success' : 'bg-secondary' ?>">
                            <i class="bi <?= $banquet['_air_conditioning'] ? 'bi-snow' : 'bi-x-circle-fill' ?> me-1"></i>
                            <strong>Air Conditioning</strong>
                        </span>
                        <span
                            class="service-badge px-3 py-2 rounded-pill text-white <?= $banquet['_stage_available'] ? 'bg-success' : 'bg-secondary' ?>">
                            <i
                                class="bi <?= $banquet['_stage_available'] ? 'bi-check-circle-fill' : 'bi-x-circle-fill' ?> me-1"></i>
                            <strong>Stage Available</strong>
                        </span>
                    </div>

                </div>
                <div class="mt-5 text-white">
                    <h3>Facilities & Amenities</h3>
                    <hr>
                    <div class="d-flex flex-wrap align-items-center gap-3 mb-3">

                        <!-- Parking Availability -->
                        <span
                            class="service-badge px-3 py-2 rounded-pill text-white <?= $banquet['_is_parking_available'] ? 'bg-success' : 'bg-secondary' ?>"
                            data-bs-toggle="tooltip" title="Parking Facility">
                            <i
                                class="bi <?= $banquet['_is_parking_available'] ? 'bi-check-circle-fill' : 'bi-x-circle-fill' ?> me-1"></i>
                            <strong>Parking</strong>
                        </span>

                        <!-- Parking Capacity -->
                        <span class="service-badge bg-dark px-3 py-2 rounded-pill">
                            <i class="bi bi-car-front me-1"></i> <strong>Cars :</strong>&nbsp;
                            <strong><?= htmlspecialchars($banquet['_parking_capacity_cars']) ?></strong>
                        </span>
                        <span class="service-badge bg-dark px-3 py-2 rounded-pill">
                            <i class="bi bi-bicycle me-1"></i> <strong>Bikes :</strong>&nbsp;
                            <strong><?= htmlspecialchars($banquet['_parking_capacity_bikes']) ?></strong>
                        </span>

                        <!-- Changing Rooms & Restrooms -->
                        <span class="service-badge bg-dark px-3 py-2 rounded-pill">
                            <i class="bi bi-person-arms-up me-1"></i> <strong>Changing Rooms :</strong>&nbsp;
                            <strong><?= htmlspecialchars($banquet['_changing_rooms']) ?></strong>
                        </span>
                        <span class="service-badge bg-dark px-3 py-2 rounded-pill">
                            <i class="bi bi-building me-1"></i> <strong>Restrooms :</strong>&nbsp;
                            <strong><?= htmlspecialchars($banquet['_restrooms']) ?></strong>
                        </span>

                        <!-- Conditional Facilities -->
                        <?php
                        $facilities = [
                            '_accessible_facilities' => 'Facilities Accessible',
                            '_lift_available' => 'Lift Available',
                            '_sound_system_available' => 'Sound System',
                            '_wifi_available' => 'WiFi',
                            '_power_backup_available' => 'Power Backup',
                            '_seperate_kitchen_available' => 'Separate Kitchen'
                        ];
                        foreach ($facilities as $key => $label) {
                            $available = $banquet[$key];
                            echo '<span class="service-badge px-3 py-2 rounded-pill text-white ' . ($available ? 'bg-success' : 'bg-secondary') . '">';
                            echo '<i class="bi ' . ($available ? 'bi-check-circle-fill' : 'bi-x-circle-fill') . ' me-1"></i>';
                            echo '<strong>' . $label . '</strong>';
                            echo '</span>';
                        }
                        ?>
                    </div>
                </div>
                <div class="mt-5 text-white">
                    <h3>Food & Catering</h3>
                    <hr>
                    <div class="d-flex flex-wrap align-items-center gap-3 mb-3">
                        <!-- In-house Catering -->
                        <span
                            class="service-badge px-3 py-2 rounded-pill text-white <?= $banquet['_inhouse_catering'] ? 'bg-success' : 'bg-secondary' ?>"
                            data-bs-toggle="tooltip" title="In-house catering services available">
                            <i
                                class="bi <?= $banquet['_inhouse_catering'] ? 'bi-house-door-fill' : 'bi-x-circle-fill' ?> me-1"></i>
                            <strong>In-house Catering</strong>
                        </span>

                        <!-- Outside Catering -->
                        <span
                            class="service-badge px-3 py-2 rounded-pill text-white <?= $banquet['_outside_catering_allowed'] ? 'bg-success' : 'bg-secondary' ?>"
                            data-bs-toggle="tooltip" title="Outside catering allowed">
                            <i
                                class="bi <?= $banquet['_outside_catering_allowed'] ? 'bi-box-arrow-up-right' : 'bi-x-circle-fill' ?> me-1"></i>
                            <strong>Outside Catering Allowed</strong>
                        </span>

                        <!-- Minimum Per Plate -->
                        <span class="service-badge bg-dark px-3 py-2 rounded-pill">
                            <i class="bi bi-currency-rupee me-1"></i> <strong>Min Per Plate :</strong>&nbsp;
                            <strong><?= number_format((float) $banquet['_per_plate_price_min'], 0) ?></strong>
                        </span>

                        <!-- Maximum Per Plate -->
                        <span class="service-badge bg-dark px-3 py-2 rounded-pill">
                            <i class="bi bi-currency-rupee me-1"></i> <strong>Max Per Plate :</strong>&nbsp;
                            <strong><?= number_format((float) $banquet['_per_plate_price_max'], 0) ?></strong>
                        </span>

                        <!-- Alcohol Policy -->
                        <span class="service-badge bg-dark px-3 py-2 rounded-pill">
                            <i class="bi bi-cup-straw me-1"></i> <strong>Alcohol Policy :</strong>&nbsp;
                            <strong><?= htmlspecialchars($banquet['_alcohol_policy']) ?></strong>
                        </span>
                    </div>
                </div>
                <div class="mt-5 text-white">
                    <h3>Decoration & Setup</h3>
                    <hr>
                    <div class="d-flex flex-wrap align-items-center gap-3 mb-3">
                        <!-- In-house Decoration -->
                        <span
                            class="service-badge px-3 py-2 rounded-pill text-white <?= $banquet['_inhouse_decor'] ? 'bg-success' : 'bg-secondary' ?>"
                            data-bs-toggle="tooltip" title="In-house decoration services available">
                            <i class="bi <?= $banquet['_inhouse_decor'] ? 'bi-brush-fill' : 'bi-x-circle-fill' ?> me-1"></i>
                            <strong>In-house Decoration</strong>
                        </span>

                        <!-- Outside Decoration -->
                        <span
                            class="service-badge px-3 py-2 rounded-pill text-white <?= $banquet['_outside_decor_allowed'] ? 'bg-success' : 'bg-secondary' ?>"
                            data-bs-toggle="tooltip" title="Outside decoration allowed">
                            <i
                                class="bi <?= $banquet['_outside_decor_allowed'] ? 'bi-brush' : 'bi-x-circle-fill' ?> me-1"></i>
                            <strong>Outside Decoration</strong>
                        </span>

                        <!-- Theme Decoration -->
                        <span
                            class="service-badge px-3 py-2 rounded-pill text-white <?= $banquet['_theme_decor_support'] ? 'bg-success' : 'bg-secondary' ?>"
                            data-bs-toggle="tooltip" title="Theme decoration support available">
                            <i
                                class="bi <?= $banquet['_theme_decor_support'] ? 'bi-stars' : 'bi-x-circle-fill' ?> me-1"></i>
                            <strong>Theme Decoration</strong>
                        </span>

                        <!-- Furniture Provided -->
                        <span class="service-badge bg-dark px-3 py-2 rounded-pill">
                            <i class="bi bi-table me-1"></i> <strong>Furniture Provided :</strong>&nbsp;
                            <strong><?= htmlspecialchars($banquet['_furniture_provided']) ?></strong>
                        </span>
                    </div>
                </div>
                <div class="mt-5 text-white">
                    <h3>Cancellation Policy</h3>
                    <hr>
                    <div class="d-flex flex-wrap align-items-center gap-3 mb-3">
                        <span
                            class="service-badge px-3 py-2 rounded-pill text-white <?= !empty($banquet['_cancellation_policy']) ? 'bg-danger' : 'bg-secondary' ?>">
                            <i class="bi bi-x-octagon-fill me-1"></i>
                            <strong>
                                <?= !empty($banquet['_cancellation_policy'])
                                    ? htmlspecialchars($banquet['_cancellation_policy'])
                                    : 'No specific cancellation policy provided' ?>
                            </strong>
                        </span>
                    </div>
                </div>
                <div class="mt-5 text-white">
                    <h3>Licenses & Compliance</h3>
                    <hr>
                    <div class="d-flex flex-wrap align-items-center gap-3 mb-3">
                        <!-- Fire Safety -->
                        <span
                            class="service-badge px-3 py-2 rounded-pill text-white <?= $banquet['_fire_safety_certificate'] ? 'bg-success' : 'bg-danger' ?>"
                            data-bs-toggle="tooltip" title="Fire and safety certificate availability">
                            <i
                                class="bi <?= $banquet['_fire_safety_certificate'] ? 'bi-shield-check' : 'bi-shield-exclamation' ?> me-1"></i>
                            Fire & Safety
                        </span>
                        <!-- Food License -->
                        <span
                            class="service-badge px-3 py-2 rounded-pill text-white <?= $banquet['_food_license'] ? 'bg-success' : 'bg-danger' ?>"
                            data-bs-toggle="tooltip" title="Food license compliance">
                            <i class="bi <?= $banquet['_food_license'] ? 'bi-badge-check' : 'bi-x-circle-fill' ?> me-1"></i>
                            Food License
                        </span>
                        <!-- Event Permission -->
                        <span
                            class="service-badge px-3 py-2 rounded-pill text-white <?= $banquet['_event_permission_required'] ? 'bg-success' : 'bg-warning' ?>"
                            data-bs-toggle="tooltip" title="Event permission requirements">
                            <i
                                class="bi <?= $banquet['_event_permission_required'] ? 'bi-clipboard-check' : 'bi-exclamation-triangle' ?> me-1"></i>
                            Event Permission
                        </span>
                    </div>
                </div>
                <div class="mt-5 text-white">
                    <h3>Location & Address</h3>
                    <hr>
                    <div class="card shadow-sm rounded-4 mb-4 border-0">
                        <div class="card-body">
                            <p><strong>📍 Address:</strong>
                                <?= htmlspecialchars(($banquet['_flat_no'] ?? '') . ", " . ($banquet['_address'] ?? '') . ", " . ($banquet['_city'] ?? '') . ", " . ($banquet['_state'] ?? '') . " - " . ($banquet['_pincode'] ?? '')) ?>
                            </p>
                            <div id="map" style="height:250px; width:100%; border-radius:12px;"></div>
                        </div>
                    </div>
                </div>
                <div class="mt-5 text-white">
                    <h3>Customer Reviews & Ratings</h3>
                    <div class="d-flex align-items-center mb-3">
                        <div class="fs-3 text-warning me-2">
                            <?= str_repeat('★', floor($averageRating)) ?>
                            <?= str_repeat('☆', 5 - floor($averageRating)) ?>
                        </div>
                        <span class="fw-bold">
                            <?= $averageRating ?>/5 (Based on <?= $totalReviews ?>
                            review<?= $totalReviews !== 1 ? 's' : '' ?>)
                        </span>
                    </div>
                    <!-- Reviews -->
                    <?php if (!empty($ratingResult)): ?>
                        <?php foreach ($ratingResult as $review): ?>
                            <div class="review-card p-3 rounded-3 mb-3 shadow-sm border-start border-4 border-success bg-light"
                                style="color: #000; transition: transform 0.3s ease, box-shadow 0.3s ease;"
                                onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 6px 12px rgba(0,0,0,0.15)';"
                                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 6px rgba(0,0,0,0.1)';">

                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <strong><?= htmlspecialchars($review['_customer_name'] ?? 'Anonymous') ?></strong>
                                    <span class="small" style="color: #ffc107;">
                                        <?= str_repeat('★', (int) $review['_rating']) ?>
                                        <?= str_repeat('☆', 5 - (int) $review['_rating']) ?>
                                    </span>
                                </div>

                                <p class="mb-0" style="color: #000;">
                                    <?php
                                    $text = htmlspecialchars($review['_review']);
                                    echo (strlen($text) > 80) ? substr($text, 0, 80) . '...' : $text;
                                    ?>
                                </p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="alert alert-secondary text-center rounded-3 shadow-sm">
                            No Review's Available
                        </div>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="text-center text-white py-5">
                    <h2>No Banquet Hall Found</h2>
                    <p>The banquet hall you are looking for does not exist or is no longer available.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php require './bootstrap_modals/schedule_visit_modal.php'; ?>
    <?php require './bootstrap_modals/success_error_modal.php'; ?>
    <script>
        const BASE_URL = "<?= BASE_URL ?>";
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC_45Rq9STmkXf2jatXaVg-XUcd2ykD4hs"></script>
    <script src="assets/js/common.js"></script>
    <script src="assets/js/banquets.js"></script>
    <script>
        function initMap() {
            let locationString = "<?= $banquet['_location'] ?? '' ?>"; // "lat,lng"
            if (!locationString) return;
            let coords = locationString.split(",");
            let lat = parseFloat(coords[0].trim());
            let lng = parseFloat(coords[1].trim());
            let hallLocation = { lat: lat, lng: lng };

            let map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: hallLocation
            });

            new google.maps.Marker({
                position: hallLocation,
                map: map,
                title: "<?= htmlspecialchars($hall['tbh_hall_name'] ?? 'Banquet Hall') ?>"
            });
        }
        window.onload = initMap;
    </script>
</body>

</html>