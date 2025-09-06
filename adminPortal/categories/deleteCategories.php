<?php require_once __DIR__ . '/../../includes/connection.php'; ?>

<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['role']) && $_SESSION['role'] == 1): ?>
    <?php if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'): ?>





    <?php else:
        header("location: ./../../logout");
        exit; ?>
    <?php endif; ?>
<?php else:
    header("location: ./../../logout");
    exit; ?>
<?php endif; ?>