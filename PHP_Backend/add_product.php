<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["save"])) {
    $service_name = $con->real_escape_string(trim($_POST["service_name"]));
    $description = $con->real_escape_string(trim($_POST["description"]));
    $price = $con->real_escape_string(trim($_POST["price"]));
    
   

    // Image validation
    if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        http_response_code(400);
        echo "Error uploading image.";
        exit();
    }

    $image = $_FILES['image']['tmp_name'];
    $imageSize = $_FILES['image']['size'];
    $imageType = mime_content_type($image);

    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif','image/webp','image/avif'];
    $maxSize = 2 * 1024 * 1024; // 2MB


    if (!in_array($imageType, $allowedTypes)) {
        http_response_code(400);
        echo "Only JPG, PNG, WEBP,AVIF and GIF images are allowed.";
        exit();
    }

    if ($imageSize > $maxSize) {
        http_response_code(400);
        echo "Image size must be less than 2MB.";
        exit();
    }

    $imgContent = file_get_contents($image);
    $null=null;

    // Prepare and bind
    $stmt = $con->prepare("INSERT INTO products (service_name, description, price,  image, image_type) VALUES (?, ?, ?, ?,?)");
    $stmt->bind_param("ssdbs", $service_name, $description, $price,$null, $imageType);
    $stmt->send_long_data(3, $imgContent);

    if ($stmt->execute()) {
        header("Location: manage_products.php");
        exit();
    } else {
        http_response_code(500);
        echo "Database Error: " . $stmt->error;
        exit();
    }
} else {
    header("Location: manage_products.php");
    exit();
}
?>
