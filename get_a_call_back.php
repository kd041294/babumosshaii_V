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
    /* ===========================
   Contact Section
=========================== */

#contact {
    background: linear-gradient(135deg, #fffdf2 0%, #fafad2 100%);
    border-radius: 25px;
    padding: 70px 0;
    position: relative;
    overflow: hidden;
}

#contact::before {
    content: "";
    position: absolute;
    width: 250px;
    height: 250px;
    background: rgba(184, 24, 62, 0.05);
    border-radius: 50%;
    top: -80px;
    left: -80px;
}

#contact::after {
    content: "";
    position: absolute;
    width: 220px;
    height: 220px;
    background: rgba(255, 193, 7, 0.08);
    border-radius: 50%;
    bottom: -90px;
    right: -90px;
}

/* ===========================
   Title
=========================== */

.section-title {
    font-size: 2.2rem;
    font-weight: 700;
    letter-spacing: 1px;
}

/* ===========================
   Form Card
=========================== */

#contactForm {
    background: #fff;
    border-radius: 20px;
    padding: 35px;
    box-shadow:
        0 10px 30px rgba(0,0,0,.08),
        0 2px 10px rgba(184,24,62,.08);
    transition: .35s ease;
}

#contactForm:hover {
    transform: translateY(-4px);
    box-shadow:
        0 18px 40px rgba(0,0,0,.12),
        0 8px 18px rgba(184,24,62,.12);
}

/* ===========================
   Labels
=========================== */

#contactForm label {
    color: #222;
    font-weight: 600;
    margin-bottom: 8px;
}

/* ===========================
   Inputs
=========================== */

#contactForm .form-control,
#contactForm .form-select {
    border-radius: 12px;
    border: 2px solid #ececec;
    padding: 12px 16px;
    font-size: 15px;
    transition: .3s ease;
    background: #fff;
}

#contactForm .form-control::placeholder {
    color: #999;
}

#contactForm textarea {
    min-height: 120px;
    resize: vertical;
}

/* Focus */

#contactForm .form-control:focus,
#contactForm .form-select:focus {
    border-color: #B8183E;
    box-shadow: 0 0 0 4px rgba(184,24,62,.12);
    transform: translateY(-2px);
}

/* ===========================
   Button
=========================== */

#contactForm .btn-primary {
    background: linear-gradient(135deg,#B8183E,#d62154);
    border: none;
    border-radius: 50px;
    padding: 14px 42px;
    font-size: 17px;
    font-weight: 600;
    transition: .35s ease;
}

#contactForm .btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 24px rgba(184,24,62,.35);
    background: linear-gradient(135deg,#181818,#444);
}

#contactForm .btn-primary:active {
    transform: scale(.98);
}

/* ===========================
   Icons
=========================== */

#contactForm label i {
    font-size: 1rem;
    vertical-align: middle;
}

/* ===========================
   Responsive
=========================== */

@media (max-width: 768px) {

    #contact {
        padding: 45px 15px;
    }

    #contactForm {
        padding: 25px;
    }

    .section-title {
        font-size: 1.8rem;
    }

    #contactForm .btn-primary {
        width: 100%;
    }
}
</style>
<!-- Enhanced Contact Section Replaced -->
<!-- See contact-section.css for enhanced styles -->