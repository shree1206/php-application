<?php
ob_start();
require_once __DIR__ . '/../../includes/connection.php';

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest' && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['role']) && $_SESSION['role'] == 1) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $category_name = $_POST['category_name'] ?? '';

        if (empty($category_name)) {
            echo json_encode(['success' => false, 'message' => 'All fields are required.']);
            exit;
        }

        // Check if a file was uploaded
        if (!isset($_FILES['category_image']) || $_FILES['category_image']['error'] !== UPLOAD_ERR_OK) {
            echo json_encode(['success' => false, 'message' => 'No file uploaded or upload error.']);
            exit;
        }

        $db3 = connectToDatabase('admin-application');
        if ($db3 === null) {
            echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
            exit;
        }


        $file_info = $_FILES['category_image'];
        $target_dir = "../../images/"; // Root directory images folder
        $image_name = basename($file_info["name"]);
        $target_file = $target_dir . $image_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image
        $check = getimagesize($file_info["tmp_name"]);
        if ($check === false) {
            echo json_encode(['success' => false, 'message' => 'File is not an image.']);
            $db3->close();
            exit;
        }

        // Move the uploaded file to the target directory
        if (!move_uploaded_file($file_info["tmp_name"], $target_file)) {
            echo json_encode(['success' => false, 'message' => 'Failed to move uploaded file.']);
            $db3->close();
            exit;
        }

        // Insert data into the database
        $sql = "INSERT INTO categories (categories_name, categories_img_url) VALUES (?, ?)";
        $stmt = $db3->prepare($sql);
        if ($stmt === false) {
            echo json_encode(['success' => false, 'message' => 'Prepare failed: ' . $db3->error]);
            $db3->close();
            exit;
        }

        $stmt->bind_param("ss", $category_name, $image_name);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Category and image uploaded successfully!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Execution failed: ' . $stmt->error]);
        }

        $stmt->close();
        $db3->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    }
    header('Content-Type: application/json');
    ob_end_flush();
    exit;
} else {
    header("Location: ../index.php");
    exit;
}
?>