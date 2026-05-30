<?php
require 'template_header.php';

if (!isset($_GET['id'])) {
    die("Invalid request");
}

$encryptedId = $_GET['id'];
$menuId = decryptData($encryptedId);
$menuResponse = get_bm_menus_by_id($menuId, 1);
$menu = $menuResponse['status'] ? $menuResponse['data'] : null;

?>

<title>Menu Catalogue | BabuMosshaii Event & Co.</title>
<!-- ✅ SEO + Share Preview -->
<?php if ($menu): ?>
    <meta property="og:title" content="Wedding Menu - <?= htmlspecialchars($menu['_menu_code']) ?>">
    <meta property="og:description" content="Premium wedding menu with delicious items and pricing.">
    <meta property="og:image" content="<?= BASE_URL ?>assets/images/logo.png">
    <meta property="og:url" content="<?= BASE_URL ?>menu_details.php?id=<?= $menu['_id'] ?>">
<?php endif; ?>
<meta name="description"
    content="BabuMosshaii Kitchen & Caterer's offers premium Bengali and multi-cuisine catering services in Kolkata for weddings, receptions, corporate events, birthdays, and private parties.">
<meta name="keywords"
    content="BabuMosshaii catering Kolkata, Bengali catering Kolkata, wedding catering Kolkata, best caterers in Kolkata, corporate catering Kolkata">

<style>
    :root {
        --primary: #f99583;
        --primary-dark: #f67a60;
        --gold: #FFD166;
        --success: #22c55e;
        --dark: #1f2937;
        --light: #fffaf8;
    }

    body {
        background:
            linear-gradient(135deg, #fff8f5, #fff, #fff5f1);
    }

    /* ==========================
   CARD
========================== */

    .menu-card {
        position: relative;
        border-radius: 30px;
        background: #fff;
        border: none;
        overflow: hidden;

        box-shadow:
            0 25px 60px rgba(0, 0, 0, .08);

        backdrop-filter: blur(10px);
    }

    /* Decorative background */

    .menu-card::before {
        content: '';
        position: absolute;
        top: -120px;
        right: -120px;
        width: 280px;
        height: 280px;
        border-radius: 50%;
        background: rgba(249, 149, 131, .08);
    }

    .menu-card::after {
        content: '';
        position: absolute;
        bottom: -120px;
        left: -120px;
        width: 280px;
        height: 280px;
        border-radius: 50%;
        background: rgba(249, 149, 131, .05);
    }

    /* ==========================
   WATERMARK
========================== */

    .watermark-logo {
        position: absolute;
        inset: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        pointer-events: none;
        z-index: 0;
    }

    .watermark-logo img {
        width: 450px;
        max-width: 75%;
        opacity: .035;
        filter: grayscale(100%);
        transform: rotate(-15deg);
    }

    /* ==========================
   HEADER
========================== */

    .menu-header {
        position: relative;
        z-index: 2;

        background:
            linear-gradient(135deg,
                var(--primary),
                var(--primary-dark));

        padding: 30px 20px 25px;

        text-align: center;
        color: #fff;
    }

    .logo-box {
        width: 90px;
        height: 90px;

        margin: 0 auto 12px;

        border-radius: 50%;

        background: rgba(255, 255, 255, .18);

        backdrop-filter: blur(15px);

        border: 3px solid rgba(255, 255, 255, .25);

        padding: 8px;

        box-shadow:
            0 10px 25px rgba(0, 0, 0, .15);
    }

    .logo-box img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .menu-header h4 {
        font-weight: 800;
        margin-bottom: 5px;
    }

    .menu-code {
        display: inline-flex;
        align-items: center;
        gap: 8px;

        padding: 6px 14px;

        background: rgba(255, 255, 255, .15);

        border-radius: 50px;

        font-size: .85rem;
    }

    .arrange-badge {
        background: #fff;
        color: #f67a60;
        border-radius: 30px;
        padding: 6px 14px;
        font-size: .75rem;
        font-weight: 700;
    }

    /* ==========================
   SHARE BUTTON
========================== */

    .share-btn {
        width: 40px;
        height: 40px;
        border-radius: 50% !important;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .share-btn:hover {
        transform: translateY(-2px);
    }

    /* ==========================
   NOTICE
========================== */

    .notice-bar {
        background:
            linear-gradient(135deg,
                #fff8d6,
                #fff0b3);

        border: 1px solid #ffe08a;

        padding: 14px 18px;

        border-radius: 16px;

        font-weight: 600;

        box-shadow:
            0 8px 18px rgba(255, 208, 0, .08);
    }

    /* ==========================
   CONTENT
========================== */

    .menu-section {
        position: relative;
        z-index: 2;

        margin: 14px;
        margin-bottom: 0;

        background:
            rgba(255, 255, 255, .8);

        border: 1px solid rgba(249, 149, 131, .12);

        border-left: 5px solid var(--primary);

        border-radius: 18px;

        padding: 16px;

        transition: .3s;
    }

    .menu-section:hover {
        transform: translateY(-3px);

        box-shadow:
            0 12px 30px rgba(249, 149, 131, .12);
    }

    .menu-title {
        display: flex;
        align-items: center;
        justify-content: space-between;

        font-size: .9rem;
        font-weight: 800;

        color: #c2410c;

        margin-bottom: 10px;

        text-transform: uppercase;
    }

    .menu-count {
        background: #fff0ea;
        color: #c2410c;
        font-size: .7rem;
        padding: 4px 10px;
        border-radius: 30px;
    }

    .menu-list {
        padding-left: 0;
        list-style: none;
        margin: 0;
    }

    .menu-list li {
        padding: 7px 0;
        color: #4b5563;

        border-bottom: 1px dashed #f2d7c8;

        display: flex;
        align-items: center;
    }

    .menu-list li:last-child {
        border-bottom: none;
    }

    .menu-list li::before {
        content: '✓';
        color: var(--success);
        font-weight: bold;
        margin-right: 10px;
    }

    /* ==========================
   PRICE SECTION
========================== */

    .menu-footer {
        position: relative;
        z-index: 2;
    }

    .price-box {
        background:
            linear-gradient(135deg,
                #202937,
                #111827);

        color: white;

        border-radius: 22px;

        margin: 15px;

        padding: 22px;
    }

    .final-price {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--gold);
        line-height: 1;
    }

    .original-price {
        text-decoration: line-through;
        opacity: .6;
    }

    .discount-badge {
        background: var(--success);
        color: white;
        padding: 5px 12px;
        border-radius: 30px;
        font-size: .75rem;
        font-weight: 700;
    }

    .price-features {
        margin-top: 15px;

        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }

    .price-features span {
        background: rgba(255, 255, 255, .08);
        padding: 10px;
        border-radius: 10px;
        text-align: center;
        font-size: .85rem;
    }

    .updated-date {
        opacity: .75;
        font-size: .8rem;
    }

    /* ==========================
   MOBILE
========================== */

    @media(max-width:768px) {

        .menu-card {
            border-radius: 22px;
        }

        .logo-box {
            width: 75px;
            height: 75px;
        }

        .watermark-logo img {
            width: 260px;
        }

        .final-price {
            font-size: 2rem;
        }

        .price-features {
            grid-template-columns: 1fr;
        }

        .notice-bar {
            font-size: .85rem;
        }

        .menu-section {
            margin: 10px;
        }
    }

    .package-note {
        margin-top: 20px;

        background: rgba(255, 255, 255, .08);

        border: 1px solid rgba(255, 255, 255, .08);

        border-radius: 16px;

        padding: 15px;
    }

    .package-note-title {
        color: var(--gold);
        font-weight: 700;
        margin-bottom: 8px;
    }

    .package-note-content {
        font-size: .9rem;
        line-height: 1.7;
        color: rgba(255, 255, 255, .9);
    }
    .back-button:hover {
        background: #FFFFFF;
        color: var(--dark);
        border-color: #000;
    }
</style>

</head>

<body>

    <?= require 'navbar.php'; ?>

    <div class="container my-3">

        <!-- Back -->
        <div class="mb-2 d-flex justify-content-between align-items-center">
            <a href="<?= BASE_URL.'menu_list.php' ?>" class="btn btn-outline-dark btn-sm back-btn text-dark back-button">
                <i class="bi bi-arrow-left"></i> Back
            </a>

            <?php if ($menu): ?>
                <button class="btn btn-danger btn-sm share-btn"
                    data-menu="<?= htmlspecialchars($menu['_menu_code']) ?>"
                    data-id="<?= $menu['_id'] ?>">
                    <i class="bi bi-share-fill"></i>
                </button>
            <?php endif; ?>
        </div>

        <div class="row justify-content-center">

            <?php if ($menu): ?>

                <div class="col-md-6">

                    <div class="menu-card">
                        <div class="watermark-logo">
                            <img src="<?= BASE_URL ?>assets/images/logo.png" alt="Watermark">
                        </div>
                        <!-- Header -->
                        <div class="menu-header">

                            <div class="logo-box">
                                <img src="<?= BASE_URL ?>assets/images/logo.png" alt="Logo">
                            </div>

                            <h4 class="mb-2">BabuMosshaii Kitchen & Catering</h4>

                            <div class="d-flex justify-content-center gap-2 flex-wrap">

                                <span class="menu-code">
                                    🍽 <?= htmlspecialchars($menu['_menu_code']) ?>
                                </span>

                                <span class="arrange-badge">
                                    <?= $menu['_arrange'] ?>
                                </span>

                            </div>

                        </div>

                        <?php
                        $sections = [
                            "🔥 Live Counters" => $menu['_live_counter'],
                            "🥟 Starters" => $menu['_starter'],
                            "🍛 Main Course" => $menu['_main_course'],
                            "🍨 Dessert" => $menu['_dessert'],
                            "➕ Add-ons" => $menu['_Ads_on'],
                            "🥤 Beverages" => $menu['_beverages']
                        ];
                        ?>

                        <!-- Content -->
                        <?php foreach ($sections as $title => $items): ?>
                            <?php if (!empty(trim($items))): ?>
                                <div class="menu-section">
                                    <div class="menu-title">
                                        <?= $title ?>

                                        <span class="menu-count">
                                            <?= count(array_filter(preg_split("/\r\n|\n|,/", $items))) ?> Items
                                        </span>
                                    </div>
                                    <ul class="menu-list">
                                        <?php foreach (preg_split("/\r\n|\n|,/", $items) as $item): ?>
                                            <?php if (trim($item)): ?>
                                                <li><?= htmlspecialchars(trim($item)) ?></li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        <div class="menu-footer">
                            <?php
                            $original = (float)$menu['_price'];
                            $discount = (int)$menu['_discount'];
                            $final = $discount > 0 ? $original - ($original * $discount / 100) : $original;
                            ?>

                            <div class="price-box">

                                <div class="d-flex justify-content-between align-items-center flex-wrap">

                                    <div>
                                        <div class="fw-bold fs-5">
                                            Menu Package
                                        </div>

                                        <small>
                                            Total Heads: <?= $menu['_heads'] ?>
                                        </small>
                                    </div>

                                    <div class="text-end">

                                        <?php if ($discount > 0): ?>

                                            <div class="final-price">
                                                ₹<?= number_format($final, 0) ?>
                                            </div>

                                            <div>
                                                <span class="original-price">
                                                    ₹<?= number_format($original, 0) ?>
                                                </span>

                                                <span class="discount-badge">
                                                    <?= $discount ?>% OFF
                                                </span>
                                            </div>

                                        <?php else: ?>

                                            <div class="final-price">
                                                ₹<?= number_format($original, 0) ?>
                                            </div>

                                        <?php endif; ?>

                                    </div>

                                </div>

                                <div class="price-features">
                                    <span>🍽 Premium Food</span>
                                    <span>👨‍🍳 Expert Chef</span>
                                    <span>✨ Hygienic Service</span>
                                </div>

                                <div class="package-note">
                                    <div class="package-note-title">
                                        📌 Package Information
                                    </div>

                                    <div class="package-note-content">
                                        🍽️ Includes breakfast & lunch for <strong>30 guests</strong>.<br>
                                        👥 Extra guest charge: <strong>₹225/head</strong>.<br>
                                        🎉 Minimum booking requirement: <strong>250 guests</strong>.
                                    </div>
                                </div>

                                <div class="updated-date mt-3">
                                    Updated:
                                    <?= date('d M Y', strtotime($menu['_update_dt'])) ?>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            <?php else: ?>

                <!-- No Data -->
                <div class="text-center mt-5">
                    <i class="bi bi-exclamation-circle fs-1"></i>
                    <h5>Menu not found</h5>
                </div>

            <?php endif; ?>

        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const BASE_URL = "<?= BASE_URL ?>";

        $(document).on('click', '.share-btn', function() {

            let menuName = $(this).data('menu');
            let menuId = $(this).data('id');
            let url = BASE_URL + "menu_details.php?id=" + menuId;

            if (navigator.share) {
                navigator.share({
                    title: "Wedding Menu",
                    text: "🍽️ " + menuName,
                    url: url
                });
            } else {
                navigator.clipboard.writeText(url).then(() => {
                    alert("Link copied!");
                });
            }
        });
    </script>
</body>

</html>