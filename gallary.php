<section id="gallery" class="m-4 py-5 rounded">
  <div class="container">
    <h2 class="section-title text-center mb-4" style="color:#B8183E;">
      <i class="bi bi-images me-2 text-warning"></i>Our Social & Professional Events Gallery
    </h2>
    <div class="row g-3">
      <?php
      $galleryImages = [
        "assets/images/event_images/1.jpg",
        "assets/images/event_images/2.jpg",
        "assets/images/event_images/3.jpg",
        "assets/images/event_images/4.jpg",
        "assets/images/event_images/5.jpeg",
        "assets/images/event_images/6.jpeg",
        "assets/images/event_images/7.jpeg",
        "assets/images/event_images/8.jpeg",
        "assets/images/event_images/9.jpg",
        "assets/images/event_images/10.jpg",
        "assets/images/event_images/11.jpg",
        "assets/images/event_images/12.jpg"
      ];
      foreach ($galleryImages as $i => $img) {
        echo '<div class="col-sm-6 col-md-4 col-lg-3 col-sm-12">';
        echo '  <div class="gallery-img-wrap position-relative overflow-hidden rounded-4 shadow-sm" onclick="openGalleryModal(\'' . $img . '\')" style="aspect-ratio: 4/3;">';
        echo '    <img src="' . $img . '" alt="Traditional Bengali Wedding Catering Setup in Kolkata" class="w-100 h-100 gallery-img" loading="lazy">';
        echo '    <span class="gallery-hover position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">View</span>';
        echo '  </div>';
        echo '</div>';
      }
      ?>
    </div>
  </div>
</section>
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered">
    <div class="modal-content bg-dark border-0">
      <div class="modal-body p-0">
        <img id="modalImage" src="" class="img-fluid w-100 h-auto" style="object-fit: contain;" alt="Full view">
      </div>
      <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
  </div>
</div>
<!-- Script -->
<script>
  function openGalleryModal(src) {
    const modalImg = document.getElementById('modalImage');
    modalImg.src = src;
    const modal = new bootstrap.Modal(document.getElementById('imageModal'));
    modal.show();
  }
</script>
<style>
  .gallery-img-wrap {
    cursor: pointer;
    border: 1px solid #FAFAD2;
    background: #f8f9fa;
    transition: box-shadow 0.2s, border-color 0.2s;
    min-height: 180px;
    max-height: 220px;
  }

  .gallery-img {
    object-fit: cover;
    width: 100%;
    height: 100%;
    transition: transform 0.3s;
  }

  .gallery-hover {
    background: rgba(24, 24, 24, 0.55);
    color: #fff;
    opacity: 0;
    transition: opacity 0.3s;
    font-size: 1.3rem;
    font-weight: 600;
    border-radius: 1rem;
    pointer-events: none;
  }

  .gallery-img-wrap:hover {
    box-shadow: 0 8px 32px #b8183e44, 0 2px 16px #18181833;
    border-color: #B8183E;
  }

  .gallery-img-wrap:hover .gallery-img {
    transform: scale(1.07) rotate(-2deg);
    filter: brightness(1.08) saturate(1.1);
  }

  .gallery-img-wrap:hover .gallery-hover {
    opacity: 1;
  }

  @media (max-width: 767px) {
    .gallery-img-wrap {
      min-height: 120px;
      max-height: 140px;
    }
  }
</style>