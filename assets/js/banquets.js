$(document).ready(function () {
    $("#banquetSearch").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        var visibleCount = 0;

        $(".banquet-item").each(function () {
            var match = $(this).data("name").indexOf(value) > -1;
            $(this).toggle(match);
            if (match) visibleCount++;
        });

        if (visibleCount === 0) {
            $("#noBanquetCard").removeClass("d-none");
        } else {
            $("#noBanquetCard").addClass("d-none");
        }
    });
});
$(document).ready(function () {
    // When modal is about to show
    $('#scheduleVisitModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var hallId = button.data('hall-id'); // Get hall ID
        var vendorId = button.data('vendor-id'); // Get vendor ID
        // Set values into hidden fields inside the modal
        $(this).find('input[name="hall_id"]').val(hallId);
        $(this).find('input[name="user_id"]').val(vendorId);
    });
});
$(document).ready(function () {
    // Inline Validation
    hideEventLoader();
    $('#scheduleVisitForm input').on('input change', function () {
        let input = $(this);
        if (input.val().trim() === '') {
            input.addClass('is-invalid').removeClass('is-valid');
        } else {
            input.addClass('is-valid').removeClass('is-invalid');
        }

        // Specific Validation for Contact Number
        if (input.attr('id') === 'contactNumber') {
            let phonePattern = /^[0-9]{10}$/;
            if (!phonePattern.test(input.val())) {
                input.addClass('is-invalid').removeClass('is-valid');
            } else {
                input.addClass('is-valid').removeClass('is-invalid');
            }
        }

        // Specific Validation for Email
        if (input.attr('id') === 'email') {
            let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(input.val())) {
                input.addClass('is-invalid').removeClass('is-valid');
            } else {
                input.addClass('is-valid').removeClass('is-invalid');
            }
        }
    });

    // Handle Form Submission
    $('#scheduleVisitForm').on('submit', function (e) {
        e.preventDefault();

        let form = $(this);
        let allValid = true;

        // Validate all inputs before sending
        form.find('input').each(function () {
            if ($(this).val().trim() === '') {
                $(this).addClass('is-invalid').removeClass('is-valid');
                allValid = false;
            }
        });

        if (!allValid) {
            alert('Please fill all fields correctly before submitting.');
            return;
        }

        let formData = form.serialize();
        console.log("form data : ", formData);
        $.ajax({
            url: BASE_URL + '/api/api_schedule_visit.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            beforeSend: function () {
                showEventLoader();
                $('.loader-text').text('Creating your visit...');
                $('.btn-success')
                    .prop('disabled', true)
                    .html('<i class="bi bi-hourglass-split me-1"></i> Submitting...');
            },
            success: function (response) {
                hideEventLoader();

                if (response.status === 'success') {
                    $('#scheduleVisitModal').modal('hide');
                    showResponseModal('success', response.message || 'Your visit has been successfully scheduled!');
                    form[0].reset();
                } else {
                    showResponseModal('error', response.message || 'Failed to schedule the visit. Please try again.');
                }
            },
            error: function () {
                hideEventLoader();
                showResponseModal('error', 'An unexpected error occurred. Please try again later.');
            },
            complete: function () {
                $('.btn-success')
                    .prop('disabled', false)
                    .html('<i class="bi bi-check-circle me-1"></i> Confirm Schedule');
            }
        });
    });
});