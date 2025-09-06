<?php
ob_start();
require_once __DIR__ . '/../../includes/connection.php';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['role']) && $_SESSION['role'] == 1) {

    if ($_SESSION['loggedin'] === true) {
        // Get sorting parameters from URL
        $sort_by = $_GET['sort_by'] ?? 'categories_name';
        $order = $_GET['order'] ?? 'ASC';

        // Validate sorting parameters to prevent SQL injection
        $allowed_columns = ['categories_name', 'categories_created_at', 'categories_updated_at'];
        $allowed_order = ['ASC', 'DESC'];

        if (!in_array($sort_by, $allowed_columns) || !in_array(strtoupper($order), $allowed_order)) {
            $sort_by = 'categories_name';
            $order = 'ASC';
        }

        $db3 = connectToDatabase('admin-application');
        if ($db3 === null) {
            echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
            exit;
        }

        $sql = "SELECT categories_name, categories_created_at, categories_updated_at FROM categories ORDER BY " . $db3->real_escape_string($sort_by) . " " . $db3->real_escape_string($order);
        $result = $db3->query($sql);

        $categories = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }
        }

        $db3->close();

        echo json_encode(['data' => $categories]);
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