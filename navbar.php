<?php
if ($fileName === 'banquets_list' || $fileName === 'banquet_details') {
?>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?= $routes['home'] ?>">
                <img src="assets/images/logo.png" alt="Logo" />
                <span>BabuMosshaii</span>
            </a>
            <button class="navbar-toggler text-white border" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <i class="bi bi-list fs-2 "></i>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $routes['home'] ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-decoration-none <?= $fileName === 'menu_list' ? 'active' : '' ?>" href="<?= $routes['menu_list'] ?>">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-decoration-none <?= $fileName === 'client_testimonials' ? 'active' : '' ?>" href="<?= $routes['testimonials'] ?>">Testimonial's</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-decoration-none <?= $fileName === 'banquets_list' ? 'active' : '' ?>" href="<?= $routes['banquet_list'] ?>">Banquet Halls</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-quote" href="<?= $routes['home'] ?>">Get Catering Quotation</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<?php
} else if ($fileName === 'client_testimonials') {
?>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?= $routes['home'] ?>">
                <img src="assets/images/logo.png" alt="Logo" />
                <span>BabuMosshaii</span>
            </a>
            <button class="navbar-toggler text-white border" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <i class="bi bi-list fs-2 "></i>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $routes['home'] ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-decoration-none <?= $fileName === 'menu_list' ? 'active' : '' ?>" href="<?= $routes['menu_list'] ?>">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-decoration-none <?= $fileName === 'client_testimonials' ? 'active' : '' ?>" href="<?= $routes['testimonials'] ?>">Testimonial's</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-decoration-none" href="<?= $routes['banquet_list'] ?>">Banquet Halls</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-quote" href="<?= $routes['home'] ?>">Get Catering Quotation</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<?php
} else if ($fileName === 'menu_list') {
?>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?= $routes['home'] ?>">
                <img src="assets/images/logo.png" alt="Logo" />
                <span>BabuMosshaii</span>
            </a>
            <button class="navbar-toggler text-white border" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <i class="bi bi-list fs-2 "></i>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $routes['home'] ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-decoration-none <?= $fileName === 'menu_list' ? 'active' : '' ?>" href="<?= $routes['menu_list'] ?>">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-decoration-none <?= $fileName === 'client_testimonials' ? 'active' : '' ?>" href="<?= $routes['testimonials'] ?>">Testimonial's</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-decoration-none" href="<?= $routes['banquet_list'] ?>">Banquet Halls</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-quote" href="<?= $routes['home'] ?>">Get Catering Quotation</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<?php
} else {
?>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?= $routes['home'] ?>">
                <img src="assets/images/logo.png" alt="Logo" />
                <span>BabuMosshaii</span>
            </a>
            <button class="navbar-toggler text-white border" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <i class="bi bi-list fs-2 "></i>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link active" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-decoration-none <?= $fileName === 'menu_list' ? 'active' : '' ?>" href="<?= $routes['menu_list'] ?>">Menu</a></li>
                    <li class="nav-item"><a class="nav-link text-decoration-none" href="#about">About Us</a></li>
                    <li class="nav-item"><a class="nav-link text-decoration-none <?= $fileName === 'client_testimonials' ? 'active' : '' ?>" href="<?= $routes['testimonials'] ?>">Testimonial's</a></li>
                    <li class="nav-item"><a class="nav-link text-decoration-none" href="<?= REVIEW_LINK ?>">Write a review</a></li>
                    <li class="nav-item"><a class="nav-link text-decoration-none" href="<?= $routes['banquet_list'] ?>">Banquet Halls</a></li>
                </ul>
                <a href="#contact" class="btn btn-quote px-3">Get Quote</a>
            </div>
        </div>
    </nav>
<?php
}
?>