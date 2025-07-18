
<?php 
require_once './PHP_Backend/db.php'; // Include your database connection file
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/PHPMailer/PHPMailer/src/Exception.php';
require_once __DIR__ . '/PHPMailer/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/PHPMailer/src/SMTP.php';

require_once __DIR__ . '/vendor/autoload.php'; 


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
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "devhub66@gmail.com";
$mail->Password = "rkxgvepehchfhfhy";
$mail->From ="devhub66@gmail.com";
$mail->FromName = "Nanamon Farms Ltd.";
$mail->Subject = "Reply from Nanamon Farms Ltd.";
$mail->Body = "
 <br/> <br/>
<div style='width:70%'>
<p>Hello <strong>$name</strong>,</p>
<p>$message</p>
</div>
<br/>
Best regards <br/>
<br/>
<br/>
<br/>
<br/>

<b>Nanamon Farms Limited © Tech. </b>
<footer>
<hr/>
For further enquiries, kindly contact Nanamon Farms Ltd via: <br/>
Telephone(MTN): +233 (0) 59 703 0141 <br/>
Email: info@centralmigrationgrace.com <br/>
Website: www.nanamonfarmsltd.com
<hr/>
<a><i class='fa fa-pen'></i></a>
</footer>
"

;

$mail->addAddress($email,$name);

if(!$mail->Send())
{
    echo "Mailer Error: " . $mail->ErrorInfo;
}
else
{
    echo "Message has been sent";
    header("Location: PHP_Backend/user_bookings.php" ); // Redirect to the bookings page
    exit();
}

