<?php
// ================== PROCESS FORM FIRST (NO HTML ABOVE THIS) ==================

include __DIR__ . '/../db.php';
include __DIR__ . '/../config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../src/Exception.php';
require __DIR__ . '/../src/PHPMailer.php';
require __DIR__ . '/../src/SMTP.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST['submit'])){

    $name    = trim($_POST['name']);
    $phone   = trim($_POST['phone']);
    $email   = trim($_POST['email']);
    $message = trim($_POST['message']);
    $urgent  = isset($_POST['urgent']) ? 1 : 0;
    $preferred_date = !empty($_POST['preferred_date']) ? $_POST['preferred_date'] : null;

    // ===== VALIDATION =====
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid Email Address!";
    } elseif($urgent && empty($preferred_date)){
        $error = "Please select preferred date & time!";
    } else {

        // ===== SAVE TO DATABASE =====
        $stmt = $conn->prepare("INSERT INTO contact_messages 
            (name, phone, email, message, urgent, preferred_date) 
            VALUES (?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("ssssss", 
            $name, $phone, $email, $message, $urgent, $preferred_date
        );

        if($stmt->execute()){

            $mail = new PHPMailer(true);

            try {
                // ===== SMTP SETTINGS =====
                $mail->isSMTP();
                $mail->Host       = MAIL_HOST;
                $mail->SMTPAuth   = true;
                $mail->Username   = MAIL_USER;
                $mail->Password   = MAIL_PASS;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = MAIL_PORT;

                // ===== ADMIN EMAIL =====
                $mail->setFrom(MAIL_USER, 'Green Tech');
                $mail->addAddress(MAIL_USER);
                $mail->addReplyTo($email, $name);

                $mail->isHTML(false);
                $mail->Subject = "New Contact Message";
                $mail->Body =
                    "New Message Received:\n\n".
                    "Name: $name\n".
                    "Phone: $phone\n".
                    "Email: $email\n".
                    "Urgent: ".($urgent ? 'Yes' : 'No')."\n".
                    ($urgent ? "Preferred Date: $preferred_date\n" : "").
                    "Message:\n$message";

                $mail->send();

                // ===== AUTO REPLY =====
                $mail->clearAddresses();
                $mail->clearReplyTos();

                $mail->addAddress($email);
                $mail->Subject = "Thank You for Contacting Green Tech";
                $mail->Body =
                    "Dear $name,\n\n".
                    "Thank you for contacting Green Tech Water Solutions.\n".
                    "We have received your message.\n".
                    ($urgent ? "Your urgent request for $preferred_date has been noted.\n" : "").
                    "Our team will contact you shortly.\n\n".
                    "Regards,\nGreen Tech Team\n".
                    "Phone: +91 7025262747";

                $mail->send();

                // ===== REDIRECT TO HOME =====
                header("Location: ../index.php?success=1");
                exit();

            } catch (Exception $e) {
                $error = "Mailer Error: " . $mail->ErrorInfo;
            }

        } else {
            $error = "Database Error: " . $conn->error;
        }

        $stmt->close();
    }
}

// ================== LOAD HEADER AFTER PROCESSING ==================
include __DIR__ . '/../includes/header.php';
?>

<section class="section-padding">
  <div class="container mt-5" >
    <div class="row">

      <div class="col-md-6">
        <h2>Contact Us</h2>
        <p><strong>Address:</strong> Kochullur Medical College PO, Thiruvananthapuram, Kerala</p>
        <p><strong>Phone:</strong> +91 7025262747</p>
        <p><strong>Email:</strong> greeninfo2026@gmail.com</p>
      </div>

      <div class="col-md-6">

        <?php if(isset($error)){ ?>
          <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>

        <form method="post">

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
             class="form-check-input p-0" id="urgentCheck">
            <label class="form-check-label" for="urgentCheck">
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
        dateInput.setAttribute("required", "required");
    } else {
        dateField.style.display = "none";
        dateInput.removeAttribute("required");
        dateInput.value = "";
    }
});
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>