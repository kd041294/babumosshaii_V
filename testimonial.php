<section id="review" class="py-5 bg-light m-4 rounded">
  <div class="container">
    <h2 class="section-title text-center mb-4" style="color:#B8183E;">
        <i class="bi bi-chat-quote-fill text-warning me-2"></i> What Our Clients Say
    </h2>
    <div class="scroll-wrapper position-relative overflow-hidden">
      <div class="scroll-content d-flex align-items-stretch">
        <!-- Repeat as many reviews as needed -->
        <div class="testimonial card mx-3 shadow-sm border-0 text-center flex-shrink-0">
          <div class="card-body">
            <img src="assets/images/blank_user_review.jpg" alt="Riya Sen" class="rounded-circle mb-3 border border-3" style="border-color: #0AA865;" width="70" height="70" loading="lazy" />
            <p>"Absolutely delicious food and very professional service. Everyone loved it!"</p>
            <small class="text-muted d-block mt-2">Riya Sen, Kolkata</small>
          </div>
        </div>

        <div class="testimonial card mx-3 shadow-sm border-0 text-center flex-shrink-0">
          <div class="card-body">
            <img src="assets/images/blank_user_review.jpg" alt="Arjun Das" class="rounded-circle mb-3 border border-3" style="border-color: #0AA865;" width="70" height="70" loading="lazy" />
            <p>"The best catering experience we've had! The team was punctual and the food was authentic."</p>
            <small class="text-muted d-block mt-2">Arjun Das, Howrah</small>
          </div>
        </div>

        <div class="testimonial card mx-3 shadow-sm border-0 text-center flex-shrink-0">
          <div class="card-body">
            <img src="assets/images/blank_user_review.jpg" alt="Priya Mukherjee" class="rounded-circle mb-3 border border-3" style="border-color: #0AA865;" width="70" height="70" loading="lazy" />
            <p>"Highly recommended for any event. The menu variety and taste were outstanding."</p>
            <small class="text-muted d-block mt-2">Priya Mukherjee, Salt Lake</small>
          </div>
        </div>

        <!-- Add more reviews -->
        <div class="testimonial card mx-3 shadow-sm border-0 text-center flex-shrink-0">
          <div class="card-body">
            <img src="assets/images/blank_user_review.jpg" alt="Rahul Bose" class="rounded-circle mb-3 border border-3" style="border-color: #0AA865;" width="70" height="70" loading="lazy" />
            <p>"Superb service and mouth-watering food. Thank you for making our event special."</p>
            <small class="text-muted d-block mt-2">Rahul Bose, Ballygunge</small>
          </div>
        </div>

        <!-- Duplicate few reviews at the end to simulate seamless loop -->
        <div class="testimonial card mx-3 shadow-sm border-0 text-center flex-shrink-0">
          <div class="card-body">
            <img src="assets/images/blank_user_review.jpg" alt="Riya Sen" class="rounded-circle mb-3 border border-3" style="border-color: #0AA865;" width="70" height="70" loading="lazy" />
            <p>"Absolutely delicious food and very professional service. Everyone loved it!"</p>
            <small class="text-muted d-block mt-2">Riya Sen, Kolkata</small>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<style>
.scroll-wrapper {
  height: 100%;
  overflow: hidden;
  position: relative;
}

.scroll-content {
  display: flex;
  gap: 1rem;
  animation: scrollLeft 40s linear infinite;
}

.testimonial {
  width: 300px;
  min-width: 250px;
  max-width: 300px;
}

@keyframes scrollLeft {
  0% {
    transform: translateX(0%);
  }
  100% {
    transform: translateX(-50%);
  }
}

/* Mobile Adjustments */
@media (max-width: 576px) {
  .testimonial {
    width: 260px;
  }
}
</style>
