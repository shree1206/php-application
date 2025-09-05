<?php
// Include your database connection file
require_once __DIR__ . '/includes/connection.php';

// Check if the user is already logged in, then redirect to the welcome page
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("location: welcome");
    exit;
}
?>

<?php require_once __DIR__ . '/includes/header.php'; ?>
<div class="container d-flex justify-content-center align-items-center" style="margin-top: 12px;">
    <div class="card p-4 shadow-sm" style="width: 100%; max-width: 400px;">
        <div class="card-body">
            <h2 class="card-title text-center">Login</h2>
            <form id="loginForm" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" id="loginBtn" class="btn btn-primary">Login</button>
                </div>
            </form>
            <p class="text-center mt-3">
                Forgot Password? <a href="<?php echo BASE_URL; ?>/forgot_password">Click Here</a>
            </p>
            <div id="loader" class="text-center mt-3" style="display:none;">Loading...</div>
            <div id="message" class="mt-3"></div>
        </div>
    </div>
</div>
<script src="/application/js/login_ajax.js"></script>
<?php require_once __DIR__ . '/includes/footer.php'; ?>