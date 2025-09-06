<?php
ob_start();
require_once __DIR__ . '/../../includes/connection.php';

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest' && $_SERVER["REQUEST_METHOD"] == "GET" && isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['role']) && $_SESSION['role'] == 1) {

    if ($_SESSION['loggedin'] === true) {
        // Get sorting and pagination parameters from URL
        $sort_by = $_GET['sort_by'] ?? 'categories_name';
        $order = $_GET['order'] ?? 'ASC';
        $page = (int) ($_GET['page'] ?? 1);
        $limit = 10; // Number of items per page
        $offset = ($page - 1) * $limit;

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

        // First query to get the total number of records
        $countSql = "SELECT COUNT(*) AS total_records FROM categories";
        $countResult = $db3->query($countSql);
        $totalRecords = $countResult->fetch_assoc()['total_records'];

        // Second query to get the paginated and sorted data
        $sql = "SELECT categories_name, categories_created_at, categories_updated_at 
        FROM categories 
        ORDER BY " . $db3->real_escape_string($sort_by) . " " . $db3->real_escape_string($order) . " 
        LIMIT ? OFFSET ?";
        $stmt = $db3->prepare($sql);
        $stmt->bind_param("ii", $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();

        $categories = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }
        }

        $stmt->close();
        $db3->close();

        echo json_encode([
            'data' => $categories,
            'total_records' => $totalRecords,
            'current_page' => $page,
            'total_pages' => ceil($totalRecords / $limit)
        ]);
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