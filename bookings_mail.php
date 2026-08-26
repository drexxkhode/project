
<?php 
session_start();
include './PHP_Backend/handler/alert-handler.php';

require_once './PHP_Backend/db.php'; // Include your database connection file
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/PHPMailer/PHPMailer/src/Exception.php';
require_once __DIR__ . '/PHPMailer/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/PHPMailer/src/SMTP.php';


$id = $_POST['id'];
$email = $_POST['email'];
$name = $_POST['name'];
$message = $_POST['message'];
// update status to 'replied' in the database
$stmt= $con->prepare("UPDATE bookings SET status='replied' WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();


// inserting the reply message into the replies table
$query=$con->prepare("INSERT INTO `replies` (clients_id, `email`, `name`, `replied_message`) VALUES (?,?,?,?)");
$query->bind_param("isss", $id, $email,$name, $message);
$query->execute();


// SMTP settings
$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

$mail->Host = $_ENV['MAIL_HOST'];
$mail->Port = $_ENV['MAIL_PORT'];

$mail->Username = $_ENV['MAIL_USERNAME'];
$mail->Password = $_ENV['MAIL_PASSWORD'];

$mail->setFrom(
    $_ENV['MAIL_FROM'],
    $_ENV['MAIL_FROM_NAME']
);

$mail->isHTML(true);
$mail->Subject = "Reply from Nananom Farms Ltd.";
$mail->Body = "
 <br/> <br/>
<div style='width:90%'>
<p>Hello <strong>$name</strong>,</p>
<p>$message</p>
</div>
<br/>
<br/>
<p><b>BEST REGARDS!</b></p> 
<br/>
<br/>

<b>Nananom Farms Limited © Tech. </b>
<footer>
<hr/>
For further enquiries, kindly contact Nananom Farms Ltd via: <br/>
Telephone(Telecel): +233 (0) 50 914 1585  <br/>
Email: nanamonfarmsltd@gmail.com <br/>
Website: www.nananomfarmsltd.com
<hr/>
<a>✍️</a>
</footer>
"

;

$mail->addAddress($email,$name);

if(!$mail->Send())
{
    setAlert('error','Error 404', 'Failed to reply! Check Internet Connection .', 3000, false);
    header("Location: PHP_Backend/user_bookings.php");
    exit;
  
}
else
{
    
    setAlert('success','Success', 'Email sent to client.', 3000, false);
    header("Location: PHP_Backend/user_bookings.php" ); // Redirect to the bookings page
    exit;
}

