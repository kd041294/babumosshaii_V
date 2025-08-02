<!-- Quick Connect Popup -->
<div class="quick-connect-popup shadow-lg" id="quickConnectPopup">
  <span class="close-btn" id="closeQuickConnect">&times;</span>
  <h5 class="mb-3"><i class="bi bi-lightning-charge-fill text-warning me-2"></i>Quick Connect</h5>
  <hr class="mt-0 mb-2">
  <a href="tel:+918910414656"><i class="bi bi-telephone-fill me-2 text-success"></i>+91 89104 14656</a>
  <a href="mailto:info@babumosshaii.in"><i class="bi bi-envelope-fill me-2 text-danger"></i>info@babumosshaii.in</a>
  <a href="https://wa.me/918910414656" target="_blank"><i class="bi bi-whatsapp me-2 text-success"></i>WhatsApp</a>
  <a href="https://www.facebook.com/BabuMosshaii.Official" target="_blank"><i class="bi bi-facebook me-2 text-primary"></i>Facebook</a>
  <a href="https://instagram.com/babumosshaii20.official" target="_blank"><i class="bi bi-instagram me-2 text-danger"></i>Instagram</a>
</div>

<!-- CSS Styling -->
<style>
  .quick-connect-popup {
    position: fixed;
    bottom: 80px;
    right: 25px;
    background-color: #ffffff;
    border: 2px solid #0AA865;
    border-radius: 1rem;
    padding: 1.5rem 1.3rem 1.2rem;
    width: 280px;
    z-index: 1060;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease-in-out;
    font-size: 0.95rem;
    font-family: 'Segoe UI', sans-serif;
  }

  .quick-connect-popup h5 {
    color: #0AA865;
    font-weight: 700;
    font-size: 1.2rem;
    display: flex;
    align-items: center;
  }

  .quick-connect-popup a {
    display: flex;
    align-items: center;
    margin: 0.6rem 0;
    color: #333;
    font-weight: 500;
    text-decoration: none;
    transition: 0.2s;
    font-size: 0.95rem;
  }

  .quick-connect-popup a i {
    font-size: 1.1rem;
    min-width: 20px;
  }

  .quick-connect-popup a:hover {
    color: #0AA865;
    transform: translateX(4px);
    text-decoration: none;
  }

  .quick-connect-popup .close-btn {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 1.3rem;
    cursor: pointer;
    color: #aaa;
    transition: color 0.2s;
  }

  .quick-connect-popup .close-btn:hover {
    color: #000;
  }

  @media (max-width: 576px) {
    .quick-connect-popup {
      right: 10px;
      width: 90%;
      font-size: 0.9rem;
      padding: 1rem;
    }
  }
</style>