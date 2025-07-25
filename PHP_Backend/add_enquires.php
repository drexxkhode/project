
<?php
ob_start(); // Start output buffering
header('Content-Type: text/plain');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require_once 'db.php';
require_once __DIR__ . '/../PHPMailer/PHPMailer/src/Exception.php';
require_once __DIR__ . '/../PHPMailer/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../PHPMailer/PHPMailer/src/SMTP.php';
// Autoload dependencies
require_once __DIR__ . '/../vendor/autoload.php'; // Composer autoload
// Check if the request is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $con->real_escape_string($_POST['name']);
    $email = $con->real_escape_string($_POST['email']);
    $subject = $con->real_escape_string($_POST['subject']);
    $message = $con->real_escape_string($_POST['message']);

    $query = "INSERT INTO enquiries (name, email, subject, message) VALUES (?, ?, ?, ?)";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        // Prepare the reply
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
                <p>  Thank you so much for reaching out to us! 💬
We've received your request and want you to know it’s in caring and capable hands.
Your message means a lot to us, and we truly appreciate the opportunity to assist you.
One of our team members will review your request and get back to you as soon as possible — usually within a short period.
In the meantime, feel free to relax knowing we’re on it. 🙌
If you need anything urgent, don’t hesitate to reply to this message or call us directly.
           
                </p>
                </div>
                <br/><br/>
                Best Regards!<br/><br/>
                <b>Nanamon Farms Limited © Tech.</b>
                <footer>
                    <hr/>
                    For further enquiries, kindly contact Nanamon Farms Ltd:<br/>
                    TELECEL: +233 (0) 50 914 1585<br/>
                    Email: info@nanamonfarmsltd@gmail.com.com<br/>
                    Website: www.nanamonfarmsltd.com
                    <hr/>
                </footer>
            ";

            $mail->send();
            ob_end_clean(); // Clear any prior output
            echo "OK"; // Only this gets sent to JS
            exit();

        } catch (Exception $e) {
            ob_end_clean();
            http_response_code(500);
            echo "Mailer Error: " . $mail->ErrorInfo;
            exit();
        }

    } else {
        ob_end_clean();
        http_response_code(500);
        echo "Database Error: " . $stmt->error;
        exit();
    }

} else {
    ob_end_clean();
    http_response_code(405);
    echo "Invalid request.";
    exit();
}
?>
