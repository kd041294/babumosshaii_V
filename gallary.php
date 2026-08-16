<section id="gallery" class="py-100 position-relative overflow-hidden" style="background: linear-gradient(135deg, rgba(24, 24, 24, 0.95) 0%, rgba(184, 24, 62, 0.05) 100%);">
  <!-- Background Pattern -->
  <div style="
    position: absolute;
    top: 50%;
    right: -10%;
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(250, 250, 210, 0.08) 0%, rgba(184, 24, 62, 0.08) 100%);
    border-radius: 50%;
    animation: float 8s ease-in-out infinite;
    z-index: 0;
  "></div>

  <div class="container position-relative z-1">
    <!-- Section Header -->
    <div class="row mb-5">
      <div class="col-lg-8 mx-auto text-center mb-5">
        <div class="d-inline-block mb-3">
          <span class="badge bg-danger bg-opacity-10 text-danger px-4 py-2 fw-bold" style="border-radius: 50px; font-size: 1rem; letter-spacing: 1px;">
            <i class="bi bi-camera-fill me-2"></i>VISUAL MOMENTS
          </span>
        </div>
        <h2 class="display-5 fw-900 mb-4 gradient-text-danger" style="letter-spacing: -1px;">
          Our Gallery of Events
        </h2>
        <p class="fs-5 text-secondary-light" style="line-height: 1.8; max-width: 650px; margin: auto;">
          Explore the magic we create at every celebration. From intimate gatherings to grand celebrations, witness the artistry behind every event.
        </p>
      </div>
    </div>

    <!-- Filter Buttons -->
    <div class="row mb-5">
      <div class="col-12 text-center">
        <div class="d-flex flex-wrap justify-content-center gap-3">
          <button class="filter-btn active" data-filter="all" onclick="filterGallery('all')">
            <i class="bi bi-grid-3x3-gap me-2"></i>All Events
          </button>
          <button class="filter-btn" data-filter="weddings" onclick="filterGallery('weddings')">
            <i class="bi bi-heart-fill me-2"></i>Weddings
          </button>
          <button class="filter-btn" data-filter="corporate" onclick="filterGallery('corporate')">
            <i class="bi bi-briefcase-fill me-2"></i>Corporate
          </button>
          <button class="filter-btn" data-filter="celebrations" onclick="filterGallery('celebrations')">
            <i class="bi bi-balloon-heart-fill me-2"></i>Celebrations
          </button>
        </div>
      </div>
    </div>

    <!-- Gallery Grid -->
    <div class="row g-4">
      <?php
      $galleryImages = [
        ["url" => "assets/images/event_images/1.jpg", "category" => "weddings", "title" => "Elegant Wedding Setup"],
        ["url" => "assets/images/event_images/2.jpg", "category" => "corporate", "title" => "Corporate Dinner Event"],
        ["url" => "assets/images/event_images/3.jpg", "category" => "celebrations", "title" => "Festive Celebration"],
        ["url" => "assets/images/event_images/4.jpg", "category" => "weddings", "title" => "Wedding Reception"],
        ["url" => "assets/images/event_images/5.jpeg", "category" => "corporate", "title" => "Professional Catering"],
        ["url" => "assets/images/event_images/6.jpeg", "category" => "celebrations", "title" => "Birthday Party"],
        ["url" => "assets/images/event_images/7.jpeg", "category" => "weddings", "title" => "Traditional Wedding"],
        ["url" => "assets/images/event_images/8.jpeg", "category" => "corporate", "title" => "Business Banquet"],
        ["url" => "assets/images/event_images/9.jpg", "category" => "celebrations", "title" => "Anniversary Celebration"],
        ["url" => "assets/images/event_images/10.jpg", "category" => "weddings", "title" => "Couple's Special Day"],
        ["url" => "assets/images/event_images/11.jpg", "category" => "corporate", "title" => "Corporate Gala"],
        ["url" => "assets/images/event_images/12.jpg", "category" => "celebrations", "title" => "Grand Celebration"]
      ];
      
      foreach ($galleryImages as $i => $img) {
        echo '<div class="col-sm-6 col-md-4 col-lg-3 gallery-item" data-category="' . $img['category'] . '" data-aos="fade-up" data-aos-delay="' . ($i * 50) . '">';
        echo '  <div class="gallery-card-wrapper position-relative overflow-hidden rounded-4" onclick="openGalleryModal(\'' . $img['url'] . '\', \'' . $img['title'] . '\')" style="aspect-ratio: 1/1; cursor: pointer;">';
        echo '    <!-- Image -->';
        echo '    <img src="' . $img['url'] . '" alt="' . $img['title'] . '" class="gallery-img w-100 h-100" loading="lazy">';
        echo '    <!-- Overlay -->';
        echo '    <div class="gallery-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column align-items-center justify-content-center">';
        echo '      <div class="overlay-content text-center text-white">';
        echo '        <i class="bi bi-zoom-in" style="font-size: 3rem; margin-bottom: 1rem; display: block;"></i>';
        echo '        <h5 class="mb-2" style="font-weight: 700;">' . $img['title'] . '</h5>';
        echo '        <p class="small" style="opacity: 0.9;">Click to view</p>';
        echo '      </div>';
        echo '    </div>';
        echo '    <!-- Category Badge -->';
        echo '    <div class="position-absolute top-3 start-3">';
        echo '      <span class="badge bg-danger bg-opacity-90" style="font-size: 0.75rem; padding: 0.4rem 0.8rem; text-transform: capitalize;">' . ucfirst($img['category']) . '</span>';
        echo '    </div>';
        echo '  </div>';
        echo '</div>';
      }
      ?>
    </div>

    <!-- View More Button -->
    <div class="row mt-5">
      <div class="col-12 text-center">
        <button class="btn btn-explore" onclick="alert('More gallery images coming soon!')">
          <i class="bi bi-images me-2"></i>View More Events
        </button>
      </div>
    </div>
  </div>
</section>
<!-- Enhanced Gallery Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered">
    <div class="modal-content bg-dark border-0" style="border-radius: 16px; overflow: hidden;">
      <div class="modal-body p-0 position-relative">
        <!-- Close Button -->
        <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-4" data-bs-dismiss="modal" aria-label="Close" style="z-index: 100; background: rgba(0,0,0,0.5); border-radius: 50%; width: 50px; height: 50px; padding: 0;"></button>
        
        <!-- Image Container -->
        <div style="background: rgba(0, 0, 0, 0.8); display: flex; align-items: center; justify-content: center; min-height: 500px;">
          <img id="modalImage" src="" class="img-fluid" style="object-fit: contain; max-height: 90vh; max-width: 90vw;" alt="Gallery image">
        </div>

        <!-- Image Info -->
        <div class="p-4 bg-gradient" style="background: linear-gradient(135deg, rgba(24,24,24,0.98) 0%, rgba(184,24,62,0.1) 100%);">
          <h5 id="modalTitle" class="text-white mb-2 fw-bold">Image Title</h5>
          <p class="text-secondary-light small mb-0" style="opacity: 0.8;">
            <i class="bi bi-camera-fill me-2"></i>Professional Event Photography
          </p>
        </div>

        <!-- Navigation Arrows (Desktop Only) -->
        <button class="btn btn-light position-absolute start-0 top-50 translate-middle-y ms-3 d-none d-lg-inline-flex" onclick="previousImage()" style="width: 50px; height: 50px; border-radius: 50%; z-index: 50;">
          <i class="bi bi-chevron-left"></i>
        </button>
        <button class="btn btn-light position-absolute end-0 top-50 translate-middle-y me-3 d-none d-lg-inline-flex" onclick="nextImage()" style="width: 50px; height: 50px; border-radius: 50%; z-index: 50;">
          <i class="bi bi-chevron-right"></i>
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Gallery Styling -->
<style>
  /* Gallery Items */
  .gallery-card-wrapper {
    box-shadow: 0 4px 20px rgba(184, 24, 62, 0.15);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: 2px solid transparent;
    background: linear-gradient(135deg, #f8f9fa 0%, #f0f0f0 100%);
  }

  .gallery-card-wrapper:hover {
    transform: translateY(-8px);
    box-shadow: 0 16px 48px rgba(184, 24, 62, 0.3);
    border-color: #b8183e;
  }

  .gallery-img {
    object-fit: cover;
    width: 100%;
    height: 100%;
    transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1), filter 0.5s ease;
  }

  .gallery-card-wrapper:hover .gallery-img {
    transform: scale(1.12) rotate(2deg);
    filter: brightness(1.1) saturate(1.15);
  }

  /* Overlay */
  .gallery-overlay {
    background: rgba(24, 24, 24, 0.7);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    opacity: 0;
    transition: opacity 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .gallery-card-wrapper:hover .gallery-overlay {
    opacity: 1;
  }

  .overlay-content {
    animation: slideInUp 0.5s ease;
  }

  /* Filter Buttons */
  .filter-btn {
    padding: 0.75rem 1.5rem;
    border: 2px solid #e0e0e0;
    background: transparent;
    color: #666;
    font-weight: 600;
    border-radius: 50px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
    font-size: 0.95rem;
  }

  .filter-btn:hover {
    border-color: #b8183e;
    color: #b8183e;
    transform: translateY(-2px);
  }

  .filter-btn.active {
    background: linear-gradient(135deg, #b8183e 0%, #d41f50 100%);
    color: white;
    border-color: #b8183e;
    box-shadow: 0 8px 20px rgba(184, 24, 62, 0.3);
  }

  /* Text Color Classes */
  .text-secondary-light {
    color: rgba(255, 255, 255, 0.7) !important;
  }

  .gradient-text-danger {
    background: linear-gradient(135deg, #b8183e 0%, #ff6b8a 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .filter-btn {
      padding: 0.6rem 1.2rem;
      font-size: 0.85rem;
    }
  }

  @media (max-width: 576px) {
    .gallery-card-wrapper {
      min-height: 250px;
    }

    .display-5 {
      font-size: 1.8rem !important;
    }
  }

  /* Animation for gallery items */
  .gallery-item {
    opacity: 0;
    animation: fadeInUp 0.6s ease forwards;
  }

  @keyframes slideInUp {
    from {
      opacity: 0;
      transform: translateY(20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
</style>

<!-- Gallery Filtering & Navigation Script -->
<script>
  let currentGalleryIndex = 0;
  let filteredImages = [];
  let allImages = [];

  document.addEventListener('DOMContentLoaded', function() {
    // Initialize gallery
    initializeGallery();
    
    // Add animations
    document.querySelectorAll('.gallery-item').forEach((item, index) => {
      item.style.setProperty('--delay', (index * 50) + 'ms');
    });
  });

  function initializeGallery() {
    const galleryItems = document.querySelectorAll('.gallery-item');
    allImages = Array.from(galleryItems).map(item => ({
      url: item.querySelector('.gallery-img').src,
      title: item.querySelector('.gallery-img').alt || item.querySelector('h5').textContent || 'Event Photo',
      category: item.dataset.category
    }));
    filteredImages = allImages;
  }

  function filterGallery(category) {
    // Update active button
    document.querySelectorAll('.filter-btn').forEach(btn => {
      btn.classList.remove('active');
    });
    event.target.closest('.filter-btn').classList.add('active');

    // Filter items
    const items = document.querySelectorAll('.gallery-item');
    items.forEach(item => {
      if (category === 'all' || item.dataset.category === category) {
        item.style.display = 'block';
        setTimeout(() => {
          item.style.opacity = '1';
          item.style.animation = 'fadeInUp 0.5s ease forwards';
        }, 50);
      } else {
        item.style.opacity = '0';
        setTimeout(() => {
          item.style.display = 'none';
        }, 300);
      }
    });

    // Update filtered images
    filteredImages = category === 'all' ? allImages : allImages.filter(img => img.category === category);
  }

  function openGalleryModal(src, title) {
    document.getElementById('modalImage').src = src;
    document.getElementById('modalTitle').textContent = title;
    
    // Find current index
    currentGalleryIndex = filteredImages.findIndex(img => img.url === src);
    
    const modal = new bootstrap.Modal(document.getElementById('imageModal'));
    modal.show();
  }

  function previousImage() {
    if (filteredImages.length > 0) {
      currentGalleryIndex = (currentGalleryIndex - 1 + filteredImages.length) % filteredImages.length;
      const img = filteredImages[currentGalleryIndex];
      openGalleryModal(img.url, img.title);
    }
  }

  function nextImage() {
    if (filteredImages.length > 0) {
      currentGalleryIndex = (currentGalleryIndex + 1) % filteredImages.length;
      const img = filteredImages[currentGalleryIndex];
      openGalleryModal(img.url, img.title);
    }
  }
</script>