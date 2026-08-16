<style>
  .navbar {
    box-shadow: 0 4px 24px rgba(184, 24, 62, 0.25) !important;
  }

  .navbar.scrolled {
    box-shadow: 0 8px 40px rgba(184, 24, 62, 0.4) !important;
  }

  .navbar-brand {
    animation: slideInLeft 0.6s ease;
  }

  .navbar-brand img {
    filter: drop-shadow(0 2px 12px rgba(184, 24, 62, 0.4));
  }

  .navbar-nav .nav-link {
    position: relative;
    overflow: hidden;
  }

  .nav-item:not(:last-child) .nav-link {
    margin-right: 0.5rem;
  }

  .navbar-toggler {
    border: 2px solid #fafad2 !important;
    transition: all 0.3s ease;
  }

  .navbar-toggler:focus {
    box-shadow: 0 0 0 0.25rem rgba(184, 24, 62, 0.25);
  }

  .navbar-toggler:hover {
    transform: scale(1.1);
    border-color: #ffe066 !important;
  }

  @media (max-width: 991px) {
    .navbar-collapse {
      animation: slideInDown 0.4s ease;
    }
  }
</style>

<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="<?= $routes['home'] ?>" title="BabuMosshaii - Premium Catering Services">
            <img src="assets/images/logo.png" alt="BabuMosshaii Logo" style="height:50px;margin-right:12px;" />
            <div style="line-height:1.1;">
                <span style="font-weight:900;font-size:1.65rem;display:block;letter-spacing:1px;">BabuMosshaii</span>
                <span style="font-size:0.7rem;color:#fafad2;letter-spacing:1px;font-weight:700;">Event & Co.</span>
            </div>
        </a>

        <button class="navbar-toggler text-white border-2" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list fs-1"></i>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <ul class="navbar-nav mx-auto">

                <li class="nav-item">
                    <a class="nav-link <?= ($fileName == 'menu_list') ? 'active' : '' ?>"
                        href="<?= $routes['menu_list'] ?>" title="Catering Menu - Explore our dishes">
                        <i class="bi bi-book-fill me-1"></i>Catering Menu
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= ($fileName == 'mehendi_artists' || $fileName == 'mehendi_profile') ? 'active' : '' ?>"
                        href="<?= $routes['mehendi'] ?>" title="Mehendi Artists & Packages">
                        <i class="bi bi-person-heart me-1"></i>Mehendi Package
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= ($fileName == 'makeup_artists' || $fileName == 'makeup_profile') ? 'active' : '' ?>"
                        href="<?= $routes['makeup'] ?>" title="Professional Makeup Artists">
                        <i class="bi bi-star-fill me-1"></i>Makeup Package
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link <?= ($fileName == 'banquets_list' || $fileName == 'banquet_details') ? 'active' : '' ?>"
                        href="<?= $routes['banquet_list'] ?>" title="Premium Banquet Halls">
                        <i class="bi bi-building me-1"></i>Banquet Halls
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= ($fileName == 'client_testimonials') ? 'active' : '' ?>"
                        href="<?= $routes['testimonials'] ?>" title="Happy Clients Reviews">
                        <i class="bi bi-chat-heart me-1"></i>Testimonials
                    </a>
                </li>

            </ul>
            <?php if ($fileName !== 'home') { ?>
                <div class="nav-item ms-auto">
                    <a class="btn btn-quote ms-2" href="<?= $routes['home'] ?>" title="Get a quote">
                        <i class="bi bi-gift-fill me-2"></i>Get Quote
                    </a>
                </div>
            <?php } ?>

            <?php if ($fileName == 'home') { ?>
                <a href="#contact" class="btn btn-quote ms-2" title="Book our catering services">
                    <i class="bi bi-telephone me-2"></i>Get Quote
                </a>
            <?php } ?>

        </div>
    </div>
</nav>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.querySelector('.navbar');
    window.addEventListener('scroll', function() {
      if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }
    });

    // Add smooth animation to nav links
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
      link.addEventListener('mouseenter', function() {
        this.style.animation = 'none';
        setTimeout(() => {
          this.style.animation = '';
        }, 10);
      });
    });
  });
</script>
</nav>