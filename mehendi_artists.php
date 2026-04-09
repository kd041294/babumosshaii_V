<?php
require 'template_header.php';

$resultMehendi = getMehendiPackageList();
$packages = ($resultMehendi['status'] && !empty($resultMehendi['data']))
    ? $resultMehendi['data']
    : [];
?>
<title>Mehendi Packages | BabuMosshaii Event & Co.</title>
<meta name="description"
    content="Discover top mehendi packages in Kolkata with BabuMosshaii. Book professional mehendi artists for weddings and events. Explore our curated mehendi services now!">
<meta name="keywords"
    content="Mehendi packages Kolkata, best mehendi artists Kolkata, wedding mehendi services Kolkata, mehendi design packages Kolkata, mehendi artist booking Kolkata">
<style>
    /* ===== HERO SECTION ===== */
    .hero-section {
        padding: 80px 0 100px;
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.5)),
            url('assets/images/artist_images/mehendi_background.png');
        background-size: cover;
        background-position: center;
        color: #fff;
    }

    .hero-section h1 {
        font-size: 44px;
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    .hero-section p {
        font-size: 16px;
        opacity: 0.85;
    }

    /* ===== FILTER SECTION ===== */
    .filter-box {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        padding: 18px;
        border-radius: 18px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        margin-top: -60px;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    /* Inputs */
    .filter-box input,
    .filter-box select {
        border-radius: 30px;
        padding: 10px 15px;
        border: 1px solid #eee;
        transition: 0.2s;
    }

    .filter-box input:focus,
    .filter-box select:focus {
        border-color: #f99583;
        box-shadow: 0 0 0 2px rgba(249, 149, 131, 0.2);
    }

    /* ===== CARD ===== */
    .artist-card {
        border: none;
        border-radius: 18px;
        overflow: hidden;
        background: #fff;
        transition: all 0.3s ease;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
        position: relative;
    }

    .artist-card:hover {
        transform: translateY(-10px) scale(1.01);
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.12);
    }

    /* ===== IMAGE ===== */
    .image-wrapper {
        position: relative;
        overflow: hidden;
    }

    .artist-img {
        width: 100%;
        height: 230px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .artist-card:hover .artist-img {
        transform: scale(1.08);
    }

    /* Gradient overlay */
    .image-wrapper::after {
        content: "";
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 70px;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.6), transparent);
    }

    /* ===== COMPANY NAME ===== */
    .company-name-overlay {
        position: absolute;
        bottom: 12px;
        left: 12px;
        background: rgba(0, 0, 0, 0.65);
        color: #fff;
        padding: 6px 14px;
        font-size: 12px;
        border-radius: 25px;
        backdrop-filter: blur(5px);
        max-width: 75%;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* ===== BADGE ===== */
    .badge-custom {
        position: absolute;
        top: 12px;
        left: 12px;
        background: linear-gradient(45deg, #f99583, #ffb199);
        color: #fff;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 500;
        z-index: 2;
    }

    /* ===== IMAGE COUNTER ===== */
    .image-counter {
        position: absolute;
        top: 12px;
        right: 12px;
        background: rgba(0, 0, 0, 0.65);
        color: #fff;
        padding: 4px 10px;
        font-size: 11px;
        border-radius: 15px;
    }

    /* ===== BODY ===== */
    .artist-body {
        padding: 15px;
    }

    .artist-name {
        font-weight: 600;
        font-size: 17px;
        margin-bottom: 2px;
    }

    /* Subtitle */
    .artist-body .text-muted {
        font-size: 13px;
    }

    /* Rating */
    .rating {
        font-size: 14px;
        color: #ffc107;
    }

    /* ===== PRICE ===== */
    .price {
        font-size: 20px;
        font-weight: 700;
        color: #f99583;
    }

    /* ===== BUTTON ===== */
    .btn-book {
        background: linear-gradient(45deg, #f99583, #ffb199);
        color: #fff;
        border-radius: 25px;
        padding: 6px 14px;
        font-size: 13px;
        border: none;
        transition: 0.3s;
    }

    .btn-book:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(249, 149, 131, 0.4);
    }

    /* ===== RESET BUTTON ===== */
    .btn-reset {
        background: #2c2c2c;
        color: #fff;
        border-radius: 25px;
        font-size: 14px;
        transition: 0.3s;
    }

    .btn-reset:hover {
        background: #000;
    }

    /* ===== CAROUSEL CONTROLS ===== */
    .carousel-control-prev,
    .carousel-control-next {
        width: 32px;
        height: 32px;
        background: rgba(0, 0, 0, 0.6);
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
    }

    #noResults {
        background: #fff;
        border-radius: 10px;
        font-weight: bold;
    }

    .coming-soon-box {
        background: linear-gradient(135deg, #fff5f2, #ffe3dc);
        border-radius: 18px;
        border: 1px dashed #f99583;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    .coming-soon-box h4 {
        color: #333;
    }

    .coming-soon-box p {
        max-width: 500px;
        margin: auto;
        font-size: 14px;
    }
</style>
</head>

<body>

    <?= require 'navbar.php'; ?>

    <!-- ===== HERO ===== -->
    <section class="hero-section">
        <div class="container">
            <h1>Find Best Mehendi Packages</h1>
            <p>Book professional mehendi artists for your wedding & other events</p>
        </div>
    </section>

    <!-- ===== FILTER ===== -->
    <div class="container">
        <div class="filter-box row align-items-center g-2">

            <!-- Search -->
            <div class="col-md-4">
                <input type="text"
                    id="searchInput"
                    class="form-control"
                    placeholder="Search Artist...">
            </div>

            <!-- Location (INPUT now) -->
            <div class="col-md-3">
                <input type="text"
                    id="locationInput"
                    class="form-control"
                    placeholder="Search Location...">
            </div>

            <!-- Price -->
            <div class="col-md-3">
                <select id="priceFilter" class="form-select">
                    <option value="">Price Range</option>

                    <?php foreach ($priceRanges as $range) : ?>
                        <option value="<?= $range['min'] . '-' . ($range['max'] ?? '') ?>">
                            <?= $range['label'] ?>
                        </option>
                    <?php endforeach; ?>

                </select>
            </div>

            <!-- Reset Button -->
            <div class="col-md-2">
                <button class="btn btn-reset w-100" onclick="resetFilters()">
                    <i class="bi bi-arrow-clockwise me-1"></i> Reset
                </button>
            </div>

        </div>
    </div>

    <!-- ===== ARTIST LIST ===== -->
    <div class="container py-5">
        <div class="row g-4">

            <?php if (!empty($packages)) : ?>

                <?php foreach ($packages as $pkg) :

                    // ===== DATA PREP =====
                    $images = !empty($pkg['_image_urls'])
                        ? array_filter(explode('||', $pkg['_image_urls']))
                        : [];

                    $thumbnail = $pkg['_thumbnail'] ?? ($images[0] ?? 'assets/images/default.jpg');

                    $hasMultipleImages = count($images) > 1;
                    $carouselId = 'carousel' . $pkg['_id'];

                ?>

                    <div class="col-md-4 mb-4"
                        data-area="<?= strtolower(htmlspecialchars($pkg['_serviceable_area'] ?? '')) ?>">
                        <div class="card artist-card">

                            <!-- Discount Badge -->
                            <?php if (!empty($pkg['_discount_label'])) : ?>
                                <span class="badge-custom">
                                    <?= htmlspecialchars($pkg['_discount_label']) ?>
                                </span>
                            <?php endif; ?>

                            <!-- ===== IMAGE WRAPPER (FIXED) ===== -->
                            <div class="image-wrapper">

                                <?php if ($hasMultipleImages) : ?>

                                    <div id="<?= $carouselId ?>"
                                        class="carousel slide"
                                        data-bs-ride="carousel"
                                        data-bs-interval="2500">

                                        <!-- Indicators -->
                                        <div class="carousel-indicators">
                                            <?php foreach ($images as $i => $img) : ?>
                                                <button type="button"
                                                    data-bs-target="#<?= $carouselId ?>"
                                                    data-bs-slide-to="<?= $i ?>"
                                                    class="<?= $i === 0 ? 'active' : '' ?>">
                                                </button>
                                            <?php endforeach; ?>
                                        </div>

                                        <!-- Counter -->
                                        <div class="image-counter">
                                            <span id="counter<?= $pkg['_id'] ?>">
                                                1 / <?= count($images) ?>
                                            </span>
                                        </div>

                                        <!-- Images -->
                                        <div class="carousel-inner">
                                            <?php foreach ($images as $i => $img) : ?>
                                                <div class="carousel-item <?= $i === 0 ? 'active' : '' ?>">
                                                    <img src="<?= htmlspecialchars($img) ?>"
                                                        class="artist-img"
                                                        loading="lazy"
                                                        alt="mehendi">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>

                                        <!-- Controls -->
                                        <button class="carousel-control-prev"
                                            type="button"
                                            data-bs-target="#<?= $carouselId ?>"
                                            data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon"></span>
                                        </button>

                                        <button class="carousel-control-next"
                                            type="button"
                                            data-bs-target="#<?= $carouselId ?>"
                                            data-bs-slide="next">
                                            <span class="carousel-control-next-icon"></span>
                                        </button>

                                    </div>

                                <?php else : ?>

                                    <img src="<?= htmlspecialchars($thumbnail) ?>"
                                        class="artist-img"
                                        loading="lazy"
                                        alt="mehendi">

                                <?php endif; ?>

                                <!-- ✅ COMPANY NAME (FIXED POSITION) -->
                                <div class="company-name-overlay">
                                    <i class="bi bi-building me-1"></i>
                                    <?= htmlspecialchars($pkg['_company_name'] ?? 'Unknown Artist') ?>
                                </div>

                            </div>

                            <!-- ===== CARD BODY ===== -->
                            <div class="artist-body">

                                <div class="artist-name">
                                    <?= htmlspecialchars($pkg['_package_title']) ?>
                                </div>

                                <div class="text-muted small mb-1">
                                    <?= htmlspecialchars($pkg['_short_title']) ?>
                                </div>

                                <div class="rating mb-2">⭐ 4.7</div>

                                <div class="d-flex justify-content-between align-items-center">

                                    <div>
                                        <?php if (!empty($pkg['_price']) && $pkg['_price'] > $pkg['_final_price']) : ?>
                                            <small class="text-muted text-decoration-line-through">
                                                ₹<?= htmlspecialchars($pkg['_price']) ?>
                                            </small><br>
                                        <?php endif; ?>

                                        <span class="price">
                                            ₹<?= htmlspecialchars($pkg['_final_price']) ?>
                                        </span>
                                    </div>

                                    <a href="<?= $routes['mehendi_profile'] . '?id=' . encryptData($pkg['_id']) ?>"
                                        class="btn btn-book">
                                        <i class="bi bi-person-circle me-1"></i> View Profile
                                    </a>

                                </div>

                            </div>

                        </div>
                    </div>

                <?php endforeach; ?>

            <?php else : ?>

                <div class="col-12">
                    <div class="coming-soon-box text-center p-5">

                        <div class="mb-3">
                            <i class="bi bi-stars fs-1 text-warning"></i>
                        </div>

                        <h4 class="fw-bold mb-2">Exciting Mehendi Packages Coming Soon 🎉</h4>

                        <p class="text-muted mb-3">
                            We're onboarding talented mehendi artists in your area.
                            Stay tuned — amazing packages will be available shortly!
                        </p>

                        <button class="btn btn-book px-4"
                            data-bs-toggle="modal"
                            data-bs-target="#bookingModal">
                            <i class="bi bi-bell-fill me-1"></i> Notify Me
                        </button>

                    </div>
                </div>

            <?php endif; ?>

        </div>
        <div id="noResults" class="text-center py-4 text-white" style="display:none; color: #eee;">
            <h5 class="text-muted">No package to show 😢</h5>
        </div>
    </div>

    <!-- Footer -->
    <?php require 'footer.php'; ?>

    <!-- Quick Connect -->
    <div class="quick-connect-btn" id="quickConnectBtn">
        <i class="fas fa-comments"></i>
    </div>
    <?php require 'quick_connect.php'; ?>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/common.js"></script>
    <script src="assets/js/artist.js"></script>
    <div id="pageLoader" class="loader-overlay">
        <div class="loader-spinner"></div>
    </div>
</body>

</html>