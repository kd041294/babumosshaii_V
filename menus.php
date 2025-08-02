<!-- Menu Section -->
<section id="menu" class="py-5 px-3 px-sm-4 m-4 rounded bg-light">
  <div class="container">
    <h2 class="text-center mb-4 section-title">
      <i class="bi bi-egg-fried text-success me-2"></i>Our Menu
    </h2>
    <div class="row g-4">
      <!-- Menu Image 1 -->
      <div class="col-lg-3 col-md-4 col-sm-6 col-12">
        <div class="card border-0 shadow-sm h-100">
          <img src="assets/images/menus/menu_222.png" class="menu-img" alt="Menu 1" data-bs-toggle="modal" data-bs-target="#imageModal" loading="lazy" onclick="showImage(this)" />
        </div>
      </div>

      <!-- Menu Image 2 -->
      <div class="col-lg-3 col-md-4 col-sm-6 col-12">
        <div class="card border-0 shadow-sm h-100">
          <img src="assets/images/menus/menu_333.png" class="menu-img" alt="Menu 2" data-bs-toggle="modal" data-bs-target="#imageModal" loading="lazy" onclick="showImage(this)" />
        </div>
      </div>

      <!-- Menu Image 3 -->
      <div class="col-lg-3 col-md-4 col-sm-6 col-12">
        <div class="card border-0 shadow-sm h-100">
          <img src="assets/images/menus/menu_444.png" class="menu-img" alt="Menu 3" data-bs-toggle="modal" data-bs-target="#imageModal" loading="lazy" onclick="showImage(this)" />
        </div>
      </div>

      <!-- Menu Image 4 -->
      <div class="col-lg-3 col-md-4 col-sm-6 col-12">
        <div class="card border-0 shadow-sm h-100">
          <img src="assets/images/menus/menu_555.png" class="menu-img" alt="Menu 4" data-bs-toggle="modal" data-bs-target="#imageModal" loading="lazy" onclick="showImage(this)" />
        </div>
      </div>

      <!-- Menu Image 5 -->
      <div class="col-lg-3 col-md-4 col-sm-6 col-12">
        <div class="card border-0 shadow-sm h-100">
          <img src="assets/images/menus/menu_666.png" class="menu-img" alt="Menu 5" data-bs-toggle="modal" data-bs-target="#imageModal" loading="lazy" onclick="showImage(this)" />
        </div>
      </div>

      <!-- Menu Image 6 -->
      <div class="col-lg-3 col-md-4 col-sm-6 col-12">
        <div class="card border-0 shadow-sm h-100">
          <img src="assets/images/menus/menu_777.png" class="menu-img" alt="Menu 6" data-bs-toggle="modal" data-bs-target="#imageModal" loading="lazy" onclick="showImage(this)" />
        </div>
      </div>

      <!-- Menu Image 7 -->
      <div class="col-lg-3 col-md-4 col-sm-6 col-12">
        <div class="card border-0 shadow-sm h-100">
          <img src="assets/images/menus/menu_888.png" class="menu-img" alt="Menu 7" data-bs-toggle="modal" data-bs-target="#imageModal" loading="lazy" onclick="showImage(this)" />
        </div>
      </div>

      <!-- Menu Image 8 -->
      <div class="col-lg-3 col-md-4 col-sm-6 col-12">
        <div class="card border-0 shadow-sm h-100">
          <img src="assets/images/menus/menu_999.png" class="menu-img" alt="Menu 8" data-bs-toggle="modal" data-bs-target="#imageModal" loading="lazy" onclick="showImage(this)" />
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered">
    <div class="modal-content border-0 bg-dark">
      <div class="modal-header border-0">
        <button type="button" class="btn-close btn-close-white ms-auto me-2 mt-2" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0 d-flex justify-content-center align-items-center">
        <img id="modalImage" src="" alt="Zoomed Menu" class="img-fluid w-100 h-auto">
      </div>
    </div>
  </div>
</div>
<!-- Style -->
<style>
  .menu-img {
    width: 100%;
    height: 320px;
    object-fit: cover;
    border-radius: 0.5rem;
    cursor: pointer;
    transition: transform 0.3s ease;
  }

  .menu-img:hover {
    transform: scale(1.02);
  }

  @media (max-width: 576px) {
    .menu-img {
      height: auto;
    }
  }
</style>
<!-- Script -->
<script>
  function showImage(el) {
    const modalImg = document.getElementById('modalImage');
    modalImg.src = el.src;
    modalImg.alt = el.alt;
  }
</script>
