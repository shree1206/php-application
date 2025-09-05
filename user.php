<?php
// Include your database connection file
require_once __DIR__ . '/includes/connection.php';

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login");
    exit;
} else {
    if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
        header("location: admin");
        exit;
    }
}
?>
<?php
require_once __DIR__ . '/includes/header.php';
define('INSIDE_APP', true);
require_once __DIR__ . '/includes/check_business_data.php';
$hasBusinessData = hasBusinessData();
?>
<?php if (!$hasBusinessData): ?>
    <?php require_once __DIR__ . '/customerPortal/business/addBusinessDetails.php'; ?>
<?php else: ?>
    <div class="alert alert-success mt-4">
        You have already registered your business! You can view or edit your details.
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>