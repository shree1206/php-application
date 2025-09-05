<?php
// Include the database connection and Composer's autoloader
require_once __DIR__ . '/includes/connection.php';
// Check if the user is already logged in, then redirect to the welcome page
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("location: welcome");
    exit;
}
?>
<?php require_once __DIR__ . '/includes/header.php'; ?>
<div class="container-fluid d-flex justify-content-center align-items-center" style="margin-top: 12px;">
    <div class="card shadow p-4" style="width: 100%; max-width: 450px;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Forgot Password</h2>
            <div id="message" class="mt-3 alert alert-danger alert-dismissible fade show" role="alert"
                style="display: none;">
                <span id="message-text"></span>
            </div>
            <form id="forgotPasswordForm" method="post" autocomplete="off">
                <div class="mb-3">
                    <label for="email_or_username" class="form-label">Enter Email or Username:</label>
                    <input type="text" id="email_or_username" name="email_or_username" class="form-control">
                </div>
                <div class="d-grid">
                    <button type="submit" id="forgotBtn" class="btn btn-primary">Send Reset Link</button>
                </div>
            </form>
            <p class="text-center mt-3">
                Already have an account? <a href="<?php echo BASE_URL; ?>/login">Login here</a>
            </p>
            <div id="loader" class="text-center mt-3" style="display:none;">Loading...</div>
        </div>
    </div>
</div>
<script src="/application/js/forgot_password_ajax.js"></script>
<?php require_once __DIR__ . '/includes/footer.php'; ?>