<?php
require_once '../db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["loginBTN"])) {
    $name = trim($_POST["username"]);
    $password = $_POST["password"];

    // Prepare and execute query
    $stmt = $con->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Verify user and password
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION["username"] = $user["username"];
        $_SESSION["role"] = $user["role"];
        header("Location: ../index.php");
        exit();
    } else {
        $_SESSION["error"] = "Invalid username or password.";
        header("Location: ../login.php");
        exit();
    }
} else {
    // If already logged in, redirect to index
    if (isset($_SESSION['username'])) {
        header("Location: ../index.php");
        exit();
    }
    // If accessed without POST or login button
    header("Location: ../login.php");
    exit();
}
