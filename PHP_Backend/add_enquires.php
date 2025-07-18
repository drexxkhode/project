<?php
require_once 'db.php'; // Ensure $con is your mysqli connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $con->real_escape_string($_POST['name']);
  $email = $con->real_escape_string($_POST['email']);
  $subject = $con->real_escape_string($_POST['subject']);
  $message = $con->real_escape_string($_POST['message']);

  $query = "INSERT INTO enquiries (name, email, subject, message) 
            VALUES (?, ?, ?, ?)";
  $stmt = $con->prepare($query);
  $stmt->bind_param("ssss", $name, $email, $subject, $message);

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
