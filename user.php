<?php
// Include your database connection file
require_once __DIR__ . '/includes/connection.php';

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: logout");
    exit;
} else {
    if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
        header("location: logout");
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
<?php if (!$hasBusinessData['dataFound']): ?>
    <?php require_once __DIR__ . '/customerPortal/business/addBusinessDetails.php'; ?>
<?php else: ?>
    <style>
        .waving-boy-container {
            /* Screen ke bottom-right mein fix karta hai */
            position: fixed;
            right: 20px;
            bottom: 0;
            height: 200px;
            width: 400px;
            overflow: hidden;
            z-index: 1000;
            text-align: center;
        }

        .waving-boy-container img {
            width: 50%;
            height: auto;
        }

        @media (max-width: 768px) {
            .waving-boy-container {
                bottom: 0px;
                height: 200px;
                width: 130px;
                right: 10px;
            }

            .waving-boy-container img {
                bottom: 0px;
                /* Chota karne ke liye size kam karein */
                height: 200px;
                width: 130px;
                right: 10px;
            }

            .contact-us-text {
                position: absolute;
                bottom: 2px;
                left: 70%;
                transform: translateX(-50%);
                background-color: red;
                color: white;
                padding: 12px 15px;
                border-radius: 20px;
                /* font-size: 14px; */
                white-space: nowrap;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            }
        }

        .contact-us-text {
            position: absolute;
            bottom: 2px;
            left: 41%;
            background-color: darkred;
            color: white;
            padding: 12px 15px;
            border-radius: 20px;
            white-space: nowrap;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
    </style>
    <div class="alert alert-success mt-4">
        You have already registered your business! You can view or edit your details.
    </div>

    <div class="container d-flex justify-content-center align-items-center">
        <div class="card shadow-sm" style="width: 100%; max-width: 400px;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">Business Information</h5>
                    <a href="<?php echo BASE_URL; ?>/customerportal/business/edit_business"
                        class="btn btn-sm btn-outline-secondary">
                        <i class="fa fa-pencil"></i> Edit
                    </a>
                </div>

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
    <div class="waving-boy-container">
        <img src="/application/gif/phone.gif" alt="Waving Boy">

        <div class="contact-us-text">
            Contact Us
        </div>
    </div>
    <script src="/application/js/view_business_ajax.js"></script>
<?php endif; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>