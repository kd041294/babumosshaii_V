<?php
require 'template_header.php';

$profileId = decryptData($_GET['id']) ?? null;
$result = getMakeupPackageDetailsById($profileId, 1, 1);
$pkg = $result['data'] ?? null;

$images = !empty($pkg['_image_urls']) ? explode('||', $pkg['_image_urls']) : [];
$reviews = [];

if (!empty($pkg['_reviews_json'])) {

    $reviewItems = explode('||', $pkg['_reviews_json']);

    foreach ($reviewItems as $item) {
        $decoded = json_decode($item, true);

        if (json_last_error() === JSON_ERROR_NONE && !empty($decoded)) {
            $reviews[] = $decoded;
        }
    }
}
$service_type = 'MAKEUP';
?>
<title>
    <?= !empty($pkg['_package_title'])
        ? htmlspecialchars($pkg['_package_title']) . ' | BabuMosshaii Event & Co.'
        : 'Makeup Packages | BabuMosshaii Event & Co.' ?>
</title>
<meta name="description"
    content="Discover top makeup packages in Kolkata with BabuMosshaii. Book professional makeup artists for weddings and events. Explore our curated makeup services now!">
<meta name="keywords"
    content="Makeup packages Kolkata, best makeup artists Kolkata, wedding makeup services Kolkata, makeup design packages Kolkata, makeup artist booking Kolkata">

<style>
    /* MAIN CONTAINER */
    .profile-container {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.08);
    }

    /* CAROUSEL IMAGE */
    .carousel-img {
        width: 100%;
        height: 100%;
        min-height: 420px;
        object-fit: cover;
    }

    /* DETAILS */
    .details-section {
        padding: 30px;
        background: #ebc0d8;
    }

    /* TITLE */
    .title {
        font-size: 26px;
        font-weight: 700;
    }

    /* COMPANY */
    .company {
        color: #888;
        font-size: 14px;
    }

    /* PRICE */
    .price-box {
        background: linear-gradient(135deg, #f99583, #ff7b6b);
        color: #fff;
        padding: 15px;
        border-radius: 12px;
    }

    .old-price {
        text-decoration: line-through;
        display: block;
        opacity: 0.8;
    }

    /* INFO GRID */
    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .info-box {
        background: #f7f7f7;
        padding: 12px;
        border-radius: 10px;
        font-size: 14px;
    }

    /* BUTTON */
    .btn-query {
        background: linear-gradient(135deg, #f99583, #ff7b6b);
        color: #fff;
        border: none;
        padding: 14px;
        border-radius: 30px;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn-query:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(249, 149, 131, 0.4);
    }

    /* MOBILE FIX */
    @media(max-width:768px) {
        .carousel-img {
            min-height: 250px;
        }
    }

    /* ===== IMAGE SECTION ===== */
    .carousel-item img {
        height: 450px;
        object-fit: cover;
        border-radius: 20px 0 0 20px;
    }

    /* ===== RIGHT SIDE ===== */
    .details-section {
        padding: 30px;
    }

    /* TITLE */
    .title {
        font-size: 26px;
        font-weight: 700;
    }

    /* COMPANY */
    .company {
        color: #777;
        font-size: 14px;
    }

    /* PRICE BOX */
    .price-box {
        background: linear-gradient(135deg, #f99583, #ff7b6b);
        color: #fff;
        padding: 15px;
        border-radius: 15px;
        margin: 20px 0;
    }

    .price-box h3 {
        margin: 0;
        font-weight: 700;
    }

    /* INFO GRID */
    .info-box {
        background: #f9f9f9;
        border-radius: 12px;
        padding: 10px 15px;
        margin-bottom: 10px;
    }

    /* SECTION TITLE */
    .section-title {
        font-weight: 600;
        margin-top: 20px;
        margin-bottom: 8px;
    }

    /* BUTTON */
    .btn-query {
        background: linear-gradient(135deg, #f99583, #ff7b6b);
        color: #fff;
        border: none;
        border-radius: 30px;
        padding: 12px;
        width: 100%;
        font-size: 16px;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn-query:hover {
        transform: scale(1.03);
        box-shadow: 0 10px 20px rgba(249, 149, 131, 0.4);
    }

    /* FLOATING CTA */
    .sticky-box {
        position: sticky;
        top: 100px;
    }

    /* MOBILE */
    @media(max-width:768px) {
        .carousel-item img {
            border-radius: 20px 20px 0 0;
            height: 250px;
        }
    }

    .content-box {
        background: #ebc0d8;
        border-radius: 10px;
        line-height: 1.6;
        padding: 2%;
    }

    .content-box p {
        margin-bottom: 10px;
    }

    .review-card {
        background-color: #ebc0d8;
        padding: 1%;
        margin: 1%;
        border-radius: 10px;
    }

    .booking-modal {
        border-radius: 20px;
        overflow: hidden;
    }

    /* HEADER */
    .modal-header {
        background: linear-gradient(135deg, #f99583, #ff7b6b);
        color: #fff;
    }

    /* PACKAGE CARD */
    .package-card {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #fff3f0;
        padding: 15px;
        border-radius: 12px;
    }

    .price-tag {
        background: #ff7b6b;
        color: #fff;
        padding: 8px 15px;
        border-radius: 20px;
        font-weight: 600;
    }

    /* FORM SECTION */
    .form-section {
        background: #fafafa;
        padding: 15px;
        border-radius: 12px;
        margin-bottom: 15px;
    }

    .form-section h6 {
        font-weight: 600;
        margin-bottom: 10px;
    }

    /* INPUT */
    .form-control {
        border-radius: 10px;
        font-size: 14px;
    }

    /* BUTTON */
    .btn-query {
        background: linear-gradient(135deg, #f99583, #ff7b6b);
        color: #fff;
        border-radius: 30px;
        padding: 12px;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn-query:hover {
        transform: scale(1.03);
        box-shadow: 0 10px 20px rgba(249, 149, 131, 0.4);
    }
</style>

<?= require 'navbar.php'; ?>

<div class="container py-5">

    <?php if ($pkg) { ?>

        <div class="row profile-container g-0 align-items-stretch">

            <!-- LEFT: IMAGES -->
            <div class="col-md-7">

                <?php if (!empty($images)) { ?>
                    <div id="carouselExample" class="carousel slide h-100" data-bs-ride="carousel">

                        <!-- INDICATORS -->
                        <div class="carousel-indicators">
                            <?php foreach ($images as $i => $img) { ?>
                                <button type="button"
                                    data-bs-target="#carouselExample"
                                    data-bs-slide-to="<?= $i ?>"
                                    class="<?= $i == 0 ? 'active' : '' ?>">
                                </button>
                            <?php } ?>
                        </div>

                        <!-- IMAGES -->
                        <div class="carousel-inner h-100">
                            <?php foreach ($images as $i => $img) { ?>
                                <div class="carousel-item <?= $i == 0 ? 'active' : '' ?> h-100">
                                    <img src="<?= htmlspecialchars(trim($img)) ?>" class="carousel-img">
                                </div>
                            <?php } ?>
                        </div>

                        <!-- CONTROLS -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>

                    </div>
                <?php } ?>

            </div>

            <!-- RIGHT: DETAILS -->
            <div class="col-md-5 d-flex">

                <div class="details-section w-100 d-flex flex-column justify-content-between">

                    <div>

                        <!-- TITLE -->
                        <h2 class="title mb-2">
                            <?= htmlspecialchars($pkg['_package_title']) ?>
                        </h2>

                        <!-- COMPANY -->
                        <div class="company mb-3">
                            <i class="bi bi-building me-1"></i>
                            <?= htmlspecialchars($pkg['_company_name']) ?>
                        </div>

                        <!-- PRICE -->
                        <div class="price-box mb-3">
                            <?php if ($pkg['_price'] > $pkg['_final_price']) { ?>
                                <small class="old-price">₹<?= $pkg['_price'] ?></small>
                            <?php } ?>
                            <h3 class="mb-0">₹<?= $pkg['_final_price'] ?></h3>
                        </div>

                        <!-- INFO GRID -->
                        <div class="info-grid">
                            <div class="info-box"><span>⏱ Duration :</span> <?= $pkg['_service_duration'] ?></div>
                            <div class="info-box"><span>👤 Person Covered :</span> <?= $pkg['_person_covered'] ?></div>
                            <div class="info-box"><span>🎨 No of Artists :</span> <?= $pkg['_no_of_artist'] ?></div>
                            <div class="info-box"><span>📅 Validity :</span> <?= $pkg['_service_validity'] ?></div>
                        </div>

                    </div>

                    <!-- CTA -->
                    <button class="btn-query mt-4"
                        data-bs-toggle="modal"
                        data-bs-target="#bookingModal">
                        <i class="bi bi-send-fill me-2"></i> Send Query
                    </button>

                </div>

            </div>

        </div>

        <!-- LOWER CONTENT -->
        <div class="mt-4 p-4 profile-container">

            <!-- DESCRIPTION -->
            <div class="section-title d-flex align-items-center">
                <i class="bi bi-card-text me-2 text-danger"></i>
                Description
            </div>
            <div class="content-box p-3 mb-3">
                <?= safeHtml($pkg['_description']) ?>
            </div>

            <!-- FEATURES -->
            <div class="section-title d-flex align-items-center">
                <i class="bi bi-stars me-2 text-warning"></i>
                Features
            </div>
            <div class="content-box p-3 mb-3">
                <ul class="feature-list">
                    <?php
                    $features = explode(',', $pkg['_features']);
                    foreach ($features as $feature) {
                        $feature = trim($feature);
                        if (!empty($feature)) {
                            echo '<li><i class="bi bi-check-circle-fill text-success me-2"></i>'
                                . htmlspecialchars($feature) . '</li>';
                        }
                    }
                    ?>
                </ul>
            </div>

            <!-- PACKAGE INCLUDES -->
            <div class="section-title d-flex align-items-center">
                <i class="bi bi-gift-fill me-2 text-primary"></i>
                Package Includes
            </div>
            <div class="content-box p-3">
                <?= safeHtml($pkg['_package_includes']) ?>
            </div>

        </div>

        <!-- ⭐ RATINGS & REVIEWS -->
        <div class="mt-4 p-4 profile-container">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">⭐ Ratings & Reviews</h4>

                <div class="rating-summary">
                    <span class="rating-number"><?= $pkg['_avg_rating'] ?? '0' ?></span>
                    <span class="text-muted">(<?= $pkg['_total_reviews'] ?? 0 ?> reviews)</span>
                </div>
            </div>

            <?php if (count($reviews) > 0) { ?>

                <div class="review-list">

                    <?php foreach ($reviews as $r) { ?>

                        <div class="review-card">

                            <div class="d-flex justify-content-between">
                                <strong><?= htmlspecialchars($r['name']) ?></strong>

                                <div class="stars">
                                    <?= str_repeat('⭐', (int)$r['rating']) ?>
                                </div>
                            </div>

                            <p class="review-msg mt-2">
                                <?= htmlspecialchars($r['msg']) ?>
                            </p>

                        </div>

                    <?php } ?>

                </div>

            <?php } else { ?>
                <p class="text-muted">No reviews yet</p>
            <?php } ?>

        </div>

    <?php } else { ?>

        <div class="text-center">
            <h4>No Package Found 😢</h4>
        </div>

    <?php } ?>

</div>
<?php require './bootstrap_modals/send_artist_inquiry_form_modal.php'; ?>
<?php require './bootstrap_modals/toaster_modal.php'; ?>
<!-- Footer -->
<?php require 'footer.php'; ?>

<!-- Quick Connect -->
<div class="quick-connect-btn" id="quickConnectBtn">
    <i class="fas fa-comments"></i>
</div>
<?php require 'quick_connect.php'; ?>
<script>
    const BASE_URL = '<?= BASE_URL ?>';
</script>
<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/common.js"></script>
<script src="assets/js/artist_profile.js"></script>
<div id="pageLoader" class="loader-overlay">
    <div class="loader-spinner"></div>
</div>
</body>
</html>