<?php
require_once '../db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["loginBTN"])) {
    $name = trim($_POST["username"]);
    $password = $_POST["password"];

    $stmt = $con->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION["username"] = $user["username"];
        $_SESSION["role"] = $user["role"];
        $_SESSION["image_data"] = $user["image_data"];
        $_SESSION["image_type"] = $user["image_type"];

    
        header("Location: ../index.php");
        exit();
    } else {
        $_SESSION["error"] = "Invalid username or password.";
        header("Location: ../login.php");
        exit();
    }
} else {
    header("Location: ../login.php");
    exit();
}
