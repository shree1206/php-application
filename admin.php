<?php
require_once __DIR__ . '/includes/connection.php';
// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: logout");
    exit;
} else {
    if (isset($_SESSION['role']) && $_SESSION['role'] == 2) {
        header("location: logout");
        exit;
    }
}
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/footer.php';
?>