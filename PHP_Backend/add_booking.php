<?php
require_once 'db.php'; // Ensure $con is your mysqli connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $con->real_escape_string($_POST['name']);
  $phone = $con->real_escape_string($_POST['tel']);
  $email = $con->real_escape_string($_POST['email']);
  $service = $con->real_escape_string($_POST['service_type']);
  $message = $con->real_escape_string($_POST['message']);
  $date = $con->real_escape_string($_POST['date']);
  $time = $con->real_escape_string($_POST['time']);

  $query = "INSERT INTO bookings (name,phone, email,service_type, message,booking_date, booking_time) 
            VALUES (?,?,?,?, ?, ?, ?)";
  $stmt = $con->prepare($query);
  $stmt->bind_param("sssssss", $name,$phone, $email, $service, $message, $date, $time);

  if ($stmt->execute()) {
    http_response_code(200);
    echo "OK";
    
    
  } else {
    http_response_code(500);
    echo "Error: " . $stmt->error;
  }

  $stmt->close();
  $con->close();
} else {
  http_response_code(405);
  echo "Invalid request.";
}
?>
