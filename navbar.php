<?php
if ($fileName === 'banquets_list' || $fileName === 'banquet_details') {
    ?>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <!-- Brand -->
            <a class="navbar-brand d-flex align-items-center" href="<?= $routes['home'] ?>">
                <img src="assets/images/logo.png" alt="Logo" style="height: 40px;" />
                <span class="ms-2">BabuMosshaii</span>
            </a>
            <!-- Toggle Button (for mobile) -->
            <button class="navbar-toggler text-white border" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <i class="bi bi-list fs-2 "></i> <!-- Hamburger menu icon -->
            </button>
            <!-- Navbar Content -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Address Input + Fetch Button -->
                <form class="d-flex align-items-center mx-auto flex-grow-1" style="max-width: 700px;">
                    <input class="form-control form-control-sm text-muted me-2 flex-grow-1" type="text"
                        placeholder="Enter your address" aria-label="Address" disabled />
                    <button class="btn btn-outline-success btn-sm d-flex align-items-center" type="button">
                        <i class="bi bi-geo-alt-fill me-1"></i>
                        <span>Fetch</span>
                    </button>
                </form>
                <!-- Get Catering Link -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= $routes['home'] ?>">Get Catering</a>
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
                <i class="bi bi-list fs-2 "></i> <!-- Hamburger menu icon -->
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link active" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-decoration-none" href="#menu">Menu</a></li>
                    <li class="nav-item"><a class="nav-link text-decoration-none" href="#about">About Us</a></li>
                    <li class="nav-item"><a class="nav-link text-decoration-none" href="#review">Testimonial's</a></li>
                    <li class="nav-item"><a class="nav-link text-decoration-none"
                            href="<?= $routes['banquet_list'] ?>">Banquet Halls</a></li>
                </ul>
                <a href="#contact" class="btn btn-quote px-3">Get Quote</a>
            </div>
        </div>
    </nav>
    <?php
}
?>