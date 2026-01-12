<section id="contact" class="m-4 py-3 rounded shadow-lg">
    <div class="container">
        <h2 class="section-title text-center mb-2" style="color:#B8183E;">
            <i class="bi bi-telephone-inbound-fill me-2 text-warning"></i>Get a Quote
        </h2>
        <p class="text-center mb-4" style="color:#181818;">Tell us about your event and we’ll get back to you with a custom menu and quote!</p>
        <form id="contactForm" class="col-lg-8 mx-auto p-4 rounded-4 shadow-sm" style="background:#fafad2;" autocomplete="off">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold" for="fullName"><i class="bi bi-person-fill me-1 text-primary"></i>Full Name</label>
                    <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Enter Full Name" required />
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold" for="contactNumber"><i class="bi bi-telephone-fill me-1 text-success"></i>Contact Number</label>
                    <input type="tel" class="form-control" id="contactNumber" maxlength="10" name="contactNumber" placeholder="Enter Contact Number" required />
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold" for="expectedHeads"><i class="bi bi-people-fill me-1 text-info"></i>Expected Heads</label>
                    <input type="number" class="form-control" id="expectedHeads" name="expectedHeads" placeholder="Number of Guests" min="1" required />
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold" for="email"><i class="bi bi-envelope-fill me-1 text-info"></i>Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required />
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold" for="eventType"><i class="bi bi-calendar-event-fill me-1 text-danger"></i>Event Type</label>
                    <select class="form-select" id="eventType" name="eventType" required>
                        <option value="" disabled selected>Select Event Type</option>
                        <option value="Wedding Party (WP)">Wedding Party (WP)</option>
                        <option value="Reception Party (RP)">Reception Party (RP)</option>
                        <option value="Rice Ceremony (RC)">Rice Ceremony (RC)</option>
                        <option value="Birthday Party (BP)">Birthday Party (BP)</option>
                        <option value="Anniversary Party (AP)">Anniversary Party (AP)</option>
                        <option value="Cooperate Party (CP)">Cooperate Party (CP)</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold" for="eventLocation"><i class="bi bi-geo-alt-fill me-1 text-warning"></i>Event Location</label>
                    <input type="text" class="form-control" id="eventLocation" name="eventLocation" placeholder="Event Location" required />
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold" for="eventDate"><i class="bi bi-calendar-date-fill me-1 text-primary"></i>Event Date</label>
                    <input type="date" class="form-control" id="eventDate" name="eventDate" required />
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold" for="eventDate">
                        <i class="bi bi-journal-text me-1 text-primary"></i>Additional Notes
                    </label>
                    <textarea class="form-control" id="additionalNotes" name="additionalNotes" placeholder="Additional Notes"></textarea>
                </div>
            </div>
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary px-5 py-2 fw-bold shadow">
                    <i class="bi bi-send-fill me-1"></i>Submit
                </button>
            </div>
        </form>
    </div>
</section>
<style>
    #contactForm .form-control,
    #contactForm .form-select {
        border-radius: 10px;
        border: 2px solid #B8183E22;
        box-shadow: 0 2px 8px #18181811;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    #contactForm .form-control:focus,
    #contactForm .form-select:focus {
        border-color: #B8183E;
        box-shadow: 0 0 0 0.2rem #B8183E22;
    }

    #contactForm label {
        color: #181818;
        font-size: 1.05rem;
    }
    #contactForm .btn-primary {
        background: #B8183E;
        border: none;
        border-radius: 20px;
        font-size: 1.1rem;
        transition: background 0.2s, box-shadow 0.2s;
    }

    #contactForm .btn-primary:hover {
        background: #181818;
        color: #FAFAD2;
        box-shadow: 0 4px 16px #B8183E55;
    }
</style>