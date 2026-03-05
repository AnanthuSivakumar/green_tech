<?php include __DIR__ . '/../includes/header.php'; ?>

<section class="section-padding">
  <div class="container mt-5">
    <div class="row">

      <div class="col-md-6">
        <h2>Contact Us</h2>
        <p><strong>Address:</strong> Kochullur Medical College PO, Thiruvananthapuram, Kerala</p>
        <p><strong>Phone:</strong> +91 7025262747</p>
        <p><strong>Email:</strong> greeninfo2026@gmail.com</p>
      </div>

      <div class="col-md-6">

        <form method="post" action="contact_message.php">

          <div class="mb-3">
            <input type="text" name="name" class="form-control"
              placeholder="Your Name" required>
          </div>

          <div class="mb-3">
            <input type="tel" name="phone" class="form-control"
              placeholder="Phone Number" required>
          </div>

          <div class="mb-3">
            <input type="email" name="email" class="form-control"
              placeholder="Email Address" required>
          </div>

          <div class="mb-3">
            <textarea name="message" class="form-control"
              rows="4" placeholder="Your Message" required></textarea>
          </div>

          <div class="form-check mb-3">
            <input type="checkbox" name="urgent"
             class="form-check-input" id="urgentCheck">
            <label class="form-check-label m-1" for="urgentCheck">
              Urgent Requirement
            </label>
          </div>

          <div class="mb-3" id="urgentDateField" style="display:none;">
            <label>Preferred Date & Time</label>
            <input type="datetime-local"
              name="preferred_date"
              id="preferredDate"
              class="form-control">
          </div>

          <button type="submit" name="submit"
            class="btn btn-primary w-100">
            Send Message
          </button>

        </form>

      </div>
    </div>
  </div>
</section>

<script>
document.getElementById("urgentCheck").addEventListener("change", function() {
    let dateField = document.getElementById("urgentDateField");
    let dateInput = document.getElementById("preferredDate");

    if (this.checked) {
        dateField.style.display = "block";
        dateInput.setAttribute("required","required");
    } else {
        dateField.style.display = "none";
        dateInput.removeAttribute("required");
        dateInput.value="";
    }
});
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>