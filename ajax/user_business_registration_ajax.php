<?php
ob_start();

require_once __DIR__ . '/../includes/connection.php';

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest' && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $full_name = $_POST['full_name'];
        $business_name = $_POST['business_name'];
        $contact_number = $_POST['contact_number'];
        $category = $_POST['category'];
        $address = $_POST['address'];
        $user_id = $_SESSION['id'];
        $fk_user_id = $_SESSION['prefixed_user_id'];


        if (empty($full_name) || empty($business_name) || empty($contact_number) || empty($category) || empty($address)) {
            echo json_encode(['success' => false, 'message' => 'All fields are required.']);
            exit;
        }

        $db2 = connectToDatabase('user_data');
        if ($db2 === null) {
            echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
            exit;
        }

        $sql = "INSERT INTO businesses (full_name, business_name, contact_number, category, address, fk_user_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $db2->prepare($sql);

        if ($stmt === false) {
            echo json_encode(['success' => false, 'message' => 'Error preparing statement.']);
            $db2->close();
            exit;
        }

        $stmt->bind_param("ssssss", $full_name, $business_name, $contact_number, $category, $address, $fk_user_id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Data Saved successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Something went wrong.']);
        }
        $stmt->close();
        $db2->close();
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