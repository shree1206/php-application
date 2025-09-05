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
    <?php require_once __DIR__ . '/customerPortal/business/addBusinessDetails'; ?>
<?php else: ?>
    <div class="alert alert-success mt-4">
        You have already registered your business! You can view or edit your details.
    </div>

    <div class="container d-flex justify-content-center align-items-center">
        <div class="card shadow-sm" style="width: 100%; max-width: 400px;">
            <div class="card-body">
                <h5 class="card-title text-center">Business Information</h5>

                <div id="loader" class="text-center my-4" style="display: none;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>

                <div id="business-data" class="list-group list-group-flush" style="display: none;">
                    <div class="list-group-item"><strong>Name:</strong> <span id="name"></span></div>
                    <div class="list-group-item"><strong>Business Name:</strong> <span id="business-name"></span></div>
                    <div class="list-group-item"><strong>Contact Number:</strong> <span id="contact-number"></span></div>
                    <div class="list-group-item"><strong>Category:</strong> <span id="category"></span></div>
                    <div class="list-group-item"><strong>Address:</strong> <span id="address"></span></div>
                    <div class="list-group-item"><strong>Status:</strong> <span id="status"></span></div>
                </div>
            </div>
        </div>
    </div>
    <script src="/application/js/view_business_ajax.js"></script>
<?php endif; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>