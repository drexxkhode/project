<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["save"])) {
    $username = $con->real_escape_string(trim($_POST["username"]));
    $fullname = $con->real_escape_string(trim($_POST["fullname"]));
    $email = $con->real_escape_string(trim($_POST["email"]));
    $password = $con->real_escape_string($_POST["password"]);
    $role = $con->real_escape_string(trim($_POST["role"]));

    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Invalid email address.";
        exit();
    }

    // Password length validation
    if (strlen($password) < 6) {
        http_response_code(400);
        echo "Password must be at least 6 characters.";
        exit();
    }

    // Hash password
    $hashed_pass = password_hash($password, PASSWORD_BCRYPT);

    // Check if an image was uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image']['tmp_name'];
        $imageSize = $_FILES['image']['size'];
        $imageType = mime_content_type($image);
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/avif', 'image/webp'];
        $maxSize = 2 * 1024 * 1024;

        // Validate image type and size
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
        $null = null;

        // Insert with image
        $stmt = $con->prepare("INSERT INTO users (username, fullname, email, password, role, image_data, image_type) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssbs", $username, $fullname, $email, $hashed_pass, $role, $null, $imageType);
        $stmt->send_long_data(5, $imgContent);
    } else {
        // Insert without image
        $stmt = $con->prepare("INSERT INTO users (username, fullname, email, password, role) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $fullname, $email, $hashed_pass, $role);
    }

    // Execute and check
    if ($stmt->execute()) {
        $stmt->close();
        header("Location: users_home.php?status=success");
        exit();
    } else {
        http_response_code(500);
        echo "Database Error: " . $stmt->error;
        $stmt->close();
        exit();
    }
} else {
    header("Location: users_home.php");
    exit();
}
?>
