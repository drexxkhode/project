<?php
header('Content-Type: application/json');
ob_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once 'db.php';
require_once __DIR__ . '/../PHPMailer/PHPMailer/src/Exception.php';
require_once __DIR__ . '/../PHPMailer/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../PHPMailer/PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  $name = $con->real_escape_string($_POST['name']);
  $phone = $con->real_escape_string($_POST['tel']);
  $email = $con->real_escape_string($_POST['email']);
  $service = $con->real_escape_string($_POST['service_type']);
  $message = $con->real_escape_string($_POST['message']);
  $date = $con->real_escape_string($_POST['date']);
  $time = $con->real_escape_string($_POST['time']);

   
    // Basic validation
    if (empty($name) || empty($email) || empty($phone) || empty($time)|| empty($date) || empty($service) ) {
        echo json_encode([
            "status" => "error",
            "message" => "Please fill out all required fields."
        ]);
        exit();
    }

    $query = "INSERT INTO bookings (name,phone, email,service_type, message,booking_date, booking_time) 
            VALUES (?,?,?,?, ?, ?, ?)";
  $stmt = $con->prepare($query);
  $stmt->bind_param("sssssss", $name,$phone, $email, $service, $message, $date, $time);

    if ($stmt->execute()) {
        // Attempt to send email but don't break submission if it fails
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "nanamonfarmsltd@gmail.com";
            $mail->Password = "nqwqwtnoasfqtxpc";
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom("nanamonfarmsltd@gmail.com", "Nanamon Farms Ltd.");
            $mail->addAddress($email, $name);
            $mail->isHTML(true);
            $mail->Subject = "Reply from Nanamon Farms Ltd.";
            $mail->Body = "
                <div style='width:90%'>
                <p>Dear <strong>$name</strong>,</p>
                <p> Thank you so much for reaching out to us! 💬
We've received your request and want you to know it’s in caring and capable hands.

Your message means a lot to us, and we truly appreciate the opportunity to assist you. One of our team members will review your request and get back to you as soon as possible — usually within a short period.
In the meantime, feel free to relax knowing we’re on it. 🙌
If you need anything urgent, don’t hesitate to reply to this message or call us directly.
           </p>
                </div>
                <br/><br/>
                Best Regards!<br/><br/>
                <b>Nanamon Farms Limited © Tech.</b>
                <footer>
                    <hr/>
                    Contact us:<br/>
                    TELECEL: +233 (0) 50 914 1585<br/>
                    Email: info@nanamonfarmsltd@gmail.com<br/>
                    Website: www.nanamonfarmsltd.com
                    <hr/>
                </footer>
            ";
            $mail->send();
        } catch (Exception $e) {
            // Email failed, but we still consider submission successful
            // Log error if needed
        }

        echo json_encode([
            "status" => "ok"
        ]);
        exit();
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Failed to save your enquiry. Please try again."
        ]);
        exit();
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid request method."
    ]);
    exit();
}
?>



