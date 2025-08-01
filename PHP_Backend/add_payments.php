<?php
require_once 'db.php';
session_start();
include 'handler/alert-handler.php';
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
    setAlert('error','Format error', 'Invalid National ID format! ', 3000, false);
    header("Location: index.php");
    exit;
  }

  if (!isValidGhanaPhone($number)) {
    setAlert('error','Format error', 'Invalid client phone number!', 3000, false);
    header("Location: index.php");
    exit;
  }

  $final_payment_type = $payment_type;

  // Initialize optional fields
  $save_bank = null;
  $save_momo = null;

  if ($payment_type === "MTN Mobile Money") {
    if (empty($mtn_number)) {
    setAlert('error','Empty field', 'Please enter the MTN Mobile Money number', 3000, false);
    header("Location: index.php");
    exit;
    }
    if (!isValidGhanaPhone($mtn_number)) {
      setAlert('error','Input Error', 'Invalid MTN MoMo Number', 3000, false);
    header("Location: index.php");
    exit;
    }
    $save_momo = $mtn_number;
  }

  if ($payment_type === "Bank") {
    if (empty($bank_name)) {
      setAlert('error','Input Error', 'Please select a bank', 3000, false);
    header("Location: index.php");
    exit;
    }
    $save_bank = $bank_name;
  }

  // Insert with optional fields
  $stmt = $con->prepare("INSERT INTO payments (name, national_id, number, payment_type, bank_type, momo_num,amount, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssssds", $name, $nid, $number, $final_payment_type, $save_bank, $save_momo,$amount, $dop);

  if ($stmt->execute()) {
    setAlert('success','success!', 'Payment recorded successfully!', 3000, false);
    header("Location: index.php");
    exit;
  } else {
    echo "❌ Database error: " . $stmt->error;
  }

  $stmt->close();
}
$con->close();
?>
