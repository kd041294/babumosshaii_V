<div class="modal fade" id="reviewModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content review-modal">

            <!-- HEADER -->
            <!-- <div class="modal-header border-0 pb-2 bg-secondary text-white rounded ">
                <h5 class="modal-title fw-bold">Write Your Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div> -->

            <!-- BODY -->
            <div class="modal-body">
                <input type="hidden" id="packageId">
                <input type="hidden" id="artistId">
                <input type="hidden" id="artistUniqId">
                <input type="hidden" id="serviceType" value="<?php echo $service_type; ?>">
                <!-- PACKAGE + ARTIST -->
                <div class="mb-3 small bg-danger text-white p-2 rounded">
                    <div><strong>Package:</strong> <span id="modalPackage"></span></div>
                    <div><strong>Artist:</strong> <span id="modalArtist"></span></div>
                </div>

                <!-- NAME + EMAIL -->
                <div class="row g-2 mb-3">
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="Your Full Name" id="userName">
                    </div>
                    <div class="col-md-6">
                        <input type="email" class="form-control" placeholder="Your Email" id="userEmail">
                    </div>
                </div>

                <!-- EVENT TYPE (READONLY) -->
                <div class="mb-3">
                    <input style="background-color: #e2e0e0;" type="text" class="form-control" value="<?= $service_type = 'MAKEUP' ? 'Make Up' : 'Mehendi' ?>" readonly>
                </div>

                <!-- EVENT DATE -->
                <div class="mb-3">
                    <input type="date" class="form-control" id="eventDateRev" min="2000-01-01" />
                </div>

                <!-- STAR RATING -->
                <div class="mb-3 text-center">
                    <div class="star-rating">
                        <i class="bi bi-star" data-value="1"></i>
                        <i class="bi bi-star" data-value="2"></i>
                        <i class="bi bi-star" data-value="3"></i>
                        <i class="bi bi-star" data-value="4"></i>
                        <i class="bi bi-star" data-value="5"></i>
                    </div>
                    <input type="hidden" id="ratingValue" value="0">
                </div>

                <!-- MESSAGE -->
                <div class="mb-3">
                    <textarea class="form-control" rows="4" id="reviewMessage" placeholder="Share your experience..."></textarea>
                </div>

            </div>

            <!-- FOOTER -->
            <div class="modal-footer border-0">
                <button class="btn btn-light border border-dark" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Cancel
                </button>
                <button class="btn btn-danger"><i class="bi bi-check-circle"></i> Submit Review</button>
            </div>

        </div>
    </div>
</div>