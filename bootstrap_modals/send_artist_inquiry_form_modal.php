<div class="modal fade" id="bookingModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content booking-modal">

            <!-- HEADER -->
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-calendar2-heart me-2"></i> Book Your Package
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body pt-0 mt-2">

                <!-- PACKAGE CARD -->
                <div class="package-card mb-4">
                    <div>
                        <h6 class="mb-1">
                            <i class="bi bi-gift-fill me-2"></i>
                            <?= htmlspecialchars($pkg['_package_title']) ?>
                        </h6>
                        <small class="text-muted">
                            <i class="bi bi-building me-1"></i>
                            <?= htmlspecialchars($pkg['_company_name']) ?>
                        </small>
                    </div>

                    <div class="price-tag">
                        ₹<?= $pkg['_final_price'] ?>
                    </div>
                </div>

                <input type="hidden" name="package_id" value="<?= $pkg['_id'] ?>">
                <input type="hidden" name="package_code" value="<?= $pkg['_package_code'] ?? '' ?>">
                <input type="hidden" name="artist_id" value="<?= $pkg['_user_id'] ?? '' ?>">
                <input type="hidden" name="artist_uniq_id" value="<?= $pkg['_user_uniq_id'] ?? '' ?>">
                <input type="hidden" name="service_type" value="<?= $service_type ?>" />

                <!-- USER INFO -->
                <div class="form-section">
                    <h6><i class="bi bi-person-circle me-2 text-danger"></i>Your Details</h6>

                    <div class="row">

                        <!-- NAME -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Full Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="bi bi-person"></i>
                                </span>
                                <input type="text" name="customer_name" class="form-control" placeholder="Enter your name" />
                            </div>
                        </div>

                        <!-- PHONE -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone Number</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="bi bi-telephone"></i>
                                </span>
                                <input type="text" name="customer_phone" class="form-control" placeholder="Enter phone number" />
                            </div>
                        </div>

                    </div>

                    <!-- EMAIL -->
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input type="email" name="customer_email" class="form-control" placeholder="Enter email (optional)">
                        </div>
                    </div>

                </div>

                <!-- SERVICE DETAILS -->
                <div class="form-section">
                    <h6><i class="bi bi-briefcase-fill me-2"></i>Service Details</h6>

                    <div class="mb-3">
                        <label class="form-label">No. Of People</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="bi bi-people-fill"></i>
                            </span> 
                            <input type="number" name="no_of_heads" class="form-control" placeholder="Enter expected heads" min="1" max="1000" />
                        </div>
                    </div>
                </div>
                <!-- EVENT INFO -->
                <div class="form-section">
                    <h6><i class="bi bi-calendar-event me-2"></i>Event Details</h6>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Event Date</label>

                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="bi bi-calendar-date"></i>
                                </span>
                                <input type="date" name="event_date" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="bi bi-clock-fill text-danger me-1"></i> Event Time
                            </label>

                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="bi bi-clock"></i>
                                </span>
                                <input type="time" name="event_time" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Event Location</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="bi bi-geo-alt"></i>
                            </span>
                            <input type="text" name="event_location" class="form-control" placeholder="Enter event location">
                        </div>
                    </div>
                </div>

                <!-- MESSAGE -->
                <div class="form-section">
                    <h6><i class="bi bi-chat-left-text me-2"></i>Additional Details</h6>

                    <textarea name="message" class="form-control" rows="3" placeholder="Any special requirements..."></textarea>
                </div>

                <!-- SUBMIT -->
                <button type="button" id="submitInquiry" class="btn btn-query w-100 mt-3">
                    <i class="bi bi-send-check-fill me-2"></i> Send Inquiry
                </button>

            </div>

        </div>
    </div>
</div>