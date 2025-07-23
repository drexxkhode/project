<?php
session_start();
require_once 'db.php'; // DB connection

if (
    isset($_POST['id'], $_POST['username'], $_POST['fullname'], $_POST['email'], $_POST['role'])
) {
    $id = (int) $_POST['id'];
    $username = trim($_POST['username']);
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $role = trim($_POST['role']);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        exit("Invalid email format.");
    }

    // Check if a new image was uploaded
    $imageUpdated = isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK;

    if ($imageUpdated) {
        $imageTmp = $_FILES['image']['tmp_name'];
        $imageSize = $_FILES['image']['size'];
        $imageType = mime_content_type($imageTmp);
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $maxSize = 2 * 1024 * 1024; // 2MB

        // Validate image
        if (!in_array($imageType, $allowedTypes)) {
            exit("Only JPG, PNG, WEBP and GIF files are allowed.");
        }

        if ($imageSize > $maxSize) {
            exit("Image must be less than 2MB.");
        }

        $imgContent = file_get_contents($imageTmp);

        // Update including image
        $stmt = $con->prepare("UPDATE users SET username=?, fullname=?, email=?, role=?, image_data=?, image_type=? WHERE id=?");
        if ($stmt) {
            $null = null;
            $stmt->bind_param("ssssbsi", $username, $fullname, $email, $role, $null, $imageType, $id);
            $stmt->send_long_data(4, $imgContent);
            if ($stmt->execute()) {
                // ✅ Update session with new image
                $_SESSION['image_data'] = $imgContent;
                $_SESSION['image_type'] = $imageType;

                // Optionally update other session fields if needed
                $_SESSION['username'] = $username;
                $_SESSION['fullname'] = $fullname;
                $_SESSION['email'] = $email;
                $_SESSION['role'] = $role;

                header("Location: users_home.php?status=success");
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
        $stmt = $con->prepare("UPDATE users SET username=?, fullname=?, email=?, role=? WHERE id=?");
        if ($stmt) {
            $stmt->bind_param("ssssi", $username, $fullname, $email, $role, $id);
            if ($stmt->execute()) {
                // ✅ Update session fields (excluding image)
                $_SESSION['username'] = $username;
                $_SESSION['fullname'] = $fullname;
                $_SESSION['email'] = $email;
                $_SESSION['role'] = $role;

                header("Location: users_home.php?status=success");
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
