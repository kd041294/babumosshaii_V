<?php
require 'template_header.php';
?>
<meta name="description"
  content="BabuMosshaii Kitchen & Caterer's offers premium Bengali and multi-cuisine catering services in Kolkata for weddings, receptions, corporate events, birthdays, and private parties.">
<meta name="keywords"
  content="BabuMosshaii catering Kolkata, Bengali catering Kolkata, wedding catering Kolkata, best caterers in Kolkata, corporate catering Kolkata">
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
<style>
  .hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(184, 24, 62, 0.85) 0%, rgba(24, 24, 24, 0.92) 100%);
    z-index: 1;
  }

  .hero-content-wrapper {
    position: relative;
    z-index: 2;
  }

  .hero h1 {
    font-size: clamp(2.5rem, 8vw, 4rem) !important;
    font-weight: 800 !important;
    background: linear-gradient(135deg, #fafad2 0%, #ffe066 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    letter-spacing: -1px;
    line-height: 1.2;
    margin-bottom: 1.5rem !important;
  }

  .hero .lead {
    font-size: 1.3rem;
    color: #f5f5f5;
    font-weight: 300;
    letter-spacing: 0.5px;
    line-height: 1.6;
    margin-bottom: 2.5rem !important;
  }

  .hero-cta-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
  }

  .btn-explore {
    background: linear-gradient(135deg, #fafad2 0%, #ffe066 100%);
    color: #181818;
    border: none;
    font-weight: 700;
    padding: 1rem 2.5rem;
    border-radius: 50px;
    box-shadow: 0 8px 32px rgba(184, 24, 62, 0.4);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    text-decoration: none;
    display: inline-block;
    font-size: 1.1rem;
    letter-spacing: 0.5px;
  }

  .btn-explore:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 12px 48px rgba(184, 24, 62, 0.6);
    background: linear-gradient(135deg, #ffe066 0%, #fafad2 100%);
  }

  .btn-secondary-cta {
    border: 2px solid #fafad2;
    color: #fafad2;
    background: transparent;
    font-weight: 700;
    padding: 0.9rem 2.3rem;
    border-radius: 50px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    text-decoration: none;
    display: inline-block;
    font-size: 1.1rem;
  }

  .btn-secondary-cta:hover {
    background: #fafad2;
    color: #181818;
    transform: translateY(-3px);
    box-shadow: 0 8px 32px rgba(184, 24, 62, 0.3);
  }

  .floating-elements {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    overflow: hidden;
  }

  .floating-shape {
    position: absolute;
    opacity: 0.05;
  }
</style>
</head>

<body>
  <!-- Navbar -->
  <?php require 'navbar.php'; ?>
  <!-- Hero Section -->
  <section id="home" class="hero d-flex align-items-center position-relative overflow-hidden">
    <div class="floating-elements">
      <svg class="floating-shape" width="300" height="300" viewBox="0 0 300 300" style="top: -50px; left: -50px;">
        <circle cx="150" cy="150" r="120" fill="#fafad2" opacity="0.1"/>
      </svg>
      <svg class="floating-shape" width="250" height="250" viewBox="0 0 250 250" style="bottom: -30px; right: -30px;">
        <rect width="250" height="250" fill="#b8183e" opacity="0.05" transform="rotate(45)"/>
      </svg>
    </div>
    
    <div class="hero-overlay"></div>
    
    <div class="container hero-content animate__animated animate__fadeInDown hero-content-wrapper">
      <h1 class="mb-4">Flavors that Celebrate Every Occasion</h1>
      <p class="lead mb-5">Premium Bengali & Fusion Catering for Weddings, Parties, and Corporate Events</p>
      <div class="hero-cta-buttons">
        <a href="#menu" class="btn-explore">
          <i class="bi bi-bookmark-heart me-2"></i>Explore Menu
        </a>
        <a href="#contact" class="btn-secondary-cta">
          <i class="bi bi-telephone me-2"></i>Book Now
        </a>
      </div>
    </div>
  </section>
  <!-- About Section -->
  <?php require 'about_us.php'; ?>
  <!-- Gallery Section -->
  <?php require 'gallary.php'; ?>
  <!-- Contact Section -->
  <?php require 'get_a_call_back.php'; ?>
  <!-- Footer -->
  <?php require 'footer.php'; ?>
  <!-- Quick Connect Floating Button -->
  <div class="quick-connect-btn" id="quickConnectBtn" title="Quick Connect">
    <i class="fas fa-comments"></i>
  </div>
  <!-- Quick Connect Floating Popup -->
  <?php require 'quick_connect.php'; ?>
  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script src="assets/js/common.js"></script>
  <script src="assets/js/animations.js"></script>
  <script>
    AOS.init({
      duration: 800,
      easing: 'ease-in-out-cubic',
      once: false,
      mirror: false,
      offset: 100
    });
  </script>
</body>

</html>