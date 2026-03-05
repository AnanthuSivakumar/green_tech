<?php

include __DIR__ . '/../includes/db.php';
include __DIR__ . '/../includes/config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../src/Exception.php';
require __DIR__ . '/../src/PHPMailer.php';
require __DIR__ . '/../src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name    = trim($_POST['name'] ?? '');
    $phone   = trim($_POST['phone'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');
    $urgent  = isset($_POST['urgent']) ? 1 : 0;
    $preferred_date = !empty($_POST['preferred_date']) ? $_POST['preferred_date'] : null;

    // Validation
    if(empty($name) || empty($phone) || empty($email) || empty($message)){
        header("Location: contact.php?error=1");
        exit();
    }

    if($urgent && empty($preferred_date)){
        header("Location: contact.php?error=2");
        exit();
    }

    // Insert into DB
    $stmt = $conn->prepare("INSERT INTO contact_messages
        (name, phone, email, message, urgent, preferred_date)
        VALUES (?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssis",
        $name,
        $phone,
        $email,
        $message,
        $urgent,
        $preferred_date
    );

    if($stmt->execute()){

        $mail = new PHPMailer(true);

        try{

            $mail->isSMTP();
            $mail->Host = MAIL_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = MAIL_USER;
            $mail->Password = MAIL_PASS;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = MAIL_PORT;

            $mail->setFrom(MAIL_USER,'Green Tech');
            $mail->addAddress(MAIL_USER);
            $mail->addReplyTo($email,$name);

            $mail->isHTML(false);

            $mail->Subject = "New Contact Message";

            $mail->Body =
            "New Contact Message\n\n".
            "Name: $name\n".
            "Phone: $phone\n".
            "Email: $email\n".
            "Urgent: ".($urgent ? 'Yes' : 'No')."\n".
            ($urgent ? "Preferred Date: $preferred_date\n" : "").
            "Message:\n$message";

            $mail->send();

            // Auto reply
            $mail->clearAddresses();
            $mail->clearReplyTos();

            $mail->addAddress($email);
            $mail->Subject="Thank You for Contacting Green Tech";

            $mail->Body =
            "Dear $name,\n\n".
            "Thank you for contacting Green Tech Water Solutions.\n".
            "We received your message.\n".
            ($urgent ? "Urgent request date: $preferred_date\n" : "").
            "Our team will contact you soon.\n\n".
            "Regards\nGreen Tech Team";

            $mail->send();

            header("Location: thank_you.php");
            exit();

        }
        catch(Exception $e){

            header("Location: contact.php?error=3");
            exit();

        }

    }

}