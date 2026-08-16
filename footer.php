<style>
    footer {
        position: relative;
        overflow: hidden;
    }

    footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #b8183e 0%, #fafad2 50%, #b8183e 100%);
        animation: shimmer 3s infinite;
    }

    @keyframes shimmer {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.5;
        }
    }

    .footer-section {
        position: relative;
        padding: 2.5rem 2rem;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .footer-section::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg, transparent, rgba(184, 24, 62, 0.5), transparent);
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .footer-section:hover::before {
        opacity: 1;
    }

    .footer-brand {
        animation: fadeInUp 0.8s ease;
    }

    .footer-brand img {
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        filter: drop-shadow(0 2px 12px rgba(184, 24, 62, 0.3));
    }

    .footer-brand img:hover {
        transform: scale(1.1) rotate(-3deg);
    }

    .footer-brand span {
        background: linear-gradient(135deg, #fafad2 0%, #ffe066 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        text-shadow: none;
    }

    .footer-social a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, rgba(250, 250, 210, 0.1) 0%, rgba(184, 24, 62, 0.1) 100%);
        border: 2px solid rgba(250, 250, 210, 0.2);
        border-radius: 50%;
        color: #fafad2;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        margin: 0 0.5rem;
    }

    .footer-social a:hover {
        background: linear-gradient(135deg, #fafad2 0%, #ffe066 100%);
        color: #181818;
        border-color: #fafad2;
        transform: translateY(-6px) scale(1.15) rotate(10deg);
        box-shadow: 0 12px 32px rgba(184, 24, 62, 0.4);
    }

    .footer-contact-item {
        animation: slideInRight 0.6s ease;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        padding: 0.8rem 0;
    }

    .footer-contact-item:hover {
        padding-left: 0.5rem;
    }

    .footer-contact-item i {
        font-size: 1.3rem;
        color: #fafad2;
        filter: drop-shadow(0 2px 8px rgba(184, 24, 62, 0.4));
        margin-right: 1rem;
    }

    .footer-contact-item a {
        transition: all 0.3s ease;
        color: #fff;
    }

    .footer-contact-item a:hover {
        color: #fafad2;
        text-shadow: 0 0 12px rgba(184, 24, 62, 0.5);
    }

    .footer-bottom {
        background: linear-gradient(90deg, rgba(184, 24, 62, 0.1) 0%, rgba(250, 250, 210, 0.05) 50%, rgba(184, 24, 62, 0.1) 100%);
        border-top: 3px solid;
        border-image: linear-gradient(90deg, #b8183e 0%, #fafad2 50%, #b8183e 100%) 1;
    }

    .footer-bottom span {
        animation: slideInUp 0.8s ease;
    }

    @media (max-width: 767px) {
        .footer-section {
            padding: 1.8rem 1rem;
            text-align: center;
        }

        .footer-contact {
            text-align: center !important;
            align-items: center !important;
        }
    }
</style>

<footer class="text-white pt-0 pb-0" style="background: linear-gradient(135deg, #181818 0%, #1a1a1a 100%); width: 100vw; margin-left: calc(50% - 50vw);">
    <div class="container-fluid px-0">
        <div class="row align-items-stretch g-0" style="overflow: hidden; margin-top: 40px;">
            <!-- Logo & About -->
            <div class="col-md-4 footer-section footer-brand" style="background: rgba(184, 24, 62, 0.08);">
                <div class="d-flex align-items-center mb-4">
                    <img src="assets/images/logo.png" alt="Logo" style="height:50px;margin-right:14px;">
                    <div>
                        <span style="font-weight:900;font-size:1.85rem;letter-spacing:2px;display:block;">BabuMosshaii</span>
                        <span style="font-size:0.75rem;letter-spacing:1px;color:#fafad2;">Event & Catering Co.</span>
                    </div>
                </div>
                <p class="mb-3" style="font-size:1.05rem;color:#e8e8e8;line-height:1.8;">
                    Crafting <span style="color:#fafad2;font-weight:700;">memorable celebrations</span> with authentic flavors and heartfelt service since day one.
                </p>
                <div class="d-flex align-items-center mt-3 p-2 rounded-3" style="background: rgba(250, 250, 210, 0.1); border-left: 3px solid #fafad2;">
                    <i class="bi bi-star-fill text-warning me-3" style="font-size:1.2rem;"></i>
                    <span style="font-size:0.98rem;color:#fafad2;font-weight:600;">Premium Catering | Kolkata's Favourite Choice</span>
                </div>
            </div>
            <!-- Social Links -->
            <div class="col-md-4 footer-section d-flex flex-column align-items-center justify-content-center" style="background: rgba(250, 250, 210, 0.03);">
                <div class="mb-4" style="font-weight:800;font-size:1.2rem;letter-spacing:0.8px;color:#fafad2;text-transform:uppercase;">
                    <i class="bi bi-share-fill me-2"></i>Follow Us
                </div>
                <div class="footer-social mb-4 d-flex justify-content-center">
                    <a href="https://facebook.com/" target="_blank" aria-label="Facebook" class="footer-social-link">
                        <i class="bi bi-facebook" style="font-size:1.3rem;"></i>
                    </a>
                    <a href="https://instagram.com/" target="_blank" aria-label="Instagram" class="footer-social-link">
                        <i class="bi bi-instagram" style="font-size:1.3rem;"></i>
                    </a>
                    <a href="https://youtube.com/" target="_blank" aria-label="YouTube" class="footer-social-link">
                        <i class="bi bi-youtube" style="font-size:1.3rem;"></i>
                    </a>
                    <a href="mailto:info@babumosshaii.in" aria-label="Email" class="footer-social-link">
                        <i class="bi bi-envelope-fill" style="font-size:1.3rem;"></i>
                    </a>
                </div>
                <div class="badge rounded-pill bg-danger px-4 py-2 fw-bold" style="font-size:1.05rem;box-shadow:0 4px 16px rgba(184,24,62,0.4);">
                    <i class="bi bi-megaphone-fill me-2"></i> Follow for Exclusive Offers!
                </div>
            </div>
            <!-- Contact Info -->
            <div class="col-md-4 footer-section d-flex flex-column justify-content-center footer-contact" style="background: rgba(184, 24, 62, 0.08);">
                <h6 class="mb-4 fw-bold" style="color:#fafad2;font-size:1.15rem;text-transform:uppercase;letter-spacing:1px;">
                    <i class="bi bi-telephone-inbound me-2"></i>Contact Us
                </h6>
                <div class="footer-contact-item">
                    <i class="bi bi-geo-alt-fill"></i>
                    <span style="color:#e8e8e8;font-size:1rem;">Wireless Para, Konnagar, Near Sukanta Sporting Club, Hooghly - 712246, West Bengal</span>
                </div>
                <div class="footer-contact-item">
                    <i class="bi bi-telephone-fill"></i>
                    <a href="tel:+916290184366" class="fw-bold">+91 62901 84366</a>
                </div>
                <div class="footer-contact-item">
                    <i class="bi bi-envelope-fill"></i>
                    <a href="mailto:info@babumosshaii.in" class="fw-bold">info@babumosshaii.in</a>
                </div>
                <div class="footer-contact-item">
                    <i class="bi bi-clock-fill"></i>
                    <span style="color:#e8e8e8;">Open Daily: 9:00 AM - 10:00 PM</span>
                </div>
            </div>
        </div>
        <div class="footer-bottom d-flex justify-content-center align-items-center mt-0 pt-4 pb-4" style="font-size:1.08rem;letter-spacing:0.8px;">
            <span class="d-inline-block text-center fw-bold" style="color:#fff;">
                <i class="bi bi-c-circle me-2"></i> <?= date('Y') ?> <span style="color:#fafad2;">BabuMosshaii</span> Event & Co.
                <span class="mx-3 text-white-50">•</span>
                <span style="color:#fafad2;">Crafted with <i class="bi bi-heart-fill text-danger"></i> for your celebrations</span>
            </span>
        </div>
    </div>
    <div style="background: linear-gradient(135deg, #B8183E, #82102B); color: #fff; text-align: center; padding: 2px;">
        Crafted with <span style="font-size:1.2em; color: red;">&#10084;</span> in Kolkata
    </div>
</footer>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    footer a:hover {
        color: #181818 !important;
        background: #fff;
        border-radius: 8px;
        transition: 0.2s;
        text-decoration: none;
    }

    footer .badge.bg-warning {
        background: #fff !important;
        color: #181818 !important;
        font-weight: 600;
    }

    footer .bi-facebook:hover {
        color: #4267B2 !important;
        background: #fff;
    }

    footer .bi-instagram:hover {
        color: #E1306C !important;
        background: #fff;
    }

    footer .bi-envelope-fill:hover {
        color: #181818 !important;
        background: #fff;
    }

    @media (max-width: 767px) {
        footer .row>div {
            border-right: none !important;
            border-bottom: none !important;
            border-radius: 0 !important;
        }

        footer .row>div:last-child {
            border-bottom: none !important;
        }

        footer .row {
            border-radius: 0 !important;
        }
    }
</style>