<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="<?= $routes['home'] ?>">
            <img src="assets/images/logo.png" alt="Logo" />
            <span>BabuMosshaii</span>
        </a>

        <button class="navbar-toggler text-white border" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav">
            <i class="bi bi-list fs-2"></i>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <ul class="navbar-nav mx-auto">

                <li class="nav-item">
                    <a class="nav-link <?= ($fileName == 'home') ? 'active' : '' ?>"
                        href="<?= $routes['home'] ?>">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= ($fileName == 'menu_list') ? 'active' : '' ?>"
                        href="<?= $routes['menu_list'] ?>">Catering Menu</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= ($fileName == 'mehendi_artists' || $fileName == 'mehendi_profile') ? 'active' : '' ?>"
                        href="<?= $routes['mehendi'] ?>">Mehendi Package</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= ($fileName == 'makeup_artists' || $fileName == 'makeup_profile') ? 'active' : '' ?>"
                        href="<?= $routes['makeup'] ?>">Makeup Package</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link <?= ($fileName == 'banquets_list' || $fileName == 'banquet_details') ? 'active' : '' ?>"
                        href="<?= $routes['banquet_list'] ?>">Banquet Halls</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= ($fileName == 'client_testimonials') ? 'active' : '' ?>"
                        href="<?= $routes['testimonials'] ?>">Client Testimonial's</a>
                </li>

            </ul>
            <?php if ($fileName !== 'home') { ?>
                <li class="nav-item">
                    <a class="btn btn-quote" href="<?= $routes['home'] ?>">
                        Get Quote
                    </a>
                </li>
            <?php } ?>

            <?php if ($fileName == 'home') { ?>
                <a href="#contact" class="btn btn-quote px-3">Get Quote</a>
            <?php } ?>

        </div>
    </div>
</nav>