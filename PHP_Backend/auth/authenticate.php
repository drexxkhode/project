<?php
session_start();

// Inactivity threshold (e.g., 5 minutes)
define('INACTIVITY_TIMEOUT', 300);

// 🚫 If user never logged in at all (no session)
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// 🔒 If user is locked (inactive), redirect to lockscreen
if (!isset($_SESSION['is_authenticated']) || $_SESSION['is_authenticated'] === false) {
    header("Location: lockscreen.php?=logout due to inactive");
    exit();
}

// ⏱️ Check inactivity
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > INACTIVITY_TIMEOUT) {
    // Do NOT destroy the session — just lock it
    $_SESSION['is_authenticated'] = false;
    header("Location: lockscreen.php?=logout due to inactive");
    exit();
}

// ✅ Active session: update last activity time
$_SESSION['last_activity'] = time();
?>
