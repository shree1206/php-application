<?php require_once __DIR__ . '/../../includes/connection.php'; ?>

<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['role']) && $_SESSION['role'] == 1): ?>
    <?php
    require_once __DIR__ . '/../../includes/header.php'; ?>
<?php else:
    header("location: ./../../logout");
    exit; ?>
<?php endif; ?>
<?php require_once __DIR__ . '/../../includes/footer.php'; ?>