$(document).on("click", "#submitInquiry", function() {
    let modal = $("#bookingModal");

    // Collect values ONLY from this modal (important)
    let data = {
        package_id: modal.find("input[name='package_id']").val(),
        package_code: modal.find("input[name='package_code']").val(),
        artist_id: modal.find("input[name='artist_id']").val(),
        artist_uniq_id: modal.find("input[name='artist_uniq_id']").val(),
        customer_name: $.trim(modal.find("input[name='customer_name']").val()),
        customer_phone: $.trim(modal.find("input[name='customer_phone']").val()),
        customer_email: $.trim(modal.find("input[name='customer_email']").val()),
        event_date: modal.find("input[name='event_date']").val(),
        event_time: modal.find("input[name='event_time']").val(),
        event_location: modal.find("input[name='event_location']").val(),
        service_type: modal.find("input[name='service_type']").val(),
        message: modal.find("textarea[name='message']").val(),
        no_of_heads: $.trim(modal.find("input[name='no_of_heads']").val()),
    };

    // ✅ Regex validation
    let nameRegex = /^[a-zA-Z\s]{3,50}$/;
    let phoneRegex = /^[6-9]\d{9}$/;
    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    let headsRegex = /^[1-9]\d*$/; // only positive integers (no 0, no letters)

    if (!headsRegex.test(data.no_of_heads)) {
        showToast("Enter valid number of people (only numbers)", "error");
        modal.find("input[name='no_of_heads']").focus();
        return;
    }

    // Optional: range validation (recommended for business logic)
    if (parseInt(data.no_of_heads) < 10) {
        showToast("Minimum 10 people required", "error");
        return;
    }

    if (!nameRegex.test(data.customer_name)) {
        showToast("Enter valid name (min 3 letters)", "error");
        modal.find("input[name='customer_name']").focus();
        return;
    }

    if (!phoneRegex.test(data.customer_phone)) {
        showToast("Enter valid 10-digit mobile number", "error");
        modal.find("input[name='customer_phone']").focus();
        return;
    }

    if (data.customer_email !== "" && !emailRegex.test(data.customer_email)) {
        showToast("Enter valid email address", "error");
        modal.find("input[name='customer_email']").focus();
        return;
    }

    // ✅ AJAX
    $.ajax({
        url: BASE_URL + "api/api_save_artist_inquiry.php",
        type: "POST",
        data: data,

        beforeSend: function() {
            showLoader();
        },

        success: function(response) {

            if (response.status) {
                showToast(response.message, "success");

                // Clear inputs inside modal only
                modal.find("input, textarea").val("");

                // Close modal
                let bsModal = bootstrap.Modal.getInstance(modal[0]);
                bsModal.hide();

            } else {
                showToast(response.message || "Something failed", "error");
            }
        },

        error: function() {
            showToast("Server error. Please try again.", "error");
        },

        complete: function() {
            hideLoader();
        }
    });

});

document.addEventListener("DOMContentLoaded", function() {

    const modal = document.getElementById('reviewModal');

    // 🎯 MODAL PREFILL
    modal.addEventListener('show.bs.modal', function(event) {

        const btn = event.relatedTarget;

        const packageId = btn.getAttribute('data-package-id');
        const artistId = btn.getAttribute('data-artist-id');
        const artistUniqId = btn.getAttribute('data-artist-uniq-id');

        const packageName = btn.getAttribute('data-package-name');
        const artistName = btn.getAttribute('data-artist-name');

        document.getElementById('modalPackage').textContent = packageName;
        document.getElementById('modalArtist').textContent = artistName;

        document.getElementById('packageId').value = packageId;
        document.getElementById('artistId').value = artistId;
        document.getElementById('artistUniqId').value = artistUniqId;
    });

    // ⭐ STAR RATING
    const stars = document.querySelectorAll('.star-rating i');
    const ratingInput = document.getElementById('ratingValue');

    stars.forEach((star, index) => {
        star.addEventListener('click', function() {

            let value = this.getAttribute('data-value');
            ratingInput.value = value;

            stars.forEach(s => s.classList.remove('active'));

            for (let i = 0; i < value; i++) {
                stars[i].classList.add('active');
            }
        });
    });

    // 🚀 SUBMIT (jQuery AJAX)
    $('.modal-footer .btn-danger').on('click', function() {

        const name = $('#userName').val().trim();
        const email = $('#userEmail').val().trim();
        const date = $('#eventDateRev').val();
        const rating = $('#ratingValue').val();
        const message = $('#reviewMessage').val().trim();

        const packageId = $('#packageId').val();
        const artistId = $('#artistId').val();
        const artistUniqId = $('#artistUniqId').val();
        const serviceType = $('#serviceType').val();

        // ✅ VALIDATION
        if (!name || !email || !date || rating == 0 || !message) {
            showToast("Please fill all fields and select rating ⭐", "error");
            return;
        }

        const data = {
            name,
            email,
            event_date: date,
            rating,
            message,
            package_id: packageId,
            artist_id: artistId,
            artist_uniq_id: artistUniqId,
            service_type: serviceType
        };

        $.ajax({
            url: BASE_URL + "api/api_save_artist_review.php",
            type: "POST",
            data: data,

            beforeSend: function() {
                showLoader();
            },

            success: function(response) {

                if (typeof response === "string") {
                    response = JSON.parse(response);
                }

                if (response.status) {
                    showToast(response.message || "Review submitted successfully!", "success");

                    // RESET
                    $('#reviewModal input, #reviewModal textarea').val('');
                    $('#ratingValue').val(0);
                    $('.star-rating i').removeClass('active');

                    // CLOSE MODAL
                    let bsModal = bootstrap.Modal.getInstance(modal);
                    bsModal.hide();

                } else {
                    showToast(response.message || "Something failed", "error");
                }
            },

            error: function() {
                showToast("Server error. Please try again.", "error");
            },

            complete: function() {
                hideLoader();
            }
        });

    });

});