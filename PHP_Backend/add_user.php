<?php
require_once 'db.php';
session_start();
include 'handler/alert-handler.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["save"])) {
    $username = $con->real_escape_string(trim($_POST["username"]));
    $fullname = $con->real_escape_string(trim($_POST["fullname"]));
    $email = $con->real_escape_string(trim($_POST["email"]));
    $password = $con->real_escape_string($_POST["password"]);
    $role = $con->real_escape_string(trim($_POST["role"]));

    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        setAlert('warning','Submission Failed', 'Invalid email address.', 3000, false);
        header("Location: users_home.php");
        exit;
    }

    // Password length validation
    if (strlen($password) < 6) {
        setAlert('warning', 'Password Error','Password must be at least 6 characters.',3000, false);
        header("Location: users_home.php");
        exit;
    }

    // Hash password
    $hashed_pass = password_hash($password, PASSWORD_BCRYPT);

    // If an image was uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image']['tmp_name'];
        $imageSize = $_FILES['image']['size'];
        $imageType = mime_content_type($image);
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/avif', 'image/webp'];
        $maxSize = 2 * 1024 * 1024; // 2MB

        // Validate image type and size
        if (!in_array($imageType, $allowedTypes)) {
            setAlert('warning', 'Image format error','Only JPG, PNG, WEBP, and GIF files are allowed.', 3000, false);
            header("Location: users_home.php");
            exit;
        }

        if ($imageSize > $maxSize) {
            setAlert('warning', 'Image size error','Image size must be less than 2MB.', 3000, false);
            header("Location: users_home.php");
            exit;
        }

        $imgContent = file_get_contents($image);
        $null = null;

        // Prepare insert with image
        $stmt = $con->prepare("INSERT INTO users (username, fullname, email, password, role, image_data, image_type) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssbs", $username, $fullname, $email, $hashed_pass, $role, $null, $imageType);
        $stmt->send_long_data(5, $imgContent);

        if ($stmt->execute()) {
            $stmt->close();
            setAlert('success', 'User', 'User added successfully with image.', 3000, false);
            header("Location: users_home.php");
            exit;
        } else {
            http_response_code(500);
            echo "Database Error: " . $stmt->error;
            $stmt->close();
            exit();
        }

    } else {
        // Prepare insert without image
        $stmt = $con->prepare("INSERT INTO users (username, fullname, email, password, role) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $fullname, $email, $hashed_pass, $role);

        if ($stmt->execute()) {
            $stmt->close();
            setAlert('success', 'User', 'User added successfully.', 3000, false);
            header("Location: users_home.php");
            exit;
        } else {
            http_response_code(500);
            echo "Database Error: " . $stmt->error;
            $stmt->close();
            exit();
        }
    }
} else {
    header("Location: users_home.php");
    exit();
}
?>
