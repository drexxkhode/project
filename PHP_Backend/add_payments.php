<?php
require_once 'db.php';
function isValidGhanaPhone($phone) {
  return preg_match('/^(02|03|05)[0-9]{8}$/', $phone);
}

function isValidNationalID($nid) {
  return preg_match('/^GHA\-\d{9}\-\d{1}$/', $nid);
}


if (isset($_POST['submit'])) {
  $name = trim($_POST['name']);
  $nid = trim($_POST['nid']);
  $number = trim($_POST['number']);
  $payment_type = trim($_POST['payment_type']);
  $bank_name = $_POST['bank_name'] ?? '';
  $mtn_number = $_POST['mtn_number'] ?? '';
  $amount = $_POST['amount'];
  $dop = $_POST['dop'];

  // Validate required
  if (empty($name) || empty($nid) || empty($number) || empty($payment_type) || empty($dop) || empty($amount)) {
    die("❌ All required fields must be filled.");
  }

  if (!isValidNationalID($nid)) {
    die("❌ Invalid National ID format.");
  }

  if (!isValidGhanaPhone($number)) {
    die("❌ Invalid Client Phone Number.");
  }

  $final_payment_type = $payment_type;

  // Initialize optional fields
  $save_bank = null;
  $save_momo = null;

  if ($payment_type === "MTN Mobile Money") {
    if (empty($mtn_number)) {
      die("❌ Please enter the MTN Mobile Money number.");
    }
    if (!isValidGhanaPhone($mtn_number)) {
      die("❌ Invalid MTN MoMo number.");
    }
    $save_momo = $mtn_number;
  }

  if ($payment_type === "Bank") {
    if (empty($bank_name)) {
      die("❌ Please select a bank.");
    }
    $save_bank = $bank_name;
  }

  // Insert with optional fields
  $stmt = $con->prepare("INSERT INTO payments (name, national_id, number, payment_type, bank_type, momo_num,amount, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssssds", $name, $nid, $number, $final_payment_type, $save_bank, $save_momo,$amount, $dop);

  if ($stmt->execute()) {
    echo "✅ Payment recorded successfully!";
    header("Location: index.php");
    exit();
  } else {
    echo "❌ Database error: " . $stmt->error;
  }

  $stmt->close();
}
$con->close();
?>
