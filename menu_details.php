<?php
require 'template_header.php';

$id = $_GET['id'] ?? 0;
$menuResponse = get_bm_menus_by_id($id, 1);
$menu = $menuResponse['status'] ? $menuResponse['data'] : null;
?>

<title>Menu Details | Babumosshai</title>

<!-- ✅ SEO + Share Preview -->
<?php if ($menu): ?>
    <meta property="og:title" content="Wedding Menu - <?= htmlspecialchars($menu['_menu_code']) ?>">
    <meta property="og:description" content="Premium wedding menu with delicious items and pricing.">
    <meta property="og:image" content="<?= BASE_URL ?>assets/images/logo.png">
    <meta property="og:url" content="<?= BASE_URL ?>menu_details.php?id=<?= $menu['_id'] ?>">
<?php endif; ?>

<style>
    /* Card */
    .menu-card {
        border-radius: 22px;
        background: linear-gradient(180deg, #fffaf5, #fff1e8);
        border: 1px solid #ffe0cc;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
    }

    /* Header */
    .menu-header {
        background: linear-gradient(90deg, #ff512f, #f09819);
        color: #fff;
        padding: 16px;
        font-weight: 700;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Sections */
    .menu-section {
        padding: 12px 18px;
    }

    .menu-title {
        font-size: 0.8rem;
        font-weight: 800;
        color: #c2410c;
        border-bottom: 1px dashed #f5b089;
        margin-bottom: 6px;
        text-transform: uppercase;
    }

    .menu-list {
        font-size: 0.85rem;
        padding-left: 18px;
        color: #444;
    }

    /* Footer */
    .menu-footer {
        background: #fff7ed;
        padding: 14px 18px;
        border-top: 1px dashed #f4c6a3;
    }

    /* Price */
    .final-price {
        color: #b11226;
        font-size: 1.4rem;
        font-weight: 800;
    }

    .original-price {
        text-decoration: line-through;
        color: #888;
    }

    .discount-badge {
        background: #22c55e;
        color: #fff;
        padding: 3px 8px;
        border-radius: 20px;
        font-size: 0.7rem;
    }

    /* Share Button */
    .share-btn {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        color: #fff;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .share-btn:hover {
        background: #fff;
        color: #ff512f;
    }

    /* Back button */
    .back-btn {
        border-radius: 20px;
    }

    /* Notice */
    .notice-bar {
        background: linear-gradient(90deg, #e6d131, #ecdfb9);
        padding: 10px;
        border-radius: 10px;
        margin-bottom: 15px;
        font-weight: 600;
    }
</style>

</head>

<body>

    <?= require 'navbar.php'; ?>

    <div class="container my-3">

        <!-- Back -->
        <div class="mb-2 d-flex justify-content-between align-items-center">
            <button onclick="history.back()" class="btn btn-outline-dark btn-sm back-btn">
                <i class="bi bi-arrow-left"></i> Back
            </button>

            <?php if ($menu): ?>
                <button class="btn btn-danger btn-sm share-btn"
                    data-menu="<?= htmlspecialchars($menu['_menu_code']) ?>"
                    data-id="<?= $menu['_id'] ?>">
                    <i class="bi bi-share-fill"></i>
                </button>
            <?php endif; ?>
        </div>

        <!-- Notice -->
        <div class="notice-bar">
            🍽️ Includes breakfast & lunch for 50 guests. Extra guest ₹225/head. Minimum 250 guests required.
        </div>

        <div class="row justify-content-center">

            <?php if ($menu): ?>

                <div class="col-md-6">

                    <div class="menu-card">

                        <!-- Header -->
                        <div class="menu-header">
                            <span><?= htmlspecialchars($menu['_menu_code']) ?></span>
                            <span class="badge bg-success"><?= $menu['_arrange'] ?></span>
                        </div>

                        <?php
                        $sections = [
                            "Live Counters" => $menu['_live_counter'],
                            "Starters" => $menu['_starter'],
                            "Main Course" => $menu['_main_course'],
                            "Dessert" => $menu['_dessert'],
                            "Add-ons" => $menu['_Ads_on'],
                            "Beverages" => $menu['_beverages']
                        ];
                        ?>

                        <!-- Content -->
                        <?php foreach ($sections as $title => $items): ?>
                            <?php if (!empty(trim($items))): ?>
                                <div class="menu-section">
                                    <div class="menu-title"><?= $title ?></div>
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

                        <!-- Footer -->
                        <div class="menu-footer">
                            <strong>Total Heads: <?= $menu['_heads'] ?></strong>
                        </div>

                        <div class="menu-footer">
                            <?php
                            $original = (float)$menu['_price'];
                            $discount = (int)$menu['_discount'];
                            $final = $discount > 0 ? $original - ($original * $discount / 100) : $original;
                            ?>

                            <?php if ($discount > 0): ?>
                                <span class="final-price">₹<?= number_format($final, 2) ?></span>
                                <span class="original-price">₹<?= number_format($original, 2) ?></span>
                                <span class="discount-badge"><?= $discount ?>% OFF</span>
                            <?php else: ?>
                                <span class="final-price">₹<?= number_format($original, 2) ?>/plate</span>
                            <?php endif; ?>

                            <br>
                            <small>Updated: <?= date('d M Y', strtotime($menu['_update_dt'])) ?></small>
                        </div>

                        <!-- CTA -->
                        <div class="text-center p-3">
                            <button class="btn btn-danger px-4 share-btn"
                                data-menu="<?= htmlspecialchars($menu['_menu_code']) ?>"
                                data-id="<?= $menu['_id'] ?>">
                                <i class="bi bi-share-fill me-2"></i> Share This Menu
                            </button>
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

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>