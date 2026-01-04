<?php
require 'template_header.php';
$menuResponse = get_all_bm_menus(1); // fetch active menus
$menus = $menuResponse['status'] ? $menuResponse['data'] : [];
?>
<title>Wedding Menu Collection</title>
<style>
  /* Card Container */
  .menu-grid-card {
    border-radius: 18px;
    background: linear-gradient(145deg, #fff8f0, #fff1e6);
    transition: 0.3s ease;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    min-height: 100%;
  }

  /* Hover Effect (desktop only) */
  @media (hover: hover) {
    .menu-grid-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 16px 32px rgba(0, 0, 0, 0.18);
    }
  }

  /* Header */
  .menu-grid-header {
    background: linear-gradient(90deg, #ff9966, #ff5e62);
    color: #fff;
    padding: 12px 15px;
    font-size: 0.95rem;
    font-weight: 600;
    border-radius: 18px 18px 0 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
  }

  /* Status Badge */
  .menu-grid-header .badge {
    font-size: 0.7rem;
    font-weight: 600;
    padding: 3px 6px;
    margin-top: 4px;
  }

  /* Menu Sections */
  .menu-grid-section {
    padding: 10px 15px 0;
  }

  .menu-grid-title {
    font-size: 0.78rem;
    font-weight: 700;
    color: #d35400;
    text-transform: uppercase;
    border-bottom: 1px dashed #e0bfb0;
    margin-bottom: 6px;
  }

  .menu-grid-list {
    font-size: 0.82rem;
    padding-left: 18px;
    margin-bottom: 8px;
    color: #555;
    line-height: 1.4;
  }

  /* Footer Section */
  .menu-grid-footer {
    background: #fff3e0;
    border-top: 1px dashed #f0d9c8;
    padding: 10px 15px;
    font-size: 0.78rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
  }

  /* Buy Now Button */
  .buy-now-btn {
    width: 100%;
    font-size: 0.88rem;
    font-weight: 600;
    border-radius: 12px;
    background: linear-gradient(90deg, #ff7e5f, #feb47b);
    color: #fff;
    border: none;
    padding: 10px 0;
    margin-top: 10px;
    transition: 0.3s ease;
  }

  .buy-now-btn:hover {
    background: linear-gradient(90deg, #feb47b, #ff7e5f);
    transform: translateY(-2px);
  }

  /* Grid layout responsive */
  @media (max-width: 1200px) {
    .col-xl-3 {
      flex: 0 0 33.3333%;
      max-width: 33.3333%;
    }
  }

  @media (max-width: 992px) {
    .col-md-4 {
      flex: 0 0 50%;
      max-width: 50%;
    }
  }

  @media (max-width: 576px) {
    .col-sm-6 {
      flex: 0 0 100%;
      max-width: 100%;
    }

    .menu-grid-header {
      font-size: 0.9rem;
      flex-direction: column;
      align-items: flex-start;
    }

    .menu-grid-footer {
      font-size: 0.72rem;
      flex-direction: column;
      align-items: flex-start;
      gap: 4px;
    }

    .menu-grid-title {
      font-size: 0.72rem;
    }

    .menu-grid-list {
      font-size: 0.75rem;
      padding-left: 15px;
    }

    .buy-now-btn {
      font-size: 0.82rem;
      padding: 10px 0;
    }
  }

  .text-decoration-line-through {
    opacity: 0.7;
  }

  .price-highlight {
    font-size: 1rem;
    font-weight: 700;
    color: #e74c3c;
  }
</style>
</head>

<body>
  <!-- Navbar -->
  <?= require 'navbar.php'; ?>
  <?php require 'quick_connect.php'; ?>
  <div class="container my-2">
    <div class="row g-3">
      <?php foreach ($menus as $menu): ?>
        <div class="col-12 col-sm-6 col-md-4 col-xl-3">
          <div class="menu-grid-card shadow-sm h-100 d-flex flex-column">
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
              "Starter's"      => $menu['_starter'],
              "Main Course"   => $menu['_main_course'],
              "Dessert"       => $menu['_dessert'],
              "Add's-on"       => $menu['_Ads_on'],
              "Beverages"     => $menu['_beverages']
            ];
            ?>
            <!-- Menu Sections -->
            <div class="flex-grow-1">
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
            <div class="menu-grid-footer">
              <span>
                <span class="text-danger fw-bold">Total Heads : <?= $menu['_heads'] ?></span>
              </span>
            </div>
            <!-- Price Footer -->
            <div class="menu-grid-footer">
              <?php
              $originalPrice = (float) $menu['_price'];
              $discount      = (int) $menu['_discount'];

              $finalPrice = $originalPrice;

              if ($discount > 0) {
                $finalPrice = $originalPrice - (($originalPrice * $discount) / 100);
              }
              ?>
              <span class="fw-bold">
                <?php if ($discount > 0): ?>
                  <!-- Original Price (Striked) -->
                  <span class="text-muted text-decoration-line-through me-1">
                    ₹ <?= number_format($originalPrice, 2) ?>/plate
                  </span>

                  <!-- Discounted Price -->
                  <span class="text-danger">
                    ₹ <?= number_format($finalPrice, 2) ?>/plate
                  </span>

                  <span class="text-success ms-1">
                    (<?= $discount ?>% off)
                  </span>
                <?php else: ?>
                  <!-- No Discount -->
                  <span class="text-danger">
                    ₹ <?= number_format($originalPrice, 2) ?>/plate
                  </span>
                <?php endif; ?>
              </span>
              <br>
              <span style="font-size: 75%;">Last Updated On : <?= date('d M Y', strtotime($menu['_update_dt'])) ?></span>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="quick-connect-btn" id="quickConnectBtn" title="Quick Connect">
    <i class="fas fa-comments"></i>
  </div>
  <!-- Quick Connect Floating Popup -->
  <?php require 'quick_connect.php'; ?>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/common.js"></script>
</body>
</html>