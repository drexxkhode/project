<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["save"])) {
    $username = $con->real_escape_string(trim($_POST["username"]));
    $fullname = $con->real_escape_string(trim($_POST["fullname"]));
    $email = $con->real_escape_string(trim($_POST["email"]));
    $password = $con->real_escape_string($_POST["password"]);
    $role = $con->real_escape_string(trim($_POST["role"]));

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Invalid email address.";
        exit();
    }

    // Validate password
    if (strlen($password) < 6) {
        http_response_code(400);
        echo "Password must be at least 6 characters.";
        exit();
    }

    
    $image = $_FILES['image']['tmp_name'];
    $imageSize = $_FILES['image']['size'];
    $imageType = mime_content_type($image);

    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif','image/avif','image/webp'];
    $maxSize = 2 * 1024 * 1024; // 2MB


    if (!in_array($imageType, $allowedTypes)) {
        http_response_code(400);
        echo "Only JPG, PNG, AVIF, WEBP and GIF images are allowed.";
        exit();
    }

    if ($imageSize > $maxSize) {
        http_response_code(400);
        echo "Image size must be less than 2MB.";
        exit();
    }

    $imgContent = file_get_contents($image);
    $null=null;

    // Hash password
    $hashed_pass = password_hash($password, PASSWORD_BCRYPT);

    // Prepare and bind
    $stmt = $con->prepare("INSERT INTO users (username, fullname, email, password, role, image_data, image_type) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssbs", $username, $fullname, $email, $hashed_pass, $role, $null, $imageType);
    $stmt->send_long_data(5, $imgContent);

    if ($stmt->execute()) {
        header("Location: users_home.php");
        exit();
    } else {
        http_response_code(500);
        echo "Database Error: " . $stmt->error;
        exit();
    }
} else {
    header("Location: users_home.php");
    exit();
}
?>
