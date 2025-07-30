<?php
session_start();
require_once '../db.php'; // adjust if your DB connection file is elsewhere

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_SESSION['username'];
    $password = $_POST['password'];

    if(empty($password)){
         $_SESSION['error'] = "Password required ";
            header("Location: ../lockscreen.php");
            exit();
 }


    $stmt = $con->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hashedPassword);

    if ($stmt->fetch()) {
        if (password_verify($password, $hashedPassword)) {
            $_SESSION['is_authenticated'] = true;
            $_SESSION['last_activity'] = time();
            header("Location: ../index.php");
            exit();
        } else {
            $_SESSION['error'] = "Incorrect password";
            header("Location: ../lockscreen.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "User not found";
        header("Location: ../lockscreen.php");
        exit();
    }

    $stmt->close();
}
?>
