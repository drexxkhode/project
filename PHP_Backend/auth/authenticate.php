<?php
session_start();
define('INACTIVITY_TIMEOUT', 300);

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Check for inactivity timeout
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > INACTIVITY_TIMEOUT) {
    session_unset();
    session_destroy();
    header("Location: login.php?=logged out for inactive");
    exit();
}

// Update last activity time
$_SESSION['last_activity'] = time();
?>