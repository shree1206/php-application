<?php
ob_start();
require_once __DIR__ . '/../includes/connection.php';

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest' && $_SERVER["REQUEST_METHOD"] == "GET") {

    // Check if user is logged in and has the correct role
    if (isset($_SESSION['id']) && $_SESSION['role'] == 2 && isset($_SESSION['prefixed_user_id'])) {

        $userId = $_SESSION['id'];
        $prefixed_user_id = $_SESSION['prefixed_user_id'];

        $db2 = connectToDatabase('user_data');
        if ($db2 === null) {
            echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
            exit;
        }

        $sql = "SELECT * FROM businesses WHERE fk_user_id = ?";
        $stmt = $db2->prepare($sql);

        if ($stmt === false) {
            echo json_encode(['success' => false, 'message' => 'Failed to prepare statement.']);
            $db2->close();
            exit;
        }

        $stmt->bind_param("i", $prefixed_user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            echo json_encode(['success' => true, 'data' => $data]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No business data found.']);
        }

        $stmt->close();
        $db2->close();

    } else {
        echo json_encode(['success' => false, 'message' => 'Unauthorized access.']);
    }
    header('Content-Type: application/json');
    ob_end_flush();
    exit;
}
?>