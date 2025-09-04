<?php
session_start();
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/header.php';
define('APP_INIT', true);
// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    include_once __DIR__ . '/home.php';
    exit;
} else {
    if (isset($_SESSION['role']) && $_SESSION['role'] == 2) {
        header("location: user");
        exit;
    } else {
        header("location: admin");
        exit;
    }
}

require_once __DIR__ . '/includes/footer.php';
?>