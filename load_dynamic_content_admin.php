<?php
ob_start();
require_once __DIR__ . '/includes/connection.php';

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest' && $_SERVER["REQUEST_METHOD"] == "GET" && isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Define a base path to restrict file access
    $base_path = $_SERVER['DOCUMENT_ROOT'] . '/application/adminPortal/';

    // Get the requested file path from the URL
    $file_path = $_GET['file'] ?? '';

    // Sanitize and validate the path to prevent directory traversal attacks
    if (strpos($file_path, '/application/adminPortal/') === 0 && file_exists($base_path . substr($file_path, strlen('/application/adminPortal/')))) {
        // Correctly build the path and include the file
        require_once $base_path . substr($file_path, strlen('/application/adminPortal/'));
    } else {
        // Send a 403 Forbidden status code for invalid requests
        http_response_code(403);
        header("location: ./logout");
        exit;
    }
} else {
    http_response_code(403);
    header("location: ./logout");
    exit;
}
