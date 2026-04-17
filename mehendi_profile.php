<?php
require 'template_header.php';


$profileId = decryptData($_GET['id']) ?? null;
$result = getMehendiPackageDetailsById($profileId, 1, 1);
$pkg = $result['data'] ?? null;

$artist_id = $pkg['_user_id'] ?? null;
$artist_uniq_id = $pkg['_user_uniq_id'] ?? null;

if ($artist_id && $artist_uniq_id) {
    $artistGalleryResults = getArtistGalleryImages($artist_id, $artist_uniq_id);
    $galleryImages = [];
    $galleryVideos = [];

    if (!empty($artistGalleryResults['data'])) {
        foreach ($artistGalleryResults['data'] as $g) {
            if ($g['_media_type'] === 'image') {
                $galleryImages[] = $g;
            } elseif ($g['_media_type'] === 'video') {
                $galleryVideos[] = $g;
            }
        }
    }
}

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
$ratingCounts = [
    5 => 0,
    4 => 0,
    3 => 0,
    2 => 0,
    1 => 0,
];

foreach ($reviews as $r) {
    $rating = (int)($r['rating'] ?? 0);

    if ($rating >= 1 && $rating <= 5) {
        $ratingCounts[$rating]++;
    }
}

$totalReviews = count($reviews);
$service_type = 'MEHENDI';
?>
<title>
    <?= !empty($pkg['_package_title'])
        ? htmlspecialchars($pkg['_package_title']) . ' | BabuMosshaii Event & Co.'
        : 'Mehendi Packages | BabuMosshaii Event & Co.' ?>
</title>
<meta name="description"
    content="Discover top mehendi packages in Kolkata with BabuMosshaii. Book professional mehendi artists for weddings and events. Explore our curated mehendi services now!">
<meta name="keywords"
    content="Mehendi packages Kolkata, best mehendi artists Kolkata, wedding mehendi services Kolkata, mehendi design packages Kolkata, mehendi artist booking Kolkata">

<style>
    /* ============================= */
    /* GLOBAL CONTAINER */
    /* ============================= */
    .profile-container {
        background: #fff;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
    }

    /* ============================= */
    /* IMAGE CAROUSEL */
    /* ============================= */
    .carousel-img {
        width: 100%;
        height: 100%;
        min-height: 420px;
        object-fit: cover;
    }

    @media(max-width:768px) {
        .carousel-img {
            min-height: 240px;
        }
    }

    /* ============================= */
    /* DETAILS SECTION */
    /* ============================= */
    .details-section {
        padding: 25px;
    }

    .title {
        font-size: 24px;
        font-weight: 700;
    }

    .company {
        font-size: 14px;
        color: #777;
    }

    /* ============================= */
    /* PRICE */
    /* ============================= */
    .price-box {
        background: linear-gradient(135deg, #f99583, #ff7b6b);
        color: #fff;
        padding: 14px;
        border-radius: 12px;
        margin: 15px 0;
    }

    .old-price {
        text-decoration: line-through;
        font-size: 13px;
        opacity: 0.8;
    }

    /* ============================= */
    /* INFO GRID */
    /* ============================= */
    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .info-box {
        background: #f7f7f7;
        padding: 10px;
        border-radius: 10px;
        font-size: 13px;
    }

    /* ============================= */
    /* BUTTON */
    /* ============================= */
    .btn-query {
        background: linear-gradient(135deg, #f99583, #ff7b6b);
        color: #fff;
        border: none;
        border-radius: 30px;
        padding: 12px;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn-query:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(249, 149, 131, 0.4);
    }

    /* ============================= */
    /* TABS */
    /* ============================= */
    .custom-tabs {
        flex-wrap: nowrap;
        overflow-x: auto;
        scrollbar-width: none;
    }

    .custom-tabs::-webkit-scrollbar {
        display: none;
    }

    .custom-tabs .nav-link {
        border-radius: 30px;
        padding: 8px 16px;
        margin-right: 8px;
        background: #abaaaa;
        color: #dfdddd;
        font-size: 13px;
        border: none;
    }

    .custom-tabs .nav-link.active {
        background: linear-gradient(135deg, #f99583, #ff7b6b);
        color: #fff;
    }

    /* ============================= */
    /* CONTENT CARDS */
    /* ============================= */
    .content-card {
        background: #fff;
        padding: 18px;
        border-radius: 14px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        line-height: 1.6;
    }

    .section-heading {
        font-weight: 600;
        margin-bottom: 10px;
    }

    /* ============================= */
    /* FEATURES */
    /* ============================= */
    .feature-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .feature-item {
        background: #fff5f3;
        padding: 10px;
        border-radius: 10px;
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .feature-item i {
        color: #ff6b5c;
    }

    /* ============================= */
    /* REVIEW SECTION */
    /* ============================= */
    .review-wrapper {
        background: #fff;
        padding: 20px;
        border-radius: 14px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
    }

    /* AVG RATING */
    .avg-rating-box {
        background: #fff5f3;
        padding: 10px 16px;
        border-radius: 10px;
    }

    .avg-score {
        font-size: 24px;
        font-weight: 700;
        color: #ff5a5f;
    }

    /* STARS */
    .stars {
        color: #ffc107;
        font-size: 13px;
    }

    /* ============================= */
    /* RATING BREAKDOWN */
    /* ============================= */
    .rating-breakdown-card {
        background: #fafafa;
        padding: 12px;
        border-radius: 10px;
    }

    .rating-row {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 8px;
    }

    .star-label {
        width: 30px;
        font-size: 12px;
    }

    .progress {
        height: 6px;
        background: #eee;
        border-radius: 10px;
        overflow: hidden;
    }

    .progress-bar {
        background: linear-gradient(135deg, #ff7b6b, #f99583);
    }

    .count {
        font-size: 11px;
        width: 25px;
        text-align: right;
    }

    /* ============================= */
    /* REVIEW CARD */
    /* ============================= */
    .review-card-new {
        background: #fff;
        padding: 14px;
        border-radius: 12px;
        margin-bottom: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: linear-gradient(135deg, #ff7b6b, #f99583);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
    }

    .review-msg {
        font-size: 13px;
        color: #444;
    }

    /* ============================= */
    /* EMPTY STATE */
    /* ============================= */
    .no-review-box {
        background: #fafafa;
        border-radius: 12px;
        border: 1px dashed #ddd;
    }

    /* ============================= */
    /* MOBILE OPTIMIZATION */
    /* ============================= */
    @media(max-width:768px) {

        .title {
            font-size: 20px;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .feature-grid {
            grid-template-columns: 1fr;
        }

        .review-wrapper {
            padding: 15px;
        }

        .content-card {
            padding: 15px;
        }

        .avg-rating-box {
            margin-top: 10px;
        }

    }

    /* STOP FORCED STRETCH */
    .profile-container {
        align-items: flex-start !important;
    }

    /* PREVENT CAROUSEL OVER-STRETCH */
    .carousel,
    .carousel-inner,
    .carousel-item {
        height: auto !important;
    }

    /* CONTROL IMAGE HEIGHT PROPERLY */
    .carousel-img {
        width: 100%;
        height: 420px;
        /* fixed clean height */
        object-fit: cover;
    }

    /* MOBILE FIX */
    @media(max-width:768px) {
        .carousel-img {
            height: 240px;
        }
    }

    /* WRAPPER */
    .details-section {
        position: relative;
        z-index: 1;
        overflow: hidden;
    }

    /* BACKGROUND IMAGE LAYER */
    /* SOFT GRADIENT + IMAGE */
    .details-section::before {
        content: "";
        position: absolute;
        inset: 0;

        background: url('./assets/images/artist_images/mehendi_background.png');
        background-size: contain;
        /* important change */
        background-repeat: repeat;
        /* makes pattern visible */
        background-position: center;

        opacity: 0.2;
        /* increase visibility */
        z-index: -1;
        height: 100%;
    }

    /* MODAL DESIGN */
    .review-modal {
        border-radius: 18px;
        padding: 10px;
    }

    /* STAR RATING */
    .star-rating i {
        font-size: 26px;
        cursor: pointer;
        color: #ddd;
        transition: 0.3s;
    }

    .star-rating i.active {
        color: #ffc107;
        transform: scale(1.1);
    }

    /* TEXTAREA */
    .review-modal textarea {
        border-radius: 10px;
        resize: none;
    }

    /* INPUT STYLE */
    .review-modal input,
    .review-modal textarea {
        border-radius: 10px;
        border: 1px solid #eee;
        font-size: 14px;
    }

    .review-modal input:focus,
    .review-modal textarea:focus {
        border-color: #f99583;
        box-shadow: 0 0 0 2px rgba(249, 149, 131, 0.15);
    }

    .gallery-card {
        width: 100%;
        height: 220px;
        /* fixed box */
        border-radius: 12px;
        background: #f8f8f8;
        /* light bg for empty space */
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    /* ✅ IMAGE FULL FIT */
    .gallery-img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        /* 🔥 KEY FIX */
    }

    /* ✅ VIDEO FULL FIT */
    .gallery-video {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        /* 🔥 KEY FIX */
    }

    /* MOBILE */
    @media(max-width:768px) {
        .gallery-card {
            height: 160px;
        }
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
        <div class="mt-5 modern-section">

            <!-- TABS -->
            <ul class="nav nav-pills mb-4 custom-tabs" id="packageTab" role="tablist">

                <li class="nav-item">
                    <button class="nav-link active text-dark" data-bs-toggle="pill" data-bs-target="#desc">
                        <i class="bi bi-card-text me-1"></i> Description
                    </button>
                </li>

                <li class="nav-item">
                    <button class="nav-link text-dark" data-bs-toggle="pill" data-bs-target="#features">
                        <i class="bi bi-stars me-1"></i> Features
                    </button>
                </li>

                <li class="nav-item">
                    <button class="nav-link text-dark" data-bs-toggle="pill" data-bs-target="#includes">
                        <i class="bi bi-gift me-1"></i> Includes
                    </button>
                </li>

            </ul>

            <!-- TAB CONTENT -->
            <div class="tab-content">

                <!-- DESCRIPTION -->
                <div class="tab-pane fade show active" id="desc">
                    <div class="content-card highlight-card">

                        <h6 class="section-heading">
                            <i class="bi bi-card-text me-2"></i> About This Package
                        </h6>

                        <div class="content-text">
                            <?= safeHtml($pkg['_description']) ?>
                        </div>

                    </div>
                </div>

                <!-- FEATURES -->
                <div class="tab-pane fade" id="features">
                    <div class="content-card">

                        <h6 class="section-heading">
                            <i class="bi bi-stars me-2"></i> Key Highlights
                        </h6>

                        <div class="feature-grid">
                            <?php
                            $features = explode(',', $pkg['_features']);
                            foreach ($features as $feature) {
                                $feature = trim($feature);
                                if (!empty($feature)) {
                                    echo '
                        <div class="feature-item">
                            <div class="icon-box">
                                <i class="bi bi-check-lg"></i>
                            </div>
                            <span>' . htmlspecialchars($feature) . '</span>
                        </div>';
                                }
                            }
                            ?>
                        </div>

                    </div>
                </div>

                <!-- INCLUDES -->
                <div class="tab-pane fade" id="includes">
                    <div class="content-card">

                        <h6 class="section-heading">
                            <i class="bi bi-gift me-2"></i> What You Get
                        </h6>

                        <div class="include-list">
                            <?= safeHtml($pkg['_package_includes']) ?>
                        </div>

                    </div>
                </div>

            </div>

        </div>

        <!-- ⭐ RATINGS & REVIEWS -->
        <div class="mt-5 review-wrapper">

            <!-- HEADER -->
            <div class="review-header d-flex justify-content-between align-items-center flex-wrap">

                <div>
                    <h4 class="mb-1">Ratings & Reviews</h4>
                    <small class="text-muted">
                        <?= $pkg['_total_reviews'] ?? 0 ?> verified reviews
                    </small>
                </div>

                <!-- AVG RATING -->
                <div class="avg-rating-box text-center">
                    <div class="avg-score"><?= number_format($pkg['_avg_rating'] ?? 0, 1) ?></div>
                    <div class="stars">
                        <?= str_repeat('★', round($pkg['_avg_rating'] ?? 0)) ?>
                    </div>
                </div>

            </div>

            <!-- BODY -->
            <div class="row mt-4">

                <!-- LEFT: RATING BREAKDOWN (STATIC UI for now) -->
                <div class="col-md-4">

                    <div class="rating-breakdown-card">

                        <?php foreach ($ratingCounts as $star => $count) {

                            $percent = $totalReviews > 0
                                ? ($count / $totalReviews) * 100
                                : 0;
                        ?>

                            <div class="rating-row">

                                <div class="star-label">
                                    <?= $star ?> <i class="bi bi-star-fill"></i>
                                </div>

                                <div class="progress flex-grow-1">
                                    <div class="progress-bar"
                                        style="width: <?= $percent ?>%">
                                    </div>
                                </div>

                                <div class="count">
                                    <?= $count ?>
                                </div>

                            </div>

                        <?php } ?>

                    </div>

                </div>

                <!-- RIGHT: REVIEWS -->
                <div class="col-md-8">

                    <?php if (!empty($reviews)) { ?>
                        <div class="row justify-content-end">
                            <div class="row justify-content-end">
                                <button class="btn btn-danger btn-sm w-25"
                                    data-bs-toggle="modal"
                                    data-bs-target="#reviewModal"

                                    data-package-id="<?= htmlspecialchars($pkg['_id']) ?>"
                                    data-artist-id="<?= htmlspecialchars($pkg['_user_id']) ?>"
                                    data-artist-uniq-id="<?= htmlspecialchars($pkg['_user_uniq_id']) ?>"

                                    data-package-name="<?= htmlspecialchars($pkg['_package_title']) ?>"
                                    data-artist-name="<?= htmlspecialchars($pkg['_company_name']) ?>">

                                    <i class="bi bi-pencil-square me-1"></i>
                                    Write a Review
                                </button>
                            </div>
                        </div>
                        <?php foreach ($reviews as $r) { ?>

                            <div class="review-card-new">

                                <div class="d-flex justify-content-between align-items-center">

                                    <!-- USER INFO -->
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar">
                                            <?= strtoupper(substr($r['name'], 0, 1)) ?>
                                        </div>
                                        <div>
                                            <strong><?= htmlspecialchars($r['name']) ?></strong>
                                            <div class="small text-muted">
                                                Verified Customer
                                            </div>
                                        </div>
                                    </div>

                                    <!-- STARS -->
                                    <div class="stars">
                                        <?= str_repeat('★', (int)$r['rating']) ?>
                                    </div>

                                </div>

                                <!-- MESSAGE -->
                                <p class="review-msg mt-2 mb-0">
                                    <?= htmlspecialchars($r['msg']) ?>
                                </p>

                            </div>

                        <?php } ?>

                    <?php } else { ?>

                        <!-- 🔥 EMPTY STATE -->
                        <div class="no-review-box text-center p-4">

                            <i class="bi bi-chat-square-text fs-1 text-muted mb-2"></i>

                            <h6 class="mb-1">No reviews yet</h6>

                            <p class="text-muted small mb-2">
                                Be the first to share your experience!
                            </p>

                            <p class="text-success small mb-3">
                                ⭐ Your review helps others choose better
                            </p>
                            <button class="btn btn-danger btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#reviewModal"

                                data-package-id="<?= htmlspecialchars($pkg['_id']) ?>"
                                data-artist-id="<?= htmlspecialchars($pkg['_user_id']) ?>"
                                data-artist-uniq-id="<?= htmlspecialchars($pkg['_user_uniq_id']) ?>"

                                data-package-name="<?= htmlspecialchars($pkg['_package_title']) ?>"
                                data-artist-name="<?= htmlspecialchars($pkg['_company_name']) ?>">

                                <i class="bi bi-pencil-square me-1"></i>
                                Write a Review
                            </button>
                        </div>

                    <?php } ?>

                </div>
            </div>

        </div>

        <!-- GALLERY -->
        <div class="mt-5">

            <h4 class="mb-3 text-light">Gallery</h4>

            <!-- TABS -->
            <ul class="nav nav-pills mb-3 custom-tabs" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active"
                        data-bs-toggle="pill"
                        data-bs-target="#galleryImagesTab">
                        📸 Images
                    </button>
                </li>

                <li class="nav-item">
                    <button class="nav-link"
                        data-bs-toggle="pill"
                        data-bs-target="#galleryVideosTab">
                        🎥 Videos
                    </button>
                </li>
            </ul>

            <div class="tab-content">

                <!-- ================= IMAGES ================= -->
                <div class="tab-pane fade show active" id="galleryImagesTab">

                    <?php if (!empty($galleryImages)) { ?>

                        <div class="row g-3">

                            <?php foreach ($galleryImages as $img) { ?>

                                <div class="col-6 col-md-3 col-lg-2">
                                    <div class="gallery-card">

                                        <img src="<?= htmlspecialchars($img['_media_url']) ?>" class="gallery-img">

                                    </div>
                                </div>

                            <?php } ?>

                        </div>

                    <?php } else { ?>

                        <div class="text-center p-4 no-review-box">
                            <i class="bi bi-image fs-1 text-muted"></i>
                            <p class="text-muted mt-2 mb-0">No images available</p>
                        </div>

                    <?php } ?>

                </div>

                <!-- ================= VIDEOS ================= -->
                <div class="tab-pane fade" id="galleryVideosTab">

                    <?php if (!empty($galleryVideos)) { ?>

                        <div class="row g-3">

                            <?php foreach ($galleryVideos as $vid) { ?>

                                <div class="col-6 col-md-3 col-lg-2">
                                    <div class="gallery-card">

                                        <video controls preload="metadata" class="gallery-video">
                                            <source src="<?= htmlspecialchars($vid['_media_url']) ?>" type="video/mp4">
                                        </video>

                                    </div>
                                </div>

                            <?php } ?>

                        </div>

                    <?php } else { ?>

                        <div class="text-center p-4 no-review-box">
                            <i class="bi bi-camera-video fs-1 text-muted"></i>
                            <p class="text-muted mt-2 mb-0">No videos available</p>
                        </div>

                    <?php } ?>

                </div>

            </div>

        </div>

    <?php } else { ?>

        <div class="text-center">
            <h4>No Package Found 😢</h4>
        </div>

    <?php } ?>

</div>
<?php require './bootstrap_modals/send_artist_inquiry_form_modal.php'; ?>
<?php require './bootstrap_modals/toaster_modal.php'; ?>
<?php require './bootstrap_modals/artist_review_modal.php'; ?>

<div id="pageLoader" class="loader-overlay">
    <div class="loader-spinner"></div>
</div>
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
</body>

</html>