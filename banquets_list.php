<?php
require 'template_header.php';
$result = getBanquetList();
$result_count = is_array($result) ? count($result) : 0;
?>
<style>
  .banquet-card {
    transition: all 0.3s ease;
    min-height: 350px;
    /* Fixed height */
  }

  .banquet-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
  }

  .card-img-top {
    border-radius: 12px 12px 0 0;
    object-fit: cover;
    height: 200px;
  }
</style>
</head>

<body>
  <!-- Navbar -->
  <?php require 'navbar.php'; ?>
  <div class="content">
    <div class="container my-4">
      <div class="row align-items-center mb-4">
        <!-- Left: Title -->
        <div class="col-md-6">
          <h2 class="fw-bold text-white mb-0">Available Banquet Halls</h2>
        </div>
        <!-- Right: Search Box -->
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
          <input type="text" id="banquetSearch" class="form-control" placeholder="Search banquet halls by name..."
            style="max-width: 300px; display: inline-block;">
        </div>
      </div>
      <div class="row g-4">
        <div class="row g-4">
          <?php if (!empty($result)): ?>
            <?php foreach ($result as $banquet): ?>
              <div class="col-md-4 banquet-item" data-name="<?= strtolower(htmlspecialchars($banquet['_hall_name'])) ?>">
                <div class="card banquet-card shadow-lg border-0 h-100">
                  <img
                    src="<?= !empty($banquet['_hall_image_url']) ? $banquet['_hall_image_url'] : './assets/images/dummy_halls.jpg' ?>"
                    class="card-img-top" alt="<?= htmlspecialchars($banquet['_hall_name']) ?>">
                  <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                      <h5 class="card-title fw-bold">
                        <i class="bi bi-house-heart-fill text-danger me-2"></i>
                        <?= htmlspecialchars($banquet['_hall_name']) ?>
                      </h5>
                      <!-- Example: Star Ratings (static for now or can be added later) -->
                      <div class="d-flex align-items-center mb-2">
                        <?php if (!empty($banquet['_rating_count']) && $banquet['_rating_count'] > 0): ?>
                          <?php
                          $avgRating = round($banquet['_avg_rating'], 1); // Round to 1 decimal
                          $fullStars = floor($avgRating);
                          $halfStar = ($avgRating - $fullStars) >= 0.5 ? 1 : 0;
                          $emptyStars = 5 - ($fullStars + $halfStar);
                          ?>
                          <span class="text-warning me-1">
                            <?php for ($i = 0; $i < $fullStars; $i++): ?>
                              <i class="bi bi-star-fill"></i>
                            <?php endfor; ?>
                            <?php if ($halfStar): ?>
                              <i class="bi bi-star-half"></i>
                            <?php endif; ?>
                            <?php for ($i = 0; $i < $emptyStars; $i++): ?>
                              <i class="bi bi-star"></i>
                            <?php endfor; ?>
                          </span>
                          <small class="text-muted">
                            (<?= $avgRating ?>/5 based on <?= $banquet['_rating_count'] ?> reviews)
                          </small>
                        <?php else: ?>
                          <span class="badge bg-success px-3 py-2 rounded-pill">Newly Listed</span>
                        <?php endif; ?>
                      </div>
                      <p class="card-text text-muted small">
                        <?php
                        if (!empty($banquet['_hall_description'])) {
                          $desc = htmlspecialchars($banquet['_hall_description']);
                          echo (strlen($desc) > 50) ? substr($desc, 0, 100) . '...' : $desc;
                        } else {
                          echo 'Description is not available';
                        }
                        ?>
                      </p>
                      <p class="card-text text-muted small">
                        <i class="bi bi-clock me-2"></i> 
                        <?php
                        if (!empty($banquet['_booking_from']) && !empty($banquet['_booking_to'])) {
                          $from = date('g:i A', strtotime($banquet['_booking_from']));
                          $to = date('g:i A', strtotime($banquet['_booking_to']));
                          echo $from . ' - ' . $to;
                        } else {
                          echo 'Not Specified';
                        }
                        ?>
                      </p>
                    </div>
                    <div class="mt-3">
                      <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold text-danger">
                          <i class="bi bi-currency-rupee"></i>
                          <?= number_format((float)$banquet['_rental_charge'], 0) ?> / Day
                        </span>
                        <a href="<?= $routes['banquet_details'] . '?id=' . encryptData($banquet['_id']) ?>"
                          class="btn btn-sm custom-btn rounded-pill px-3">
                          <i class="bi bi-calendar2-check-fill me-1"></i> Check Details
                        </a>
                      </div>
                      <p class="mt-2 mb-0 text-secondary small">
                        <i class="bi bi-clock-history me-1 text-primary"></i>
                        <strong>Book Time:</strong> 7:00 AM – 12:00 AM
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <div class="col-12">
              <p class="text-center text-white">No banquet halls found.</p>
            </div>
          <?php endif; ?>
          <div class="col-12 text-center d-none" id="noBanquetCard">
            <div class="card bg-white text-dark border-0 shadow-lg p-4">
              <h5 class="mb-0">No Banquet Found</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
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
  <script src="assets/js/banquets.js"></script>
</body>
</html>