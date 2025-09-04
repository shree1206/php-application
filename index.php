<?php
session_start();
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/header.php';

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
    print ($role);
}

require_once __DIR__ . '/includes/footer.php';
?>