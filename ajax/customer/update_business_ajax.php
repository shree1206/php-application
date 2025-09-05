<?php
ob_start();
require_once __DIR__ . '/../../includes/connection.php';

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest' && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $business_name = $_POST['business_name'];
        $full_name = $_POST['user_name'];
        $contact_number = $_POST['contact_number'];
        $category = $_POST['category'];
        $address = $_POST['address'];
        $username = $_SESSION['username'];
        $userrole = $_SESSION['role'];
        $userID = $_SESSION['id'];
        $prefixed_user_id = $_SESSION['prefixed_user_id'];

        if (empty($business_name) || empty($contact_number) || empty($category) || empty($address) || empty($full_name)) {
            echo json_encode(['success' => false, 'message' => 'All fields are required.']);
            exit;
        }

        $db1 = connectToDatabase('user_auth');
        if ($db1 === null) {
            echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
            exit;
        }

        $sql_verify = "SELECT id FROM users WHERE username = ? AND prefixed_user_id = ?";
        $stmt_verify = $db1->prepare($sql_verify);
        $stmt_verify->bind_param("ss", $username, $prefixed_user_id);
        $stmt_verify->execute();
        $result = $stmt_verify->get_result();

        if ($result->num_rows === 0) {
            echo json_encode(['success' => false, 'message' => 'User not found.']);
            $stmt_verify->close();
            $db1->close();
            exit;
        }

        $stmt_verify->close();


        $db2 = connectToDatabase('user_data');
        if ($db2 === null) {
            echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
            exit;
        }

        $updated_at = date('Y-m-d H:i:s');
        $sql_update = "UPDATE businesses SET business_name = ?, contact_number = ?, category = ?, address = ?, updated_at = ?, full_name = ? WHERE fk_user_id = ?";
        $stmt_update = $db2->prepare($sql_update);

        if ($stmt_update === false) {
            echo json_encode(['success' => false, 'message' => 'Error preparing update statement.']);
            $db2->close();
            exit;
        }

        $stmt_update->bind_param("sssssss", $business_name, $contact_number, $category, $address, $updated_at, $full_name, $prefixed_user_id);

        if ($stmt_update->execute()) {
            echo json_encode(['success' => true, 'message' => 'Data updated successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Something went wrong.']);
        }

        $stmt_update->close();
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