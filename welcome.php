<?php
require_once __DIR__ . '/includes/connection.php';

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login");
    exit;
}

// Redirect based on the user's role
switch ($_SESSION['role']) {
    case 1:
        // Redirect to admin dashboard if role is 1
        header("location: admin");
        exit;
    case 2:
        // Redirect to user dashboard if role is 2
        header("location: user");
        exit;
    default:
        // Default redirect for an unknown role
        header("location: login");
        exit;
}

?>