<?php
require_once 'db.php'; // DB connection

if (
    isset($_POST['id'], $_POST['service_name'], $_POST['description'], $_POST['price'])
) {
    $id = (int) $_POST['id'];
    $service_name = trim($_POST['service_name']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);
   

    // Check if a new image was uploaded
    $imageUpdated = isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK;

    if ($imageUpdated) {
        $imageTmp = $_FILES['image']['tmp_name'];
        $imageSize = $_FILES['image']['size'];
        $imageType = mime_content_type($imageTmp);
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif','image/webp','image/avif'];
        $maxSize = 2 * 1024 * 1024; // 2MB

        // Validate image
        if (!in_array($imageType, $allowedTypes)) {
            exit("Only JPG, PNG, WEBP, AVIF and GIF files are allowed.");
        }

        if ($imageSize > $maxSize) {
            exit("Image must be less than 2MB.");
        }

        $imgContent = file_get_contents($imageTmp);

        // Update including image
        $stmt = $con->prepare("UPDATE products SET service_name=?, description=?, price=?, image=?, image_type=? WHERE id=?");
        if ($stmt) {
            $null = null;
            $stmt->bind_param("ssdbsi", $service_name, $description, $price,  $null, $imageType, $id);
            $stmt->send_long_data(3, $imgContent);
            if ($stmt->execute()) {
              
                header("Location: manage_products.php?status=success");
                exit;
            } else {
                echo "Execution failed: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Prepare failed: " . $con->error;
        }

    } else {
        // No image uploaded — update everything else
        $stmt = $con->prepare("UPDATE products SET service_name=?, description=?, price=? WHERE id=?");
        if ($stmt) {
            $stmt->bind_param("ssdi", $service_name, $description, $price,  $id);
            if ($stmt->execute()) {
             
                header("Location: manage_products.php?status=success");
                exit;
            } else {
                echo "Execution failed: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Prepare failed: " . $con->error;
        }
    }
} else {
    echo "Missing required fields.";
}
?>
