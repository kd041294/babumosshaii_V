<?php
require 'template_header.php';
$menuResponse = get_all_bm_menus(1);
$menus = $menuResponse['status'] ? $menuResponse['data'] : [];
?>
<title>Menu Catalogue | BabuMosshaii Kitchen & Caterer's</title>
<meta name="description"
  content="BabuMosshaii Kitchen & Caterer's offers premium Bengali and multi-cuisine catering services in Kolkata for weddings, receptions, corporate events, birthdays, and private parties.">
<meta name="keywords"
  content="BabuMosshaii catering Kolkata, Bengali catering Kolkata, wedding catering Kolkata, best caterers in Kolkata, corporate catering Kolkata">
<style>
  :root {
    --primary: #B8183E;
    --primary-light: #D6335C;

    --bg: #14090B;
    --card: #1E1114;
    --card-hover: #281418;

    --text: #F8F8F8;
    --muted: #C8C8C8;

    --gold: #F6C453;
    --gold-light: #FFE4A3;

    --border: rgba(255, 255, 255, .08);

    --shadow: 0 18px 45px rgba(0, 0, 0, .45);
  }

  /*=========================================
    GOOGLE FONT
  ==========================================*/
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

  body {
    font-family: 'Poppins', sans-serif;
    background:
      radial-gradient(circle at top left,
        rgba(184, 24, 62, .15),
        transparent 35%),
      radial-gradient(circle at bottom right,
        rgba(246, 196, 83, .08),
        transparent 35%),
      linear-gradient(135deg, #14090B, #1B0D11, #0F0A0B);

    color: var(--text);
  }

  /*=========================================
  HERO NOTICE
  ==========================================*/

  .notice-bar {
    background: linear-gradient(90deg,
        #3A151B,
        #261012);
    border-left: 5px solid var(--gold);
    color: #FFF;
    border-radius: 18px;
    padding: 15px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
    margin-bottom: 30px;
    overflow: hidden;
  }

  .notice-text {
    color: #FFF;
    font-size: 15px;
    font-weight: 600;
    white-space: nowrap;
    display: inline-block;
    padding-left: 100%;
    animation: marquee 22s linear infinite;
  }

  @keyframes marquee {

    from {
      transform: translateX(0);
    }

    to {
      transform: translateX(-100%);
    }

  }

  /*=========================================
 CARD
==========================================*/

  .menu-grid-card {

    background: linear-gradient(180deg,
        #241215,
        #1B1012);

    border: 1px solid var(--border);

    border-radius: 22px;

    box-shadow: var(--shadow);

    transition: .35s;

  }

  .menu-grid-card:hover {

    transform: translateY(-8px);

    border-color: rgba(246, 196, 83, .4);

    box-shadow:
      0 25px 60px rgba(0, 0, 0, .55);

  }

  /*=========================================
 WATERMARK
==========================================*/

  .menu-grid-card::before {

    content: "";

    position: absolute;

    inset: 0;

    background: url("assets/images/logo.png") center center no-repeat;

    background-size: 65%;

    opacity: .04;

    pointer-events: none;

  }

  .menu-grid-card>* {

    position: relative;

    z-index: 2;

  }

  /*=========================================
  HEADER
  ==========================================*/

  .menu-grid-header {
    background: linear-gradient(135deg,
        #B8183E,
        #82102B);

    color: #fff;

    padding: 18px;

    font-size: 18px;

    font-weight: 700;

  }

  .menu-grid-header span {

    letter-spacing: .5px;

  }

  /*=========================================
 BADGE
==========================================*/

  .menu-grid-header .badge {

    background: rgba(255, 255, 255, .25) !important;

    backdrop-filter: blur(10px);

    border: 1px solid rgba(255, 255, 255, .3);

    color: #fff;

    font-size: 11px;

    padding: 6px 10px;

    border-radius: 50px;

  }

  /*=========================================
  SHARE BUTTON
  ==========================================*/

  .share-btn {

    width: 38px;

    height: 38px;

    border: none;

    border-radius: 50%;

    background: rgba(255, 255, 255, .08);

    color: white;

    transition: .3s;

  }

  .share-btn:hover {

    background: var(--gold);
    color: #111;
    transform: rotate(20deg) scale(1.12);

  }

  /*=========================================
  CONTENT
  ==========================================*/

  .menu-content {

    max-height: 420px;

    overflow-y: auto;

    padding: 15px;

  }

  /*=========================================
  SCROLLBAR
  ==========================================*/

  .menu-content::-webkit-scrollbar {

    width: 6px;

  }

  ::-webkit-scrollbar-thumb {

    background: var(--primary);

    border-radius: 10px;

  }

  .menu-content::-webkit-scrollbar-track {

    background: #f4f4f4;

  }

  /*=========================================
  SECTIONS
  ==========================================*/

  .menu-grid-section {

    margin-bottom: 20px;

  }

  .menu-grid-title {

    color: var(--gold);

    border-left: 4px solid var(--gold);

    padding-left: 10px;

    font-weight: 700;

  }

  /*=========================================
  MENU LIST
  ==========================================*/

  .menu-grid-list {

    list-style: none;

    padding-left: 0;

    margin-bottom: 0;

  }

  .menu-grid-list li {

    display: flex;

    align-items: center;

    padding: 8px 0;

    color: #DDDDDD;

    border-bottom: 1px dashed rgba(255, 255, 255, .08);

    font-size: 14px;

  }

  .menu-grid-list li:last-child {

    border: none;

  }

  .menu-grid-list li::before {

    content: "✓";

    width: 22px;

    height: 22px;

    background: #B8183E;

    color: var(--gold);

    display: flex;

    justify-content: center;

    align-items: center;

    border-radius: 50%;

    font-size: 11px;

    margin-right: 10px;

    flex-shrink: 0;
    font-weight: bold;

  }

  /*=========================================
  FOOTER
  ==========================================*/

  .menu-grid-footer {

    background: #211214;

    border-top: 1px solid rgba(255, 255, 255, .08);

    color: #DDD;
  padding: 3%
  }

  .menu-grid-footer small {

    color: #888;

  }

  /*=========================================
  HEAD COUNT
  ==========================================*/

  .text-danger {

    color: #B8183E !important;

    font-weight: 700;

  }

  /*=========================================
  PRICE
  ==========================================*/

  .final-price {

    font-size: 20px;

    font-weight: 800;

    color: var(--gold);

  }

  .original-price {

    margin-left: 8px;

    color: #888;

    text-decoration: line-through;

    font-size: 15px;

  }

  .discount-badge {

    display: inline-block;

    margin-left: 10px;

    background: linear-gradient(135deg,
        #EAB308,
        #FACC15);

    color: #111;

    border-radius: 50px;

    padding: 6px 14px;

    font-size: 12px;

    font-weight: 700;

  }

  /*=========================================
  CARD ENTRY ANIMATION
  ==========================================*/

  .menu-grid-card {

    animation: fadeUp .6s ease both;

  }

  @keyframes fadeUp {

    from {

      opacity: 0;

      transform: translateY(30px);

    }

    to {

      opacity: 1;

      transform: none;

    }

  }

  /*=========================================
  HOVER EFFECT
  ==========================================*/

  .menu-grid-card:hover .menu-grid-header {

    background: linear-gradient(135deg, #a01133, #ff4b72);

  }

  /*=========================================
  RESPONSIVE
  ==========================================*/

  @media(max-width:992px) {

    .menu-content {

      max-height: 350px;

    }

  }

  @media(max-width:768px) {

    .menu-grid-header {

      font-size: 16px;

      padding: 15px;

    }

    .final-price {

      font-size: 24px;

    }

    .notice-text {

      font-size: 14px;

      animation-duration: 15s;

    }

  }

  @media(max-width:576px) {

    .container {

      padding-left: 12px;

      padding-right: 12px;

    }

    .menu-grid-card {

      border-radius: 18px;

    }

    .menu-content {

      max-height: 280px;

    }

    .final-price {

      font-size: 22px;

    }

    .menu-grid-list li {

      font-size: 13px;

    }

    .menu-grid-title {

      font-size: 13px;

    }

    .share-btn {

      width: 34px;

      height: 34px;

    }

  }
</style>
</head>

<body>
  <?php require 'navbar.php'; ?>
  <?php require 'quick_connect.php'; ?>
  <section class="menu-hero">
    <div class="container text-center">
      <h1>🍽 Premium Catering Menu Collection</h1>
      <p>Select a menu package for your special occasion.</p>
    </div>
  </section>
  <div class="container my-2 mb-4">
    <div class="notice-bar">
      <div class="notice-text">
        🍽️ All menus include breakfast and lunch for 30 guests. For additional guests beyond 30, a charge of ₹225 per head will apply. The minimum requirement for any event is 250 guests.
      </div>

    </div>
    <div class="row g-3">
      <?php foreach ($menus as $menu): ?>
        <div class="col-12 col-sm-6 col-md-4 col-xl-3">

          <div class="menu-grid-card shadow-sm rounded">

            <!-- Header -->
            <div class="menu-grid-header d-flex justify-content-between align-items-center">

              <span><?= htmlspecialchars($menu['_menu_code']) ?></span>

              <div class="d-flex align-items-center gap-2">

                <span class="badge bg-success"><?= $menu['_arrange'] ?></span>
                <?php $encryptedId = encryptData($menu['_id']); ?>

                <button
                  class="share-btn"
                  data-menu="<?= htmlspecialchars($menu['_menu_code']) ?>"
                  data-id="<?= htmlspecialchars($encryptedId, ENT_QUOTES, 'UTF-8') ?>"
                  title="Share Menu">
                  <i class="bi bi-share-fill"></i>
                </button>

              </div>

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
    <div class="quick-connect-btn" id="quickConnectBtn" title="Quick Connect">
      <i class="fas fa-comments"></i>
    </div>
  </div>
  <!-- Footer -->
  <?php require 'footer.php'; ?>
  <script>
    const BASE_URL = "<?= BASE_URL ?>";
  </script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/common.js?v=1.4.0"></script>
  <script>
    $(document).on('click', '.share-btn', function() {

      let menuName = $(this).data('menu');
      let menuId = $(this).data('id');

      // 🔗 Create share URL (customize route)
      let shareUrl = BASE_URL + "menu_details.php?id=" + menuId;

      // 📱 If Web Share API supported (mobile)
      if (navigator.share) {
        navigator.share({
          title: "Check this Wedding Menu",
          text: "🍽️ " + menuName + " - Wedding Menu",
          url: shareUrl
        }).catch(err => console.log(err));
      } else {
        // 💻 Fallback → Copy link
        navigator.clipboard.writeText(shareUrl).then(() => {
          showResponseModal(true, "Link copied! Share it anywhere 👍");
        }).catch(() => {
          showResponseModal(false, "Failed to copy link");
        });
      }

    });
  </script>
</body>

</html>
