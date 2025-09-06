<?php require_once __DIR__ . '/../../includes/connection.php'; ?>

<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['role']) && $_SESSION['role'] == 1): ?>
    <?php if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        // The request is an AJAX call, so proceed with the file logic
        echo "Show Contacts";
    } else {
        header("location: ./../../logout");
        exit;
    }
?>
<?php else:
    header("location: ./../../logout");
    exit; ?>
<?php endif; ?>