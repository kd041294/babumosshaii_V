<?php
require 'template_header.php';
$menuResponse = get_all_bm_menus(1);
$menus = $menuResponse['status'] ? $menuResponse['data'] : [];
?>
<title>Wedding Menu Collection</title>
<style>
  /* Card Container */
  .menu-grid-card {
    border-radius: 20px;
    background: linear-gradient(180deg, #fffaf5, #fff1e8);
    transition: all 0.35s ease;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    border: 1px solid #ffe0cc;
    height: 100%;
  }

  /* Hover Effect */
  @media (hover: hover) {
    .menu-grid-card:hover {
      transform: translateY(-8px) scale(1.01);
      box-shadow: 0 18px 40px rgba(255, 94, 98, 0.25);
    }
  }

  /* Header */
  .menu-grid-header {
    background: linear-gradient(90deg, #f857a6, #ff5858);
    color: #fff;
    padding: 14px 16px;
    font-size: 1rem;
    font-weight: 700;
    letter-spacing: 0.4px;
    border-radius: 20px 20px 0 0;
    flex-shrink: 0;
  }

  /* Status Badge */
  .menu-grid-header .badge {
    font-size: 0.7rem;
    font-weight: 700;
    padding: 4px 8px;
    border-radius: 999px;
  }

  /* SCROLLABLE CONTENT */
  .menu-content {
    flex: 1;
    overflow-y: auto;
    padding-bottom: 6px;
  }

  /* Scrollbar */
  .menu-content::-webkit-scrollbar {
    width: 4px;
  }

  .menu-content::-webkit-scrollbar-thumb {
    background: #fca5a5;
    border-radius: 4px;
  }

  /* Menu Sections */
  .menu-grid-section {
    padding: 10px 16px 0;
  }

  /* Section Title */
  .menu-grid-title {
    font-size: 0.8rem;
    font-weight: 800;
    color: #c2410c;
    text-transform: uppercase;
    border-bottom: 1px dashed #f5b089;
    margin-bottom: 6px;
  }

  /* Items */
  .menu-grid-list {
    font-size: 0.82rem;
    padding-left: 18px;
    margin-bottom: 8px;
    color: #444;
    line-height: 1.5;
  }

  /* Footer */
  .menu-grid-footer {
    background: linear-gradient(90deg, #fff7ed, #ffedd5);
    border-top: 1px dashed #f4c6a3;
    padding: 12px 16px;
    font-size: 0.8rem;
    flex-shrink: 0;
  }

  /* Total Heads */
  .menu-grid-footer .text-danger {
    color: #9f1239 !important;
    font-weight: 700;
  }

  /* Price */
  .original-price {
    color: #656668ff;
    text-decoration: line-through;
    font-size: 0.9rem;
    font-weight: bold
  }

  .final-price {
    color: #b11226;
    font-size: 1.25rem;
    font-weight: 800;
  }

  .discount-badge {
    background: linear-gradient(90deg, #16a34a, #22c55e);
    color: #fff;
    font-size: 0.72rem;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 999px;
  }

  /* Mobile */
  @media (max-width: 576px) {
    .menu-content {
      max-height: 260px;
    }
  }

  .notice-bar {
    width: 100%;
    background: linear-gradient(90deg, #ff512f, #f09819);
    color: #fff;
    padding: 10px 0;
    overflow: hidden;
    position: relative;
    border-radius: 10px;
    margin-bottom: 12px;
    box-shadow: 0 6px 16px rgba(255, 81, 47, 0.35);
  }

  .notice-text {
    white-space: nowrap;
    display: inline-block;
    padding-left: 100%;
    font-size: 0.95rem;
    font-weight: 700;
    animation: scrollNotice 14s linear infinite;
  }

  /* Smooth scrolling animation */
  @keyframes scrollNotice {
    0% {
      transform: translateX(0);
    }

    100% {
      transform: translateX(-100%);
    }
  }

  /* Mobile tuning */
  @media (max-width: 576px) {
    .notice-text {
      font-size: 0.85rem;
      animation-duration: 10s;
    }
  }
</style>
</head>
<body>
  <?= require 'navbar.php'; ?>
  <?php require 'quick_connect.php'; ?>
  <div class="container my-2">
    <div class="notice-bar">
      <div class="notice-text">
        🍽️ All menus include breakfast and lunch for 50 guests.
      </div>
    </div>
    <div class="row g-3">
      <?php foreach ($menus as $menu): ?>
        <div class="col-12 col-sm-6 col-md-4 col-xl-3">

          <div class="menu-grid-card shadow-sm">

            <!-- Header -->
            <div class="menu-grid-header d-flex justify-content-between align-items-center">
              <span><?= htmlspecialchars($menu['_menu_code']) ?></span>
              <span class="badge <?= $menu['_status'] ? 'bg-success' : 'bg-secondary' ?>">
                <?= $menu['_status'] ? 'Active' : 'Inactive' ?>
              </span>
            </div>

            <?php
            $sections = [
              "Live Counter's" => $menu['_live_counter'],
              "Starter's"     => $menu['_starter'],
              "Main Course"   => $menu['_main_course'],
              "Dessert"       => $menu['_dessert'],
              "Add's-on"      => $menu['_Ads_on'],
              "Beverages"    => $menu['_beverages']
            ];
            ?>

            <!-- 🔒 SCROLL CONTENT -->
            <div class="menu-content">
              <?php foreach ($sections as $title => $items): ?>
                <?php if (!empty(trim($items))): ?>
                  <div class="menu-grid-section">
                    <div class="menu-grid-title"><?= $title ?></div>
                    <ul class="menu-grid-list">
                      <?php foreach (preg_split("/\r\n|\n|,/", $items) as $item): ?>
                        <?php if (trim($item)): ?>
                          <li><?= htmlspecialchars(trim($item)) ?></li>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                <?php endif; ?>
              <?php endforeach; ?>
            </div>

            <!-- Footer -->
            <div class="menu-grid-footer">
              <span class="text-danger fw-bold">
                Total Heads : <?= $menu['_heads'] ?>
              </span>
            </div>

            <!-- Price Footer -->
            <div class="menu-grid-footer">
              <?php
              $originalPrice = (float) $menu['_price'];
              $discount = (int) $menu['_discount'];
              $finalPrice = $discount > 0
                ? $originalPrice - ($originalPrice * $discount / 100)
                : $originalPrice;
              ?>

              <?php if ($discount > 0): ?>
                <span class="final-price ms-1">₹ <?= number_format($finalPrice, 2) ?></span>
                <span class="original-price">₹ <?= number_format($originalPrice, 2) ?></span>
                <span class="discount-badge ms-2"><?= $discount ?>% OFF</span>
              <?php else: ?>
                <span class="final-price">₹ <?= number_format($originalPrice, 2) ?>/plate</span>
              <?php endif; ?>

              <br>
              <small>Last Updated: <?= date('d M Y', strtotime($menu['_update_dt'])) ?></small>
            </div>

          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/common.js"></script>
</body>
</html>