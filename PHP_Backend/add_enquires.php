
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
            $mail->Username = "devhub66@gmail.com";
            $mail->Password = "rkxgvepehchfhfhy";
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom("devhub66@gmail.com", "Nanamon Farms Ltd.");
            $mail->addAddress($email, $name);
            $mail->isHTML(true);
            $mail->Subject = "Reply from Nanamon Farms Ltd.";
            $mail->Body = "
                <div style='width:70%'>
                <p>Dear <strong>$name</strong>,</p>
                <p>Thank you for contacting Nanamon Farms Ltd. This is an automated confirmation that we received your message and will reply soon.</p>
                </div>
                <br/><br/>
                Best Regards!<br/><br/>
                <b>Nanamon Farms Limited © Tech.</b>
                <footer>
                    <hr/>
                    For further enquiries, kindly contact Nanamon Farms Ltd:<br/>
                    MTN: +233 (0) 59 703 0141<br/>
                    Email: info@centralmigrationgrace.com<br/>
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
