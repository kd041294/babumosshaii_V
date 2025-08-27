<?php
require 'template_header.php';
?>
</head>
<body>
  <!-- Navbar -->
  <?= require 'navbar.php'; ?>
  <!-- Hero Section -->
  <section id="home" class="hero d-flex align-items-center">
    <div class="container hero-content animate__animated animate__fadeInDown">
      <h1>Flavors that Celebrate Every Occasion</h1>
      <p class="lead">Premium Bengali & Fusion Catering for Weddings, Parties, and Corporate Events</p>
      <a href="#menu" class="btn btn-warning btn-lg shadow">Explore Menu</a>
    </div>
  </section>
  <!-- About Section -->
  <?php require 'about_us.php'; ?>
  <!-- Menu Section -->
  <?php require 'menus.php'; ?>
  <!-- Gallery Section -->
  <?php require 'gallary.php'; ?>
  <!-- Review Section -->
  <?php require 'testimonial.php'; ?>
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
  <script src="assets/js/common.js"></script>
</body>
</html>