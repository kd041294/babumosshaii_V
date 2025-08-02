<?php
require 'template_header.php';
?>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="assets/images/logo.png" alt="Logo" />
        <span>BabuMosshaii</span>
      </a>
      <button class="navbar-toggler text-white border" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <i class="bi bi-list fs-2"></i> <!-- Hamburger menu icon -->
      </button>
      <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item"><a class="nav-link active" href="#home">Home</a></li>
          <li class="nav-item"><a class="nav-link text-decoration-none" href="#menu">Menu</a></li>
          <li class="nav-item"><a class="nav-link text-decoration-none" href="#about">About Us</a></li>
          <li class="nav-item"><a class="nav-link text-decoration-none" href="#review">Testimonial's</a></li>
        </ul>
        <a href="#contact" class="btn btn-quote px-3">Get Quote</a>
      </div>
    </div>
  </nav>
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