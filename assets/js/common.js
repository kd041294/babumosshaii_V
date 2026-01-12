function showEventLoader() {
  $("#eventLoader").removeClass("d-none");
}
function hideEventLoader() {
  $("#eventLoader").addClass("d-none");
}
function showResponseModal(type, message) {
    // type: 'success' or 'error'
    let modalTitle = (type === 'success') ? 'Success' : 'Error';
    let modalClass = (type === 'success') ? 'text-success' : 'text-danger';

    // Update modal content dynamically
    $('#responseModalLabel').text(modalTitle);
    $('#responseModalBody')
        .removeClass('text-success text-danger')
        .addClass(modalClass)
        .html(`<strong>${message}</strong>`);

    // Show the modal
    let responseModal = new bootstrap.Modal(document.getElementById('responseModal'));
    responseModal.show();
}
$(document).ready(function () {
  // Disable past dates for eventDate input
  var today = new Date().toISOString().split("T")[0];
  $("#eventDate").attr("min", today);

  // Form validation and AJAX submit
  $("#contactForm").on("submit", function (e) {
    e.preventDefault();
    let valid = true;

    // Name: only letters and spaces
    const name = $("#fullName").val().trim();
    if (!/^[A-Za-z\s]+$/.test(name)) {
      valid = false;
      $("#fullName").addClass("is-invalid");
    } else {
      $("#fullName").removeClass("is-invalid");
    }

    // Contact: exactly 10 digits
    const contact = $("#contactNumber").val().trim();
    if (!/^\d{10}$/.test(contact)) {
      valid = false;
      $("#contactNumber").addClass("is-invalid");
    } else {
      $("#contactNumber").removeClass("is-invalid");
    }

    // Heads: only numeric and > 0
    const heads = $("#expectedHeads").val().trim();
    if (!/^\d+$/.test(heads) || parseInt(heads) < 1) {
      valid = false;
      $("#expectedHeads").addClass("is-invalid");
    } else {
      $("#expectedHeads").removeClass("is-invalid");
    }

    // Event Location: required
    const location = $("#eventLocation").val().trim();
    if (location.length === 0) {
      valid = false;
      $("#eventLocation").addClass("is-invalid");
    } else {
      $("#eventLocation").removeClass("is-invalid");
    }

    // Event Date: required and not before today
    const eventDate = $("#eventDate").val();
    if (!eventDate || eventDate < today) {
      valid = false;
      $("#eventDate").addClass("is-invalid");
    } else {
      $("#eventDate").removeClass("is-invalid");
    }

    // Event Type: required
    const eventType = $("#eventType").val();
    if (!eventType) {
      valid = false;
      $("#eventType").addClass("is-invalid");
    } else {
      $("#eventType").removeClass("is-invalid");
    }

    //Email: required and valid format
    const email = $("#email").val().trim();
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
      valid = false;
      $("#email").addClass("is-invalid");
    } else {
      $("#email").removeClass("is-invalid");
    }

    if (!valid) {
      return;
    }

    // AJAX submit to API
    $.ajax({
      url: "api/api_save_call_back.php",
      type: "POST",
      data: {
        fullName: name,
        contactNumber: contact,
        email: email,
        expectedHeads: heads,
        eventType: eventType,
        eventLocation: location,
        eventDate: eventDate,
        additionalNotes: $("#additionalNotes").val() ? $("#additionalNotes").val().trim() : ""
      },
      dataType: "json",
      success: function (response) {
        if (response.success) {
          $("#contactForm")[0].reset();
          // Remove any existing modal
          if ($("#successModal").length) {
            $("#successModal").remove();
          }
          // Append modal with animation classes
          $("body").append(`
            <div class="modal fade animate__animated animate__fadeInDown" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border-radius:18px;">
                  <div class="modal-header" style="border-bottom:none;">
                    <h5 class="modal-title" id="successModalLabel" style="color:#B8183E;">
                      <i class="bi bi-check-circle-fill text-success me-2 animate__animated animate__bounceIn"></i>
                      Thank You for Selecting Us!
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body text-center animate__animated animate__fadeInUp" style="font-size:1.15rem;">
                    Our representative will connect you shortly.
                  </div>
                  <div class="modal-footer" style="border-top:none;">
                    <button type="button" class="btn btn-danger px-4 fw-bold shadow rounded" data-bs-dismiss="modal">
                      <i class="bi bi-x-circle-fill me-2"></i> Close
                    </button>
                  </div>
                </div>
              </div>
            </div>
          `);
          var modal = new bootstrap.Modal(document.getElementById('successModal'));
          modal.show();
        } else {
          alert("Error: " + response.message);
        }
      },
      error: function () {
        alert("Something went wrong. Please try again later.");
      },
    });
  });

  // Remove is-invalid on input
  $("#contactForm input, #contactForm select").on("input change", function () {
    $(this).removeClass("is-invalid");
  });

  // Quick Connect Floating Button
  $("#quickConnectBtn").on("click", function (e) {
    e.stopPropagation();
    $("#quickConnectPopup").fadeToggle(200);
  });

  $("#closeQuickConnect").on("click", function (e) {
    e.stopPropagation();
    $("#quickConnectPopup").fadeOut(150);
  });

  // Hide popup on outside click
  $(document).on("mousedown touchstart", function (e) {
    if (
      !$(e.target).closest("#quickConnectPopup").length &&
      !$(e.target).closest("#quickConnectBtn").length
    ) {
      $("#quickConnectPopup").fadeOut(150);
    }
  });

  // Prevent popup from closing when clicking inside
  $("#quickConnectPopup").on("mousedown touchstart", function (e) {
    e.stopPropagation();
  });

  // Menu rendering (if needed)
  const menu = [
    {
      name: "Chicken Biryani",
      price: "₹200",
      img: "https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=400&q=80",
      desc: "Aromatic basmati rice layered with succulent chicken and traditional spices.",
    },
    {
      name: "Mutton Kosha",
      price: "₹280",
      img: "https://images.unsplash.com/photo-1519864600265-abb23847ef2c?auto=format&fit=crop&w=400&q=80",
      desc: "Slow-cooked mutton in a rich, spicy Bengali gravy.",
    },
    {
      name: "Fish Fry",
      price: "₹180",
      img: "https://images.unsplash.com/photo-1464306076886-debca5e8a6b0?auto=format&fit=crop&w=400&q=80",
      desc: "Crispy golden fish fillets, a Kolkata street food classic.",
    },
    {
      name: "Paneer Tikka",
      price: "₹150",
      img: "https://images.unsplash.com/photo-1502741338009-cac2772e18bc?auto=format&fit=crop&w=400&q=80",
      desc: "Char-grilled cottage cheese cubes marinated in spices.",
    },
    {
      name: "Veg Pulao",
      price: "₹120",
      img: "https://images.unsplash.com/photo-1506089676908-3592f7389d4d?auto=format&fit=crop&w=400&q=80",
      desc: "Fragrant rice cooked with fresh vegetables and mild spices.",
    },
    {
      name: "Rosogolla",
      price: "₹60",
      img: "https://images.unsplash.com/photo-1603079841834-8b6b9b8d7c3a?auto=format&fit=crop&w=400&q=80",
      desc: "Soft, spongy Bengali sweets soaked in sugar syrup.",
    },
  ];
  if ($("#menuItems").length) {
    menu.forEach((item, i) => {
      $("#menuItems").append(`
        <div class="col-md-6 col-lg-4 animate__animated animate__fadeInUp" style="animation-delay:${i * 0.1}s;">
          <div class="menu-item h-100">
            <img src="${item.img}" alt="${item.name}" class="mb-3 rounded shadow-sm" style="width:100%;height:160px;object-fit:cover;">
            <h5>${item.name} <span class="badge">${item.price}</span></h5>
            <p class="mb-1">${item.desc}</p>
          </div>
        </div>
      `);
    });
  }

  // Smooth scroll animation
  $(".nav-link, .btn-quote, .hero .btn").on("click", function (e) {
    const target = $(this).attr("href");
    if (target && target.startsWith("#")) {
      e.preventDefault();
      $("html, body").animate(
        {
          scrollTop: $(target).offset().top - 60,
        },
        600
      );
      $(".nav-link").removeClass("active");
      $(`.nav-link[href='${target}']`).addClass("active");
    }
  });
});