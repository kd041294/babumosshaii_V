<section id="about" class="m-4 py-5 rounded">
    <div class="container">
        <div class="row align-items-center">
            <!-- Left Image & Trust Badge -->
            <div class="col-lg-5 mb-4 mb-lg-0 position-relative">
                <div class="text-center mb-2">
                    <span class="badge bg-warning text-dark px-4 py-2 fs-6 shadow animate__animated animate__pulse animate__infinite"
                        style="font-weight:700; border-radius: 22px; font-size:1.08rem; box-shadow:0 4px 16px #b8183e33;">
                        <i class="bi bi-people-fill me-1"></i>
                        <span id="clientCount">Trusted By 50+ Satisfied Clients</span>
                    </span>
                </div>
                <div class="position-relative w-100 h-100 d-flex align-items-center justify-content-center"
                    style="min-height:320px;">
                    <img src="assets/images/event_images/about_us.jpeg"
                        alt="About BabuMosshaii"
                        class="about-img animate__animated animate__zoomIn rounded-4 shadow-lg w-100 h-100 about-img-hover"
                        style="object-fit: cover; min-height:320px; max-height:380px; border: 1px solid #FAFAD2; filter: brightness(0.93) saturate(1.1); transition: transform 0.4s cubic-bezier(.4,2,.6,1), box-shadow 0.4s;">
                    <span class="position-absolute bottom-0 start-50 translate-middle-x mb-3 px-3 py-2 rounded-pill shadow"
                        style="background:rgba(24,24,24,0.82); color:#fff; font-size:75%; font-weight:500; letter-spacing:0.5px;">
                        <i class="bi bi-award-fill text-warning me-1"></i> Kolkata's Favourite Caterer
                    </span>
                </div>
            </div>
            <!-- About Content -->
            <div class="col-lg-7">
                <h2 class="section-title mb-3" style="color:#B8183E;">
                    <i class="bi bi-info-circle-fill me-2 text-warning"></i>About Us
                </h2>
                <p class="mb-3 fs-5" style="color:#181818;">
                    Welcome to <span style="font-weight:600;color:#B8183E;">BabuMosshaii Catering Service</span> where culinary excellence meets exceptional service.<br>
                    <span class="text-secondary">Our mission is to turn every event into an unforgettable experience by offering delicious food, impeccable presentation, and personalized service.</span>
                </p>
                <div class="mb-3 d-flex align-items-start">
                    <span class="me-2"><i class="bi bi-heart-fill text-danger fs-4"></i></span>
                    <span style="color:#181818;">
                        At BabuMosshaii, we are passionate food enthusiasts committed to bringing joy to your plate. Our team of skilled chefs, event planners, and dedicated staff work tirelessly to ensure that each dish we serve is crafted with love and attention to detail.
                    </span>
                </div>
                <div class="mt-4 mb-2">
                    <h5 class="fw-bold mb-3" style="color:#B8183E;">
                        <i class="bi bi-stars text-warning me-2"></i>What We Offer
                    </h5>
                    <div class="row g-2">
                        <div class="col-12 col-md-6">
                            <div class="d-flex align-items-center bg-light rounded-3 px-3 py-2 mb-2 shadow-sm offer-hover"
                                style="min-height:48px; cursor:pointer;">
                                <i class="bi bi-briefcase-fill text-primary fs-4 me-3"></i>
                                <span class="fw-semibold">Corporate Events</span>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="d-flex align-items-center bg-light rounded-3 px-3 py-2 mb-2 shadow-sm offer-hover"
                                style="min-height:48px; cursor:pointer;">
                                <i class="bi bi-gem text-success fs-4 me-3"></i>
                                <span class="fw-semibold">Weddings / Reception</span>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="d-flex align-items-center bg-light rounded-3 px-3 py-2 mb-2 shadow-sm offer-hover"
                                style="min-height:48px; cursor:pointer;">
                                <i class="bi bi-people-fill text-info fs-4 me-3"></i>
                                <span class="fw-semibold">Private Parties</span>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="d-flex align-items-center bg-light rounded-3 px-3 py-2 mb-2 shadow-sm offer-hover"
                                style="min-height:48px; cursor:pointer;">
                                <i class="bi bi-list-check text-danger fs-4 me-3"></i>
                                <span class="fw-semibold">Custom Menus</span>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="mb-0 mt-3" style="color:#B8183E;font-weight:600;">
                    <i class="bi bi-emoji-smile-fill me-1 text-warning"></i>
                    Let us make your next event truly memorable with flavors that feel like home!
                </p>
            </div>
        </div>
    </div>
</section>
<style>
/* Attractive hover for image */
.about-img-hover:hover {
    transform: scale(1.04) rotate(-2deg);
    box-shadow: 0 8px 32px #b8183e44, 0 2px 16px #18181833;
    filter: brightness(1) saturate(1.2);
    z-index: 2;
}
/* Offer card hover effect */
.offer-hover:hover {
    background: #B8183E !important;
    color: #fff !important;
    box-shadow: 0 4px 24px #b8183e33, 0 2px 8px #18181822;
    transform: translateY(-4px) scale(1.03);
}
.offer-hover:hover i {
    color: #FAFAD2 !important;
    transition: color 0.2s;
}
.offer-hover span {
    transition: color 0.2s;
}
@media (max-width: 991px) {
    .about-img-hover { max-height: 260px !important; min-height: 180px !important; }
}
</style>
<script>
    // Dynamic client count animation
    document.addEventListener("DOMContentLoaded", function () {
        let count = 0;
        const target = 50;
        const el = document.getElementById('clientCount');
        if (el) {
            const interval = setInterval(() => {
                count++;
                el.innerHTML = `Trusted By ${count}+ Satisfied Clients`;
                if (count >= target) clearInterval(interval);
            }, 28);
        }
    });
</script>